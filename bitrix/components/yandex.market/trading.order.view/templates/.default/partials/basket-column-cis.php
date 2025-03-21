<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { die(); }

use Yandex\Market\Data\Trading\MarkingRegistry;
use Yandex\Market\Data\TextString;
use Yandex\Market\Trading\Entity as TradingEntity;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Web\Json;

/** @var array $item */
/** @var array $basketItem */
/** @var string $column */
/** @var string $itemInputName */

$allowCisEdit = isset($arResult['ORDER_ACTIONS'][TradingEntity\Operation\Order::CIS]);

// internal cis

$internalCis = array_filter(array_column($basketItem['INTERNAL_INSTANCES'], MarkingRegistry::UIN));
$internalType = MarkingRegistry::UIN;

if (empty($internalCis))
{
	$internalCis = array_filter(array_column($basketItem['INTERNAL_INSTANCES'], MarkingRegistry::CIS));
	$internalType = MarkingRegistry::CIS;
}

if (empty($internalCis) && !empty($basketItem['MARKING_TYPE']))
{
	$internalType = $basketItem['MARKING_TYPE'];
}

// -- internal cis

// types

$requiredTypes = $basketItem['INSTANCE_TYPES'];
$cisType = $internalType;
$cisTypeFixed = false;
$optionalTypes = [];

if (in_array(MarkingRegistry::CIS, $requiredTypes, true))
{
	$cisType = MarkingRegistry::CIS;
	$cisTypeFixed = true;
}
else if (in_array(MarkingRegistry::CIS_OPTIONAL, $requiredTypes, true))
{
	$cisType = MarkingRegistry::CIS;
	$cisTypeFixed = true;

	$requiredTypes = array_diff($requiredTypes, [MarkingRegistry::CIS_OPTIONAL]);
	$requiredTypes[] = MarkingRegistry::CIS;

	$optionalTypes[] = MarkingRegistry::CIS;
}
else if (in_array(MarkingRegistry::UIN, $requiredTypes, true))
{
	$cisType = MarkingRegistry::UIN;
	$cisTypeFixed = true;
}
else if (!empty($basketItem['MARKING_GROUP']))
{
	$instancesUin = array_filter(array_column($basketItem['INSTANCES'], MarkingRegistry::UIN));
	$instancesCis = array_filter(array_column($basketItem['INSTANCES'], MarkingRegistry::CIS));

	if (!empty($instancesUin))
	{
		$cisType = MarkingRegistry::UIN;
	}
	else if (!empty($instancesCis))
	{
		$cisType = MarkingRegistry::CIS;
	}

	$requiredTypes[] = MarkingRegistry::CIS;
}

uasort($requiredTypes, static function($a, $b) {
	$typesSort = [
		MarkingRegistry::CIS => 1,
		MarkingRegistry::UIN => 2,
		MarkingRegistry::RNPT => 3,
		MarkingRegistry::GTD => 4,
	];
	$aSort = isset($typesSort[$a]) ? $typesSort[$a] : 10;
	$bSort = isset($typesSort[$b]) ? $typesSort[$b] : 10;

	if ($aSort === $bSort) { return 0; }

	return ($aSort < $bSort ? -1 : 1);
});

// -- types

// copy data

$internalCopyData = [];

foreach ($basketItem['INTERNAL_INSTANCES'] as $index => $itemInstances)
{
	foreach ($itemInstances as $type => $code)
	{
		if (!$cisTypeFixed && $type === MarkingRegistry::UIN)
		{
			$type = MarkingRegistry::CIS;
		}

		if (!in_array($type, $requiredTypes, true)) { continue; }

		$internalCopyData[sprintf('[ITEMS][%s][%s]', $index, $type)] = $code;
	}
}

$hasInternalCis = !empty($internalCopyData);
$internalCopyData['TYPE'] = $internalType;

// -- copy data

// status

$filledCount = 0;
$optionalCount = 0;
$instanceIndex = 0;

foreach ($basketItem['INSTANCES'] as $itemInstances)
{
	if (!is_array($itemInstances)) { $itemInstances = []; }

	if ($instanceIndex < $item['OFFSET'] || $instanceIndex >= $item['COUNT'] + $item['OFFSET'])
	{
		++$instanceIndex;
		continue;
	}

	++$instanceIndex;

	$itemFilled = array_filter(array_intersect_key($itemInstances, array_flip($requiredTypes)));

	if (count($itemFilled) >= count($requiredTypes))
	{
		++$filledCount;
		++$optionalCount;
		continue;
	}

	$itemFilled += array_flip($optionalTypes);

	if (count($itemFilled) >= count($requiredTypes))
	{
		++$optionalCount;
	}
}

if ($filledCount >= $item['COUNT'])
{
	$itemCisStatus = 'READY';
}
else if ($optionalCount >= $item['COUNT'] || count(array_diff($requiredTypes, $optionalTypes)) === 0)
{
	$itemCisStatus = 'OPTIONAL';
}
else
{
	$itemCisStatus = 'WAIT';
}

// -- status

if (empty($requiredTypes))
{
	?>
	<td class="tal for--<?= TextString::toLower($column) ?>">&mdash;</td>
	<?php
}
else if (!$allowCisEdit)
{
	?>
	<td class="tal for--<?= TextString::toLower($column) ?>">
		<span class="yamarket-cis-summary is--disabled" data-status="<?= $itemCisStatus ?>"><?php
			echo Loc::getMessage('YANDEX_MARKET_T_TRADING_ORDER_VIEW_BASKET_ITEM_CIS_SUMMARY_' . $itemCisStatus) ?: $itemCisStatus;
		?></span>
	</td>
	<?php
}
else
{
	?>
	<td
		class="tal for--<?= TextString::toLower($column) ?> js-yamarket-basket-item__field"
		data-plugin="OrderView.BasketItemCisSummary"
		<?= $hasInternalCis ? sprintf("data-copy='%s'", Json::encode($internalCopyData)) : '' ?>
		<?= !empty($requiredTypes) ? sprintf('data-required-types="%s"', implode(',', $requiredTypes)) : '' ?>
		<?= !empty($optionalTypes) ? sprintf('data-optional-types="%s"', implode(',', $optionalTypes)) : '' ?>
		data-name="IDENTIFIERS"
		data-modal-width="<?= max(400, min(count($requiredTypes) * 300, 1200)) ?>"
		data-title="<?= htmlspecialcharsbx($basketItem['NAME']) ?>"
	>
		<input class="js-yamarket-basket-item__data is--persistent" type="hidden" name="<?= $itemInputName . '[IDENTIFIERS][INITIAL_COUNT]' ?>" value="<?= $filledCount ?>" data-name="[IDENTIFIERS][INITIAL_COUNT]" />
		<a class="yamarket-cis-summary js-yamarket-basket-item-cis__summary" href="#" data-status="<?= $itemCisStatus ?>"><?php
			echo Loc::getMessage('YANDEX_MARKET_T_TRADING_ORDER_VIEW_BASKET_ITEM_CIS_SUMMARY_' . $itemCisStatus) ?: $itemCisStatus;
		?></a>
		<?php
		if ($hasInternalCis && $allowCisEdit)
		{
			?>
			<button
				class="yamarket-copy-icon js-yamarket-basket-item-cis__summary-copy"
				type="button"
				title="<?= Loc::getMessage('YANDEX_MARKET_T_TRADING_ORDER_VIEW_BASKET_ITEM_CIS_COPY') ?>"
			>
				<?= Loc::getMessage('YANDEX_MARKET_T_TRADING_ORDER_VIEW_BASKET_ITEM_CIS_COPY') ?>
			</button>
			<?php
		}
		?>
		<div class="is--hidden js-yamarket-basket-item-cis__modal">
			<div class="js-yamarket-basket-item-cis__field" data-plugin="OrderView.BasketItemCis" data-name="ITEMS">
				<table class="yamarket-cis-table">
					<thead class="yamarket-cis-table__head">
						<td>&nbsp;</td>
						<?php
						foreach ($requiredTypes as $type)
						{
							echo '<td>' .  Loc::getMessage('YANDEX_MARKET_T_TRADING_ORDER_VIEW_BASKET_ITEM_CIS_HEAD_' . $type) . '</td>';
						}
						?>
					</thead>
					<?php

					$placeholders = [
						MarkingRegistry::RNPT => Loc::getMessage('YANDEX_MARKET_T_TRADING_ORDER_VIEW_BASKET_ITEM_CIS_PLACEHOLDER_RNPT'),
						MarkingRegistry::GTD => Loc::getMessage('YANDEX_MARKET_T_TRADING_ORDER_VIEW_BASKET_ITEM_CIS_PLACEHOLDER_GTD')
					];

					for ($markingIndex = 0; $markingIndex < $basketItem['COUNT']; ++$markingIndex)
					{
						$markingNumber = '&numero;' . ($markingIndex + 1);
						$enabled = ($markingIndex >= $item['OFFSET'] && $markingIndex < $item['OFFSET'] + $item['COUNT']);

						?>
						<tr class="js-yamarket-basket-item-cis__row <?= $enabled ? '' : 'is--hidden' ?>">
							<td class="yamarket-cis-table__number"><?= $markingNumber ?></td>
							<?php
							foreach ($requiredTypes as $type)
							{
								$inputName = sprintf($itemInputName . "[IDENTIFIERS][ITEMS][%s][$type]", $markingIndex);
								$value = isset($basketItem['INSTANCES'][$markingIndex][$type]) ? (string)$basketItem['INSTANCES'][$markingIndex][$type] : '';

								?>
								<td class="yamarket-cis-table__control type-count--<?= count($requiredTypes) ?>">
									<input
										class="yamarket-cis-table__input js-yamarket-basket-item-cis__input"
										type="text"
										name="<?= $inputName ?>"
										value="<?= htmlspecialcharsbx($value) ?>"
										<?= $allowCisEdit ? '' : 'readonly' ?>
										placeholder="<?= isset($placeholders[$type]) ? $placeholders[$type] : '' ?>"
										data-name="[ITEMS][<?= $markingIndex ?>][<?= $type ?>]"
										<?= $enabled ? '' : 'disabled' ?>
									/>
								</td>
								<?php
							}
							?>
						</tr>
						<?php
					}

					if ($cisTypeFixed)
					{
						?>
						<tr>
							<td colspan="<?= count($requiredTypes) + 1 ?>">
								<input class="js-yamarket-basket-item-cis__input" type="hidden" name="<?= $itemInputName . '[IDENTIFIERS][TYPE]' ?>" value="<?= $cisType ?>" data-name="TYPE" />
							</td>
						</tr>
						<?php
					}
					else if (in_array(MarkingRegistry::CIS, $requiredTypes, true))
					{
						$cisVariants = [
							MarkingRegistry::CIS,
							MarkingRegistry::UIN,
						];

						?>
						<tr>
							<td></td>
							<td class="yamarket-cis-table__type">
								<label class="yamarket-cis-table__type-label"><?= Loc::getMessage('YANDEX_MARKET_T_TRADING_ORDER_VIEW_BASKET_ITEM_CIS_TYPE') ?></label>
								<select class="yamarket-cis-table__type-value js-yamarket-basket-item-cis__input" name="<?= $itemInputName . '[IDENTIFIERS][TYPE]' ?>" data-name="TYPE">
									<?php
									foreach ($cisVariants as $typeVariant)
									{
										?>
										<option value="<?= $typeVariant ?>" <?= $typeVariant === $cisType ? 'selected' : '' ?>>
											<?= Loc::getMessage('YANDEX_MARKET_T_TRADING_ORDER_VIEW_BASKET_ITEM_CIS_TYPE_' . $typeVariant) ?>
										</option>
										<?php
									}
									?>
								</select>
							</td>
							<?php
							if (count($requiredTypes) > 1)
							{
								echo sprintf('<td colspan="%s"></td>', count($requiredTypes) - 1);
							}
							?>
						</tr>
						<?php
					}

					if ($hasInternalCis && $allowCisEdit)
					{
						?>
						<tr>
							<td></td>
							<td class="yamarket-cis-table__actions" colspan="<?= count($requiredTypes) ?>">
								<button class="yamarket-btn adm-btn js-yamarket-basket-item-cis__copy" type="button">
									<?= Loc::getMessage('YANDEX_MARKET_T_TRADING_ORDER_VIEW_BASKET_ITEM_CIS_COPY') ?>
								</button>
							</td>
						</tr>
						<?php
					}
					?>
				</table>
			</div>
		</div>
	</td>
	<?php
}
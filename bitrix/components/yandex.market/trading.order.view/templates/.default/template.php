<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { die(); }

use Yandex\Market;
use Yandex\Market\Ui\UserField\Helper;

/** @var CMain $APPLICATION */
/** @var array $arResult */

Market\Ui\Library::loadConditional('jquery');

Market\Ui\Assets::loadPluginCore();
Market\Ui\Assets::loadFieldsCore();
Market\Ui\Assets::loadPlugins([
	'lib.dialog',
	'lib.printdialog',
]);

Market\Ui\Assets::loadMessages([
	'PRINT_DIALOG_SUBMIT',
	'PRINT_DIALOG_WINDOW_BLOCKED',
]);

$blocks = [
	'PROPERTIES',
	'DELIVERY',
	'COURIER',
	'BUYER',
	'BOX',
];

?>
<div class="js-yamarket-order js-plugin" <?= Helper\Attributes::stringify([
	'id' => 'YAMARKET_ORDER_VIEW',
	'data-plugin' => 'OrderView.Order',
	'data-base-name' => 'YAMARKET_ORDER',
	'data-refresh-url' => $APPLICATION->GetCurPageParam(''),
]) ?>>
	<?php
	foreach ($blocks as $block)
	{
		if (empty($arResult[$block])) { continue; }

		include __DIR__ . '/partials/block-' . mb_strtolower($block) . '.php';
	}

	include __DIR__ . '/partials/actions.php';
	?>
</div>

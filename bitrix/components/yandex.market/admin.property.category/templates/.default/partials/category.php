<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) { die(); }

use Bitrix\Main\Localization\Loc;

/** @var array $arParams */

$copyTitle = Loc::getMessage('YANDEX_MARKET_CATEGORY_COMPONENT_COPY');
$parentCategory = !empty($arParams['PARENT_VALUE']['CATEGORY']) ? (string)$arParams['PARENT_VALUE']['CATEGORY'] : '';
$options = sprintf('<option value="">%s</option>', Loc::getMessage('YANDEX_MARKET_CATEGORY_COMPONENT_NO_VALUE'));

if (!empty($arParams['VALUE']['CATEGORY']))
{
	$options .= '<option selected>' . $arParams['VALUE']['CATEGORY'] . '</option>';
}

return <<<SELECT
    <div class="ym-category-origin" data-entity="category">
    	<input type="hidden" data-entity="parentCategory" value="{$parentCategory}" />
        <select class="ym-category-origin__control" name="{$arParams['CONTROL_NAME']}[CATEGORY]">{$options}</select>
        <button class="ym-category-origin__copy" type="button" title="{$copyTitle}" data-entity="copy">{$copyTitle}</button>
    </div>
SELECT;

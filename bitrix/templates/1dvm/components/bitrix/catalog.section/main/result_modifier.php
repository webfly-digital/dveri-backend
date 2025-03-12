<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arResult["PAGE_NOMER"]=$arResult["NAV_RESULT"]->NavPageNomer;//номер страницы
foreach ($arResult["ITEMS"] as $key => $arItem) {
    $pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>245, 'height'=>245), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["ITEMS"][$key]['PREVIEW_PICTURE']['SRC'] = $pic['src'];
}
<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arResult['SECTIONS'] = [];
$filter = ['IBLOCK_ID'=>$arParams['IBLOCK_ID'], 'ACTIVE'=>'Y', 'INCLUDE_SUBSECTIONS'];
$res = CIBlockSection::GetList(['SORT'=>'ASC'], $filter, false, ['ID','CODE','NAME','DESCRIPTION','DEPTH_LEVEL']);
while($arSection = $res->GetNext())
{
    $arSection['ITEMS'] = [];
    $arResult['SECTIONS'][$arSection['ID']] = $arSection;
}

foreach($arResult["ITEMS"] as $key => $arItem) {
    $arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = $arItem;
}


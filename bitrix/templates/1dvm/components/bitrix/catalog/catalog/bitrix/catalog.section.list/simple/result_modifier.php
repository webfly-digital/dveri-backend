<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//tree
foreach ($arResult["SECTIONS"] as $key => $section) {
    if (empty($section["IBLOCK_SECTION_ID"])) {
        $arResult['TREE_SECTIONS'][$section['ID']] = $section;
    } else {
        $arResult["TREE_SECTIONS"][$section['IBLOCK_SECTION_ID']]['CHILDS'][] = $section;
    }
}

$arResult["TREE_SECTIONS"];
<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($arResult["SECTION"]["PATH"])
    $sectionID = end($arResult["SECTION"]["PATH"])['ID'];
else
    $sectionID = 53;

// GET SECTION BY ID
$section = CIBlockSection::GetList(
    [], ['IBLOCK_ID' => $arParams["IBLOCK_ID"], "ID" => $sectionID, 'ACTIVE' => 'Y'], false,
    ['ID', 'NAME', "UF_*", "DETAIL_PICTURE", "PICTURE", "DESCRIPTION"]
)->Fetch();

$section['PICTURE'] = CFile::GetPath($section["PICTURE"]);

/* ADD SECTION EDIT BUTTON */
$arButtons = CIBlock::GetPanelButtons($arParams["IBLOCK_ID"], 0, $sectionID, ["SECTION_BUTTONS" => true]);
$section["EDIT_LINK"] = $arButtons["edit"]["edit_section"]["ACTION_URL"];

$select = ['ID', 'CODE', 'NAME', 'PREVIEW_TEXT'];
$filter = ['ID' => $section['UF_FAQ']];
$res = CIBlockElement::GetList([], $filter, false, false, $select);
while ($faq = $res->Fetch()) {
    $arResult['FAQ'][] = $faq;
}

$arResult['SECTION'] = $section;


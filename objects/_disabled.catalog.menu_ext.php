<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
$aMenuLinksExt = array();

$aMenuLinksExt = $APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
    "IS_SEF" => "Y",
    "SEF_BASE_URL" => "/",
    "SECTION_PAGE_URL" => "#SITE_DIR#/objects/#SECTION_CODE_PATH#/",
    "DETAIL_PAGE_URL" => "#SITE_DIR#/objects/#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
    "IBLOCK_TYPE" => 'objects',
    "IBLOCK_ID" => 21,
    "DEPTH_LEVEL" => "2",
    "CACHE_TYPE" => "A",
), false, Array('HIDE_ICONS' => 'Y'));

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>
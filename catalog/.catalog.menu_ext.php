<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

global $APPLICATION;
$aMenuLinksExt = array();

$aMenuLinksExt = $APPLICATION->IncludeComponent("webfly:menu.sections", "", array(
    "IS_SEF" => "Y",
    "SEF_BASE_URL" => "/",
    "SECTION_PAGE_URL" => "#SITE_DIR#/catalog/#SECTION_CODE_PATH#/",
    "DETAIL_PAGE_URL" => "#SITE_DIR#/catalog/#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
    "IBLOCK_TYPE" => 'catalog',
    "IBLOCK_ID" => 24,
    "DEPTH_LEVEL" => "4",
    "CACHE_TYPE" => "N",
), false, array('HIDE_ICONS' => 'Y'));

foreach ($aMenuLinksExt as $key => $sect) {
    $aMenuLinksExt[$key][1] = $sect[3]["DESCRIPTION"];
    $aMenuLinksExt[$key][2][0] = $sect[3]["DESCRIPTION"];
}

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);

?>
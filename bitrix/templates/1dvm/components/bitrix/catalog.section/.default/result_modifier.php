<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arResult["PAGE_NOMER"]=$arResult["NAV_RESULT"]->NavPageNomer;//номер страницы
foreach ($arResult["ITEMS"] as $key => $arItem) {
    $pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>245, 'height'=>245), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    $arResult["ITEMS"][$key]['PREVIEW_PICTURE']['SRC'] = $pic['src'];
}

global $USER;
if($USER->IsAdmin()){
   $subdomen =  CWebflyCities::GetSubDomain();
   $url = $subdomen.'.'.SITE_SERVER_NAME.$arResult["SECTION_PAGE_URL"];
   CModule::IncludeModule('iblock');

    $arSelect = array(
        "ID",
        "IBLOCK_ID",
        "NAME",
        "PROPERTY_WF_SEO_TEXT",
    );
    $arFilter = array("IBLOCK_CODE" => WF_SEO_IBLOCK, "ACTIVE" => "Y", "ACTIVE_DATE" => "Y", 'NAME' => $url);
    $res = CIBlockElement::GetList(array('NAME' => "ASC"), $arFilter, false, false, $arSelect);
    while ($ob = $res->GetNext()) {
        if(!empty($ob["PROPERTY_WF_SEO_TEXT_VALUE"])){
            $arResult["DESCRIPTION"] = '';
        }
    }
}
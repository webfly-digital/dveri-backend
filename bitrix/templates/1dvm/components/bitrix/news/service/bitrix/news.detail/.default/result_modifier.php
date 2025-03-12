<?
if ($arResult["DETAIL_TEXT"] and substr_count($arResult["DETAIL_TEXT"], "#GALLERY#")>0 and !empty($arResult["PROPERTIES"]["GALLERY"]["VALUE"]))
{
    $arResult["GALLERY"]="YES";
    $arResult["DETAIL_TEXT"] = explode ("#GALLERY#",$arResult["DETAIL_TEXT"]);
}
?>

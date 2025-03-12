<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if ($arResult["PROPERTIES"]["IMG"]["VALUE"])
{
    $arResult["PHOTOS"]=array();
    foreach ($arResult["PROPERTIES"]["IMG"]["VALUE"] as $img){
        $arResult["PHOTOS"][] = CFIle::ResizeImageGet($img, array("width"=>900,"height"=>600),BX_RESIZE_OMAGE_PROPORTIONAL,true);
    }
}
if ($arResult["PROPERTIES"]["VIDEO"]["VALUE"])
    $arResult["VIDEO"] = str_replace(array('https://www.youtube.com/watch?v=','http://www.youtube.com/watch?v='), '', $arResult["PROPERTIES"]["VIDEO"]["VALUE"]);
?>


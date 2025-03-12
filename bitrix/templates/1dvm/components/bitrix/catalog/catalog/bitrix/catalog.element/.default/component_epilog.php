<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$dbSectionTree = CIBlockSection::GetNavChain($arResult["IBLOCK_ID"], $arResult["IBLOCK_SECTION_ID"], array("ID", "CODE"));
$arPath = array();
while($arSTree = $dbSectionTree->Fetch()){
   $arPath[] = $arSTree["CODE"];
}
$sSectionPaths = implode("/",$arPath);
$arElem = CIBlockElement::GetList(array("ID" => "ASC"), array("ID" => $arResult["ID"]),false,false,array("CODE"))->Fetch();
$url = "/catalog/".$sSectionPaths."/".$arElem["CODE"]."/";
if($APPLICATION->GetCurDir() != $url){
   LocalRedirect($url, true, "301 Moved Permanently");
}
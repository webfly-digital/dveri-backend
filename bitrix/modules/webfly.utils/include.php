<?php
CModule::AddAutoloadClasses('webfly.utils', array(
    'CWebflyStrings' => 'classes/strings.php',
    'CWebflyUtility' => 'classes/utility.php',
    'CWeblfyIblocks' => 'classes/iblocks.php',
    'CWebflyHighLoadBlock' => 'classes/highloadblocks.php',
    'CWebflyCurrency' => 'classes/currency.php',
    'CWebflyHTML' => 'classes/utility.php',
    'CWebflyComment' => 'classes/entities/comment.php',
    'CWebflyEntity' => 'classes/entity.php'
));
/* shortcuts because legacy */
function wfDump($var, $die = false, $all = false){
    CWebflyUtility::dump($var,$die,$all);
}
function wfShowErrors(){
    CWebflyUtility::showErrors();
}
function wfRefreshArray($array){
    return CWebflyUtility::refreshArray($array);
}
function wfGetWeekDay($date){
    return CWebflyStrings::getWeekDay($date);
}
function wfAddToDate($params){
    return CWebflyStrings::addToDate($params);
}
function wfDiffDate($date1, $date2){
    return CWebflyStrings::diffDate($date1, $date2);
}
function wfGetPluralEnum($number, $text){
    return CWebflyStrings::getPluralEnum($number, $text);
}
function wfParseFileSize($bytes){
    return CWebflyStrings::parseSizeInBytes($bytes);
}
function wfInArray($needle,$haystack){
    return CWebflyUtility::inArray($needle, $haystack);
}
function wfIsImage($fileName){
    return CWebflyUtility::isImage($fileName);
}
function wfMakeTree($array){
    return CWebflyUtility::makeTree($array);
}
function wfMakeTreeEx($array,$prop){
    return CWebflyUtility::makeTreeEx($array,$prop);
}
function wfIBGetFirstElement($IBLOCK_ID, $fields = array(), $sort = array("SORT" => "ASC")){
    $arFilter = array("IBLOCK_ID" => $IBLOCK_ID, "ACTIVE" => "Y");
    return CWeblfyIblocks::getFirstElement($arFilter,$fields,$sort);
}
function wfIBGetAllElementsForMenu($IBLOCK_ID, $fields = array(), $limit = 0, $sort = array("SORT" => "ASC")){
    $arFilter = array("IBLOCK_ID" => $IBLOCK_ID, "ACTIVE" => "Y");
    return CWeblfyIblocks::getAllElementsForMenu($arFilter,$fields, $limit, $sort);
}
function wfIBSearchElementsByProp($IBLOCK_ID, $prop = array(), $fields = array(), $limit = 0, $sort = array("SORT" => "ASC")){
    $arFilter = array("IBLOCK_ID" => $IBLOCK_ID, "ACTIVE" => "Y");
    $arFilter = array_merge($arFilter,$prop);
    return CWeblfyIblocks::searchElementsByProp($arFilter,$fields,$limit,$sort);
}
function wfGetIBlockInfo($IBLOCK_ID, $filter = array()){
    $arFilter = array("ID" => $IBLOCK_ID);
    $arFilter = array_merge($arFilter,$filter);
    return CWeblfyIblocks::getIBlockInfo($arFilter);
}
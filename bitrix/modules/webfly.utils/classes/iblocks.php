<?php
CModule::IncludeModule("iblock");
IncludeModuleLangFile(__FILE__);
class CWeblfyIblocks{
  /**
  * First IB element by SORT => ASC
  * @param int $IBLOCK_ID IB index
  * @param array $fields array of additional fields to query ("ID", "NAME", "IBLOCK_ID", "CODE" avalable by default) 
  * @param array $sort array of additional fields for sorting
  * @return mixed result array or false
  * @version 0.2
  * @author aga <dev@webfly.pro>
  */
  public static function getFirstElement($arFilter = array("ACTIVE" => "Y"), $fields = array(), $sort = array("SORT" => "ASC")){
    $arOrder = $sort;
    $arSelect = array("ID","IBLOCK_ID","NAME","CODE");
    if(!empty($fields)) $arSelect = array_merge($arSelect, $fields);
    $arGroupBy = false;
    $elm = CIBlockElement::GetList($arOrder,$arFilter,$arGroupBy,false,$arSelect);
    $first = array();
    if($el = $elm->Fetch()){
      $first = array("CODE" => $el["CODE"]);
    }else return false;
    if(!empty($first)) return $first;
    else return false;
  }
  /**
   * Get all IB elements (for menu purposes mainly)
   * @param int/array $IBLOCK_ID  IB index (or indexes)
   * @param array $fields additional fields to query
   * @param int $limit query elements upper limit (0 - no limit)
   * @param array $sort array of fields for sorting (by default SORT => ASC)
   * @return array result array
   * @version 0.23
   * @author aga <dev@webfly.pro>
   */
   public static function getAllElementsForMenu($arFilter = array("ACTIVE" => "Y"), $fields = array(), $limit = 0, $sort = array("SORT" => "ASC")){
    $arOrder = $sort;
    $arSelect = array("ID","IBLOCK_ID","NAME","DETAIL_PAGE_URL");
    if(!empty($fields)) $arSelect = array_merge($arSelect, $fields);
    $arGroupBy = false;
    if($limit >0) $arNavStartParams = array("nTopCount" => $limit);
    else $arNavStartParams = false;
    $elm = CIBlockElement::GetList($arOrder,$arFilter,$arGroupBy,$arNavStartParams,$arSelect);
    $menu = array();
    while($el = $elm->GetNext()){
      $array = array("NAME" => $el["NAME"], "URL" => $el["DETAIL_PAGE_URL"], "ID" => $el["ID"]);
      if(in_array("PREVIEW_PICTURE",$fields)) $array["IMAGE_P"] = CFile::GetPath($el["PREVIEW_PICTURE"]);
      if(in_array("DETAIL_PICTURE",$fields)) $array["IMAGE_D"] = CFile::GetPath($el["DETAIL_PICTURE"]);
      foreach($fields as $value){
        if (substr_count($value,"PROPERTY_") > 0) $array[str_replace("PROPERTY_","",$value)] = $el[$value."_VALUE"];
        else $array[$value] = $el[$value];
      }
      $menu[] = $array;
    }
    return $menu;
  }

  /**
   * Search elements in IB
   * @param int/array $IBLOCK_ID index (indexes)
   * @param array $prop array of prop => value to filter
   * @param array $fields array of to select
   * @param int $limit query elements upper limit (0 - no limit)
   * @param array $sort sorting
   * @return boolean/array result of search
   * @version 0.24
   * @author aga <dev@webfly.pro>
   */
  public static function searchElementsByProp($arFilter = array("ACTIVE" => "Y"), $prop = array(), $fields = array(), $limit = 0, $sort = array("SORT" => "ASC")){
    if(empty($prop)) return false;
    $arOrder = $sort;
    $arSelect = array("ID","IBLOCK_ID","NAME","DETAIL_PAGE_URL", "PREVIEW_PICTURE", "PREVIEW_TEXT");
    if(!empty($fields)) $arSelect = array_merge($arSelect, $fields);
    $arGroupBy = false;
    if($limit >0) $arNavStartParams = array("nTopCount" => $limit);
    else $arNavStartParams = false;
    $elm = CIBlockElement::GetList($arOrder,$arFilter,$arGroupBy,$arNavStartParams,$arSelect);
    $result = array();
    while($el = $elm->GetNext()){
      $array = array("NAME" => $el["NAME"], "URL" => $el["DETAIL_PAGE_URL"], "ID" => $el["ID"], "TEXT" => $el["PREVIEW_TEXT"]);
      $array["IMAGE_P"] = CFile::GetPath($el["PREVIEW_PICTURE"]);
      foreach($fields as $value){
        if (substr_count($value,"PROPERTY_") > 0) $array[str_replace("PROPERTY_","",$value)] = $el[$value."_VALUE"];
        else $array[$value] = $el[$value];
      }
      $result[] = $array;
    }
    return $result;
  }
  /**
   * Get IB information
   * @param int/array $IBLOCK_ID index (indexes)
   * @param array $filter fields to filter
   * @return array info about IB
   * @version 0.1
   * @author aga <dev@webfly.pro>
   */
  public static function getIBlockInfo($arFilter, $arSort = array("SORT" => "ASC")){
    $res = CIBlock::GetList($arSort, $arFilter, true);
    $iblocks = array();
    while($ibInfo = $res->GetNext()){
      $iblocks[] = $ibInfo;
    }
    return $iblocks;
  }
}
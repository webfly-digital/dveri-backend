<?php
class CWebflyEntity{
    protected $entityId;
    protected $dataManager;
    protected $resizeOptions = array();
    /**
     * Cache times
     */
    const SECONDS_15MIN = 900;
    const SECONDS_HOUR = 3600;
    const SECONDS_DAY = 86400;
    const SECONDS_WEEK = 604800;
    const SECONDS_MONTH = 2592000;
    const SECONDS_YEAR = 31536000;
    /**
     * Cache paths
     */
    const CACHEPATH_ENTITY = "/entity/";
    /**
     * 
     * @param int $id
     */
    function __construct($id = false){
        if(!empty($id)){
        $this->entityId = intval($id);
        $this->dataManager = new CWebflyHighLoadBlock($this->entityId);
        }
    }
    /**
     * Gets data
     * @param array $select fields to select
     * @param array $filter where clause
     * @param array $order order by
     * @param int $limit
     * @param int $offset
     * @return type
     */
    public function getData($select = array("*"), $filter = array(), $order = array("ID" => "ASC"), $limit = 0, $offset = 0){
        return $this->dataManager->getData($select, $filter, $order, $limit, $offset);
    }
    /**
     * Gets row
     * @param array $select
     * @param array $filter
     * @param array $order
     * @return type
     */
    public function getRow($select = array("*"), $filter = array(), $order = array("ID" => "ASC")){
        return $this->dataManager->getRow($select, $filter, $order);
    }
    /**
     * Gets count
     * @param type $select
     * @param type $filter
     * @return type
     */
    public function getCount($select,$filter = array()){
        return $this->dataManager->getCount($select, $filter);
    }
    /**
     * Gets sum
     * @param array $select
     * @param array $filter
     * @param string $fieldToSum
     * @param string $fieldToGroup
     * @return type
     */
    public function getSum($select,$filter = array(),$fieldToSum = "*",$fieldToGroup){
        return $this->dataManager->getSum($select, $filter,$fieldToSum,$fieldToGroup);
    }
    /**
     * Gets entity properties
     * @param array $filter entity codes
     * @return array result
     */
    protected function getEntityPropertiesList($filter = array()) {
        $obCache = new CPHPCache();
        $cacheId = "entity" . $this->entityId . serialize($filter);
        $cachePath = self::CACHEPATH_ENTITY;
        if ($obCache->InitCache(self::SECONDS_WEEK, $cacheId, $cachePath)) {
            $vars = $obCache->GetVars();
            $propFields = $vars["ENTITYPROPS"];
        } else {
            $arFilter["ENTITY_ID"] = "HLBLOCK_" . $this->entityId;
            if(!empty($filter) && is_array($filter)) $arFilter = array_merge($arFilter,$filter);
            $rs = CUserTypeEntity::GetList(array("SORT" => "ASC"), $arFilter);
            $propFields = array();
            while ($ars = $rs->Fetch()) {
                if ($ars["USER_TYPE_ID"] == "enumeration") {
                    $ars["VALUES_LIST"] = $this->getsEnumPropList($ars["ID"]);
                }
                $propFields[$ars["FIELD_NAME"]] = $ars;
            }
            $obCache->StartDataCache(self::SECONDS_WEEK, $cacheId, $cachePath);
            $obCache->EndDataCache(array("ENTITYPROPS" => $propFields));
        }
        return $propFields;
    }
    /**
     * Gets enum property value list
     * @param int $propId index of property
     * @return type
     */
    protected function getsEnumPropList($propId) {
        $arr = array();
        $resEnum = CUserFieldEnum::GetList(array(), array("USER_FIELD_ID" => $propId));
        while ($aresEnum = $resEnum->Fetch()) {
            $arr[$aresEnum["ID"]] = $aresEnum["VALUE"];
        }
        return $arr;
    }
    /**
     * Basic format date operations
     * @param object $value
     * @return array
     */
    protected function getDateFormatted($value){
        $dateFormat = array("today" => "H:i, today", "yesterday" => "H:i, yesterday", "d" => "H:i, j F","" => "j F Y года в H:i");
        $arDate = array("UF_DATE" => $value->toString());
        $arDate["UF_FORMATTED_DATE_WOYEAR"] = strtolower(FormatDate("j F", MakeTimeStamp($arDate["UF_DATE"])));
        $arDate["UF_FORMATTED_DATE"] = strtolower(FormatDate("j F Y года", MakeTimeStamp($arDate["UF_DATE"])));
        $arDate["UF_FORMATTED_DATE_WTIME"] = strtolower(FormatDate($dateFormat, MakeTimeStamp($arDate["UF_DATE"])));
        return $arDate;
    }
    /**
     * Obsolete format date operations
     * @param object $value
     * @param string $fieldName
     * @return array
     */
    protected function getDateFormattedOld($value,$fieldName){
        $dateFormat = array("today" => "H:i, today", "yesterday" => "H:i, yesterday", "d" => "H:i, j F","" => "j F Y года в H:i");
        $arDate = array($fieldName => $value->toString());
        $arDate["UF_FORMATTED_DATE_WOYEAR"] = strtolower(FormatDate("j F", MakeTimeStamp($arDate[$fieldName])));
        $arDate["UF_FORMATTED_DATE"] = strtolower(FormatDate("j F Y года", MakeTimeStamp($arDate[$fieldName])));
        $arDate["UF_FORMATTED_DATE_WTIME"] = strtolower(FormatDate($dateFormat, MakeTimeStamp($arDate[$fieldName])));
        return $arDate;
    }
    /**
     * Adds new element (with logging)
     * @param array $arNew
     * @return type
     */
    public function addItem($arNew){
        $result = $this->dataManager->addRow($arNew);
        return $result;
    }
    /**
     * updates entity element
     * @param array $arUpdate
     * @return type
     */
    public function update($elemId,$arUpdate){
        $result = $this->dataManager->elemModify($elemId,$arUpdate);
        return $result;
    }
    /**
     * delete entity element
     * @param int $elemId
     * @return type
     */
    public function delete($elemId){
        return $this->dataManager->elemDelete($elemId);
    }
    /**
     * Gets files info
     * @param array $fileId
     * @return type
     */
    public function getFilesInfo($fileId){
        $newFiles = array();
        if(is_int($fileId) || is_string($fileId)) $fileId = array(intval($fileId));
        foreach ($fileId as $file) {
            $newFiles[$file] = CFile::GetByID($file)->Fetch();
            $newFiles[$file]["PATH"] = "/upload{$newFiles[$file]["SUBDIR"]}/{$newFiles[$file]["FILE_NAME"]}";
        }
        return $newFiles;
    }
    /**
     * Clears cahce
     */
    public function clearEntityCache(){
        $this->clearCachePath(self::CACHEPATH_ENTITY);
    }
    /**
     * Gets entity id
     * @return type
     */
    public function getEntityId(){
        return $this->entityId;
    }
    public function clearCachePath($path){
        BXClearCache(true,$path);
    }
    public function setResize($resize){
        $this->resizeOptions = $resize;
    }
}
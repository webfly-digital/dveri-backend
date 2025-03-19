<?
CModule::IncludeModule("highloadblock");
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

class CWebflyHighLoadBlock{
    private $hlBlockID = 0;
    private $hlHandler = null;
    public $errors = array();
    /**
     * Constructs an object
     * @param int $hlblockid hlblock id
     * @version 0.5
     */
    function __construct($hlblockid = 0){
        if($hlblockid >0){
            $this->setHLBlockId($hlblockid);
        }
    }
    /**
     * Sets HL block for CRUD
     * @param int $hlblockid as name suggests
     */
    public function setHLBlockId($hlblockid){
        $this->hlBlockID = $hlblockid;
        $hlblock = HL\HighloadBlockTable::getById($hlblockid)->fetch();
        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $this->hlHandler = $entity->getDataClass();
    }
    /**
     * Main method to add data
     * @param array $fields data fields
     * @return boolean
     */
    function addRow($fields){
        if(empty($fields)){
            $this->errors[] = "Can't add empty row!";
            return false;
        }else{
            $hlHandler = $this->hlHandler;
            $res = $hlHandler::add($fields);
            return $res->getId();
        }
    }
    /**
     * Modify
     * @param int $elemId elem id
     * @param array $data
     * @return array
     */
    function elemModify($elemId, $data){
        $hlHandler = $this->hlHandler;
        $res = $hlHandler::update($elemId,$data);
        return $res;
    }
    /**
     * Delete
     * @param int $elemId element id
     */
    function elemDelete($elemId){
        if(!empty($elemId)){
            $hlHandler = $this->hlHandler;
            $hlHandler::Delete($elemId);
        }
    }
    /**
     * Gets element
     * @param array $order
     * @param array $filter
     * @return array
     */
    function getQuery($select = array("*"),$filter = array(),$order = array("ID" => "ASC"), $group = array(),$limit = 0, $offset = 0,$runtime = array()){
        $hlHandler = $this->hlHandler;
        $getList = new Entity\Query($hlHandler);
        $getList->setSelect($select);
        $getList->setOrder($order);
        if(!empty($filter)) $getList->setFilter($filter);
        if(!empty($group)) $getList->setGroup($group);
        if(!empty($limit)) $getList->setLimit($limit);
        if(!empty($offset)) $getList->setOffset($offset);
        if(!empty($runtime)) $getList->registerRuntimeField($runtime);
        $result = $getList->exec();
        $result = new CDBResult($result);
        $arRes = array();
        while ($row = $result->Fetch()){
            $arRes[] = $row;
        }
        return $arRes;
    }
    /**
     * Gets all data in one fetch query
     * @param array $select fields to select
     * @param array $filter fields to filter
     * @param array $order as name suggests
     */
    function getData($select = array("*"),$filter = array(), $order = array("ID" => "ASC"), $limit = 0, $offset = 0){
        $hlHandler = $this->hlHandler;
        $arData = array(
              "select" => $select,
              "order" => $order,
              "filter" => $filter
        );
        if($limit > 0) $arData["limit"] = $limit;
        if($offset > 0) $arData["offset"] = $offset;
        $rsData = $hlHandler::getList($arData);
        return $rsData->fetchAll();
    }
    /**
     * Gets one row
     * @param type $select
     * @param type $filter
     * @param type $order
     */
    function getRow($select = array("*"),$filter = array(), $order = array("ID" => "ASC")){
        $hlHandler = $this->hlHandler;
        $arData = array(
            "select" => $select,
            "order" => $order,
            "filter" => $filter,
        );
        return $hlHandler::getRow($arData);
    }
    /**
     * Runs count expression with filter statement
     * @param array $filter as name suggests
     * @return type
     */
    function getCount($select, $filter = array()){
        $hlHandler = $this->hlHandler;
        $select[] = "CNT";
        $rsData = $hlHandler::getList(array(
            "select" => $select,
            "order" => array(),
            "filter" => $filter,
            "runtime" => array(new Entity\ExpressionField('CNT', 'COUNT(*)'))
        ));
        return $rsData->fetchAll();
    }
    /**
     * Runs sum expression with filter statement
     * @param array $select
     * @param array $filter
     * @param string $fieldToSum
     * @param string $fieldToGroup
     * @return type
     */
    function getSum($select, $filter = array(),$fieldToSum = "*", $fieldToGroup){
        $hlHandler = $this->hlHandler;
        $select[] = "SUM";
        $arQueryData = array(
            "select" => $select,
            "order" => array(),
            "filter" => $filter,
            "runtime" => array(new Entity\ExpressionField('SUM', 'SUM(%s)',"$fieldToSum"))
        );
        if(!empty($fieldToGroup)) $arQueryData["group"] = array("$fieldToGroup");
        $rsData = $hlHandler::getList($arQueryData);
        return $rsData->fetchAll();
    }
    /**
     * Gets hlblock id
     * @return int hlblock id
     */
    function getHLBlockID(){
        return $this->hlBlockID;
    }
    /**
     * Gets hl handler
     * @return object
     */
    function getHLHandler(){
        return $this->hlHandler;
    }
    /**
     * Gets table name
     * @return string
     */
    function getTableName(){
        $hlHandler = $this->hlHandler;
        return $hlHandler::getTableName();
    }
    /**
     * Gets HL Blocks list
     * @param type $select
     * @param type $filter
     * @return type
     */
    function getHLBlocksList($select = array("ID","NAME"), $filter = array()){
        $hlList = HL\HighloadBlockTable::getList(array("select" => $select, "filter" => $filter))->fetchAll();
        return $hlList;
    }
}
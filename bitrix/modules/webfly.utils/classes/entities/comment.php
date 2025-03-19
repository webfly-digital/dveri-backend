<?php
class CWebflyComment extends CWebflyEntity{
    const CACHEPATH = "/comment/";
    const CACHDEPATHDETAIL = "/comment/#ID#/";
    const WARE = 1;
    function __construct($id = 0){
        if(intval($id) <= 0){
            $id = 7;
        }
        parent::__construct($id);
    }
    function getComments($select = array("*"),$filter = array(),$order = array("ID" => "DESC"),$limit = 0,$offset = 0){
        $comments = $this->getData($select,$filter,$order,$limit,$offset);
        $bSelectAll = (bool)($select[0] == "*");
        if(!empty($comments)){
            foreach($comments as $key => $comment){
                if($bSelectAll || in_array("UF_DATE",$select)){
                    if(!empty($comment["UF_DATE"])){
                        $dateResult = $this->getDateFormatted($comment["UF_DATE"]);
                        $comments[$key] = array_merge($comments[$key],$dateResult);
                    }
                }
                if($bSelectAll || in_array("UF_TEXT",$select)){
                    if(!empty($comment["UF_TEXT"])){
                        $comments[$key]["UF_TEXT"] = preg_replace(WF_TEMPLATE_PCRE,'<a href="$1$2" target="_blank">$2</a>',$comment["UF_TEXT"]);
                    }
                }
            }
        }
        return $comments;
    }
    /**
     * Gets number of comments by group id
     * @param int $groupId
     * @return int
     */
    function getNumCommentsByGroup($groupId){
        $res = $this->getCount(array("UF_GROUP"),array("UF_GROUP" => $groupId));
        return $res[0]["CNT"];
    }
    /**
     * Update rating
     * @param int $commentId
     * @param array $rates
     */
    public function updateRating($commentId,$rates){
        $this->dataManager->elemModify($commentId,array("UF_RATING" => $rates));
    }
}
<?php
IncludeModuleLangFile(__FILE__);
class CWebflyStrings{
  /**
  * Get months' names (deprecated because of BX.FormatDate)
  * @link http://dev.1c-bitrix.ru/api_help/main/functions/date/formatdate.php formatdate
  * @param string $mnum month index
  * @param boolean $spawn months in genitive
  * @return string month name
  * @version 0.2
  * @deprecated since version 0.2
  * @author aga <dev@webfly.pro>
  */
 function getMonth($mnum, $spawn = false){
   //deprecated
   return ;
 }
 /** Get plural with units
 * @param int $number number
 * @param array/string $labels  plural forms of 1, 2 and 5, or text key in PLURALS with such
 * @return string result
 * @version 0.11
 * @author aga <dev@webfly.pro>
 */
 static function getPluralEnum($number, $text){
   if(!is_array($text)) $labels = explode("|",GetMessage("PLURALS_".$text));
   else $labels = $text;
   $variant = array (2, 0, 1, 1, 1, 2);
   return $number." ".$labels[ ($number%100 > 4 && $number%100 < 20)? 2 : $variant[min($number%10, 5)] ];
 }
 /**
  * Find day/hours/minutes difference between two dates
  * @param string $date1 start date
  * @param string $date2 end dates
  * @return array difference
  * @version 0.11 (9.09.2014)
  * @author aga <dev@webfly.pro>
  */
 static function diffDate($date1, $date2){
   $endDay = strtotime($date2);
   $startDay = strtotime($date1);
   $difference = $endDay - $startDay;
   $return['days'] = floor($difference / 86400);
   $return['hours'] = floor($difference / 3600) % 24;
   $return['minutes'] = floor($difference / 60) % 60;
   return $return;
 }
 /**
  * Return date with addition of days
  * @param array $params - array of parameters "DATE" - date to add in dd.mm.yyyy format
  *                                            "ADD" - value to add
  *                                            "TYPE" - type of value to add (days, weeks)
  * @return string new date
  * @version 0.2 (23.10.2014)
  * @author aga <dev@webfly.pro>
  */
  static function addToDate($params){
    $date = explode(".",$params["DATE"]);
    $add = $params["ADD"];
    switch($params["TYPE"]){
      case 'weeks':
        $newMult = 7*$add;
        break;
      case 'days':default:
        $newMult = $add;
    }
    $newsetDate = date("d.m.Y",mktime(0,0,0,$date[1],$date[0]+$newMult,$date[2]));
    return $newsetDate;
  }
  /**
  * Return weekday of date
  * @param string $date
  * @return int week day
  * @version 0.1 (16.08.2014)
  * @author aga <dev@webfly.pro>
  */
  static function getWeekDay($date){
    $date = explode(".",$date);
    $newDate = mktime(0, 0, 0, $date[1], $date[0], $date[2]);
    $weekday = date("w", $newDate);
    return $weekday == 0?$weekday:$weekday;
  }
  /**
   * File size in bytes
   * @param int $bytes
   * @return float size in kB|MB
   */
  static function parseSizeInBytes($bytes){
    $mibs = explode("|",GetMessage("MIBS"));
    $bytes = $bytes/1024;
    if($bytes > 1024){
      $bytes = round($bytes/1024,2)." ".$mibs[2];
    }else{
      $bytes = round($bytes,2)." ".$mibs[1];
    }
    return $bytes;
  }
}
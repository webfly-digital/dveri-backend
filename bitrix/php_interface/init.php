<?


use Bitrix\Main\Loader;

Loader::includeModule("webfly.utils");


$mediaLib = $_SERVER["DOCUMENT_ROOT"] . '/bitrix/php_interface/user_field/propiblockmedialib.php';
if (file_exists($mediaLib))
    include_once $mediaLib;

$wfHelp = $_SERVER["DOCUMENT_ROOT"] . '/bitrix/php_interface/include/functions/help.php';
if (file_exists($wfHelp))
    include_once $wfHelp;

$wfGeneral = $_SERVER["DOCUMENT_ROOT"] . '/bitrix/php_interface/include/functions/general.php';
if (file_exists($wfGeneral))
    include_once $wfGeneral;

$wfHandlers = $_SERVER["DOCUMENT_ROOT"] . '/bitrix/php_interface/include/functions/handlers.php';
if (file_exists($wfHandlers))
    include_once $wfHandlers;

$htmlType = $_SERVER["DOCUMENT_ROOT"] . '/bitrix/php_interface/user_type/usertypehtml.php';
if (file_exists($htmlType))
    include_once $htmlType;

//iblocks
define("WF_CATALOG",3);
define("WF_ADDITIONAL_COMPLECT",16);
define("WF_COLORS",17);
define("WF_DETAIL_UTP",18);


function wf_get_load_avg() {

    // get number of days from http://crm.ei-60.online/getload.php and cache

    $cache = new CPHPCache();
    $cache_time = 3600;
    $cache_id = 'crm_load_avg';
    $cache_path = '/'.SITE_ID.'/'.$cache_id;

    $obCache = new CPHPCache();
    if( $obCache->InitCache($cache_time, $cache_id, $cache_path) )
    {
        $value = $obCache->GetVars();
        //$value .= 'cache';
    }
    elseif( $obCache->StartDataCache()  )
    {
        $url = "http://crm.ei-60.online/getload.php";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $value = curl_exec($ch);
        $obCache->EndDataCache($value);
        //$value .= 'live';
    }
    if (intval($value) <= 0) $value = 10;
    return $value;
}

AddEventHandler("main", "OnEndBufferContent", array("Main", "set404"));
Class Main {
    static function set404(&$content) {
        $status = CHTTP::GetLastStatus();
        if ($status == "404 Not Found") {
            //delete maincontent
            //$rule = "/\<div id=\"maincontent\"\>(.|\n|\r)*\<\/div\>\<!--#maincontent close--\>/";
            //$replace = '';
            //$content = preg_replace($rule, $replace, $content);
            //stylish body
            //$rule = "/<body class=\"\s*\S*\s*\S*\s*\S*\">/";
            //$replace = '<body class="light-header">';
            //$content = preg_replace($rule, $replace, $content);
        }
    }

}


// https://dev.1c-bitrix.ru/community/webdev/user/1248769/blog/36218/
if (\Bitrix\Main\Loader::includeModule('iblock')) {
    \Bitrix\Main\EventManager::getInstance()->addEventHandler(
        "iblock", "OnTemplateGetFunctionClass",
        ["FunctionMinPriceSection", "eventHandler"]
    );
    //подключаем файл с определением класса FunctionBase
    include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/iblock/lib/template/functions/fabric.php");
    class FunctionMinPriceSection extends \Bitrix\Iblock\Template\Functions\FunctionBase
    {
        //Обработчик события на вход получает имя требуемой функции
        public static function eventHandler($event)
        {
            $parameters = $event->getParameters();
            $functionName = $parameters[0];
            if ($functionName === "minpricesection") {
                //обработчик должен вернуть SUCCESS и имя класса
                return new \Bitrix\Main\EventResult(
                    \Bitrix\Main\EventResult::SUCCESS,
                    "\\FunctionMinPriceSection"
                );
            }
        }
        public function onPrepareParameters(\Bitrix\Iblock\Template\Entity\Base $entity, array $parameters)
        {
            $arguments = [];
            // Перехватываем id элемента/раздела, чтобы можно было обращаться к его свойствам
            $this->data['id'] = $entity->getId();
            foreach ($parameters as $parameter) {
                $arguments[] = $parameter->process($entity);
            }
            return $arguments;
        }
        public function calculate($parameters)
        {
            \Bitrix\Main\Loader::includeModule("iblock");
            $sectionID = (!empty(reset($parameters)) ? reset($parameters) : $this->data['id']);
            $el = CIBlockElement::GetList(['PROPERTY_PRICE_N'=>'asc'],
                ['=SECTION_ID'=>$sectionID, 'INCLUDE_SUBSECTIONS'=>'Y'], false, false, ['PROPERTY_PRICE_N'])->fetch();
            return $el["PROPERTY_PRICE_N_VALUE"];
        }
    }
}
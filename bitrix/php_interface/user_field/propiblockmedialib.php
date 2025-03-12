<?
define("CMEDIALIB_IDFOR_NEWS",5);
class CUserPropMedialibCollection {
    public static function GetUserTypeDescription() {
        return array(
            "PROPERTY_TYPE" => "S",
            "USER_TYPE" => "MediaLibCollection",
            "DESCRIPTION" => "Привязка к медиаколлекции",
            "GetPropertyFieldHtml" => array(__CLASS__, "GetPropertyFieldHtml"),
            'ConvertToDB' => array(__CLASS__, 'ConvertToDB'),
            "GetPropertyFieldHtmlMulty" => array(__CLASS__, 'GetPropertyFieldHtmlMulty'),
            "GetAdminListViewHTML" => array(__CLASS__, "GetAdminListViewHTML"),
            "GetPublicViewHTML" => array(__CLASS__, "GetPublicViewHTML"),
            "GetAdminFilterHTML" => array(__CLASS__, 'GetAdminFilterHTML'),
            "GetSettingsHTML" => array(__CLASS__, 'GetSettingsHTML'),
            "PrepareSettings" => array(__CLASS__, 'PrepareSettings'),
            "AddFilterFields" => array(__CLASS__, 'AddFilterFields'),
        );
    }
    /**
     * Вызывается перед сохранением
     * @param type $arProperty
     * @param array $value
     * @return type
     */
    function ConvertToDB($arProperty, $value){
        $value['VALUE'] = intval($value['VALUE']);
        return $value;
    }
    /**
     * Построение списка в админке свойств инфоблока
     * @param type $arProperty
     * @param type $value
     * @param type $strHTMLControlName
     * @return string
     */
    static function GetPropertyFieldHtml($arProperty, $value, $strHTMLControlName) {
        $bWasSelect = false;
        $options = self::GetOptionsHtml($arProperty, array($value["VALUE"]), $bWasSelect);

        $html = '<select name="' . $strHTMLControlName["VALUE"] . '"' . $size . $width . '>';
        if ($arProperty["IS_REQUIRED"] != "Y")
          $html .= '<option value=""' . (!$bWasSelect ? ' selected' : '') . '>(нет)</option>';
        $html .= $options;
        $html .= '</select>';
        return $html;
    }
    function GetPropertyFieldHtmlMulty($arProperty, $value, $strHTMLControlName) {
        $max_n = 0;
        $values = array();
        if (is_array($value)) {
            foreach ($value as $property_value_id => $arValue) {
                  $values[$property_value_id] = $arValue["VALUE"];
                  if (preg_match("/^n(\\d+)$/", $property_value_id, $match)) {
                      if ($match[1] > $max_n)
                          $max_n = intval($match[1]);
                  }
            }
        }

        $bWasSelect = false;
        $options = self::GetOptionsHtml($arProperty, $values, $bWasSelect);

        $html = '<input type="hidden" name="' . $strHTMLControlName["VALUE"] . '[]" value="">';
        $html .= '<select multiple name="' . $strHTMLControlName["VALUE"] . '[]" size="6">';
        if ($arProperty["IS_REQUIRED"] != "Y")
            $html .= '<option value=""' . (!$bWasSelect ? ' selected' : '') . '>(нет)</option>';
        $html .= $options;
        $html .= '</select>';

        return $html;
    }
    /**
     * Получение значений для построения списка
     * @param type $arProperty
     * @param type $values
     * @param type $bWasSelect
     * @return string
     */
  static  function GetOptionsHtml($arProperty, $values, &$bWasSelect) {
        CModule::IncludeModule("fileman");
        CMedialib::Init();
        $collections = CMedialibCollection::GetList(array('arFilter' => array('ACTIVE' => 'Y')));
        $options = "";
        $bWasSelect = false;
        foreach($collections as $arItem) {
            $name = $arItem["NAME"];
            $options .= '<option value="' . $arItem["ID"] . '"';
            if (in_array($arItem["ID"], $values)) {
                $options .= ' selected';
                $bWasSelect = true;
            }
            $options .= '>[' . $arItem["ID"] . '] ' . $name . '</option>';
        }

        return $options;
    }
    /**
     * Для показа значений в списке элементов
     * @param array $arProperty массив данных свойства
     * @param array $arValue массив данных значения
     * @param str $strHTMLControlName название поля
     * @return string
     */
    public function GetAdminListViewHTML($arProperty, $arValue, $strHTMLControlName) {
        $strResult = '';

        if ($arValue['VALUE'] > 0) {
            $arCollection = CMedialibCollection::GetList(array('arFilter' => array('ACTIVE' => 'Y', 'ID' => $arValue['VALUE'])));
            if (!empty($arCollection)) {
                //p($arItem);
                $name = $arCollection['NAME'];
                $strResult = '[' . $arCollection["ID"] . ']'.$name;
            }
        }

        return $strResult;
    }
    /**
     * Показ выбранных значений в публичной части (DISPLAY_PROPERTIES)
     * @param array $arProperty массив данных свойств
     * @param array $arValue массив значения
     * @param string $strHTMLControlName строкове название свойства
     * @return boolean
     */
    public static function GetPublicViewHTML($arProperty, $arValue, $strHTMLControlName){
        CModule::IncludeModule("fileman");
        CMedialib::Init();
        $arResult = [];
        $photoResult = CMedialibItem::GetList(array('arCollections'=>array($arValue["VALUE"])));
        if(empty($photoResult)) return false;
        else{
            foreach($photoResult as $photo){
                $arResult[] = array("ID" => $photo["ID"], "ORIGINAL_NAME" => $photo["NAME"], "PATH" => $photo["PATH"], 
                    "THUMB_PATH" => $photo["THUMB_PATH"], "TYPE" => $photo["TYPE"], "HEIGHT" => $photo["HEIGHT"], "WIDTH" => $photo["WIDTH"]);
            }
            return $arResult;
        }
    }
    /*
    public function PrepareSettings($arFields)
    {

    }

    public function GetSettingsHTML($arFields,$strHTMLControlName, &$arPropertyFields)
    {

    }

    public function GetAdminFilterHTML($arProperty, $strHTMLControlName)
    {

    }

    public function AddFilterFields($arProperty, $strHTMLControlName, &$arFilter, &$filtered)
    {

    } */
}
AddEventHandler("iblock", "OnIBlockPropertyBuildList", array("CUserPropMedialibCollection", "GetUserTypeDescription"));
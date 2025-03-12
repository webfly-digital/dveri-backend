<?
class CUserTypeTextHTML extends \Bitrix\Main\UserField\Types\StringType {
    public static function GetUserTypeDescription(): array {
        return array(
            "USER_TYPE_ID" => "html",
            "CLASS_NAME" => "CUserTypeTextHTML",
            "DESCRIPTION" => "Текст/HTML",
            "BASE_TYPE" => "string",
        );
    }
    public static function getDbColumnType(): string{
        global $DB;
        switch (strtolower($DB->type)) {
            case "mysql":
                return "text";
            case "oracle":
                return "varchar2(12000 char)";
            case "mssql":
                return "varchar(12000)";
        }
    }
    public static function prepareSettings(array $arUserField): array{
        return array(
            "SIZE" => 120,
            "ROWS" => 25,
            "MIN_LENGTH" => 0,
            "MAX_LENGTH" => 0,
            "DEFAULT_VALUE" => $arUserField["SETTINGS"]["DEFAULT_VALUE"],
        );
    }
    public static function getSettingsHtml($arUserField, ?array $arHtmlControl, $bVarsFromForm): string {
        $result = '';
        if ($bVarsFromForm)
            $value = htmlspecialcharsbx($GLOBALS[$arHtmlControl["NAME"]]["DEFAULT_VALUE"]);
        elseif (is_array($arUserField))
            $value = htmlspecialcharsbx($arUserField["SETTINGS"]["DEFAULT_VALUE"]);
        else
            $value = "";
        $result .= '
		<tr>
			<td>' . GetMessage("USER_TYPE_STRING_DEFAULT_VALUE") . ':</td>
			<td>
				<input type="text" name="' . $arHtmlControl["NAME"] . '[DEFAULT_VALUE]" size="20"  maxlength="225" value="' . $value . '"/>
			</td>
		</tr>
		';

        return $result;
    }
    public static function getEditFormHtml(array $arUserField, ?array $arHtmlControl): string{
        if ($arUserField["ENTITY_VALUE_ID"] < 1 && strlen($arUserField["SETTINGS"]["DEFAULT_VALUE"]) > 0){
            $arHtmlControl["VALUE"] = htmlspecialcharsbx($arUserField["SETTINGS"]["DEFAULT_VALUE"]);
        }
        ob_start();
        CFileMan::AddHTMLEditorFrame(
            $arHtmlControl["NAME"], $arHtmlControl["VALUE"], "type", "html", array('height' => 300, 'width' => '100%'),
            "N", 0, "", "", false, true, false, array('hideTypeSelector' => false,)
        );
        $textarea = ob_get_clean();
        return $textarea;
    }
    public static function getFilterHtml(array $arUserField, ?array $arHtmlControl): string{
        return '<input type="text" name="' . $arHtmlControl["NAME"] . '" ' .
                'size="' . $arUserField["SETTINGS"]["SIZE"] . '" ' .
                'value="' . $arHtmlControl["VALUE"] . '"' .
                '>';
    }
    public static function getAdminListViewHtml(array $arUserField, ?array $arHtmlControl) {
        if (strlen($arHtmlControl["VALUE"]) > 0)
            return $arHtmlControl["VALUE"];
        else
            return '&nbsp;';
    }
    public static function getAdminListEditHTML(array $arUserField, ?array $arHtmlControl) {
            return '<textarea name="' . $arHtmlControl["NAME"] . '" cols="120" rows="25" ' .
                    ($arUserField["SETTINGS"]["MAX_LENGTH"] > 0 ? 'maxlength="' . $arUserField["SETTINGS"]["MAX_LENGTH"] . '" ' : '') .
                    '>' . $arHtmlControl["VALUE"] . '</textarea>';
    }
    public static function checkFields(array $arUserField, $value): array {
        $aMsg = array();
        if (strlen($value) < $arUserField["SETTINGS"]["MIN_LENGTH"]) {
            $aMsg[] = array(
                "id" => $arUserField["FIELD_NAME"],
                "text" => GetMessage("USER_TYPE_STRING_MIN_LEGTH_ERROR", array(
                    "#FIELD_NAME#" => $arUserField["EDIT_FORM_LABEL"],
                    "#MIN_LENGTH#" => $arUserField["SETTINGS"]["MIN_LENGTH"]
                        )
                ),
            );
        }
        if ($arUserField["SETTINGS"]["MAX_LENGTH"] > 0 && strlen($value) > $arUserField["SETTINGS"]["MAX_LENGTH"]) {
            $aMsg[] = array(
                "id" => $arUserField["FIELD_NAME"],
                "text" => GetMessage("USER_TYPE_STRING_MAX_LEGTH_ERROR", array(
                    "#FIELD_NAME#" => $arUserField["EDIT_FORM_LABEL"],
                    "#MAX_LENGTH#" => $arUserField["SETTINGS"]["MAX_LENGTH"]
                        )
                ),
            );
        }
        if (strlen($arUserField["SETTINGS"]["REGEXP"]) > 0 && !preg_match($arUserField["SETTINGS"]["REGEXP"], $value)) {
            $aMsg[] = array(
                "id" => $arUserField["FIELD_NAME"],
                "text" => (strlen($arUserField["ERROR_MESSAGE"]) > 0 ?
                        $arUserField["ERROR_MESSAGE"] :
                        GetMessage("USER_TYPE_STRING_REGEXP_ERROR", array(
                            "#FIELD_NAME#" => $arUserField["EDIT_FORM_LABEL"],
                                )
                        )
                ),
            );
        }
        return $aMsg;
    }
    public static function onSearchIndex(array $arUserField): ?string{
        if (is_array($arUserField["VALUE"]))
            return implode("\r\n", $arUserField["VALUE"]);
        else
            return $arUserField["VALUE"];
    }
}

AddEventHandler("main", "OnUserTypeBuildList", array("CUserTypeTextHTML", "GetUserTypeDescription"));
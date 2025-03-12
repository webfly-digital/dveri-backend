<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
if (!CModule::IncludeModule("iblock"))
    return;
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
$arResult["PARAMS_HASH"] = md5(serialize($arParams) . $this->GetTemplateName());

$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
if ($arParams["EMAIL_TO"] == '') {
    $arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");
}
if(isset($_POST["ajaxm"]) && check_bitrix_sessid()) {
    unset($_POST["ajaxm"]);
    $PROP = array();
    foreach ($_POST as $postkey => $postvalue) {
        switch ($postkey) {
            case "name":
                $NAME = htmlspecialchars($_POST["name"]);
                unset($_POST[$postkey]);
                break;
            case "comment":case "message";
                $COMMENT = $_POST["comment"]?htmlspecialchars($_POST["comment"]):htmlspecialchars($_POST["message"]);
                unset($_POST[$postkey]);
                break;
            default:
                $PROP[strtoupper($postkey)]=htmlspecialchars($postvalue);
                break;
        }
    }
    $ibe = new CIBlockElement;
    $messageParams = array(
      "IBLOCK_SECTION_ID" => false,
      "IBLOCK_ID" => $arParams["IBLOCK_ID"],
      "NAME" => $NAME,
      "PREVIEW_TEXT" => $COMMENT,
      "ACTIVE" => "Y",
      "ACTIVE_FROM" => date('d.m.Y H:i'),
      "PROPERTY_VALUES" => $PROP,
    );

    if ($qID = $ibe->Add($messageParams)) {
        $link = "/bitrix/admin/iblock_element_edit.php?IBLOCK_ID={$arParams["IBLOCK_ID"]}&type={$arParams["IBLOCK_TYPE"]}&ID={$qID}&lang=ru";
        $arFieldsM = Array(
          "NAME" => $NAME,
          "COMMENT" => $COMMENT,
          "EMAIL_TO" => $arParams["EMAIL_TO"],
          "LINK" => $link
        );
        if ($messageParams["PROPERTY_VALUES"]){
            foreach ($messageParams["PROPERTY_VALUES"] as $propKey=>$propVal){
                $arFieldsM[$propKey]=$propVal;
            }
        }
        //
        if (is_array($arParams['EVENT_MESSAGE_ID']))
            foreach ($arParams['EVENT_MESSAGE_ID'] as $event) {
                $rsEM = CEventMessage::GetByID($event);
                $arEM = $rsEM->Fetch();
                CEvent::Send($arEM['EVENT_NAME'], SITE_ID, $arFieldsM, "N", $event);
            }
        else {
            $event = $arParams['EVENT_MESSAGE_ID'];
            $rsEM = CEventMessage::GetByID($event);
            $arEM = $rsEM->Fetch();
            CEvent::Send($arEM['EVENT_NAME'], SITE_ID, $arFieldsM, "N", $event);
        }
    }
    else {
        echo $ibe->LAST_ERROR;
    }
}
else {
    $this->IncludeComponentTemplate();
}
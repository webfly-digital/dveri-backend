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
if (SITE_CHARSET == "windows-1251")
{
    $_POST["name"] = iconv("utf-8", "windows-1251", $_POST["name"]);
    $_POST["text"] = iconv("utf-8", "windows-1251", $_POST["text"]);
    $_POST["time"] = iconv("utf-8", "windows-1251", $_POST["time"]);
    $_POST["zamer-address"] = iconv("utf-8", "windows-1251", $_POST["zamer-address"]);
}
$arResult["PARAMS_HASH"] = md5(serialize($arParams) . $this->GetTemplateName());

$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);

if ($arParams["EMAIL_TO"] == "")
    $arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");

if (isset($_POST["ajaxm"]) && check_bitrix_sessid())
{
    if ($_POST["ajaxm"] == "zakaz")
    {
        $arFields = Array(
          "NAME" => $_POST["name"],
          "CODE" => $_POST["time"],
          "PREVIEW_TEXT" => $_POST["email"] . "<br>" . $_POST["phone"] . "<br>" . $_POST["text"],
          "EMAIL_TO" => $arParams["EMAIL_TO"],
        );

        $ibe = new CIBlockElement;

        $PROP = array();

        if (!empty($_FILES['uploadfile']['name']) and empty($_FILES['uploadfile']['error']))
        {
            if ($_FILES['uploadfile']['size'] <= $_POST["MAX_FILE_SIZE"])
            {
                $PROP[8] = $_FILES['uploadfile'];
            }
            else
            {
                $PROP[8] = "";
            }
        }
        if (!empty($_FILES['uploadfile']['error']))
        {
            echo "bigfile";
            die();
        }


        $messageParams = array(
          "IBLOCK_SECTION_ID" => false, //
          "IBLOCK_ID" => $arParams["IBLOCK_ID"],
          "NAME" => $_POST["name"],
          "CODE" => $_POST["time"],
          "PREVIEW_TEXT" => $_POST["email"] . "<br>" . $_POST["phone"] . "<br>" . $_POST["text"],
          "ACTIVE" => "N",
          "PROPERTY_VALUES" => $PROP,
            //"ACTIVE_FROM"    => date('d.m.Y H:i'),
        );

        if ($qID = $ibe->Add($messageParams))
        {
            $link = "bitrix/admin/iblock_element_edit.php?IBLOCK_ID={$arParams["IBLOCK_ID"]}&type={$arParams["IBLOCK_TYPE"]}&ID={$qID}&lang=ru";
            $arFields = Array(
              "NAME" => $_POST["name"],
              "TIME" => $_POST["time"],
              "TEXT" => $_POST["text"],
              "AUTHOR_EMAIL" => $_POST["email"],
              "PHONE" => $_POST["phone"],
              "EMAIL_TO" => $arParams["EMAIL_TO"],
              "LINK" => $link
            );
            //
            if (is_array($arParams['EVENT_MESSAGE_ID']))
                foreach ($arParams['EVENT_MESSAGE_ID'] as $event)
                {
                    $rsEM = CEventMessage::GetByID($event);
                    $arEM = $rsEM->Fetch();
                    CEvent::Send($arEM['EVENT_NAME'], SITE_ID, $arFields, "N", $event);
                }
            else
            {
                $event = $arParams['EVENT_MESSAGE_ID'];
                $rsEM = CEventMessage::GetByID($event);
                $arEM = $rsEM->Fetch();
                CEvent::Send($arEM['EVENT_NAME'], SITE_ID, $arFields, "N", $event);
            }
        }
        else
            echo $ibe->LAST_ERROR;
    }
    if ($_POST["ajaxm"] == "zamer")
    {
        $arFields = Array(
          "NAME" => $_POST["name"],
          "PREVIEW_TEXT" => $_POST["phone"] . "<br>" . $_POST["email"] . "<br>" . $_POST["zamer-address"],
          "EMAIL_TO" => $arParams["EMAIL_TO"],
        );

        $ibe = new CIBlockElement;

        $messageParams = array(
          "IBLOCK_SECTION_ID" => false, //
          "IBLOCK_ID" => $arParams["IBLOCK_ID"],
          "NAME" => $_POST["name"],
          "PREVIEW_TEXT" => $_POST["phone"] . "<br>" . $_POST["email"] . "<br>" . $_POST["zamer-address"],
          "ACTIVE" => "N",
          "ACTIVE_FROM" => date('d.m.Y H:i'),
        );

        if ($qID = $ibe->Add($messageParams))
        {
            $link = "bitrix/admin/iblock_element_edit.php?IBLOCK_ID={$arParams["IBLOCK_ID"]}&type={$arParams["IBLOCK_TYPE"]}&ID={$qID}&lang=ru";
            $arFields = Array(
              "NAME" => $_POST["name"],
              "AUTHOR_EMAIL" => $_POST["email"],
              "PHONE" => $_POST["phone"],
              "MESSAGE" => $_POST["zamer-address"],
              "EMAIL_TO" => $arParams["EMAIL_TO"],
              "LINK" => $link
            );
            //
            if (is_array($arParams['EVENT_MESSAGE_ID']))
                foreach ($arParams['EVENT_MESSAGE_ID'] as $event)
                {
                    $rsEM = CEventMessage::GetByID($event);
                    $arEM = $rsEM->Fetch();
                    CEvent::Send($arEM['EVENT_NAME'], SITE_ID, $arFields, "N", $event);
                }
            else
            {
                $event = $arParams['EVENT_MESSAGE_ID'];
                $rsEM = CEventMessage::GetByID($event);
                $arEM = $rsEM->Fetch();
                CEvent::Send($arEM['EVENT_NAME'], SITE_ID, $arFields, "N", $event);
            }
        }
        else
            echo $ibe->LAST_ERROR;
    }
    if ($_POST["ajaxm"] == "callback")
    {
        $arFields = Array(
          "NAME" => $_POST["name"],
          "CODE" => $_POST["phone"],
          "EMAIL_TO" => $arParams["EMAIL_TO"],
        );

        $ibe = new CIBlockElement;

        $messageParams = array(
          "IBLOCK_SECTION_ID" => false, //
          "IBLOCK_ID" => $arParams["IBLOCK_ID"],
          "NAME" => $_POST["name"],
          "CODE" => $_POST["phone"],
          "ACTIVE" => "N",
          "ACTIVE_FROM" => date('d.m.Y H:i'),
        );

        if ($qID = $ibe->Add($messageParams))
        {
            $link = "bitrix/admin/iblock_element_edit.php?IBLOCK_ID={$arParams["IBLOCK_ID"]}&type={$arParams["IBLOCK_TYPE"]}&ID={$qID}&lang=ru";
            $arFields = Array(
              "NAME" => $_POST["name"],
              "PHONE" => $_POST["phone"],
              "EMAIL_TO" => $arParams["EMAIL_TO"],
              "LINK" => $link
            );
            //
            if (is_array($arParams['EVENT_MESSAGE_ID']))
                foreach ($arParams['EVENT_MESSAGE_ID'] as $event)
                {
                    $rsEM = CEventMessage::GetByID($event);
                    $arEM = $rsEM->Fetch();
                    CEvent::Send($arEM['EVENT_NAME'], SITE_ID, $arFields, "N", $event);
                }
            else
            {
                $event = $arParams['EVENT_MESSAGE_ID'];
                $rsEM = CEventMessage::GetByID($event);
                $arEM = $rsEM->Fetch();
                CEvent::Send($arEM['EVENT_NAME'], SITE_ID, $arFields, "N", $event);
            }
        }
        else
            echo $ibe->LAST_ERROR;
    }
}
else
{
    $this->IncludeComponentTemplate();
}
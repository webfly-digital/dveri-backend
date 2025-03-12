<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("DESCRIPTION", "Положение об обработке и защите персональных данных на сайте завода «Двери металл - М» в #WF_CITY_PRED#: #WF_PHONES#.");
$APPLICATION->SetPageProperty("title", "Политика конфиденциальности | Компания «Двери металл - М» в #WF_CITY_PRED#");
$APPLICATION->SetTitle("Политика конфиденциальности");

?>
<? $APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    array(
        "AREA_FILE_SHOW" => "file",
        "PATH" => "text.php"
    ),
    false
); ?>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
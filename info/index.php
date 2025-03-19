<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

/** @global CMain $APPLICATION */

$APPLICATION->SetPageProperty("title", "Информация | Компания «Двери металл - М»  8 (499) 110-09-12");
$APPLICATION->SetTitle("О Компании");

 $APPLICATION->IncludeComponent("bitrix:menu", "left", [
    "ROOT_MENU_TYPE" => "left",
    "MENU_CACHE_TYPE" => "A",
    "MENU_CACHE_TIME" => "36000",
    "MENU_CACHE_USE_GROUPS" => "Y",
    "MENU_CACHE_GET_VARS" => [
    ],
    "MAX_LEVEL" => "1",
    "CHILD_MENU_TYPE" => "",
    "USE_EXT" => "N",
    "DELAY" => "N",
    "ALLOW_MULTI_SELECT" => "N"
],
    false
);

$APPLICATION->IncludeComponent(
    "bitrix:news",
    "info",
    [
        "IBLOCK_TYPE" => "news",
        "IBLOCK_ID" => "9",
        "NEWS_COUNT" => "20",
        "USE_SEARCH" => "N",
        "USE_RSS" => "N",
        "USE_RATING" => "N",
        "USE_CATEGORIES" => "N",
        "USE_FILTER" => "N",
        "SORT_BY1" => "SORT",
        "SORT_ORDER1" => "ASC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "CHECK_DATES" => "Y",
        "SEF_MODE" => "Y",
        "SEF_FOLDER" => "/info/",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "N",
        "AJAX_OPTION_HISTORY" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "SET_TITLE" => "Y",
        "SET_STATUS_404" => "Y",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "Y",
        "USE_PERMISSIONS" => "N",
        "PREVIEW_TRUNCATE_LEN" => "",
        "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
        "LIST_FIELD_CODE" => [
            0 => "",
            1 => "",
        ],
        "LIST_PROPERTY_CODE" => [
            0 => "",
            1 => "",
        ],
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "DISPLAY_NAME" => "Y",
        "META_KEYWORDS" => "-",
        "META_DESCRIPTION" => "-",
        "BROWSER_TITLE" => "-",
        "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
        "DETAIL_FIELD_CODE" => [
            0 => "",
            1 => "",
        ],
        "DETAIL_PROPERTY_CODE" => [
            0 => "GALLERY",
            1 => "",
        ],
        "DETAIL_DISPLAY_TOP_PAGER" => "N",
        "DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
        "DETAIL_PAGER_TITLE" => "Страница",
        "DETAIL_PAGER_TEMPLATE" => "",
        "DETAIL_PAGER_SHOW_ALL" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "Новости",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => "",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "DISPLAY_DATE" => "N",
        "DISPLAY_PICTURE" => "N",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "USE_SHARE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "COMPONENT_TEMPLATE" => "info",
        "SET_LAST_MODIFIED" => "N",
        "ADD_ELEMENT_CHAIN" => "Y",
        "STRICT_SECTION_CHECK" => "N",
        "DETAIL_SET_CANONICAL_URL" => "N",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "SHOW_404" => "Y",
        "MESSAGE_404" => "",
        "FILE_404" => "",
        "SEF_URL_TEMPLATES" => [
            "news" => "",
            "section" => "",
            "detail" => "#ELEMENT_CODE#/",
        ]
    ],
    false
);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
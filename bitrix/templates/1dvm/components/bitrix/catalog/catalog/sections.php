<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain                $APPLICATION
 * @var array                   $arParams
 * @var array                   $arResult *
 * @var CatalogSectionComponent $component
 */

?>
<div class="container">
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section.list",
        "catalog-2020",
        [
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
            "TOP_DEPTH" => "1",//$arParams["SECTION_TOP_DEPTH"],
            "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
            "SECTION_USER_FIELDS" => [0 => "UF_PICS",
                1 => "UF_FIRE_RESIST",
                2 => "UF_FIRE_RESIST_TEXT",
                3 => "UF_LIST_NAME",
                4 => "",
            ]
        ],
        $component
    );
    ?>
</div>
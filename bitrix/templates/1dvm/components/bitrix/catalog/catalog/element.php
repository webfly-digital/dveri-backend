<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain                $APPLICATION
 * @var array                   $arParams
 * @var array                   $arResult
 * @var CatalogElementComponent $component
 */

$sub = CWebflyCities::GetSubDomain();

$price_mod = 0;
if ($sub == 'msk') $price_mod = 1;

$section = CIBlockSection::GetList([],
    ['IBLOCK_ID' => $arParams['IBLOCK_ID'], 'CODE' => $arResult['VARIABLES']["SECTION_CODE"]], false, ['ID', 'ACTIVE'])->fetch();
//if ($section['ACTIVE'] != 'Y') LocalRedirect('/404.php');

$res = CIBlockSection::GetNavChain($arParams['IBLOCK_ID'], $section['ID']);
while ($nav = $res->GetNext())
    $APPLICATION->AddChainItem($nav['NAME'], $nav['SECTION_PAGE_URL']);

$ElementID = $APPLICATION->IncludeComponent(
    "bitrix:catalog.element",
    "",
    [
        'PRICE_MOD' => $price_mod,
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
        "META_KEYWORDS" => $arParams["DETAIL_META_KEYWORDS"],
        "META_DESCRIPTION" => $arParams["DETAIL_META_DESCRIPTION"],
        "BROWSER_TITLE" => $arParams["DETAIL_BROWSER_TITLE"],
        "BASKET_URL" => $arParams["BASKET_URL"],
        "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
        "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
        "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
        "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
        "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "SET_TITLE" => $arParams["SET_TITLE"],
        "SET_STATUS_404" => $arParams["SET_STATUS_404"],
        "SHOW_404" => $arParams["SHOW_404"],
        "PRICE_CODE" => $arParams["PRICE_CODE"],
        "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
        "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
        "PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
        "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
        "QUANTITY_FLOAT" => $arParams["QUANTITY_FLOAT"],
        "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
        "LINK_IBLOCK_TYPE" => $arParams["LINK_IBLOCK_TYPE"],
        "LINK_IBLOCK_ID" => $arParams["LINK_IBLOCK_ID"],
        "LINK_PROPERTY_SID" => $arParams["LINK_PROPERTY_SID"],
        "LINK_ELEMENTS_URL" => $arParams["LINK_ELEMENTS_URL"],

        "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
        "OFFERS_FIELD_CODE" => $arParams["DETAIL_OFFERS_FIELD_CODE"],
        "OFFERS_PROPERTY_CODE" => $arParams["DETAIL_OFFERS_PROPERTY_CODE"],
        "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
        "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
        "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
        "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],

        "ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
        "ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
        "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
        "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
        'USE_ELEMENT_COUNTER' => $arParams['USE_ELEMENT_COUNTER'],
        "ADD_ELEMENT_CHAIN" => $arParams["ADD_ELEMENT_CHAIN"],
        'ADD_SECTIONS_CHAIN' => $arParams["ADD_SECTIONS_CHAIN"],
        "SET_CANONICAL_URL" => "N",
        'SUBDOMAIN' => $sub
    ],
    $component
); ?>
<?php $this->SetViewTarget('catalog_detail'); ?>
<?php
//$APPLICATION->IncludeFile("/include/benefits-catalog.php", [], array("MODE" => "html", "NAME" => "Преймущества"));
?>
    <section class="page-section">
        <div class="h1 page-section__title text-center">Похожие товары:</div>
        <div class="container">
            <?php
            global $recomFilter;

            $recomFilter = ['IBLOCK_ID' => $arParams['IBLOCK_ID'], 'SECTION_CODE' => $arResult["VARIABLES"]["SECTION_CODE"], '!ID' => $ElementID];
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "main",
                [
                    'FILTER_NAME' => 'recomFilter',
                    'IBLOCK_TYPE' => 'catalog',
                    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                    'ELEMENT_SORT_FIELD' => 'RAND',
                    'ELEMENT_SORT_ORDER' => 'rand',
                    'ELEMENT_SORT_FIELD2' => 'id',
                    'ELEMENT_SORT_ORDER2' => 'desc',
                    'PROPERTY_CODE' =>
                        [
                            0 => 'FIRE_RESIST',
                            1 => 'CONSTUCTION',
                            2 => 'HIT',
                        ],
                    'META_KEYWORDS' => '-',
                    'META_DESCRIPTION' => '-',
                    'BROWSER_TITLE' => '-',
                    'INCLUDE_SUBSECTIONS' => 'Y',
                    'BASKET_URL' => '/personal/basket.php',
                    'ACTION_VARIABLE' => 'action',
                    'PRODUCT_ID_VARIABLE' => 'id',
                    'SECTION_ID_VARIABLE' => 'SECTION_ID',
                    'PRODUCT_QUANTITY_VARIABLE' => 'quantity',
                    'PRODUCT_PROPS_VARIABLE' => 'prop',
                    'CACHE_TYPE' => 'A',
                    'CACHE_TIME' => '36000000',
                    'CACHE_FILTER' => 'Y',
                    'CACHE_GROUPS' => 'Y',
                    'SET_TITLE' => false,
                    'SET_STATUS_404' => 'Y',
                    'SHOW_404' => 'Y',
                    'DISPLAY_COMPARE' => 'N',
                    'PAGE_ELEMENT_COUNT' => '4',
                    'LINE_ELEMENT_COUNT' => '1',
                    'PRICE_CODE' => $arParams['PRICE_CODE'],
                    'USE_PRICE_COUNT' => 'N',
                    'SHOW_PRICE_COUNT' => '1',
                    'PRICE_VAT_INCLUDE' => 'Y',
                    'USE_PRODUCT_QUANTITY' => 'N',
                    'QUANTITY_FLOAT' => NULL,
                    'PRODUCT_PROPERTIES' => [],
                    'DISPLAY_TOP_PAGER' => 'N',
                    'DISPLAY_BOTTOM_PAGER' => 'N',
                    'PAGER_TITLE' => 'Товары',
                    'PAGER_SHOW_ALWAYS' => 'N',
                    'PAGER_TEMPLATE' => 'dvm',
                    'PAGER_DESC_NUMBERING' => 'N',
                    'PAGER_DESC_NUMBERING_CACHE_TIME' => '36000',
                    'PAGER_SHOW_ALL' => 'N',
                    'OFFERS_CART_PROPERTIES' => NULL,
                    'OFFERS_FIELD_CODE' => NULL,
                    'OFFERS_PROPERTY_CODE' => NULL,
                    'OFFERS_SORT_FIELD' => NULL,
                    'OFFERS_SORT_ORDER' => NULL,
                    'OFFERS_SORT_FIELD2' => NULL,
                    'OFFERS_SORT_ORDER2' => NULL,
                    'OFFERS_LIMIT' => NULL,
                    'SECTION_ID' => '',
                    'SECTION_CODE' => '',
                    'SECTION_URL' => '/catalog/#SECTION_CODE_PATH#/',
                    'DETAIL_URL' => '/catalog/#SECTION_CODE_PATH#/#ELEMENT_CODE#/',
                    'CONVERT_CURRENCY' => NULL,
                    'CURRENCY_ID' => NULL,
                    'HIDE_NOT_AVAILABLE' => NULL,
                    'ADD_ELEMENT_CHAIN' => 'N',
                ], $component, ['HIDE_ICONS' => 'Y']
            );
            ?>
        </div>
    </section>
<?php
//$APPLICATION->IncludeFile("/include/index-clients-catalog.html", array(), array("MODE" => "html", "NAME" => "Логотипы клиентов",));
?>
    <!--    <section class="page-section" id="sect-feedback">-->
    <!--        <div class="container">-->
    <!--            <div class="h2 page-section__title text-center"><a href="/info/reviews/">Отзывы</a> о продукции Двери Металл М-->
    <!--            </div>-->
    <!--            <div class="gal gal-v3">-->
    <!--                --><?php //$gallery = WFGeneral::GetGallery(9); ?>
    <!--                --><?php //if ($gallery):
//                    foreach ($gallery as $key => $production):
//                        if ($key >= 5) break;
//                        if (!empty($production["DESCRIPTION"]))
//                            $production_desc = $production["DESCRIPTION"];
//                        else
//                            $production_desc = $production["NAME"];
//                        ?>
    <!--                        <div class="gal-item">-->
    <!--                            <a href="--><?php //= $production["PATH"] ?><!--" class="gal-item__preview lazyload"-->
    <!--                               title="--><?php //= $production_desc ?><!--"-->
    <!--                               data-original="--><?php //= $production['PATH'] ?><!--"></a>-->
    <!--                        </div>-->
    <!--                    --><?php //endforeach;
//                else:?>
    <!--                    <p>Пока нет ни одного отзыва!</p>-->
    <!--                --><?php //endif; ?>
    <!--            </div>-->
    <!--        </div>-->
    <!--    </section>-->
<?php /*
<section class="page-section">
    <div class="container">
        <h2 class="page-section__title text-center">Также мы предлагаем</h2>
            <?
            $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "detail", Array(
                "IBLOCK_TYPE" => "catalog", // Тип инфоблока
                "IBLOCK_ID" => "3", // Инфоблок
                "SECTION_ID" => $_REQUEST["SECTION_ID"], // ID раздела
                "SECTION_CODE" => "", // Код раздела
                "COUNT_ELEMENTS" => "N", // Показывать количество элементов в разделе
                "TOP_DEPTH" => "1", // Максимальная отображаемая глубина разделов
                "SECTION_FIELDS" => array(// Поля разделов
                    0 => "",
                    1 => "",
                ),
                "SECTION_USER_FIELDS" => array(// Свойства разделов
                    0 => "UF_PICS",
                    1 => "UF_FIRE_RESIST",
                    2 => "UF_FIRE_RESIST_TEXT",
                    3 => "UF_LIST_NAME",
                    4 => "",
                ),
                "SECTION_URL" => "", // URL, ведущий на страницу с содержимым раздела
                "CACHE_TYPE" => "A", // Тип кеширования
                "CACHE_TIME" => "36000000", // Время кеширования (сек.)
                "CACHE_GROUPS" => "Y", // Учитывать права доступа
                "ADD_SECTIONS_CHAIN" => "N", // Включать раздел в цепочку навигации
            ), false
            );
            ?>
    </div>
</section>
*/ ?>
<?php global $USER;
if ($sub == 'msk') { ?>
    <!--articles-->
    <?php $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "articles",
        [
            "ACTIVE_DATE_FORMAT" => "d.m.Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "N",
            "CHECK_DATES" => "Y",
            "DETAIL_URL" => "",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => [0 => "", 1 => "",],
            "FILTER_NAME" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "23",
            "IBLOCK_TYPE" => "news",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "Y",
            "NEWS_COUNT" => "3",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => [0 => "", 1 => "",],
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "TAG_H" => "N",

        ]
    ); ?>
    <!--/articles-->
<?php } ?>
<?php $this->EndViewTarget(); ?>
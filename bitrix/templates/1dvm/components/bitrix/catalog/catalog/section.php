<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain                $APPLICATION
 * @var array                   $arParams
 * @var array                   $arResult
 * @var CatalogSectionComponent $component
 * @const WF_SEO_IBLOCK
 */

$sectionID = $arResult['VARIABLES']['SECTION_ID'];
$section = CIBlockSection::GetByID($sectionID)->GetNext();
if ($section['ACTIVE'] != 'Y') LocalRedirect('/404.php');

$res = CIBlockSection::GetNavChain($arParams['IBLOCK_ID'], $sectionID);
while ($nav = $res->GetNext())
    $APPLICATION->AddChainItem($nav['NAME'], $nav['SECTION_PAGE_URL']);

$sub = CWebflyCities::GetSubDomain();
?>
    <div class="row double-column-layout">

        <div class="super-accordion col-md-3">
            <?php $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "tree",
                [
                    "ROOT_MENU_TYPE" => "catalog_logic",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_TIME" => "36000",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "MENU_CACHE_GET_VARS" => [],
                    "MAX_LEVEL" => "3",
                    "CHILD_MENU_TYPE" => "",
                    "USE_EXT" => "Y",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N",
                    "COMPONENT_TEMPLATE" => "tree"
                ],
                false,
                [
                    "HIDE_ICONS" => "T"
                ]
            ); ?>
        </div>

        <section class="col-md-9 super-accordion">
            <?php
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.smart.filter",
                "filter",
                [
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],//$arCurSection['ID'],
                    "FILTER_NAME" => $arParams["FILTER_NAME"],
                    "PRICE_CODE" => $arParams["~PRICE_CODE"],
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                    "SAVE_IN_SESSION" => "N",
                    "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                    "XML_EXPORT" => "N",
                    "SECTION_TITLE" => "NAME",
                    "SECTION_DESCRIPTION" => "DESCRIPTION",
                    'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                    "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                    'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                    'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                    "SEF_MODE" => $arParams["SEF_MODE"],
                    "SEF_RULE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"],
                    "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                    "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                    "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                ],
                $component,
                ['HIDE_ICONS' => 'Y']
            );

            global $USER;
            if ($section["DEPTH_LEVEL"] >= 1) {
                $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "card",
                    [
                        "VIEW_MODE" => "TEXT",
                        "SHOW_PARENT_NAME" => "N",
                        "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
                        "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                        "SECTION_ID" => $section['ID'],
                        "SECTION_CODE" => $section['CODE'],
                        "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                        "COUNT_ELEMENTS" => "N",
                        "TOP_DEPTH" => "1",
                        "SECTION_FIELDS" => "",
                        "SECTION_USER_FIELDS" => ["UF_PICS"],
                        "ADD_SECTIONS_CHAIN" => "N",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_NOTES" => "",
                        "CACHE_GROUPS" => "Y",
                        "CUSTOM_SECTION_SORT" => ['SORT' => 'ASC', 'ID' => 'DESC']
                    ], $component, ['HIDE_ICONS' => 'N']
                );
            }


            $arSortFields = [
                "SHOWS" => [
                    "ORDER" => "DESC",
                    "CODE" => "SHOWS",
                    "NAME" => "По популярности"
                ],
                "PROPERTY_PRICE_N_DESC" => [
                    "ORDER" => "DESC",
                    "CODE" => "PROPERTY_PRICE_N",
                    "NAME" => "По цене &darr;"
                ],
                "PROPERTY_PRICE_N_ASC" => [
                    "ORDER" => "ASC",
                    "CODE" => "PROPERTY_PRICE_N",
                    "NAME" => "По цене &uarr;"
                ],
                "NAME_DESC" => [
                    "ORDER" => "DESC",
                    "CODE" => "NAME",
                    "NAME" => "По алфавиту &darr;"
                ],
                "NAME_ASC" => [
                    "ORDER" => "ASC",
                    "CODE" => "NAME",
                    "NAME" => "По алфавиту &uarr;"
                ],
            ];
            if (!empty($_REQUEST["SORT_FIELD"]) && !empty($arSortFields[$_REQUEST["SORT_FIELD"]])) {

                setcookie("CATALOG_SORT_FIELD", $_REQUEST["SORT_FIELD"], time() + 60 * 60 * 24 * 30 * 12 * 2, "/");

                $arParams["ELEMENT_SORT_FIELD"] = $arSortFields[$_REQUEST["SORT_FIELD"]]["CODE"];
                $arParams["ELEMENT_SORT_ORDER"] = $arSortFields[$_REQUEST["SORT_FIELD"]]["ORDER"];

                $arSortFields[$_REQUEST["SORT_FIELD"]]["SELECTED"] = "Y";
            } elseif (!empty($_COOKIE["CATALOG_SORT_FIELD"]) && !empty($arSortFields[$_COOKIE["CATALOG_SORT_FIELD"]])) { // COOKIE
                $arParams["ELEMENT_SORT_FIELD"] = $arSortFields[$_COOKIE["CATALOG_SORT_FIELD"]]["CODE"];
                $arParams["ELEMENT_SORT_ORDER"] = $arSortFields[$_COOKIE["CATALOG_SORT_FIELD"]]["ORDER"];

                $arSortFields[$_COOKIE["CATALOG_SORT_FIELD"]]["SELECTED"] = "Y";
            } ?>

            <a href="#modalUniversal" class="d-before-sm btn btn-lg  btn--red modal-universal-button"
               data-options="Получить прайс-лист|.input-comment|PRICE_GOAL"
               style="width:100%; display: block; margin: 0 0 24px 0;text-align: center;">Получить оптовый прайс-лист</a>

            <?php if (!empty($arSortFields)): ?>
                <noindex>
                    <div class="sort-panel">
                        <span class="sort-panel__caption">Сортировать по</span>
                        <select name="sort" class="sort-panel__select chosen-single--noselect" id="selectSortParams">
                            <?php foreach ($arSortFields as $arSortFieldCode => $arSortField): ?>
                                <option value="<?= $APPLICATION->GetCurPageParam("SORT_FIELD=" . $arSortFieldCode, ["SORT_FIELD"]); ?>"<?php if ($arSortField["SELECTED"] == "Y"): ?> selected<?php endif; ?>><?= $arSortField["NAME"] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </noindex>
            <?php endif;

            if ($sub == 'msk') $price_mod = 1;


            $subdomen = CWebflyCities::GetSubDomain();
            $url = $subdomen . '.' . SITE_SERVER_NAME . $arResult["FOLDER"] . $arResult["VARIABLES"] ["SECTION_CODE_PATH"] . '/';
            CModule::IncludeModule('iblock');


            $arSelect = [
                "ID",
                "IBLOCK_ID",
                "NAME",
                "PROPERTY_WF_SEO_TEXT",
            ];
            $arFilter = ["IBLOCK_CODE" => WF_SEO_IBLOCK, "ACTIVE" => "Y", "ACTIVE_DATE" => "Y", 'NAME' => $url];
            $res = CIBlockElement::GetList(['NAME' => "ASC"], $arFilter, false, false, $arSelect);
            while ($ob = $res->GetNext()) {
                if (!empty($ob["PROPERTY_WF_SEO_TEXT_VALUE"])) {
                    $arParams["DESCRIPTION"] = 'N';
                }
            }

            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section", "", $p = [
                "DESCRIPTION" => $arParams["DESCRIPTION"],
                'USE_MAIN_ELEMENT_SECTION' => $arParams['USE_MAIN_ELEMENT_SECTION'],
                'PRICE_MOD' => $price_mod,
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                "BASKET_URL" => $arParams["BASKET_URL"],
                "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                "FILTER_NAME" => $arParams["FILTER_NAME"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                "SET_TITLE" => $arParams["SET_TITLE"],
                "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                "SHOW_404" => $arParams["SHOW_404"],
                "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                "PRICE_CODE" => $arParams["PRICE_CODE"],
                "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                "QUANTITY_FLOAT" => $arParams["QUANTITY_FLOAT"],
                "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
                "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],
                "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                "ADD_ELEMENT_CHAIN" => $arParams["ADD_ELEMENT_CHAIN"]
            ], false
            );
            //echo '<pre>';var_export($p);echo '</pre>';

            ?>
        </section>
    </div>
<?php $this->SetViewTarget('catalog_section'); ?>
    <section class="double-column" id="calculate">
        <div class="col">
            <noindex>
                <div class="page-section">
                    <div class="calc-form-wrapper">
                        <div class="page-section__title h3"><?php
                            $APPLICATION->IncludeFile(
                                SITE_DIR . "include/main/title-3.php", [], ["NAME" => "текст", "MODE" => "html"]
                            );
                            ?></div>
                        <script id="bx24_form_inline" data-skip-moving="true">
                            (function (w, d, u, b) {
                                w['Bitrix24FormObject'] = b;
                                w[b] = w[b] || function () {
                                    arguments[0].ref = u;
                                    (w[b].forms = w[b].forms || []).push(arguments[0])
                                };
                                if (w[b]['forms'])
                                    return;
                                s = d.createElement('script');
                                r = 1 * new Date();
                                s.async = 1;
                                s.src = u + '?' + r;
                                h = d.getElementsByTagName('script')[0];
                                h.parentNode.insertBefore(s, h);
                            })(window, document, 'https://dverim.bitrix24.ru/bitrix/js/crm/form_loader.js', 'b24form');

                            b24form({"id": "12", "lang": "ru", "sec": "x584cv", "type": "inline"});
                        </script>
                    </div>
                </div>
            </noindex>
        </div>
        <div class="col">
            <?php $gallery6 = WFGeneral::GetGallery(6); ?>
            <?php if ($gallery6): ?>
                <div class="square-pics">
                    <?php foreach ($gallery6 as $minigal): ?>
                        <div class="pic lazyload" data-original="<?= $minigal["PATH"] ?>"></div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>
    </section>
<?php
//$APPLICATION->IncludeFile("/include/benefits-catalog.php", [], array("MODE" => "html", "NAME" => "Преймущества"));
//$APPLICATION->IncludeFile("/include/index-clients.html", Array(), Array("MODE" => "html", "NAME" => "Логотипы клиентов",));
?>
    <!-- Отзывы -->
    <!--<section class="page-section" id="sect-feedback">-->
    <!--    <div class="container">-->
    <!--        <div class="h2 page-section__title text-center"><a href="/info/reviews/">Отзывы</a> о продукции Двери Металл М-->
    <!--        </div>-->
    <!--        <div class="gal gal-v3">-->
    <!--            --><?php // $gallery = WFGeneral::GetGallery(9); ?>
    <!--            --><?php // if ($gallery):
//                foreach ($gallery as $key => $production):
//                    if ($key >= 5) break;
//                    if (!empty($production["DESCRIPTION"]))
//                        $production_desc = $production["DESCRIPTION"];
//                    else
//                        $production_desc = $production["NAME"];
//                    ?>
    <!--                    <div class="gal-item">-->
    <!--                        <a href="--><?php //= $production["PATH"] ?><!--" class="gal-item__preview lazyload"-->
    <!--                           title="--><?php //= $production_desc ?><!--"-->
    <!--                           data-original="--><?php //= $production['PATH'] ?><!--"></a>-->
    <!--                    </div>-->
    <!--                --><?php //endforeach;
//            else:?>
    <!--                <p>Пока нет ни одного отзыва!</p>-->
    <!--            --><?php // endif; ?>
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!--/Отзывы -->
<?php

global $showArticles;
if ($showArticles) { ?>
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
            "FIELD_CODE" => [],
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
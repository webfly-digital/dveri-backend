<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="col-md-12 detail-articles">
    <? $ElementID = $APPLICATION->IncludeComponent(
        "bitrix:news.detail",
        "",
        array(
            "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
            "DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
            "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
            "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
            "PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
            "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
            "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
            "META_KEYWORDS" => $arParams["META_KEYWORDS"],
            "META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
            "BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
            "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
            "SET_TITLE" => $arParams["SET_TITLE"],
            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
            "SHOW_404" => $arParams["SHOW_404"],
            "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
            "ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
            "ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
            "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
            "DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
            "DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
            "PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
            "PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
            "CHECK_DATES" => $arParams["CHECK_DATES"],
            "ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
            "ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
            "IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
            "USE_SHARE" => $arParams["USE_SHARE"],
            "SHARE_HIDE" => $arParams["SHARE_HIDE"],
            "SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
            "SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
            "SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
            "SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
            "ADD_ELEMENT_CHAIN" => $arParams["ADD_ELEMENT_CHAIN"]
        ),
        $component
    ); ?>
</div>
<?
global $arrOtherFilter;
$arrOtherFilter = array("!=ID" => $ElementID);
$APPLICATION->IncludeComponent("bitrix:news.list", "related", array(
    "IBLOCK_TYPE" => "news",    // Тип информационного блока (используется только для проверки)
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "NEWS_COUNT" => "3",    // Количество новостей на странице
    "SORT_BY1" => "rand",    // Поле для первой сортировки новостей
    "SORT_ORDER1" => "DESC",    // Направление для первой сортировки новостей
    "SORT_BY2" => "SORT",    // Поле для второй сортировки новостей
    "SORT_ORDER2" => "ASC",    // Направление для второй сортировки новостей
    "FILTER_NAME" => "arrOtherFilter",    // Фильтр
    "FIELD_CODE" => array(    // Поля
        0 => "",
        1 => "",
    ),
    "PROPERTY_CODE" => array(    // Свойства
        0 => "",
        1 => "",
    ),
    "CHECK_DATES" => "Y",    // Показывать только активные на данный момент элементы
    "DETAIL_URL" => "",    // URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
    "AJAX_MODE" => "N",    // Включить режим AJAX
    "AJAX_OPTION_JUMP" => "N",    // Включить прокрутку к началу компонента
    "AJAX_OPTION_STYLE" => "Y",    // Включить подгрузку стилей
    "AJAX_OPTION_HISTORY" => "N",    // Включить эмуляцию навигации браузера
    "CACHE_TYPE" => "A",    // Тип кеширования
    "CACHE_TIME" => "36000000",    // Время кеширования (сек.)
    "CACHE_FILTER" => "Y",    // Кешировать при установленном фильтре
    "CACHE_GROUPS" => "Y",    // Учитывать права доступа
    "PREVIEW_TRUNCATE_LEN" => "",    // Максимальная длина анонса для вывода (только для типа текст)
    "ACTIVE_DATE_FORMAT" => "d.m.Y",    // Формат показа даты
    "SET_TITLE" => "N",    // Устанавливать заголовок страницы
    "SET_STATUS_404" => "N",    // Устанавливать статус 404, если не найдены элемент или раздел
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",    // Включать инфоблок в цепочку навигации
    "ADD_SECTIONS_CHAIN" => "N",    // Включать раздел в цепочку навигации
    "HIDE_LINK_WHEN_NO_DETAIL" => "N",    // Скрывать ссылку, если нет детального описания
    "PARENT_SECTION" => "",    // ID раздела
    "PARENT_SECTION_CODE" => "",    // Код раздела
    "INCLUDE_SUBSECTIONS" => "Y",    // Показывать элементы подразделов раздела
    "DISPLAY_TOP_PAGER" => "N",    // Выводить над списком
    "DISPLAY_BOTTOM_PAGER" => "N",    // Выводить под списком
    "PAGER_TITLE" => "Новости",    // Название категорий
    "PAGER_SHOW_ALWAYS" => "N",    // Выводить всегда
    "PAGER_TEMPLATE" => "",    // Название шаблона
    "PAGER_DESC_NUMBERING" => "N",    // Использовать обратную навигацию
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",    // Время кеширования страниц для обратной навигации
    "PAGER_SHOW_ALL" => "N",    // Показывать ссылку "Все"
    "DISPLAY_DATE" => "Y",    // Выводить дату элемента
    "DISPLAY_NAME" => "Y",    // Выводить название элемента
    "DISPLAY_PICTURE" => "Y",    // Выводить изображение для анонса
    "DISPLAY_PREVIEW_TEXT" => "Y",    // Выводить текст анонса
    "AJAX_OPTION_ADDITIONAL" => "",    // Дополнительный идентификатор
),
    $component
); ?>

<?
$res = CIBlockElement::GetList([], ['IBLOCK_ID' => $arParams["IBLOCK_ID"], 'ID' => $ElementID], false, false, ['PROPERTY_PRODUCTS_LIST']);
while ($ob = $res->GetNext()) {
    if ($ob["PROPERTY_PRODUCTS_LIST_VALUE"]) $listProduct[] = $ob["PROPERTY_PRODUCTS_LIST_VALUE"];
}
if ($listProduct) {
    global $recommendProducts;
    $recommendProducts = ["ID" => $listProduct]; ?>
    <section class="page-section detail-articles-products">
        <h2 class="h2 page-section__title text-center">Товары из статьи</h2>
        <div class="container">
            <?
            global $subDomain;
            if ($subDomain == 'msk') $price_mod = 1;
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "main",
                array(
                    'PRICE_MOD' => $price_mod,
                    'FILTER_NAME' => 'recommendProducts',
                    'IBLOCK_TYPE' => 'catalog',
                    'IBLOCK_ID' => '3',
                    'ELEMENT_SORT_FIELD' => 'property_PRICE',
                    'ELEMENT_SORT_ORDER' => 'asc,nulls',
                    'ELEMENT_SORT_FIELD2' => 'SORT',
                    'ELEMENT_SORT_ORDER2' => 'asc',
                    'PROPERTY_CODE' => ['FIRE_RESIST', 'CONSTUCTION', 'HIT'],
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
                    'SET_TITLE' => 'N',
                    'SET_STATUS_404' => 'N',
                    'SHOW_404' => 'N',
                    'DISPLAY_COMPARE' => 'N',
                    'PAGE_ELEMENT_COUNT' => '6',
                    'LINE_ELEMENT_COUNT' => '1',
                    'PRICE_CODE' => ['PRICE_N'],
                    'USE_PRICE_COUNT' => 'N',
                    'SHOW_PRICE_COUNT' => '1',
                    'PRICE_VAT_INCLUDE' => 'Y',
                    'USE_PRODUCT_QUANTITY' => 'N',
                    'QUANTITY_FLOAT' => NULL,
                    'PRODUCT_PROPERTIES' => [],
                    'DISPLAY_TOP_PAGER' => 'N',
                    'DISPLAY_BOTTOM_PAGER' => 'N',
                    'PAGER_TITLE' => '',
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
                ), false, ['HIDE_ICONS' => 'Y']
            ); ?>
        </div>
    </section>
    <?
}
?>
<section class="page-section">
    <h2 class="h2 page-section__title text-center">Рекомендуем так же</h2>
    <div class="container">
        <?
        global $recommendOtherProducts;
        if ($listProduct) $recommendOtherProducts = ["!ID" => $listProduct];

        global $subDomain;
        if ($subDomain == 'msk') $price_mod = 1;
        $APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "main",
            array(
                'PRICE_MOD' => $price_mod,
                'FILTER_NAME' => 'recommendOtherProducts',
                'IBLOCK_TYPE' => 'catalog',
                'IBLOCK_ID' => '3',
                'ELEMENT_SORT_FIELD' => 'property_PRICE',
                'ELEMENT_SORT_ORDER' => 'asc,nulls',
                'ELEMENT_SORT_FIELD2' => 'SORT',
                'ELEMENT_SORT_ORDER2' => 'asc',
                'PROPERTY_CODE' => [ 'FIRE_RESIST', 'CONSTUCTION', 'HIT'],
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
                'SET_TITLE' => 'N',
                'SET_STATUS_404' => 'N',
                'SHOW_404' => 'N',
                'DISPLAY_COMPARE' => 'N',
                'PAGE_ELEMENT_COUNT' => '6',
                'LINE_ELEMENT_COUNT' => '1',
                'PRICE_CODE' => ['PRICE_N'],
                'USE_PRICE_COUNT' => 'N',
                'SHOW_PRICE_COUNT' => '1',
                'PRICE_VAT_INCLUDE' => 'Y',
                'USE_PRODUCT_QUANTITY' => 'N',
                'QUANTITY_FLOAT' => NULL,
                'PRODUCT_PROPERTIES' => [],
                'DISPLAY_TOP_PAGER' => 'N',
                'DISPLAY_BOTTOM_PAGER' => 'N',
                'PAGER_TITLE' => '',
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
            ), false, ['HIDE_ICONS' => 'Y']
        ); ?>
    </div>
</section>
<h2 class="h2 page-section__title text-center">Оформите заказ противопожарных дверей сейчас!</h2>
<script id="bx24_form_inline" data-skip-moving="true">
    (function (w, d, u, b) {
        w['Bitrix24FormObject'] = b;
        w[b] = w[b] || function () {
            arguments[0].ref = u;
            (w[b].forms = w[b].forms || []).push(arguments[0])
        };
        if (w[b]['forms']) return;
        s = d.createElement('script');
        r = 1 * new Date();
        s.async = 1;
        s.src = u + '?' + r;
        h = d.getElementsByTagName('script')[0];
        h.parentNode.insertBefore(s, h);
    })(window, document, 'https://dverim.bitrix24.ru/bitrix/js/crm/form_loader.js', 'b24form');

    b24form({"id": "12", "lang": "ru", "sec": "x584cv", "type": "inline"});
</script>



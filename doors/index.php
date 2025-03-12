<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("DESCRIPTION", "Подбор двери по параметрам");
$APPLICATION->SetTitle("Подбор двери по параметрам");
?>
<noindex>
<div class="catalog-filter-wrapper gray-bg">
    <?  $APPLICATION->IncludeComponent(
	"bitrix:catalog.smart.filter", 
	"filter", 
	array(
		"COMPONENT_TEMPLATE" => "filter",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "3",
		"FILTER_NAME" => "arrFilter",
		"TEMPLATE_THEME" => "blue",
		"FILTER_VIEW_MODE" => "vertical",
		"POPUP_POSITION" => "left",
		"DISPLAY_ELEMENT_COUNT" => "N",
		"SEF_MODE" => "Y",
		"SEF_RULE" => "/doors/filter/#SMART_FILTER_PATH#/apply/",
		"SECTION_ID" => "24",
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => "",
		"SMART_FILTER_PATH" => $_REQUEST["SMART_FILTER_PATH"],
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SAVE_IN_SESSION" => "N",
		"PAGER_PARAMS_NAME" => "arrPager",
		"XML_EXPORT" => "N",
		"SECTION_TITLE" => "-",
		"SECTION_DESCRIPTION" => "-"
	),
	false
);?>
    <!--/Catalog-filter-->
</div>
</noindex>
</section><!--.page-section close opened in header-->

<div class="page-section">
    <div class="container">
        <!--Products-->
        <?
        $APPLICATION->IncludeComponent("bitrix:catalog.section", ".default", Array(
          "COMPONENT_TEMPLATE" => ".default",
          "IBLOCK_TYPE" => "catalog", // Тип инфоблока
          "IBLOCK_ID" => "3", // Инфоблок
          "SECTION_ID" => "24", // ID раздела
          "SECTION_CODE" => "", // Код раздела
          "SECTION_USER_FIELDS" => array(// Свойства раздела
            0 => "",
            1 => "",
          ),
          "FILTER_NAME" => "arrFilter", // Имя массива со значениями фильтра для фильтрации элементов
          "INCLUDE_SUBSECTIONS" => "Y", // Показывать элементы подразделов раздела
          "SHOW_ALL_WO_SECTION" => "N", // Показывать все элементы, если не указан раздел
          "ELEMENT_SORT_FIELD" => "sort", // По какому полю сортируем элементы
          "ELEMENT_SORT_ORDER" => "asc", // Порядок сортировки элементов
          "ELEMENT_SORT_FIELD2" => "id", // Поле для второй сортировки элементов
          "ELEMENT_SORT_ORDER2" => "desc", // Порядок второй сортировки элементов
          "PAGE_ELEMENT_COUNT" => "18", // Количество элементов на странице
          "LINE_ELEMENT_COUNT" => "3", // Количество элементов выводимых в одной строке таблицы
          "PROPERTY_CODE" => array(// Свойства
            0 => "FIRE_RESIST",
            1 => "CONSTUCTION",
            2 => "",
          ),
          "PROPERTY_CODE_MOBILE" => "", // Свойства товаров, отображаемые на мобильных устройствах
          "OFFERS_LIMIT" => "5", // Максимальное количество предложений для показа (0 - все)
          "BACKGROUND_IMAGE" => "-", // Установить фоновую картинку для шаблона из свойства
          "TEMPLATE_THEME" => "blue", // Цветовая тема
          "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]", // Вариант отображения товаров
          "ENLARGE_PRODUCT" => "STRICT", // Выделять товары в списке
          "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare", // Порядок отображения блоков товара
          "SHOW_SLIDER" => "Y", // Показывать слайдер для товаров
          "SLIDER_INTERVAL" => "3000", // Интервал смены слайдов, мс
          "SLIDER_PROGRESS" => "N", // Показывать полосу прогресса
          "ADD_PICT_PROP" => "-", // Дополнительная картинка основного товара
          "LABEL_PROP" => "", // Свойства меток товара
          "MESS_BTN_BUY" => "Купить", // Текст кнопки "Купить"
          "MESS_BTN_ADD_TO_BASKET" => "В корзину", // Текст кнопки "Добавить в корзину"
          "MESS_BTN_SUBSCRIBE" => "Подписаться", // Текст кнопки "Уведомить о поступлении"
          "MESS_BTN_DETAIL" => "Подробнее", // Текст кнопки "Подробнее"
          "MESS_NOT_AVAILABLE" => "Нет в наличии", // Сообщение об отсутствии товара
          "RCM_TYPE" => "personal", // Тип рекомендации
          "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"], // Параметр ID продукта (для товарных рекомендаций)
          "SHOW_FROM_SECTION" => "N", // Показывать товары из раздела
          "SECTION_URL" => "", // URL, ведущий на страницу с содержимым раздела
          "DETAIL_URL" => "", // URL, ведущий на страницу с содержимым элемента раздела
          "SECTION_ID_VARIABLE" => "SECTION_ID", // Название переменной, в которой передается код группы
          "SEF_MODE" => "N", // Включить поддержку ЧПУ
          "AJAX_MODE" => "N", // Включить режим AJAX
          "AJAX_OPTION_JUMP" => "N", // Включить прокрутку к началу компонента
          "AJAX_OPTION_STYLE" => "Y", // Включить подгрузку стилей
          "AJAX_OPTION_HISTORY" => "N", // Включить эмуляцию навигации браузера
          "AJAX_OPTION_ADDITIONAL" => "", // Дополнительный идентификатор
          "CACHE_TYPE" => "A", // Тип кеширования
          "CACHE_TIME" => "36000000", // Время кеширования (сек.)
          "CACHE_GROUPS" => "Y", // Учитывать права доступа
          "SET_TITLE" => "N", // Устанавливать заголовок страницы
          "SET_BROWSER_TITLE" => "N", // Устанавливать заголовок окна браузера
          "BROWSER_TITLE" => "-", // Установить заголовок окна браузера из свойства
          "SET_META_KEYWORDS" => "N", // Устанавливать ключевые слова страницы
          "META_KEYWORDS" => "-", // Установить ключевые слова страницы из свойства
          "SET_META_DESCRIPTION" => "N", // Устанавливать описание страницы
          "META_DESCRIPTION" => "-", // Установить описание страницы из свойства
          "SET_LAST_MODIFIED" => "N", // Устанавливать в заголовках ответа время модификации страницы
          "USE_MAIN_ELEMENT_SECTION" => "N", // Использовать основной раздел для показа элемента
          "ADD_SECTIONS_CHAIN" => "N", // Включать раздел в цепочку навигации
          "CACHE_FILTER" => "N", // Кешировать при установленном фильтре
          "ACTION_VARIABLE" => "action", // Название переменной, в которой передается действие
          "PRODUCT_ID_VARIABLE" => "id", // Название переменной, в которой передается код товара для покупки
          "PRICE_CODE" => array(// Тип цены
            0 => "PRICE_N",
          ),
          "USE_PRICE_COUNT" => "N", // Использовать вывод цен с диапазонами
          "SHOW_PRICE_COUNT" => "1", // Выводить цены для количества
          "PRICE_VAT_INCLUDE" => "Y", // Включать НДС в цену
          "BASKET_URL" => "/personal/basket.php", // URL, ведущий на страницу с корзиной покупателя
          "USE_PRODUCT_QUANTITY" => "N", // Разрешить указание количества товара
          "PRODUCT_QUANTITY_VARIABLE" => "quantity", // Название переменной, в которой передается количество товара
          "ADD_PROPERTIES_TO_BASKET" => "Y", // Добавлять в корзину свойства товаров и предложений
          "PRODUCT_PROPS_VARIABLE" => "prop", // Название переменной, в которой передаются характеристики товара
          "PARTIAL_PRODUCT_PROPERTIES" => "N", // Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
          "PRODUCT_PROPERTIES" => "", // Характеристики товара
          "DISPLAY_COMPARE" => "N", // Разрешить сравнение товаров
          "PAGER_TEMPLATE" => ".default", // Шаблон постраничной навигации
          "DISPLAY_TOP_PAGER" => "N", // Выводить над списком
          "DISPLAY_BOTTOM_PAGER" => "Y", // Выводить под списком
          "PAGER_TITLE" => "Товары", // Название категорий
          "PAGER_SHOW_ALWAYS" => "N", // Выводить всегда
          "PAGER_DESC_NUMBERING" => "N", // Использовать обратную навигацию
          "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000", // Время кеширования страниц для обратной навигации
          "PAGER_SHOW_ALL" => "N", // Показывать ссылку "Все"
          "PAGER_BASE_LINK_ENABLE" => "N", // Включить обработку ссылок
          "LAZY_LOAD" => "N", // Показать кнопку ленивой загрузки Lazy Load
          "LOAD_ON_SCROLL" => "N", // Подгружать товары при прокрутке до конца
          "SET_STATUS_404" => "Y", // Устанавливать статус 404
          "SHOW_404" => "Y", // Показ специальной страницы
          "FILE_404" => "", // Страница для показа (по умолчанию /404.php)
          "COMPATIBLE_MODE" => "Y", // Включить режим совместимости
          "DISABLE_INIT_JS_IN_COMPONENT" => "N", // Не подключать js-библиотеки в компоненте
          "USE_ENHANCED_ECOMMERCE" => "N", // Отправлять данные электронной торговли в Google и Яндекс
            ), false
        );
        ?>
        <!--/products-->
    </div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile(__FILE__);

use Bitrix\Main\Page\Asset;

/**@global CMain $APPLICATION */

$dirInfo = wf_curdir();
global $USER;
?>
<?php
$divs = 0;
if ($dirInfo["CHAIN"][1] == "catalog") {
    switch ($dirInfo["COUNT"]) {
        case 1:
            $divs = 0; ///catalog/
            break;
        case 2:
            $divs = 3; ///catalog/section/
            break;
        case 3:
            $divs = 1; ///catalog/section/detail/
            break;
    }

    if ($divs > 0) {
        for ($i = 1; $i <= $divs; $i++) {
            echo "</div>";
        }
    }
}
?>
<?php if ($dirInfo["CHAIN"][1] == "catalog"): ?>
    </section><!--.page-section close-->
    <?php $APPLICATION->ShowViewContent('catalog_detail'); ?>
    <?php $APPLICATION->ShowViewContent('catalog_section'); ?>
<?php endif ?>
<?php if ($dirInfo["CHAIN"][1] !== "catalog" and $dirInfo["CHAIN"][1] !== "doors"): ?>
    </div>
    </div>
    </section>
<?php endif ?>
</div>
<!--maincontent close-->
<!--Content ends-->
<?php if (defined("ERROR_404")): ?>
    <div id="maincontent">
        <div id="errorPage" class="errorPage">
            <video class="bg-video jquery-background-video" loop autoplay muted
                   poster="<?= SITE_TEMPLATE_PATH ?>/video/poster.jpg">
                <source src="<?= SITE_TEMPLATE_PATH ?>/video/bg-video.mp4" type="video/mp4">
                <source src="<?= SITE_TEMPLATE_PATH ?>/video/bg-video.webm" type="video/webm">
            </video>
            <div class="error-details">
                <div class="error-details__code">404</div>
                <h4 class="error-details__description">Запрашиваемая страница не&nbsp;существует.</h4>
                <p><a href="/" class="btn btn--sky btn--lg">Перейти на главную</a></p>
            </div>
        </div>
    </div>
<?php endif ?>
<?php
if (false) { ?>
<?php } else { ?>

    <!--Footer-->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <a href="/" class="footer-logo">
                        <span class="logo-sign"></span>
                    </a>
                    <p class="phone h4">#WF_PHONE#</p>
                    <p>#WF_SCHEDULE#</p>
                    <?php
                    $APPLICATION->IncludeComponent(
                        "webfly:cities.popup", "popup_bottom", [
                        "COMPONENT_TEMPLATE" => "popup",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600",
                        "WF_FAVORITE" => "WF_FAVOURITE",
                        "WF_JQUERY" => "N"
                    ], false
                    );
                    ?>
                    <p>#WF_CONTACTS#</p>
                    <p>#WF_ADRESS_2#</p>
                    <p>Почта: <a href="mailto:#WF_EMAIL#"> #WF_EMAIL#</a></p>
                    <div class="socials">
                        <a href="https://t.me/dverim_bot" target="_blank" class="telegram"></a>
                        <span class="whatsapp"></span>
                    </div>
                    <p class="copyright">© 2014—<?= date("Y") ?><br/>
                        <?php
                        $APPLICATION->IncludeFile(
                            SITE_DIR . "include/footer/copyright.php", [], ["NAME" => "кнопку", "MODE" => "html"]
                        );
                        ?>
                    </p>
                    <!--noindex-->
                    <p class="credits">Сделано в&nbsp;<a href="https://webfly.ru" target="_blank">Вебфлай</a></p>
                    <!--/noindex-->
                </div>
                <?php
                $APPLICATION->IncludeComponent("bitrix:menu", "bottom_products", [
                    "COMPONENT_TEMPLATE" => ".default",
                    "ROOT_MENU_TYPE" => "bottom_sections", // Тип меню для первого уровня
                    "MENU_CACHE_TYPE" => "Y", // Тип кеширования
                    "MENU_CACHE_TIME" => "360000", // Время кеширования (сек.)
                    "MENU_CACHE_USE_GROUPS" => "Y", // Учитывать права доступа
                    "MENU_CACHE_GET_VARS" => "", // Значимые переменные запроса
                    "MAX_LEVEL" => "1", // Уровень вложенности меню
                    "CHILD_MENU_TYPE" => "bottom_dop", // Тип меню для остальных уровней
                    "USE_EXT" => "Y", // Подключать файлы с именами вида .тип_меню.menu_ext.php
                    "DELAY" => "N", // Откладывать выполнение шаблона меню
                    "ALLOW_MULTI_SELECT" => "N", // Разрешить несколько активных пунктов одновременно
                ], false
                );
                ?>
                <div class="col-md-3 col-sm-4">
                    <?php
                    $APPLICATION->IncludeComponent("bitrix:menu", "bottom_info", [
                        "COMPONENT_TEMPLATE" => ".default",
                        "ROOT_MENU_TYPE" => "bottom_info", // Тип меню для первого уровня
                        "MENU_CACHE_TYPE" => "N", // Тип кеширования
                        "MENU_CACHE_TIME" => "360000", // Время кеширования (сек.)
                        "MENU_CACHE_USE_GROUPS" => "Y", // Учитывать права доступа
                        "MENU_CACHE_GET_VARS" => "", // Значимые переменные запроса
                        "MAX_LEVEL" => "1", // Уровень вложенности меню
                        "CHILD_MENU_TYPE" => "bottom_info_dop", // Тип меню для остальных уровней
                        "USE_EXT" => "N", // Подключать файлы с именами вида .тип_меню.menu_ext.php
                        "DELAY" => "N", // Откладывать выполнение шаблона меню
                        "ALLOW_MULTI_SELECT" => "N", // Разрешить несколько активных пунктов одновременно
                    ], false
                    );
                    ?>
                    <?php
                    $APPLICATION->IncludeFile(
                        SITE_DIR . "include/footer/no_oferta.php", [], ["NAME" => "Не оферта", "MODE" => "text"]
                    );
                    ?>
                </div>
            </div>
        </div>
    </footer>
    <!--Footer ends-->
<?php } ?>


<!--Mobile menu-->
<nav class="nav-mobile-wrapper">
    <div class="nav-mobile">
        <button class="btn-transparent btn-close-menu"><span class="icon-cancel-music"></span></button>
        <div class="nav-mobile__title h6">Навигация по сайту</div>
        <?php


        $APPLICATION->IncludeComponent("bitrix:menu", "vertical_multilevel_mobile", [
            "COMPONENT_TEMPLATE" => "vertical_multilevel",
            "ROOT_MENU_TYPE" => "mobile_bottom",    // Тип меню для первого уровня
            "MENU_CACHE_TYPE" => "Y",    // Тип кеширования
            "MENU_CACHE_TIME" => "360000",    // Время кеширования (сек.)
            "MENU_CACHE_USE_GROUPS" => "Y",    // Учитывать права доступа
            "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
            "MAX_LEVEL" => "2",    // Уровень вложенности меню
            "CHILD_MENU_TYPE" => "catalog_logic",    // Тип меню для остальных уровней
            "USE_EXT" => "Y",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
            "DELAY" => "N",    // Откладывать выполнение шаблона меню
            "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
            "MENU_THEME" => "site"
        ],
            false
        );

        ?>
        <div class="h6">Контактная информация</div>
        <ul class="list-unstyled mobile-contacts">
            <li>
                Город: <a href="#" class="link-dashed">#WF_CITY_NAME#</a><br/>
                <span class="address">#WF_CONTACTS#</span>
            </li>
            <li>Телефон: #WF_PHONE#</li>
            <li>
                Время работы: <br>
                #WF_SCHEDULE#
            </li>
            <li>
                <div class="socials">
                    <a href="https://t.me/dverim_bot&quot; target=" _blank" class="telegram"></a>
                    <span class="whatsapp"></span>
                </div>
            </li>
            <li>
                <a href="mailto:#WF_EMAIL#">#WF_EMAIL#</a>
            </li>
            <li>
                <script data-b24-form="click/20/ya575p" data-skip-moving="true">(function (w, d, u) {
                        var s = d.createElement('script');
                        s.async = true;
                        s.src = u + '?' + (Date.now() / 180000 | 0);
                        var h = d.getElementsByTagName('script')[0];
                        h.parentNode.insertBefore(s, h);
                    })(window, document, 'https://cdn-ru.bitrix24.ru/b3809885/crm/form/loader_20.js');</script>
                <a href="#" class="link-dashed modal-universal-button">Вызвать замерщика</a></li>

            <li>
                <script data-b24-form="click/16/17fjsp" data-skip-moving="true">(function (w, d, u) {
                        var s = d.createElement('script');
                        s.async = true;
                        s.src = u + '?' + (Date.now() / 180000 | 0);
                        var h = d.getElementsByTagName('script')[0];
                        h.parentNode.insertBefore(s, h);
                    })(window, document, 'https://cdn-ru.bitrix24.ru/b3809885/crm/form/loader_16.js');</script>
                <a href="#" class="link-dashed modal-universal-button">Обратный звонок</a>
            </li>
            <li>
                <script data-b24-form="click/22/fmjtet" data-skip-moving="true">(function (w, d, u) {
                        var s = d.createElement('script');
                        s.async = true;
                        s.src = u + '?' + (Date.now() / 180000 | 0);
                        var h = d.getElementsByTagName('script')[0];
                        h.parentNode.insertBefore(s, h);
                    })(window, document, 'https://cdn-ru.bitrix24.ru/b3809885/crm/form/loader_22.js');</script>
                <a href="#" class="btn-bordered btn--sky modal-universal-button">Получить оптовый прайс-лист</a>
            </li>
        </ul>
    </div>
</nav>
<!--/mobile menu-->
<?php
$APPLICATION->IncludeComponent(
    "webfly:message.add", "order", [
    "OK_TEXT" => GetMessage("WF_OK_TEXT"),
    "EMAIL_TO" => "",
    "IBLOCK_TYPE" => "feedback",
    "IBLOCK_ID" => "20",
    "EVENT_MESSAGE_ID" => [
        0 => "12",
    ],
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "36000000",
    "SET_TITLE" => "N",
    "COMPONENT_TEMPLATE" => "order"
], false, [
        "HIDE_ICONS" => "Y"
    ]
);
?>
<!--Bottom fixed panel-->
<div class="bottom-panel hidden-xs">
    <div class="container">
        <div class="bottom-panel__content">
            <div class="path">
                <ul class="list-inline">
                    <li>
                        <span class="flaticon-message"></span>
                        <a href="mailto:#WF_EMAIL#" class="text--sky">#WF_EMAIL#</a>
                    </li>
                    <li>
                        <span class="flaticon-user-1"></span>
                        <!--В data-options хранится строка в формате Заголовок модального окна|селекторы полей, которые нужно скрыть из формы-->
                        <script data-b24-form="click/20/ya575p" data-skip-moving="true">(function (w, d, u) {
                                var s = d.createElement('script');
                                s.async = true;
                                s.src = u + '?' + (Date.now() / 180000 | 0);
                                var h = d.getElementsByTagName('script')[0];
                                h.parentNode.insertBefore(s, h);
                            })(window, document, 'https://cdn-ru.bitrix24.ru/b3809885/crm/form/loader_20.js');</script>
                        <a href="#" class="link-dashed modal-universal-button">Вызвать замерщика</a>
                    </li>
                    <li>
                        <span class="icon-phone-callback"></span>
                        <script data-b24-form="click/16/17fjsp" data-skip-moving="true">(function (w, d, u) {
                                var s = d.createElement('script');
                                s.async = true;
                                s.src = u + '?' + (Date.now() / 180000 | 0);
                                var h = d.getElementsByTagName('script')[0];
                                h.parentNode.insertBefore(s, h);
                            })(window, document, 'https://cdn-ru.bitrix24.ru/b3809885/crm/form/loader_16.js');</script>
                        <a href="#" class="link-dashed modal-universal-button">Обратный звонок</a>
                    </li>
                </ul>
            </div>
            <div class="path">
                <a href="https://t.me/dverim_bot" ; class="soc-link telegram" target="_blank"></a>
                <span class="soc-link whatsapp"></span>
                <a href="https://vk.com/dveri_metall_m" class="soc-link" target="_blank"
                   title="Группа Вконтакте"><span class="sociconvk"></span></a>
                <a href="https://www.instagram.com/ooodverimm" class="soc-link" target="_blank"
                   title="Instagram-аккаунт @ooodverimm"><span class="sociconinstagram-new"></span></a>
                <script data-b24-form="click/22/fmjtet" data-skip-moving="true">(function (w, d, u) {
                        var s = d.createElement('script');
                        s.async = true;
                        s.src = u + '?' + (Date.now() / 180000 | 0);
                        var h = d.getElementsByTagName('script')[0];
                        h.parentNode.insertBefore(s, h);
                    })(window, document, 'https://cdn-ru.bitrix24.ru/b3809885/crm/form/loader_22.js');</script>

                <a href="#" class="btn-bordered btn--sky modal-universal-button">Получить прайс-лист</a>
            </div>
        </div>
    </div>
</div>
<!--/bottom fixed panel-->

<?php
$APPLICATION->IncludeComponent(
    "webfly:message.add", "universal", [
    "OK_TEXT" => GetMessage("WF_OK_TEXT"),
    "EMAIL_TO" => "",
    "IBLOCK_TYPE" => "feedback",
    "IBLOCK_ID" => "19",
    "EVENT_MESSAGE_ID" => [
        0 => "11",
    ],
    "CACHE_TYPE" => "A",
    "CACHE_TIME" => "36000000",
    "SET_TITLE" => "N",
    "COMPONENT_TEMPLATE" => "universal"
], false, [
        "HIDE_ICONS" => "Y"
    ]
);

$asset = \Bitrix\Main\Page\Asset::getInstance();
$asset->addCss(SITE_TEMPLATE_PATH . "/fonts.css");
$asset->addCss(SITE_TEMPLATE_PATH . '/critical-prod.css');
//$APPLICATION->ShowCSS();
$asset->addJs(SITE_TEMPLATE_PATH . "/js/jquery.min.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/cities.min.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/device.min.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/build.js");
$asset->addJs(SITE_TEMPLATE_PATH . "/js/additional.js");
if ($USER->IsAdmin()) {
    $asset->addCss(SITE_TEMPLATE_PATH . "/admin.css");
    $asset->addJs(SITE_TEMPLATE_PATH . "/admin.js");
}


$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$uri = $request->getRequestedPageDirectory();
$arUri = $request->getQueryList()->toArray();

$requestList = implode(':', array_flip($arUri));
if (strpos($requestList, 'PAGEN_') !== false) {
    $pagen = true;
    foreach (array_flip($arUri) as $key => $params) {
        if (strpos($params, 'PAGEN_') !== false) {
            $numberPagen = $key;
        }
    }
}

if (strpos($requestList, 'SORT_FIELD') !== false) {
    $sort = true;
}

$filter = false;
$filterPos = strpos($uri, 'filter');
if ($filterPos > 0 && strpos($uri, 'apply') !== false) {
    $filter = true;
    $substr = substr($uri, 0, $filterPos);
    $APPLICATION->AddHeadString('<link rel="canonical" href="https://' . $_SERVER['SERVER_NAME'] . $substr . '">', true);
}
if ($pagen || $sort) {
    $APPLICATION->SetPageProperty("description", "");
    if ($filter || $sort) $APPLICATION->SetPageProperty("robots", "noindex, nofollow");
    else {
        $APPLICATION->SetPageProperty("robots", "noindex, follow");
        $APPLICATION->AddHeadString('<link rel="canonical" href="https://' . $_SERVER['SERVER_NAME'] . $uri . '">', true);
    }
    $title = $APPLICATION->GetPageProperty("title");
    $APPLICATION->SetPageProperty("title", $title . ' | Cтраница ' . $numberPagen);
} else {
    if ($filter) $APPLICATION->SetPageProperty("robots", "noindex, nofollow");
    else $APPLICATION->AddHeadString('<link rel="canonical" href="https://' . $_SERVER['SERVER_NAME'] . $uri . '">', true);
}

?>
#WF_COUNT#

<script>
    setTimeout(function () {
        (function (w, d, u) {
            var s = d.createElement('script');
            s.async = true;
            s.src = u + '?' + (Date.now() / 60000 | 0);
            var h = d.getElementsByTagName('script')[0];
            h.parentNode.insertBefore(s, h);
        })(window, document, 'https://cdn-ru.bitrix24.ru/b3809885/crm/site_button/loader_2_tuzy2b.js');
    }, 10000)
</script>

<script data-skip-moving="true">
    var YA_COUNTER_ID = #WF_YA_COUNTER
    #
    ;
</script>

<div style="display: none;" itemscope itemtype="http://schema.org/Organization">
    <span itemprop="name">Двери Металл-М</span>
    <span itemprop="image"><?= SITE_TEMPLATE_PATH ?>/img/logo.svg</span>
    <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
        <span itemprop="streetAddress">#WF_CONTACTS#</span>
        <span itemprop="addressLocality">#WF_CITY_NAME#</span>,
    </div>
    <span itemprop="telephone">#WF_PHONES#</span>
    <span itemprop="email">#WF_EMAIL#</span>
</div>
<div class="h-card" style="display: none;">
    <span class="p-name">ООО «Двери металл - М»</span>
    <span class="p-tel">8(920)428-52-53</span>
    <a class="u-email" href="mailto:89161868081@rambler.ru">89161868081@rambler.ru</a>
    <div class="p-adr">
        <span class="p-street-address">ул. Богдана Хмельницкого, д. 77А, Офис 1</span>,
        <span class="p-locality">Воронеж</span>,
        <span class="p-country-name">Россия</span>
    </div>
</div>

<div class="scroll-top-button">
    <a href="#top" class="scroll-svg"></a>
</div>
</body>
</html>
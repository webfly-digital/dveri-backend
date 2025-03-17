<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

CJSCore::Init(["fx"]);

/**
 * @global CMain $APPLICATION
 * @const WF_CITIES_IBLOCK
 */

?>
    <!DOCTYPE html>
    <html lang="ru" class="wf-active">
<?php
IncludeTemplateLangFile(__FILE__);
Loader::includeModule('webfly.seocities');
$wfc = new CWebflyCities();
global $showArticles;
global $subDomain;
$sub = $wfc->GetSubDomain();
$subDomain = $sub;
$showArticles = ($sub === 'msk');

$dirInfo = wf_curdir();


$serverName = $_SERVER["SERVER_NAME"];
$pos = strpos($serverName, "www.");
if ($pos !== false) {
    //   LocalRedirect( 'https://1dvm.ru'.$APPLICATION->GetCurDir(), false, '301 Moved permanently');
}


?>
    <head>
        #WF_META#
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <title><?php $APPLICATION->ShowTitle() ?></title>
        <link rel="preconnect" href="https://bitrix.info">
        <link rel="preconnect" href="https://ajax.googleapis.com">
        <link rel="preconnect" href="https://cdn.bitrix24.ru">
        <link rel="preconnect" href="https://dverim.bitrix24.ru">
        <meta name="cmsmagazine" content="90c9ae1d3cdb4c8ca44eb18f6e3b47bd"/>
        <meta name="yandex-verification" content="08e82a6b57052730"/>
        <link rel="icon" type="image/png" href="/favicon.svg">
        <?php
        //$APPLICATION->ShowMeta("robots", false, true);
        $APPLICATION->ShowMeta("keywords", false, true);
        //$APPLICATION->ShowMeta("description", false, true);
        $APPLICATION->ShowLink("canonical", null, true);
        $APPLICATION->ShowHead();
        //$APPLICATION->ShowHeadStrings();
        //$APPLICATION->ShowHeadScripts(); ?>
    </head>
<?php
global $USER;
if ($dirInfo["DIR"] == SITE_DIR)
    $bodyClass = 'light-header';
else
    $bodyClass = '';
$bodyClass = $USER->isAdmin() ? 'header' : $bodyClass;
?>
<body class="header">
<?php $APPLICATION->ShowPanel(); ?>
    <input id="wf-load-avg" type="hidden" value="<?= wf_get_load_avg() // see init.php                  ?>">
<?php
// нужно настроить перенаправление по geo ip московский трафик с основного домена
//  https://1dvm.ru/ на https://msk.1dvm.ru/ соответственно.
$wfc = new CWebflyCities();
$sub = $wfc->GetSubDomain();
if (false === strpos($_SERVER['HTTP_USER_AGENT'], 'YandexBot'))
    if (empty($sub) || $sub == 'default' && $_COOKIE['wf-cancel_city'] != 'Y') {
        \Bitrix\Main\Loader::includeModule("reaspekt.geobase");
        $addr = \Reaspekt\Geobase\DefaultCities::GetAddr();
        //$addr["CITY"] = 'Москва';
        if (!empty($addr) && $addr["CITY"] == 'Москва') {
            $el = CIblockElement::GetList([], ['IBLOCK_CODE' => WF_CITIES_IBLOCK, 'NAME' => $addr["CITY"]])->GetNextElement();
            $p = $el->GetProperty('18');
            if (!empty($p["VALUE"])) {
                \Bitrix\Main\UI\Extension::load("ui.dialogs.messagebox");
                //LocalRedirect('https://' . $p["VALUE"] . '.1dvm.ru' . $_SERVER["REQUEST_URI"]);
                ?>
                <script>
                    BX.UI.Dialogs.MessageBox.show(
                        {
                            title: " ",
                            message: '<h5 style="text-align:center">Ваш город - Москва?</h5>',
                            //modal: true,
                            closeIcon: true,
                            buttons: BX.UI.Dialogs.MessageBoxButtons.OK_CANCEL,
                            onOk: function (messageBox) {
                                window.location.href = '<?='https://' . $p["VALUE"] . '.1dvm.ru' . $_SERVER["REQUEST_URI"]?>';
                            },
                            onCancel: function (messageBox) {
                                document.cookie = "wf-cancel_city=Y; path=/; max-age=604800";
                                messageBox.close();
                            }
                        }
                    );
                </script>
                <?php
            }
        }
    }
?>
    <!--Header-->
    <header class="header">
        <!--Изменения 05/2018-->
        <div class="container h-supertop hidden-sm hidden-xs">
            <div class="h-supertop__path">
                <?php /*<ul class="list-inline list-social">
                    <li><a href="https://vk.com/dveri_metall_m" class="soc-link" target="_blank" title="Группа Вконтакте"><span class="sociconvk"></span></a></li>
                    <li><a href="https://www.instagram.com/ooodverimm" class="soc-link" target="_blank" title="Instagram-аккаунт @ooodverimm"><span class="sociconinstagram-new"></span></a></li>
                </ul>*/ ?>
                <?php
                $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "inline",
                    [
                        "ROOT_MENU_TYPE" => "htop",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "36000",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => [],
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "",
                        "USE_EXT" => "N",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                    ],
                    false
                );
                ?>
            </div>
            <div class="h-supertop__path">
                <ul class="list-inline">
                    <li>
                        <span class="flaticon-location hidden-md"></span>
                        <div><?php
                            $APPLICATION->IncludeComponent(
                                "webfly:cities.popup", "popup", [
                                "COMPONENT_TEMPLATE" => "popup",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "3600",
                                "WF_FAVORITE" => "WF_FAVOURITE",
                                "WF_JQUERY" => "N"
                            ], false
                            );
                            ?>
                            <p>ул. Богдана Хмельницкого, д. 77а</p>
                        </div>
                    </li>
                    <li>
                        <span class="flaticon-timeline hidden-md"></span>
                        <p>Пн-Пт: 9:00-17:45<br>Сб-Вс-выходной</p>
                    </li>
                    <li><span class="flaticon-envelope hidden-md"></span> <a href="mailto:#WF_EMAIL#" class="text--sky">#WF_EMAIL#</a>
                    </li>
                    <li>
                        <script data-b24-form="click/22/fmjtet" data-skip-moving="true">(function (w, d, u) {
                                var s = d.createElement('script');
                                s.async = true;
                                s.src = u + '?' + (Date.now() / 180000 | 0);
                                var h = d.getElementsByTagName('script')[0];
                                h.parentNode.insertBefore(s, h);
                            })(window, document, 'https://cdn-ru.bitrix24.ru/b3809885/crm/form/loader_22.js');</script>
                        <a href="#" class="btn btn--sky btn--sm modal-universal-button"
                            <?php //      href="#modalUniversal"   data-options="Получить прайс-лист|.input-comment|PRICE_GOAL"?>
                        > Получить прайс-лист</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="header-affix">
            <div class="affix-content">
                <div class="container h-top">
                    <div class="h-top__path">
                        <?php if ($APPLICATION->GetCurDir() == '/') { ?>
                            <span class="logo"></span>
                        <?php } else { ?>
                            <a href="/" class="logo"></a>
                        <?php } ?>
                    </div>
                    <div class="h-top__path hidden-xs">

                        <?php
                        $APPLICATION->IncludeComponent("bitrix:search.form", "search", [
                            "USE_SUGGEST" => "N",    // Показывать подсказку с поисковыми фразами
                            "PAGE" => "#SITE_DIR#search/    ",    // Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
                            "COMPONENT_TEMPLATE" => "search"
                        ],
                            false
                        );
                        ?>

                    </div>
                    <div class="h-top__path hidden-sm hidden-xs">
                        <div class="contact">
                            <div class="contact__icon"><span class="flaticon-phone-call"></span></div>
                            <div class="contact__content">
                                <p class="contact__phone"><a href="tel:88007001304">#WF_PHONES#</a></p>
                                <p class="contact__main">#WF_PHONES_GOR#</p>
                                <p class="contact__info hidden-affix">
                                    <script data-b24-form="click/16/17fjsp" data-skip-moving="true">(function (w, d, u) {
                                            var s = d.createElement('script');
                                            s.async = true;
                                            s.src = u + '?' + (Date.now() / 180000 | 0);
                                            var h = d.getElementsByTagName('script')[0];
                                            h.parentNode.insertBefore(s, h);
                                        })(window, document, 'https://cdn-ru.bitrix24.ru/b3809885/crm/form/loader_16.js');</script>
                                    <a href="#"
                                       class="modal-universal-button"
                                        <?php // href="#modalUniversal"  data-options="Обратный звонок|.input-email,.input-comment|CALLBACK_GOAL"?>
                                    ><b>Обратный
                                            звонок</b></a></p>
                            </div>
                        </div>
                    </div>
                    <div class="h-top__path hidden-xs">

                        <div class="h-top__buttons">
                            <script data-b24-form="click/20/ya575p" data-skip-moving="true">(function (w, d, u) {
                                    var s = d.createElement('script');
                                    s.async = true;
                                    s.src = u + '?' + (Date.now() / 180000 | 0);
                                    var h = d.getElementsByTagName('script')[0];
                                    h.parentNode.insertBefore(s, h);
                                })(window, document, 'https://cdn-ru.bitrix24.ru/b3809885/crm/form/loader_20.js');</script>
                            <a href="#" class="btn btn--sm btn--gray modal-universal-button"
                               style="line-height: 30px;    background-color: #f24840"
                                <?php // href="#modalUniversal" data-options="Вызвать замерщика|.input-comment|GAGER_GOAL"?>
                            >
                                <span class="flaticon-user-1"></span> Бесплатный вызов замерщика</a>
                            <a href="/doors/" class="btn btn--sm btn--gray">Быстрый подбор</a>
                        </div>
                    </div>
                </div>
                <nav class="h-nav">
                    <div class="h-nav__inner">
                        <div class="container">

                            <?php

                            $APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                'header_ml_new',
                                [
                                    "ROOT_MENU_TYPE" => "main",
                                    "MENU_CACHE_TYPE" => "N",
                                    "MENU_CACHE_TIME" => "36000",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "MENU_CACHE_GET_VARS" => [],
                                    "MAX_LEVEL" => "3",
                                    "CHILD_MENU_TYPE" => "catalog",
                                    "USE_EXT" => "Y",
                                    "DELAY" => "N",
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "COMPONENT_TEMPLATE" => "header_ml"
                                ],
                                false, ['HIDE_ICONS' => 'Y']
                            );
                            ?>

                            <div class="visible-xs">
                                <ul class="nav-main mobile">
                                    <li class="nav-main__item">
                                        <a href="tel:+74732589800" class="flaticon-phone-call"></a>
                                        <a href="/contacts/"><span class="flaticon-placeholder"></span></a>
                                        <a href="#" class="wf-city-opener link-dashed">#WF_CITY_NAME#</a>
                                    </li>
                                    <li class="nav-main__item"></li>
                                    <li class="nav-main__item">
                                        <form action="/search/" class="search-group">
                                            <button class="flaticon-loupe search-opener"></button>
                                            <input type="text" name="q" class="search-input"
                                                   placeholder="Поиск по каталогу">
                                        </form>
                                        <button class="btn-menu" aria-label="Главное меню"><span
                                                    class="btn-menu__icon"></span></button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!--/изменения 05/2018-->
    </header>
    <!--Header ends-->

    <!--Content-->
<div id="maincontent">
<?php if (CSite::InDir('/catalog/')) { ?>
    <div class="advantages-wrapper">
        <div class="container">
            <?php $APPLICATION->IncludeFile("/include/seo.php", [], ["MODE" => "php", "NAME" => "seo",]); ?>
        </div>
    </div>
<?php } ?>
<?php if ($dirInfo["DIR"] !== SITE_DIR) { ?>
    <section class="page-section" id="filter-section">
    <!--Хлебные крошки Start-->
    <div class="container">
    <div class="row">
    <div class="col-xs-12">
    <?php
    $APPLICATION->IncludeComponent("bitrix:breadcrumb", ".default", [
        "START_FROM" => "0", // Номер пункта, начиная с которого будет построена навигационная цепочка
        "PATH" => "", // Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
        "SITE_ID" => "s1", // Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
    ], false
    );
    ?>
    <?php
    if ($dirInfo["CHAIN"][1] !== "catalog" and $dirInfo["CHAIN"][1] !== "doors")
        $h1Class = ' title-underlined';
    else
        $h1Class = '';
    ?>
    <h1 class="page-section__title<?= $h1Class ?>"><?= $APPLICATION->ShowTitle(false) ?></h1>
    <!--Хлебные крошки end-->
    <?php
    $divs = 3;
    if ($dirInfo["CHAIN"][1] == "catalog") {
        switch ($dirInfo["COUNT"]) {
            case 1:
                $divs = 3; ///catalog/
                break;
            case 2:
                $divs = 0; ///catalog/section/
                break;
            case 3:
            default:
                $divs = 2; ///catalog/section/detail/
                break;
        }
    }
    if ($divs > 0) {
        for ($i = 1; $i <= $divs; $i++) {
            echo "</div>";
        }
    }
    ?>
    <?php if ($dirInfo["CHAIN"][1] !== "catalog" and $dirInfo["CHAIN"][1] !== "doors") { ?>
        </section><!--.page-section close-->
        <section class="page-section">
        <div class="container">
        <div class="row">
    <?php } ?>
<?php } ?>
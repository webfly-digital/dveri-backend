<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

/**
 * /**
 * @global CMain $APPLICATION
 * @var  string  $sub
 */

$APPLICATION->SetPageProperty("title", "Завод противопожарных дверей «Двери металл-М» в #WF_CITY_PRED#");
$APPLICATION->SetPageProperty("description", "Завод «Двери металл-М» реализует противопожарные двери, ворота, люки по #WF_CITY_DAT# и области по ГОСТу. Продажа оптом и в розницу различных огнестойких и технических дверей, ворот, люков. Заказывайте по тел.: #WF_PHONES#.");
$APPLICATION->SetTitle("«Двери металл-М» - противопожарные двери в #WF_CITY_PRED#: огнеупорные, пожарные, противодымные двери");

?>
    <!-- Open Graph -->
    <div style="display:none;">
        <meta property="og:title" content="<?php $APPLICATION->ShowTitle(false) ?> в <?= htmlspecialchars("#WF_CITY_PRED#") ?>"/>
        <meta property="og:description" content="<?php $APPLICATION->ShowProperty("description") ?>"/>
        <meta property="og:image" content="https://<?= ($sub !== 'default' ? htmlspecialchars($sub) . '.' : '') . SITE_SERVER_NAME . SITE_TEMPLATE_PATH; ?>/img/logo.svg"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="https://<?= ($sub !== 'default' ? htmlspecialchars($sub) . '.' : '') . SITE_SERVER_NAME . "/" ?>"/>
        <meta property="og:locale" content="ru_RU"/>
        <meta property="og:site_name" content="«Двери металл-М» в #WF_CITY_PRED#"/>
    </div>
    <!-- End Open Graph -->

<?php global $USER;
if (true) { ?> <!--Top slider-->
    <div id="top-screen-wrapper" style="background-image: url(<?= SITE_TEMPLATE_PATH ?>/video/poster.webp);">
        <div class="bg-video-wrapper" id="bgVideo1">
            <script>
                var bgVideo1 = {
                    desktop: {
                        poster: '<?=SITE_TEMPLATE_PATH?>/video/poster.webp',
                        video: '<?=SITE_TEMPLATE_PATH?>/video/promo-video@720.mp4'
                    },
                    tablet: {
                        poster: '<?=SITE_TEMPLATE_PATH?>/video/poster.webp',
                        video: '<?=SITE_TEMPLATE_PATH?>/video/promo-video@375.mp4'
                    },
                    mobile: {
                        poster: '<?=SITE_TEMPLATE_PATH?>/video/poster.webp',
                        video: '<?=SITE_TEMPLATE_PATH?>/video/promo-video@375.mp4'
                    }
                }
            </script>
        </div>
        <div class="top-screen__content">
            <div class="container">
                <div class="content-top">
                    <h1>Противопожарные двери в #WF_CITY_PRED# оптом по ГОСТу и в срок</h1>
                    <div class="top-screen__description">
                        <p>
                            Широкий выбор противопожарных дверей и конструкций от <span class="bigger">9 600 Р</span>
                        </p>
                    </div>
                    <div class="top-screen__cta">
                        <form action="/include/ajax/universal.php" method="post" class="form user-form form-price-list">
                            <input type="hidden" name="ym_target" value="PRICE_GOAL" class="ym_target">
                            <div class="form-fields d-before-sm">
                                <div class="col-sm-4">
                                    <div class="form-row ">
                                        <a href="/catalog/" class="btn btn--red btn--lg">В каталог</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-fields d-sm">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-row">
                                            <input type="text" name="name" value="" placeholder="Ваше имя" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-row">
                                            <input type="email" name="email" value="" placeholder="Электронная почта"
                                                   required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-row ">
                                            <button class="btn btn--red btn--lg">Получить прайс-лист</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row form-footer">
                                    <label for="price_agreement" class="checkbox theme--light"> <input type="checkbox"
                                                                                                       name="price_agreement"
                                                                                                       id="price_agreement"
                                                                                                       checked=""
                                                                                                       required="">
                                        <span class="checkbox__inner">Даю свое согласие на обработку моих персональных данных, в соответствии с Федеральным законом от 27.07.2006 года №152-ФЗ «О персональных данных», на условиях определенных в Согласии на обработку персональных данных </span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-thanks">
                                <div class="h4">Ваша заявка успешно отправлена. В ближайшее время мы с вами свяжемся.
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row content-bottom">
                    <div class="col-xs-12">
                        <?php $APPLICATION->IncludeFile("/include/seo.php", [], ["MODE" => "php", "NAME" => "seo",]); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/Top slider--> <?php } else { ?> <!--Top slider-->
    <div id="top-screen-wrapper">
        <?php $APPLICATION->IncludeComponent(
            "bitrix:news.detail",
            "banner",
            [
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_ELEMENT_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "BROWSER_TITLE" => "-",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "COMPONENT_TEMPLATE" => "banner",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "N",
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "N",
                "DISPLAY_PREVIEW_TEXT" => "N",
                "DISPLAY_TOP_PAGER" => "N",
                "ELEMENT_CODE" => "",
                "ELEMENT_ID" => "386",
                "FIELD_CODE" => [0 => "", 1 => "",],
                "IBLOCK_ID" => "8",
                "IBLOCK_TYPE" => "news",
                "IBLOCK_URL" => "",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "MESSAGE_404" => "",
                "META_DESCRIPTION" => "-",
                "META_KEYWORDS" => "-",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Страница",
                "PROPERTY_CODE" => [0 => "", 1 => "IMG",],
                "SET_BROWSER_TITLE" => "N",
                "SET_CANONICAL_URL" => "N",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "N",
                "SHOW_404" => "N",
                "STRICT_SECTION_CHECK" => "N",
                "USE_PERMISSIONS" => "N",
                "USE_SHARE" => "N"
            ]
        ); ?>
    </div>
    <!--/Top slider-->
<?php }


//$APPLICATION->IncludeFile("/include/index-clients.html", array(), array("MODE" => "html", "NAME" => "Логотипы клиентов",));

?><?php $APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "main-2024",
    [
        "ADD_SECTIONS_CHAIN" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COUNT_ELEMENTS" => "N",
        "IBLOCK_ID" => "3",
        "IBLOCK_TYPE" => "catalog",
        "SECTION_CODE" => "",
        "SECTION_FIELDS" => [0 => "", 1 => "",],
        "SECTION_ID" => $_REQUEST["SECTION_ID"],
        "SECTION_URL" => "",
        "SECTION_USER_FIELDS" => [0 => "UF_PICS", 1 => "UF_FIRE_RESIST", 2 => "UF_FIRE_RESIST_TEXT", 3 => "UF_LIST_NAME", 4 => "",],
        "TOP_DEPTH" => "1"
    ]
); ?>
    <section class="page-section">
        <div class="h1 page-section__title text-center">Хит продаж</div>
        <div class="container">
            <?php
            global $mainFilter;
            if ($sub == 'msk') $price_mod = 1;
            $mainFilter = ['!PROPERTY_ON_MAIN' => false, 'SECTION_ID' => '24'];
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "main",
                [
                    'PRICE_MOD' => $price_mod,
                    'FILTER_NAME' => 'mainFilter',
                    'IBLOCK_TYPE' => 'catalog',
                    'IBLOCK_ID' => '3',
                    'ELEMENT_SORT_FIELD' => 'sort',
                    'ELEMENT_SORT_ORDER' => 'asc',
                    'ELEMENT_SORT_FIELD2' => 'id',
                    'ELEMENT_SORT_ORDER2' => 'desc',
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
                ], false, ['HIDE_ICONS' => 'Y']
            ); ?>
        </div>
    </section>
    <section class="page-section">
        <div class="container">
            <div class="text-content-wrapper">
                <div class="col-xs-12">
                    <div class="text-content"><?php
                        $APPLICATION->IncludeFile(
                            SITE_DIR . "include/main/text1.php", [], ["NAME" => "Текстовый блок 1", "MODE" => "html"]
                        );
                        ?></div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-section">
        <div class="container">
            <div class="text-content-wrapper">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-content"><?php
                            $APPLICATION->IncludeFile(
                                SITE_DIR . "include/main/srok.php", [], ["NAME" => "таблица цены и срока производства", "MODE" => "html"]
                            );
                            ?></div>
                    </div>
                    <div class="col-xs-12">
                        <div class="h2 page-section__title"><?php
                            $APPLICATION->IncludeFile(
                                SITE_DIR . "include/main/title-1.php", [], ["NAME" => "seo-текст", "MODE" => "html"]
                            );
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-content">
                            <?php
                            $APPLICATION->IncludeFile(
                                SITE_DIR . "include/main/text-1.php", [], ["NAME" => "seo-текст", "MODE" => "html"]
                            );
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-content">
                            <?php
                            $APPLICATION->IncludeFile(
                                SITE_DIR . "include/main/text-2.php", [], ["NAME" => "seo-текст", "MODE" => "html"]
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
$APPLICATION->IncludeFile("/include/benefits.php", [], ["MODE" => "html", "NAME" => "Преимущества",]);
?>

<?php $gallery4 = WFGeneral::GetGallery(4); ?>
<?php if (is_array($gallery4)): ?>
    <section class="page-section--contrast gray-bg">
        <div class="container">
            <div class="h1 page-section__title"><?php
                $APPLICATION->IncludeFile(
                    SITE_DIR . "include/main/title-2.php", [], ["NAME" => "seo-текст", "MODE" => "html"]
                );
                ?>
            </div>
            <div class="gal gal-v1">
                <?php
                foreach ($gallery4 as $cert):
                    if (!empty($cert["DESCRIPTION"]))
                        $cert_desc = $cert["DESCRIPTION"];
                    else
                        $cert_desc = $cert["NAME"];
                    ?>
                    <div class="gal-item">
                        <a href="<?= $cert["PATH"] ?>" class="gal-item__preview">
                            <img alt="<?= $cert_desc ?>" title="<?= $cert_desc ?>" class="lazyload" src="<?= $cert["PATH"] ?>"
                                 data-original="<?= $cert["PATH"] ?>">
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="page-section__footer">
                <?php
                $APPLICATION->IncludeFile(
                    SITE_DIR . "include/main/button-1.php", [], ["NAME" => "кнопку", "MODE" => "html"]
                );
                ?>
            </div>
        </div>
    </section>
<?php endif ?>
    <section class="page-section">
        <div class="container">
            <div class="text-content-wrapper">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="h2 page-section__title"><?php
                            $APPLICATION->IncludeFile(
                                SITE_DIR . "include/main/title-4.php", [], ["NAME" => "текст", "MODE" => "html"]
                            );
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-content">
                            <?php
                            $APPLICATION->IncludeFile(
                                SITE_DIR . "include/main/text-3.php", [], ["NAME" => "текст", "MODE" => "html"]
                            );
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-content">
                            <?php
                            $APPLICATION->IncludeFile(
                                SITE_DIR . "include/main/text-4.php", [], ["NAME" => "текст", "MODE" => "html"]
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Отзывы -->
    <section class="page-section" id="sect-feedback">
        <div class="container">
            <div class="h2 page-section__title text-center"><a href="/info/reviews/">Отзывы</a> о продукции Двери Металл М
            </div>
            <div class="gal gal-v3">
                <?php $gallery = WFGeneral::GetGallery(9); ?>
                <?php if ($gallery):
                    foreach ($gallery as $key => $production):
                        if ($key >= 5) break;
                        if (!empty($production["DESCRIPTION"]))
                            $production_desc = $production["DESCRIPTION"];
                        else
                            $production_desc = $production["NAME"];
                        ?>
                        <div class="gal-item">
                            <a href="<?= $production["PATH"] ?>" class="gal-item__preview lazyload"
                               title="<?= $production_desc ?>"
                               data-original="<?= $production['PATH'] ?>"></a>
                        </div>
                    <?php endforeach;
                else:?>
                    <p>Пока нет ни одного отзыва!</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!--/Отзывы -->
    <!--Рассчет стоимости b24-->
    <section class="double-column bordered" id="calculate">
        <div class="col">
            <!--noindex-->
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
            <!--/noindex-->
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
    <!--/Рассчет стоимости b24-->
    <!--Фотки-->
<?php $gallery3 = WFGeneral::GetGallery(3); ?>
<?php if ($gallery3): ?>
    <section class="page-section" id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <p class="h1 page-section__title"><?php
                        $APPLICATION->IncludeFile(
                            SITE_DIR . "include/main/title-5.php", [], ["NAME" => "текст", "MODE" => "html"]
                        );
                        ?></p>
                    <!--Gallery-->
                    <div class="gal gal-v2">
                        <?php
                        foreach ($gallery3 as $production):
                            if (!empty($production["DESCRIPTION"]))
                                $production_desc = $production["DESCRIPTION"];
                            else
                                $production_desc = $production["NAME"];
                            ?>
                            <div class="gal-item">
                                <a href="<?= $production["PATH"] ?>" class="gal-item__preview lazyload"
                                   title="<?= $production_desc ?>"
                                   data-original="<?= $production["PATH"] ?>"></a>
                            </div>
                        <?php endforeach ?>
                    </div>
                    <!--/gallery-->
                    <div class="page-section__footer">
                        <?php
                        $APPLICATION->IncludeFile(
                            SITE_DIR . "include/main/button-2.php", [], ["NAME" => "кнопку", "MODE" => "html"]
                        );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>
    <!--/Фотки-->
<?php $APPLICATION->IncludeFile("/include/index-clients.html", [], ["MODE" => "html", "NAME" => "Логотипы клиентов",]); ?>
    <!--Seotext-->
    <section class="page-section">
        <div class="container">
            <div class="text-content-wrapper">
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-content">
                            <?php
                            $APPLICATION->IncludeFile(
                                SITE_DIR . "include/main/text-5.php", [], ["NAME" => "текст", "MODE" => "html"]
                            );
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-content">
                            <?php
                            $APPLICATION->IncludeFile(
                                SITE_DIR . "include/main/text-6.php", [], ["NAME" => "текст", "MODE" => "html"]
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/Seotext-->
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
            "TAG_H" => "N"
        ]
    ); ?>
    <!--/articles-->
<?php } ?><?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
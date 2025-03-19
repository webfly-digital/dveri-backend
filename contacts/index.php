<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

/** @global CMain $APPLICATION */

$ogTitle = "Контакты в #WF_CITY_PRED# | Завод «Двери металл-М»";
$ogDescription = "Контакты завода Двери металл-М в #WF_CITY_PRED#  - производство противопожарных дверей. Схема проезда, телефоны, адрес, производство и продажа противопожарных дверей.";
$ogUrl = "https://" . SITE_SERVER_NAME . $APPLICATION->GetCurPage();
$ogImage = SITE_TEMPLATE_PATH . "/img/logo.svg";

$APPLICATION->SetPageProperty("title", $ogTitle);
$APPLICATION->SetPageProperty("description", $ogDescription);
$APPLICATION->SetTitle("«Двери металл-М» в #WF_CITY_PRED#");

$APPLICATION->IncludeComponent(
    "bitrix:menu",
    "left",
    [
        "ALLOW_MULTI_SELECT" => "N",
        "CHILD_MENU_TYPE" => "",
        "DELAY" => "N",
        "MAX_LEVEL" => "1",
        "MENU_CACHE_GET_VARS" => [],
        "MENU_CACHE_TIME" => "36000",
        "MENU_CACHE_TYPE" => "A",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "ROOT_MENU_TYPE" => "left",
        "USE_EXT" => "N"
    ]
);
?>
    <!-- Open Graph -->
    <div style="display:none;">
        <meta property="og:title" content="<?= htmlspecialchars($ogTitle) ?>"/>
        <meta property="og:description" content="<?= htmlspecialchars($ogDescription) ?>"/>
        <meta property="og:image" content="<?= $ogImage ?>"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="<?= $ogUrl ?>"/>
        <meta property="og:locale" content="ru_RU"/>
        <meta property="og:site_name" content="Двери Металл-М"/>
    </div>
    <!-- End Open Graph -->

    <!-- JSON-LD -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "LocalBusiness",
            "name": "Двери Металл-М",
            "url": "<?= $ogUrl ?>",
            "logo": "<?= $ogImage ?>",
            "image": "<?= $ogImage ?>",
            "description": "<?= htmlspecialchars($ogDescription) ?>",
            "telephone": "#WF_PHONE#",
            "email": "#WF_EMAIL#",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "#WF_CONTACTS#",
                "addressLocality": "#WF_CITY_PRED#",
                "addressCountry": "RU"
            },
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "#WF_PHONE#",
                "contactType": "customer service"
            }
        }
    </script>
    <!-- End JSON-LD -->

    <div class="col-md-9">
        <div class="row">
            <div class="col-sm-4">
                <h6>Звоните</h6>
                <div class="contacts-section">
                    <div class="contacts-section__top">
                        <span class="flaticon-phone-call"></span>
                        #WF_PHONE#<br>
                        #WF_PHONES_GOR#
                    </div>
                    <div class="contacts-section__bottom">
                        <p><br/> #WF_SCHEDULE#</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <h6>Пишите</h6>
                <div class="contacts-section">
                    <div class="contacts-section__top">
                        <span class="flaticon-envelope"></span> <a href="mailto:#WF_EMAIL#">#WF_EMAIL#</a>
                    </div>
                    <div class="contacts-section__bottom">
                        <div class="socials">
                            <a href="https://t.me/dverim_bot" target="_blank" class="telegram"></a>
                            <span class="whatsapp"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <h6>Приходите</h6>
                <div class="contacts-section">
                    <div class="contacts-section__top">
                        <span class="flaticon-placeholder"></span>
                        Офис в #WF_CITY_PRED#:<br>
                        #WF_CONTACTS#<br><br>#WF_ADRESS_2#
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <h6>Скачать</h6>
                <div class="contacts-section">
                    <div class="contacts-section__top">
                        <a href="/info/about/" class="link-doc">Реквизиты в PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="map-section">
                <h6>Офис «Двери Металл-М» на карте</h6>
                #WF_MAP#
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            #WF_CONTACTS_FOTO#
        </div>
    </div>
    <div style="clear: both;"></div>
    <br>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
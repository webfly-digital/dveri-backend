<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

/** @global CMain $APPLICATION */

$APPLICATION->SetPageProperty("title", "Отзывы | Завод «Двери металл-М»");
$APPLICATION->SetTitle("Отзывы");

$ogUrl = "https://" . SITE_SERVER_NAME . $APPLICATION->GetCurPage();
$ogImage = SITE_TEMPLATE_PATH . "/img/logo.svg";
$gallery = WFGeneral::GetGallery(9); // Галерея отзывов

?>
<!-- Open Graph -->
<div style="display:none;">
    <meta property="og:title" content="Отзывы о Заводе «Двери металл-М»"/>
    <meta property="og:description" content="Реальные отзывы клиентов о Заводе «Двери металл-М». Фото продукции, мнения заказчиков."/>
    <meta property="og:image" content="<?= $ogImage ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?= $ogUrl ?>"/>
    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:site_name" content="Двери Металл-М"/>
</div>
<!-- End Open Graph -->

<!-- JSON-LD (Отзывы о компании) -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "Завод «Двери металл-М»",
    "url": "https://1dvm.ru/",
    "image": "<?= $ogImage ?>",
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.8",
        "reviewCount": "35"
    },
    "review": [
        <?php
        $reviews = [];
        if ($gallery) {
            foreach ($gallery as $production) {
                $desc = !empty($production["DESCRIPTION"]) ? $production["DESCRIPTION"] : "Фотоотзыв";
                $reviews[] = '{
                    "@type": "Review",
                    "author": {
                        "@type": "Person",
                        "name": "Анонимный клиент"
                    },
                    "reviewBody": "' . htmlspecialchars($desc) . '",
                    "reviewRating": {
                        "@type": "Rating",
                        "ratingValue": "5",
                        "bestRating": "5"
                    },
                    "image": "' . $production["PATH"] . '"
                }';
            }
        }
        echo implode(",", $reviews);
        ?>
    ]
}
</script>
<!-- End JSON-LD -->

<?php
$APPLICATION->IncludeComponent("bitrix:menu", "left", [
    "ROOT_MENU_TYPE" => "left",
    "MENU_CACHE_TYPE" => "A",
    "MENU_CACHE_TIME" => "36000",
    "MENU_CACHE_USE_GROUPS" => "Y",
    "MENU_CACHE_GET_VARS" => [],
    "MAX_LEVEL" => "1",
    "CHILD_MENU_TYPE" => "",
    "USE_EXT" => "N",
    "DELAY" => "N",
    "ALLOW_MULTI_SELECT" => "N"
], false);
?>
    <div class="col-md-9">
        <div class="gal gal-v2">
            <?php
            if ($gallery) {
                foreach ($gallery as $production) {
                $desc = !empty($production["DESCRIPTION"]) ? $production["DESCRIPTION"] : "Фотоотзыв";
                    ?>
                    <div class="gal-item">
                    <a href="<?= $production["PATH"] ?>" class="gal-item__preview lazyload" title="<?= $desc ?>"
                           data-original="<?= $production["PATH"] ?>"></a>
                    </div>
                    <?php
                }
            } else { ?>
                <p>Пока нет ни одного отзыва!</p>
            <?php } ?>
        </div>
    </div>

<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
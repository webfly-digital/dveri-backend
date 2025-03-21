<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

/** @global CMain $APPLICATION */
/** @var string $sub (определяется в хедере) */

$ogTitle = "Отзывы о Заводе «Двери металл-М» в #WF_CITY_PRED#";
$ogDescription = "Реальные отзывы клиентов о Заводе «Двери металл-М». Фото продукции, мнения заказчиков.";
$ogUrl = "https://" . ($sub !== 'default' ? htmlspecialchars($sub) . '.' : '') . SITE_SERVER_NAME . $APPLICATION->GetCurPage();
$ogImage = "https://" . ($sub !== 'default' ? htmlspecialchars($sub) . '.' : '') . SITE_SERVER_NAME . SITE_TEMPLATE_PATH . "/img/logo.svg";

$APPLICATION->SetPageProperty("title", $ogTitle);
$APPLICATION->SetPageProperty("description", $ogDescription);
$APPLICATION->SetTitle($ogTitle);

$gallery = WFGeneral::GetGallery(9); // Галерея отзывов
?>
<!-- Open Graph -->
<div style="display:none;">
    <meta property="og:title" content="<?= htmlspecialchars($ogTitle) ?>"/>
    <meta property="og:description" content="<?= htmlspecialchars($ogDescription) ?>"/>
    <meta property="og:image" content="<?= $ogImage ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?= $ogUrl ?>"/>
    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:site_name" content="«Двери металл-М» в #WF_CITY_PRED#"/>
</div>
<!-- End Open Graph -->

<!-- JSON-LD -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "CollectionPage",
    "name": "<?= htmlspecialchars($ogTitle) ?>",
    "url": "<?= $ogUrl ?>",
    "image": "<?= $ogImage ?>",
    "description": "<?= htmlspecialchars($ogDescription) ?>"
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
                        <a href="<?= $production["PATH"] ?>" class="gal-item__preview"
                           title="<?= $desc ?>"
                           style="background-image: url('<?= ImageCompressor::getCompressedSrc($production["ID"]) ?>');">
                        </a>
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
<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @global CMain $APPLICATION */

$serviceName = $arResult["NAME"] ?: "Услуга";
$serviceDescription = $arResult["PREVIEW_TEXT"] ?: $arResult["DETAIL_TEXT"] ?: "Описание услуги";
$ogUrl = "https://" . SITE_SERVER_NAME . $APPLICATION->GetCurPage();
$ogImage = SITE_TEMPLATE_PATH . "/img/logo.svg";
?>
<!-- Open Graph -->
<div style="display:none;">
    <meta property="og:title" content="<?= htmlspecialchars($serviceName) ?>"/>
    <meta property="og:description" content="<?= htmlspecialchars(strip_tags($serviceDescription)) ?>"/>
    <meta property="og:image" content="<?= $ogImage ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?= $ogUrl ?>"/>
    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:site_name" content="1dvm.ru"/>
</div>
<!-- End Open Graph -->

<!-- JSON-LD -->
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "name": "<?= htmlspecialchars($serviceName) ?>",
        "description": "<?= htmlspecialchars(strip_tags($serviceDescription)) ?>",
        "provider": {
            "@type": "Organization",
            "name": "Двери Металл-М",
            "url": "https://1dvm.ru/"
        },
        "image": "<?= $ogImage ?>",
        "url": "<?= $ogUrl ?>"
    }
</script>
<!-- End JSON-LD -->

<?php if (empty($arResult["DETAIL_TEXT"])) { ?>
    Раздел в разработке!
<?php } else { ?>
    <?php if ($arResult["GALLERY"]) { ?>
        <div class="text-content">
            <?= $arResult["DETAIL_TEXT"][0] ?>
        </div>
        <?php $gallery = WFGeneral::GetGallery($arResult["PROPERTIES"]["GALLERY"]["VALUE"]); ?>
        <?php if ($gallery) { ?>
            <div class="gal gal-v1">
                <?php foreach ($gallery as $img) {
                    $desc = !empty($img["DESCRIPTION"]) ? $img["DESCRIPTION"] : $img["NAME"];
                    ?>
                    <div class="gal-item">
                        <a href="<?= $img["PATH"] ?>" class="gal-item__preview">
                            <img alt="<?= $desc ?>" title="<?= $desc ?>" class="lazyload" data-original="<?= $img["THUMB_PATH"] ?>">
                        </a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="text-content">
            <?= $arResult["DETAIL_TEXT"][1] ?>
        </div>
    <?php } else { ?>
        <div class="text-content">
            <?= $arResult["DETAIL_TEXT"] ?>
        </div>
    <?php } ?>
<?php } ?>
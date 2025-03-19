<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @var string $sub (определяется в хедере) */

$ogTitle = $arResult["NAME"] ?: "Услуга";
$ogDescription = !empty($arResult["PREVIEW_TEXT"]) ? $arResult["PREVIEW_TEXT"] : (!empty($arResult["DETAIL_TEXT"]) ? strip_tags($arResult["DETAIL_TEXT"]) : "Описание услуги");
$ogUrl = "https://" . ($sub !== 'default' ? htmlspecialchars($sub) . '.' : '') . SITE_SERVER_NAME . $APPLICATION->GetCurPage();
$ogImage = "https://" . ($sub !== 'default' ? htmlspecialchars($sub) . '.' : '') . SITE_SERVER_NAME . SITE_TEMPLATE_PATH . "/img/logo.svg";
?>
<!-- Open Graph -->
<div style="display:none;">
    <meta property="og:title" content="<?= htmlspecialchars($ogTitle) ?> в <?= htmlspecialchars("#WF_CITY_PRED#") ?>"/>
    <meta property="og:description" content="<?= htmlspecialchars($ogDescription) ?>"/>
    <meta property="og:image" content="<?= $ogImage ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?= $ogUrl ?>"/>
    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:site_name" content="«Двери металл-М» в #WF_CITY_PRED#"/>
</div>
<!-- End Open Graph -->

<!-- JSON-LD -->
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Service",
        "name": "<?= htmlspecialchars($ogTitle) ?>",
        "description": "<?= htmlspecialchars($ogDescription) ?>",
        "provider": {
            "@type": "Organization",
            "name": "Двери Металл-М",
            "url": "<?= $ogUrl ?>"
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
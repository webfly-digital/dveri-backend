<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @global CMain $APPLICATION */

$infoTitle = $arResult["NAME"] ?: "Информация";
$infoDescription = !empty($arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"])
    ? $arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"]
    : strip_tags($arResult["DETAIL_TEXT"]);
$ogUrl = "https://" . SITE_SERVER_NAME . $APPLICATION->GetCurPage();
$ogImage = SITE_TEMPLATE_PATH . "/img/logo.svg";
?>
<!-- Open Graph -->
<div style="display:none;">
    <meta property="og:title" content="<?= htmlspecialchars($infoTitle) ?>"/>
    <meta property="og:description" content="<?= htmlspecialchars($infoDescription) ?>"/>
    <meta property="og:image" content="<?= $ogImage ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?= $ogUrl ?>"/>
    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:site_name" content="Двери Металл-М"/>
</div>
<!-- End Open Graph -->

<!-- JSON-LD -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "<?= htmlspecialchars($infoTitle) ?>",
    "description": "<?= htmlspecialchars($infoDescription) ?>",
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?= $ogUrl ?>"
    },
    "publisher": {
        "@type": "Organization",
        "name": "Двери Металл-М",
        "logo": {
            "@type": "ImageObject",
            "url": "<?= $ogImage ?>"
        }
    },
    "url": "<?= $ogUrl ?>",
    "image": "<?= $ogImage ?>"
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
                        <a href="<?= $img["PATH"] ?>" class="gal-item__preview" title="<?= $desc ?>">
                            <img alt="<?= $desc ?>" title="<?= $desc ?>" class="lazyload" data-original="<?= $img["THUMB_PATH"] ?>">
                        </a>
                        <div class="gal-item-subtitle"><?= $desc ?></div>
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
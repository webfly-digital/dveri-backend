<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */

$this->setFrameMode(true);

$sub = CWebflyCities::GetSubDomain();

$ogTitle = "Список объектов компании Двери Металл-М в #WF_CITY_PRED#";
$ogDescription = "Список выполненных проектов и объектов компании Двери Металл-М.";
$ogUrl = "https://" . ($sub !== 'default' ? htmlspecialchars($sub) . '.' : '') . SITE_SERVER_NAME . $APPLICATION->GetCurPage();
$ogImage = "https://" . ($sub !== 'default' ? htmlspecialchars($sub) . '.' : '') . SITE_SERVER_NAME . SITE_TEMPLATE_PATH . "/img/logo.svg";
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
"description": "<?= htmlspecialchars($ogDescription) ?>",
"hasPart": [
    <?php
        $objects = [];
        foreach ($arResult['SECTIONS'] as $section) {
            if (empty($section['ITEMS'])) continue;

            foreach ($section['ITEMS'] as $arItem) {
                $imageSrc = !empty($arItem['PREVIEW_PICTURE']['SRC'])
                    ? "https://" . ($sub !== 'default' ? htmlspecialchars($sub) . '.' : '') . SITE_SERVER_NAME . $arItem['PREVIEW_PICTURE']['SRC']
                    : $ogImage;
                $objects[] = '{
                "@type": "Place",
                "name": "' . htmlspecialchars($arItem['NAME']) . '",
                "image": "' . $imageSrc . '",
                "url": "' . $ogUrl . '"
            }';
            }
        }
        echo implode(",", $objects);
        ?>
]
}
</script>
<!-- End JSON-LD -->

<?php
foreach ($arResult['SECTIONS'] as $section) {
    if (empty($section['ITEMS'])) continue; ?>
    <section class="page-section-item">
        <?php if (empty($arParams['HIDE_MENU'])) { ?>
            <h3><?= $section['NAME'] ?></h3>
        <?php } ?>
        <div class="row row-flex works-list">
            <?php foreach ($section['ITEMS'] as $arItem) {
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                ?>
                <div class="col-xs-12 col-sm-4" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                    <div class="work-card">
                        <div class="work-card__pic"><img data-original="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" class="lazyload"></div>
                        <p class="work-card__caption"><?= $arItem['NAME'] ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>
<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @var string $sub (определяется в хедере) */

$this->setFrameMode(true);

$ogTitle = $arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] ?: "Услуги";
$ogDescription = "Список услуг компании «Двери Металл-М» в #WF_CITY_PRED#.";
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
    "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
            {
                "@type": "ListItem",
                "position": 1,
                "name": "Главная",
                "item": "https://<?= ($sub !== 'default' ? htmlspecialchars($sub) . '.' : '') . "1dvm.ru/" ?>"
            },
            {
                "@type": "ListItem",
                "position": 2,
                "name": "Услуги",
                "item": "<?= $ogUrl ?>"
            }
        ]
    },
    "hasPart": [
        <?php foreach ($arResult["ITEMS"] as $index => $arItem) { ?>
            {
                "@type": "Service",
                "name": "<?= htmlspecialchars($arItem["NAME"]) ?>",
                "url": "https://<?= ($sub !== 'default' ? htmlspecialchars($sub) . '.' : '') . SITE_SERVER_NAME . $arItem["DETAIL_PAGE_URL"] ?>",
                "description": "<?= htmlspecialchars($arItem["PREVIEW_TEXT"]) ?>"
            }<?php if ($index !== array_key_last($arResult["ITEMS"])) echo ','; ?>
        <?php } ?>
    ]
}
    </script>
    <!-- End JSON-LD -->

<?php
if ($arResult['SECTION']['DESCRIPTION']) {
    $this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']["EDIT_LINK"], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT"));
    ?>
    <div class="text-content" id="<?= $this->GetEditAreaId($arResult['SECTION']['ID']); ?>">
        <?= $arResult['SECTION']['DESCRIPTION'] ?>
    </div>
    <?php
}

foreach ($arResult['ITEMS'] as $arItem) {
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    ?>
    <div id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <?= $arItem['PREVIEW_TEXT'] ?>
    </div>
<?php }
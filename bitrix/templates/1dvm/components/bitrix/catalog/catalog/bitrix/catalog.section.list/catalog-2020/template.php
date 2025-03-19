<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 * @var array    $arResult
 * @var  string  $sub (определяется в хедере)
 */

if (!empty($arResult["SECTIONS"])) {
    $ogTitle = "Противопожарная продукция в #WF_CITY_PRED#";
    $ogDescription = "Каталог противопожарной продукции в #WF_CITY_PRED#";
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
                    "name": "Каталог",
                    "item": "https://<?= ($sub !== 'default' ? htmlspecialchars($sub) . '.' : '') . "1dvm.ru/catalog/" ?>"
                },
                {
                    "@type": "ListItem",
                    "position": 3,
                    "name": "Противопожарная продукция"
                }
            ]
        },
        "hasPart": [
            <?php foreach ($arResult["SECTIONS"] as $index => $arSection) { ?>
                {
                    "@type": "Category",
                    "name": "<?= $arSection["NAME"] ?>",
                    "url": "https://<?= ($sub !== 'default' ? htmlspecialchars($sub) . '.' : '') . SITE_SERVER_NAME . $arSection["SECTION_PAGE_URL"] ?>"
                }<?php if ($index !== array_key_last($arResult["SECTIONS"])) echo ','; ?>
        <?php } ?>
        ]
    }
    </script>
    <!-- End JSON-LD -->

    <section class="page-section" id="catalog-index">
        <h2 class="h1 page-section__title text-center">Противопожарная продукция в #WF_CITY_PRED#</h2>
        <!--Catalog tiles-->
        <div class="container catalog-items">
            <div class="row catalog-sections">
                <?php
                $sectCount = 0;
                foreach ($arResult["SECTIONS"] as $arSection) {
                    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
                    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), ["CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')]);
                    $sectCount++;

                    if ($sectCount == 1 || $sectCount == 6) {
                        $columnClasses = "col-xs-12 col-lg-6";
                    } else {
                        $columnClasses = "col-xs-12 col-sm-6 col-lg-3";
                    } ?>
                    <div class="<?= $columnClasses ?>" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
                        <div class="cat-section">

                            <div class="cat-section__visual <?= $arResult["GRID_TEMPLATE"][$sectCount]["INNER"] ?>">
                                <a href="<?= $arSection["SECTION_PAGE_URL"] ?>">
                                    <?php if (count($arSection["PICS"]) > 1): ?>
                                        <div class="double-photo">
                                            <?php foreach ($arSection["PICS"] as $pkey => $pic):
                                                $picClass = [0 => "-top", 1 => "-bottom"]; ?>
                                                <div class="photo<?= $picClass[$pkey] ?> "
                                                     data-original="<?= $pic ?>"></div>
                                            <?php endforeach ?>
                                        </div>
                                    <?php else: ?>
                                        <img class="photo<?= $arSection["ID"] == 25 ? " image-position-bottom" : "" ?>" alt="<?= $arSection["NAME"] ?>"
                                             data-original="<?= $arSection["PICS"][0] ?>" src="<?= $arSection["PICS"][0] ?>">
                                    <?php endif ?>

                                    <?php if ($arSection["UF_FIRE_RESIST"] == "1"): ?>
                                        <div class="fire-resistance">
                                            <div class="icon-fire"></div>
                                            <?= $arSection["~UF_FIRE_RESIST_TEXT"] ?: "" ?>
                                        </div>
                                    <?php endif ?>
                                </a>
                            </div>

                            <div class="cat-section__description">
                                <h3 class="cat-section__title h4">
                                    <a href="<?= $arSection["SECTION_PAGE_URL"] ?>"><?= $arSection["~UF_LIST_NAME"] ?: $arSection["NAME"] ?></a>
                                </h3>
                                <ul class="sub-ul list-unstyled">
                                    <?php foreach ($arSection['SUB'] as $sub) { ?>
                                        <li><a href="<?= $sub['SECTION_PAGE_URL'] ?>"><?= $sub['NAME'] ?></a></li>
                                    <?php } ?>
                                </ul>

                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Schema.org -->
    <div style="display: none;">
        <div itemscope itemtype="https://schema.org/CollectionPage">
            <meta itemprop="name" content="Противопожарная продукция в #WF_CITY_PRED#"/>
            <meta itemprop="url" content="<?= $ogUrl ?>"/>
            <meta itemprop="image" content="<?= SITE_TEMPLATE_PATH ?>/img/logo.svg"/>
            <meta itemprop="description" content="Каталог противопожарной продукции в #WF_CITY_PRED#"/>
            <div itemprop="hasPart">
                <?php foreach ($arResult["SECTIONS"] as $arSection) { ?>
                    <div itemscope itemtype="https://schema.org/Category">
                        <meta itemprop="name" content="<?= $arSection["NAME"] ?>"/>
                        <meta itemprop="url" content="https://<?= SITE_SERVER_NAME . $arSection["SECTION_PAGE_URL"] ?>"/>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- End Schema.org -->
<?php } ?>
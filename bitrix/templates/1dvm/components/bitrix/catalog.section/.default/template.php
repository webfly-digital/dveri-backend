<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 * @var array    $arParams
 * @var array    $arResult
 */

if (!empty($arResult["ITEMS"])) {
    $ogTitle = !empty($arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) ? $arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] : "Каталог товаров";
    $ogDescription = !empty($arResult["IPROPERTY_VALUES"]["SECTION_META_DESCRIPTION"]) ? $arResult["IPROPERTY_VALUES"]["SECTION_META_DESCRIPTION"] : $ogTitle;
    $ogImage = (!empty($arResult["PICTURE"]["SRC"]))
        ? "https://" . SITE_SERVER_NAME . $arResult["PICTURE"]["SRC"]
        : SITE_TEMPLATE_PATH . "/img/logo.svg";
    $ogUrl = "https://" . SITE_SERVER_NAME . $APPLICATION->GetCurPage();
    ?>
    <!-- Open Graph -->
    <div style="display:none;">
        <meta property="og:title" content="<?= htmlspecialchars($ogTitle) ?>"/>
        <meta property="og:description" content="<?= htmlspecialchars($ogDescription) ?>"/>
        <meta property="og:image" content="<?= $ogImage ?>"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="<?= $ogUrl ?>"/>
        <meta property="og:locale" content="ru_RU"/>
        <meta property="og:site_name" content="1dvm.ru"/>
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
                    "item": "https://1dvm.ru/"
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "name": "Каталог",
                    "item": "https://1dvm.ru/catalog/"
                },
                {
                    "@type": "ListItem",
                    "position": 3,
                    "name": "<?= htmlspecialchars($ogTitle) ?>"
                }
            ]
        },
        "hasPart": [
            <?php foreach ($arResult["ITEMS"] as $index => $arElement) { ?>
                {
                    "@type": "Product",
                    "name": "<?= htmlspecialchars($arElement["NAME"]) ?>",
                    "url": "https://<?= SITE_SERVER_NAME . $arElement["DETAIL_PAGE_URL"] ?>",
                    "image": "<?= $arElement["PREVIEW_PICTURE"]["SRC"] ?>",
                    "description": "<?= htmlspecialchars($arElement["PREVIEW_TEXT"] ?: $arElement["NAME"]) ?>",
                    "offers": {
                        "@type": "Offer",
                        "price": "<?= $arElement["PROPERTIES"]["PRICE_N"]["VALUE"] ?>",
                        "priceCurrency": "RUB",
                        "availability": "https://schema.org/InStock"
                    }
                }<?php if ($index !== array_key_last($arResult["ITEMS"])) echo ','; ?>
            <?php } ?>
        ]
    }
    </script>
    <!-- End JSON-LD -->

    <div class="catalog-products catalog-products--slim">
        <?php foreach ($arResult["ITEMS"] as $cell => $arElement) {
            $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
            //$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="product <?= $arElement["PROPERTIES"]["HIT"]["VALUE"] ? 'product__popular' : '' ?>" id="<?= $this->GetEditAreaId($arElement['ID']); ?>">
                <a href="<?= $arElement["DETAIL_PAGE_URL"] ?>">
                    <div class="product__inner">
                        <div class="product__visual">
                            <?php if ($arElement["PROPERTIES"]["FIRE_RESIST"]["VALUE"]) {
                                $label = strtolower($arElement["PROPERTIES"]["FIRE_RESIST"]["VALUE"]);
                                ?>
                                <div class="el-sticker <?= $label ?>"></div>
                            <?php } ?>
                            <img alt="<?= $arElement["PREVIEW_PICTURE"]["ALT"] ?>"
                                 title="<?= $arElement["PREVIEW_PICTURE"]["TITLE"] ?>" class="lazyload"
                                 data-original="<?= $arElement["PREVIEW_PICTURE"]["SRC"] ?>">
                        </div>
                        <div class="product__details">
                            <p class="product__option"><?= $arElement["PROPERTIES"]["ARTNUMBER"]["VALUE"] ? 'Артикул: ' . $arElement["PROPERTIES"]["ARTNUMBER"]["VALUE"] : '' ?></p>
                            <div class="h5 product__name"><a href="<?= $arElement["DETAIL_PAGE_URL"] ?>"
                                                             class="link-detail"><?= $arElement["NAME"] ?></a></div>
                            <?php foreach ($arElement["DISPLAY_PROPERTIES"] as $pid => $arProperty) {
                                if ($arProperty['CODE'] == 'HIT') continue;
                                ?>
                                <p class="product__option"><?= $arProperty["NAME"] ?>: <?php
                                    if (is_array($arProperty["DISPLAY_VALUE"]))
                                        echo implode("/", $arProperty["DISPLAY_VALUE"]);
                                    else
                                        echo $arProperty["DISPLAY_VALUE"];
                                    ?></p>
                            <?php } ?>
                            <div class="product__price"><a href="<?= $arElement["DETAIL_PAGE_URL"] ?>" class="btn btn--sky">Заказать</a>
                                <?php if ($arElement["PROPERTIES"]["PRICE_N"]["VALUE"]) { ?>
                                    <?php
                                    $price = $arElement["PROPERTIES"]["PRICE_N"]["VALUE"];
                                    if (intval($arParams['PRICE_MOD']) > 0) {
                                        $price = $price / 100 * (100 + $arParams['PRICE_MOD']);
                                        $price = ceil($price / 100) * 100;
                                    }
                                    ?>
                                    <div class="product__price-price"><?= number_format($price, 0, '', ' ') ?> Р</div>
                                <?php } ?>
                            </div>
                            <div class="product__additional">
                                <ul class="list-unstyled">
                                    <li><span class="small-label"><svg class="svg-icon svg-icon--xs"><use
                                                        xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/svg-symbols.svg#delivery"></use></svg> Доставка по #WF_CITY_DAT#</span>
                                    </li>
                                    <li><span class="small-label"><svg class="svg-icon svg-icon--xs"><use
                                                        xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/svg-symbols.svg#credit-card"></use></svg> Все виды оплаты</span>
                                    </li>
                                    <li><span class="small-label"><svg class="svg-icon svg-icon--xs"><use
                                                        xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/svg-symbols.svg#stopwatch"></use></svg> Срок изготовления до <?= wf_get_load_avg() ?> дней</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>

    <!-- Schema.org  -->
    <div style="display: none;">
        <div itemscope itemtype="https://schema.org/CollectionPage">
            <meta itemprop="name" content="<?= htmlspecialchars($ogTitle) ?>"/>
            <meta itemprop="url" content="<?= $ogUrl ?>"/>
            <meta itemprop="image" content="<?= $ogImage ?>"/>
            <meta itemprop="description" content="<?= htmlspecialchars($ogDescription) ?>"/>
            <div itemprop="hasPart">
                <?php foreach ($arResult["ITEMS"] as $arElement) { ?>
                    <div itemscope itemtype="https://schema.org/Product">
                        <meta itemprop="name" content="<?= htmlspecialchars($arElement["NAME"]) ?>"/>
                        <meta itemprop="url" content="https://<?= SITE_SERVER_NAME . $arElement["DETAIL_PAGE_URL"] ?>"/>
                        <meta itemprop="image" content="<?= $arElement["PREVIEW_PICTURE"]["SRC"] ?>"/>
                        <meta itemprop="description" content="<?= htmlspecialchars($arElement["PREVIEW_TEXT"] ?: $arElement["NAME"]) ?>"/>
                        <div itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                            <meta itemprop="price" content="<?= $arElement["PROPERTIES"]["PRICE_N"]["VALUE"] ?>"/>
                            <meta itemprop="priceCurrency" content="RUB"/>
                            <link itemprop="availability" href="https://schema.org/InStock"/>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- End Schema.org -->
    <?php if ($arParams["DISPLAY_BOTTOM_PAGER"]) { ?>
        <div class="clearfix"></div>
        <?= $arResult["NAV_STRING"] ?>
    <?php } ?>
    <?php
    if (!CSite::InDir('/doors/') && stripos($APPLICATION->GetCurPageParam(), '/filter/') === false) {
        if (!$arResult["PAGE_NOMER"] or $arResult["PAGE_NOMER"] == "1") { ?>
            <div class="text-content-wrapper wide">
                <div class="text-content">
                    <br>
                    <?= $arParams["DESCRIPTION"] == 'N' ? ' #WF_SEO_TEXT_1#' : $arResult["DESCRIPTION"] ?>
                </div>
            </div>
        <?php }
    } ?>
<?php } else { ?>
    <p align="center">Список товаров пуст
    </p>
    <p align="center">
        <a class="btn" href="#calculate">Заказать противопожарную дверь по индивидуальным параметрам</a>
    </p>
<?php }
<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @global CMain $APPLICATION
 * @var array    $arParams
 * @var array    $arResult
 */

$sub = $arParams['SUBDOMAIN'] ?? 'default';
$ogTitle = !empty($arResult['NAME']) ? $arResult['NAME'] : "Товар";
$ogDescription = !empty($arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"]) ? $arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"] : $ogTitle;
$ogImage = (!empty($arResult["PHOTOS"]["SMALL"][0]["src"]))
    ? "https://" . ($sub !== 'default' ? htmlspecialchars($sub) . '.' : '') . SITE_SERVER_NAME . $arResult["PHOTOS"]["SMALL"][0]["src"]
    : "https://" . ($sub !== 'default' ? htmlspecialchars($sub) . '.' : '') . SITE_SERVER_NAME . SITE_TEMPLATE_PATH . "/img/logo.svg";
$ogUrl = "https://" . ($sub !== 'default' ? htmlspecialchars($sub) . '.' : '') . SITE_SERVER_NAME . $APPLICATION->GetCurPage();
?>
<!-- Open Graph -->
<div style="display:none;">
    <meta property="og:title" content="<?= htmlspecialchars($ogTitle) ?> в <?= htmlspecialchars("#WF_CITY_PRED#") ?>"/>
    <meta property="og:description" content="<?= htmlspecialchars($ogDescription) ?>"/>
    <meta property="og:image" content="<?= $ogImage ?>"/>
    <meta property="og:type" content="product"/>
    <meta property="og:url" content="<?= $ogUrl ?>"/>
    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:site_name" content="«Двери металл-М» в #WF_CITY_PRED#"/>
</div>
<!-- End Open Graph -->

<!-- JSON-LD-->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "name": "<?= htmlspecialchars($arResult['NAME']) ?>",
    "image": "<?= $ogImage ?>",
    "description": "<?= htmlspecialchars($ogDescription) ?>",
    "sku": "<?= $arResult["PROPERTIES"]["ARTNUMBER"]["VALUE"] ?>",
    "brand": {
        "@type": "Brand",
        "name": "ДВЕРИ МЕТАЛЛ-М"
    },
    "offers": {
        "@type": "Offer",
        "url": "<?= $ogUrl ?>",
        "priceCurrency": "RUB",
        "price": "<?= $arResult["PROPERTIES"]["PRICE_N"]["VALUE"] ?>",
        "availability": "https://schema.org/InStock",
        "priceValidUntil": "<?= date('Y-m-d', strtotime("+365 day")) ?>"
    }
}
</script>
<!-- End JSON-LD -->

<div id="door-detail" class="row detail">
    <div class="col-md-6 col-md-push-6">
        <div class="detail-section hidden-md hidden-lg <?= $arResult["PROPERTIES"]["HIT"]["VALUE"] ? 'product__popular' : '' ?>">
            <div class="detail-photo-mobile">
                <?php if ($arResult["PROPERTIES"]["FIRE_RESIST"]["VALUE"]) {
                    $label = strtolower($arResult["PROPERTIES"]["FIRE_RESIST"]["VALUE"]);
                    ?>
                    <div class="el-sticker <?= $label ?>"></div>
                <?php } ?>
                <img class="lazyload" data-original="<?= $arResult["PHOTOS"]["SMALL"][0]["src"] ?>"
                     alt="<?= $arResult["PHOTOS"]["BIG"][0]["ALT"] ?>"
                     title="<?= $arResult["PHOTOS"]["BIG"][0]["TITLE"] ?>">
            </div>
        </div>
        <div class="detail-section">
            <div class="detail__order">
                <div class="detail__order-price">
                    <?php if ($arResult["PROPERTIES"]["PRICE_N"]["VALUE"]): ?>
                        <p class="caption">Цена за 1 шт. в розницу:</p>
                        <?php
                        $price = $arResult["PROPERTIES"]["PRICE_N"]["VALUE"];
                        if (intval($arParams['PRICE_MOD']) > 0) {
                            $price = $price / 100 * (100 + $arParams['PRICE_MOD']);
                            $price = ceil($price / 100) * 100;
                        }
                        ?>
                        <p class="digit" id="product-total"><?= number_format($price, 0, '', ' '); ?> Р</p>
                    <?php endif ?>

                    <?php if ($arResult["PROPERTIES"]["ARTNUMBER"]["VALUE"]): ?>
                        <p>Артикул: <?= $arResult["PROPERTIES"]["ARTNUMBER"]["VALUE"] ?></p>
                    <?php endif ?>

                </div>
                <button data-target="#modalOrder" class="btn-order btn btn--lg btn--sky">Заказать</button>
            </div>
            <div class="alert alert-info">
                * Минимальный заказ для получения скидки - 100 шт (#WF_CITY_NAME#). <br>
                * Скидка на товар зависит от количества заказа. <br>
                Стоимость и сроки производства уточняйте у менеджера по телефону:
                8&nbsp;(800)&nbsp;700-13-04
            </div>

        </div>

        <div class="detail-section">
            <div class="detail-section__title">Вызов замерщика бесплатно</div>
            <script data-b24-form="click/20/ya575p" data-skip-moving="true">(function (w, d, u) {
                    var s = d.createElement('script');
                    s.async = true;
                    s.src = u + '?' + (Date.now() / 180000 | 0);
                    var h = d.getElementsByTagName('script')[0];
                    h.parentNode.insertBefore(s, h);
                })(window, document, 'https://cdn-ru.bitrix24.ru/b3809885/crm/form/loader_20.js');</script>
            <button class="btn btn--md btn--gray "
            ><span class="flaticon-user-1"></span> Вызвать
                замерщика
            </button>
        </div>

        <?php if ($arResult["DOP_COMPLECTATION"]) { ?>
            <div class="detail-section">
                <h2 class="detail-section__title h4">Дополнительно к базовой комплектации</h2>
                <input type="hidden" name="product-name" id="product-name" value="<?= $arResult["NAME"] ?>">
                <input type="hidden" name="baseprice" id="product-baseprice"
                       value="<?= $arResult["PROPERTIES"]["PRICE_N"]["VALUE"] ?>">
                <ul class="list-unstyled product-options">
                    <?php foreach ($arResult["DOP_COMPLECTATION"] as $comlect) { ?>
                        <li>
                            <label for="opt-<?= $comlect["ID"] ?>" class="checkbox">
                                <input type="checkbox" class="product-additional" name="option"
                                       id="opt-<?= $comlect["ID"] ?>" value="<?= $comlect["PROPERTY_PRICE_VALUE"] ?>">
                                <div class="checkbox__inner">
                                    <div class="product-option">
                                        <div class="product-option__visual"
                                             style="background-image: url('<?= ImageCompressor::getCompressedSrc($comlect["PHOTO"]["ID"]) ?>');">
                                        </div>
                                        <div class="product-option__details">
                                            <p class="product-option__name"><?= $comlect["NAME"] ?></p>
                                            <p class="product-option__description"><?= $comlect["PREVIEW_TEXT"] ?></p>
                                        </div>
                                        <div class="product-option__price"><?= $comlect["PRICE_FORMAT"] ?> Р</div>
                                    </div>
                                </div>
                            </label>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>

        <div class="detail-section">
            <div class="detail__delivery">
                <p class="h5">
                    <svg class="svg-icon svg-icon--md">
                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/svg-symbols.svg#delivery"></use>
                    </svg>
                    Доставка:
                </p>
                <div>#WF_CITY_DETAIL_DELIVERY#</div>
                <p class="h5">
                    <svg class="svg-icon svg-icon--md">
                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/svg-symbols.svg#cargo-box"></use>
                    </svg>
                    Самовывоз:
                </p>
                <p>Заказ можно забрать по адресу: #WF_CONTACTS#</p>

                <p class="h5">
                    <svg class="svg-icon svg-icon--md">
                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/svg-symbols.svg#credit-card"></use>
                    </svg>
                    Оплата:
                </p>
                <p>Наличный и безналичный расчет.
                    Для физических и юридических лиц.</p>

                <p class="h5">
                    <svg class="svg-icon svg-icon--md">
                        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/img/svg-symbols.svg#stopwatch"></use>
                    </svg>
                    Срок изготовления:
                </p>
                <p>До <span id="wf-ready-duration"><?= wf_get_load_avg() ?></span> рабочих дней.</p>
                <p>Ваш заказ будет готов к выдаче <b class="wf-order-ready">6</b> по адресу #WF_CONTACTS#</p>

            </div>
        </div>

        <!--Варианты окраски-->
        <?php if ($arResult["COLORS"]) { ?>
            <div class="detail-section">
                <div class="h4 detail-section__title">Варианты окраски</div>
                <ul class="list-inline color-options">
                    <?php foreach ($arResult["COLORS"] as $color) { ?>
                        <li>
                            <div class="color-option">
                                <div class="color-option__visual"
                                     style="background-image: url('<?= ImageCompressor::getCompressedSrc($color["PHOTO"]["ID"]) ?>');">
                                </div>
                                <p class="color-option__caption"><?= $color["PROPERTY_DOP_NAME_VALUE"]["TEXT"] ?: $color["NAME"] ?></p>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
                <?php if ($arResult["PROPERTIES"]["RAL"]["VALUE"] == "Y") { ?>
                    <p><a href="<?= SITE_TEMPLATE_PATH ?>/img/tab_ral.jpg" class="text--sky link-dashed link-gallery">Другие
                            варианты окраски</a> (наценка 7%)</p>
                <?php } ?>
            </div>
        <?php } ?>
        <!--Технические характеристики-->

        <div class="detail-section">
            <h2 class="detail-section__title h4">Технические характеристики</h2>
            <table class="table table-striped table-responsive table-options">
                <?php foreach ($arResult["PROPERTIES"]["TECHNICAL"]["VALUE"] as $tkey => $tech) { ?>
                    <tr>
                        <td<?php if (empty($arResult["PROPERTIES"]["TECHNICAL"]["DESCRIPTION"][$tkey])): ?> colspan="2"<?php endif ?>><?= $tech ?></td>
                        <?php if (!empty($arResult["PROPERTIES"]["TECHNICAL"]["DESCRIPTION"][$tkey])) { ?>
                            <td><?= $arResult["PROPERTIES"]["TECHNICAL"]["DESCRIPTION"][$tkey] ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                <?php
                $arProp = ['KOROBKA', 'ZAPOLNITEL', 'ZAPOLNITEL_POLOTNA', 'UPLOTNITEL', 'PETLI', 'SHIPY', 'NALICHNIK', 'POKRASKA', 'ZAMOK', 'RYCHKA', 'POROG', 'TOLSHINA',];
                ?>
                <?php foreach ($arProp as $prop) { ?>
                    <?php if ($arResult["PROPERTIES"][$prop]["VALUE"]) { ?>
                        <tr>
                            <td><?= $arResult["PROPERTIES"][$prop]["NAME"] ?></td>
                            <td><?= $arResult["PROPERTIES"][$prop]["VALUE"] ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
        </div>

        <!--Стандартная комплектация-->
        <?php if ($arResult["PROPERTIES"]["COMPLECTATION"]["VALUE"]) { ?>
            <div class="detail-section">
                <h2 class="detail-section__title h4"><?= $arResult["PROPERTIES"]["COMPLECTATION"]["NAME"] ?></h2>
                <table class="table table-striped table-responsive table-options">
                    <?php foreach ($arResult["PROPERTIES"]["COMPLECTATION"]["VALUE"] as $ckey => $comp) { ?>
                        <tr>
                            <td<?php if (empty($arResult["PROPERTIES"]["COMPLECTATION"]["DESCRIPTION"][$ckey])): ?> colspan="2"<?php endif ?>><?= $comp ?></td>
                            <?php if (!empty($arResult["PROPERTIES"]["COMPLECTATION"]["DESCRIPTION"][$ckey])) { ?>
                                <td><?= $arResult["PROPERTIES"]["COMPLECTATION"]["DESCRIPTION"][$ckey] ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        <?php } ?>

        <!--Стандартное описание-->
        <?php if ($arResult["PROPERTIES"]["OTDELKA"]["VALUE"]) { ?>
            <div class="detail-section">
                <h2 class="detail-section__title h4"><?= $arResult["PROPERTIES"]["OTDELKA"]["NAME"] ?></h2>
                <table class="table table-striped table-responsive table-options">
                    <?php foreach ($arResult["PROPERTIES"]["OTDELKA"]["VALUE"] as $cotd => $otd) { ?>
                        <tr>
                            <td<?php if (empty($arResult["PROPERTIES"]["OTDELKA"]["DESCRIPTION"][$cotd])): ?> colspan="2"<?php endif ?>><?= $otd ?></td>
                            <?php if (!empty($arResult["PROPERTIES"]["OTDELKA"]["DESCRIPTION"][$cotd])) { ?>
                                <td><?= $arResult["PROPERTIES"]["OTDELKA"]["DESCRIPTION"][$cotd] ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        <?php } ?>
    </div>
    <div class="col-md-6 col-md-pull-6">
        <div class="detail-section hidden-xs hidden-sm <?= $arResult["PROPERTIES"]["HIT"]["VALUE"] ? 'product__popular' : '' ?>">
            <?php if ($arResult["PROPERTIES"]["FIRE_RESIST"]["VALUE"]) {
                $label = strtolower($arResult["PROPERTIES"]["FIRE_RESIST"]["VALUE"]);
                ?>
                <div class="el-sticker <?= $label ?>"></div>
            <?php } ?>
            <div class="product-gallery">
                <div class="product-gallery__big">
                    <div class="product-gallery__photo" id="product-gallery-mainphoto">
                        <img src="<?= ImageCompressor::getCompressedSrc($arResult["PHOTOS"]["SMALL"][0]["ID"]) ?>"
                             alt="<?= $arResult["PHOTOS"]["BIG"][0]["ALT"] ?>"
                             title="<?= $arResult["PHOTOS"]["BIG"][0]["TITLE"] ?>">
                        <noscript>
                            <img src="<?= ImageCompressor::getCompressedSrc($arResult["PHOTOS"]["SMALL"][0]["ID"]) ?>"
                                 alt="<?= $arResult["PHOTOS"]["BIG"][0]["ALT"] ?>"
                                 title="<?= $arResult["PHOTOS"]["BIG"][0]["TITLE"] ?>">
                        </noscript>
                    </div>
                </div>
                <div class="product-gallery__previews">
                    <?php foreach ($arResult["PHOTOS"]["SMALL"] as $phKey => $photo) { ?>
                        <div class="product-gallery__preview active"
                             data-src="<?= ImageCompressor::getCompressedSrc($arResult["PHOTOS"]["BIG"][$phKey]["ID"]) ?>">
                            <img src="<?= ImageCompressor::getCompressedSrc($photo["ID"]) ?>"
                                 alt="<?= $arResult["PHOTOS"]["BIG"][$phKey]["ALT"] ?>"
                                 title="<?= $arResult["PHOTOS"]["BIG"][$phKey]["TITLE"] ?>">
                            <noscript>
                                <img src="<?= ImageCompressor::getCompressedSrc($photo["ID"]) ?>"
                                     alt="<?= $arResult["PHOTOS"]["BIG"][$phKey]["ALT"] ?>"
                                     title="<?= $arResult["PHOTOS"]["BIG"][$phKey]["TITLE"] ?>">
                            </noscript>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!--УТП-->
        <?php if ($arResult["UTP"]) { ?>
            <div class="detail-section">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <?php foreach ($arResult["UTP"] as $utp): ?>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading<?= $utp["ID"] ?>">
                                <p class="panel-title">
                                    <a role="button" data-toggle="collapse" href="#collapse<?= $utp["ID"] ?>"
                                       aria-expanded="true" aria-controls="collapse<?= $utp["ID"] ?>">
                                        <?= $utp["NAME"] ?>
                                    </a>
                                </p>
                            </div>
                            <div id="collapse<?= $utp["ID"] ?>" class="panel-collapse collapse in" role="tabpanel"
                                 aria-labelledby="heading<?= $utp["ID"] ?>">
                                <div class="panel-body">
                                    <?= $utp["PREVIEW_TEXT"] ?>
                                    <?php if ($utp["GALLERY"]): ?>
                                        <div class="gal gal-v<?= $utp["ID"] == 395 ? '1' : '2' ?>">
                                            <?php
                                            foreach ($utp["GALLERY"] as $key => $img):
                                                if ($utp["ID"] == 395 && $key >= 4) break;
                                                if (!empty($img["DESCRIPTION"]))
                                                    $desc = $img["DESCRIPTION"];
                                                else
                                                    $desc = $img["NAME"];
                                                ?>

                                                <?php if ($utp["ID"] == 395) { ?>
                                                <div class="gal-item">
                                                    <a href="<?= $img["PATH"] ?>" class="gal-item__preview">
                                                        <img alt="<?= $desc ?>" title="<?= $desc ?>"
                                                             src="<?= ImageCompressor::getCompressedSrc($img["THUMB_ID"]) ?>">
                                                    </a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="gal-item">
                                                    <a href="<?= $img["PATH"] ?>" class="gal-item__preview"
                                                       title="<?= $desc ?>"
                                                       style="background-image: url('<?= ImageCompressor::getCompressedSrc($img["THUMB_ID"]) ?>');">
                                                    </a>
                                                </div>
                                            <?php } ?>
                                            <?php endforeach ?>
                                        </div>
                                    <?php endif ?>
                                    <?php if ($utp["PROPERTY_LINK_VALUE"]): ?>
                                        <p><a href="<?= $utp["PROPERTY_LINK_VALUE"] ?>"
                                              class="btn btn-bordered btn--sky"><?= $utp["ID"] == 395 ? 'Смотреть все' : 'Подробнее' ?></a>
                                        </p>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <!--Подробное письмо-->
    <?php /* if ($arResult["DETAIL_TEXT"]): ?>
        <div class="col-md-12">
            <div class="text-content">
                <?= $arResult["DETAIL_TEXT"] ?>
            </div>
        </div>
    <? endif */ ?>
</div>
<!-- Schema.org -->
<div style="display: none" id="<?= $arResult['ID'] ?>" itemscope itemtype="http://schema.org/Product">
    <meta itemprop="name" content="<?= htmlspecialchars($arResult['NAME']) ?> в <?= htmlspecialchars("#WF_CITY_PRED#") ?>"/>
    <meta itemprop="image" content="<?= $arResult["PHOTOS"]["SMALL"][0]["src"] ?>"/>
    <meta itemprop="category" content="<?= $arResult["SECTION"]["NAME"] ?>"/>
    <span itemprop="description"><?= $arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"] ?></span>
    <meta itemprop="brand" content="ДВЕРИ МЕТАЛЛ-М"/>
    <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        <meta itemprop="price" content="<?= $arResult["PROPERTIES"]["PRICE_N"]["VALUE"] ?>"/>
        <meta itemprop="priceCurrency" content="RUB"/>
        <link itemprop="availability" href="http://schema.org/InStock"/>
        <meta itemprop="priceValidUntil" content="<?= date('Y-m-d', strtotime("+365 day")) ?>">
        <span itemprop="hasMerchantReturnPolicy" itemscope itemtype="https://schema.org/MerchantReturnPolicy">
              <meta itemprop="name" content="false">
              <meta itemprop="applicableCountry" content="RU">
              <meta itemprop="returnPolicyCategory" content="MerchantReturnNotPermitted">
       </span>
         <span itemprop="shippingDetails" itemscope itemtype="https://schema.org/OfferShippingDetails">
             <span itemprop="shippingRate" itemscope itemtype="https://schema.org/MonetaryAmount">
                   <meta itemprop="value" content="5">
                   <meta itemprop="currency" content="RUB">
             </span>
               <span itemprop="deliveryTime" itemscope itemtype="https://schema.org/ShippingDeliveryTime">
                    <span itemprop="handlingTime" itemscope itemtype="https://schema.org/QuantitativeValue">
                        <meta itemprop="minValue" content="1">
                        <meta itemprop="maxValue" content="2">
                        <meta itemprop="unitCode" content="d">
                    </span>
                    <span itemprop="transitTime" itemscope itemtype="https://schema.org/QuantitativeValue">
                        <meta itemprop="minValue" content="1">
                        <meta itemprop="maxValue" content="10">
                        <meta itemprop="unitCode" content="d">
                    </span>
             </span>
              <span itemprop="shippingDestination" itemscope itemtype="https://schema.org/DefinedRegion">
                   <meta itemprop="addressCountry" content="RU">
              </span>
       </span>
    </span>
    <span itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
        <span itemprop="ratingValue">4</span>
        <span itemprop="ratingCount">10</span>
    </span>
</div>
<!-- End Schema.org -->
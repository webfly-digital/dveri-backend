<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $arResult
 */

if ($arResult["ITEMS"]) { ?>
    <div class="products-slider">
        <?php foreach ($arResult["ITEMS"] as $cell => $arElement) { ?>
            <?php
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
                                 title="<?= $arElement["PREVIEW_PICTURE"]["TITLE"] ?>"
                                 src="<?= ImageCompressor::getCompressedSrc($arElement["PREVIEW_PICTURE"]["ID"]) ?>">
                        </div>
                        <div class="product__details">
                            <p class="product__option"><?= $arElement["PROPERTIES"]["ARTNUMBER"]["VALUE"] ? 'Артикул: ' . $arElement["PROPERTIES"]["ARTNUMBER"]["VALUE"] : '' ?></p>
                            <div class="product__name h5"><a href="<?= $arElement["DETAIL_PAGE_URL"] ?>"
                                                             class="link-detail"><?= $arElement["NAME"] ?></a></div>
                            <?php foreach ($arElement["DISPLAY_PROPERTIES"] as $pid => $arProperty) {
                                if ($arProperty['CODE'] == 'HIT') continue; ?>
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
<?php } else { ?>
    <p align="center">Список товаров пуст</p>
<?php } ?>
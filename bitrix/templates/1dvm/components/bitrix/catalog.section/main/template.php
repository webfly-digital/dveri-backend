<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? if ($arResult["ITEMS"]): ?>
    <div class="products-slider">
        <? foreach ($arResult["ITEMS"] as $cell => $arElement): ?>
            <?
            $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
            //$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="product plugin-clickable  <?=$arElement["PROPERTIES"]["HIT"]["VALUE"]?'product__popular':''?>" id="<?= $this->GetEditAreaId($arElement['ID']); ?>">
                <div class="product__inner">
                    <div class="product__visual">
                        <? if ($arElement["PROPERTIES"]["FIRE_RESIST"]["VALUE"]):
                            $label = strtolower($arElement["PROPERTIES"]["FIRE_RESIST"]["VALUE"]);
                            ?>
                            <div class="el-sticker <?= $label ?>"></div>
                        <? endif ?>
                        <img alt="<?= $arElement["PREVIEW_PICTURE"]["ALT"] ?>"
                             TITLE="<?= $arElement["PREVIEW_PICTURE"]["TITLE"] ?>" class="lazyload" src="<?= $arElement["PREVIEW_PICTURE"]["SRC"] ?>"
                             data-original="<?= $arElement["PREVIEW_PICTURE"]["SRC"] ?>"></div>
                    <div class="product__details">
                        <p class="product__option"><?= $arElement["PROPERTIES"]["ARTNUMBER"]["VALUE"] ? 'Артикул: ' . $arElement["PROPERTIES"]["ARTNUMBER"]["VALUE"] : '' ?></p>
                        <div class="product__name h5"><a href="<?= $arElement["DETAIL_PAGE_URL"] ?>"
                                                     class="link-detail"><?= $arElement["NAME"] ?></a></div>
                        <? foreach ($arElement["DISPLAY_PROPERTIES"] as $pid => $arProperty):
                            if($arProperty['CODE'] == 'HIT') continue;?>
                            <p class="product__option"><?= $arProperty["NAME"] ?>: <?
                                if (is_array($arProperty["DISPLAY_VALUE"]))
                                    echo implode("/", $arProperty["DISPLAY_VALUE"]);
                                else
                                    echo $arProperty["DISPLAY_VALUE"];
                                ?></p>
                        <? endforeach ?>
                        <div class="product__price"><a href="<?= $arElement["DETAIL_PAGE_URL"] ?>" class="btn btn--sky">Заказать</a>
                            <? if ($arElement["PROPERTIES"]["PRICE_N"]["VALUE"]): ?>
                                <?
                                $price = $arElement["PROPERTIES"]["PRICE_N"]["VALUE"];
                                if (intval($arParams['PRICE_MOD']) > 0) {
                                    $price = $price / 100 * (100 + $arParams['PRICE_MOD']);
                                    $price = ceil($price / 100) * 100;
                                }
                                ?>
                                <div class="product__price-price"><?= number_format($price, 0, '', ' ') ?> Р</div>
                            <? endif ?>
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
            </div>
        <? endforeach ?>
    </div>
<? else: ?>
    <p align="center">Список товаров пуст</p>
<? endif; ?>



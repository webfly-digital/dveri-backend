<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="catalog-filter">
    <form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>" method="get" class="smartfilter">
        <? foreach ($arResult["HIDDEN"] as $key => $arItem): ?>
            <input
                type="hidden"
                name="<? echo $arItem["CONTROL_NAME"] ?>"
                id="<? echo $arItem["CONTROL_ID"] ?>"
                value="<? echo $arItem["HTML_VALUE"] ?>"
                />
            <? endforeach; ?>
            <?
            $countFields = 0;
            $row = '';
            $class = 'col-sm-3';
            $opened = false;
            foreach ($arResult["ITEMS"] as $arItem):
                ?>
                <?
                if ($arItem["CODE"] != "PRICE_N"):
                    $countFields++;
                    if ($countFields == 1 or $countFields == 4) {
                        $opened = true;
                        if ($countFields == 1) {
                            $row = '<div class="row catalog-filter__row">';
                            $class = 'col-sm-4';
                        }
                        else {
                            $row = '</div><div class="row catalog-filter__row">';
                            $class = 'col-sm-3';
                        }
                    }
                    else {
                        $row = '';
                    }
                    ?>
                    <?= $row ?>
                <div class="<?= $class ?>">
                    <p class="catalog-filter__caption"><?= $arItem["NAME"] ?></p>
                    <select name="param-1" class="chosen-single--noselect">
                    <option value="0">Не важно</option>
                    <? foreach ($arItem["VALUES"] as $val => $ar): ?>
                        <option value="<? echo $ar["HTML_VALUE"] ?>"
                                name="<? echo $ar["CONTROL_NAME"] ?>"
                                id="<? echo $ar["CONTROL_ID"] ?>"
                                <? echo $ar["CHECKED"] ? 'selected' : '' ?>><? echo $ar["VALUE"] ?></option>
                        <? endforeach; ?>
                    </select>
                </div>
            <? endif ?>
        <? endforeach; ?>
        <div class="catalog-filter__footer">
            <div class="modef catalog-filter__results" id="modef" <? if (!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"'; ?>>
                <? echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">' . intval($arResult["ELEMENT_COUNT"]) . '</span>')); ?>
            </div>
            <div class="catalog-filter__buttons">
                <button id="del_filter" class="btn-transparent" title="Сбросить" type="submit" name="del_filter"><span class="flaticon-reload"></span></button>
                <button id="set_filter" name="set_filter" type="submit" class="btn btn--sky">Показать</button>
            </div>
        </div>
        <? if ($opened) echo "</div>"; ?>
    </form>
    <script>
        var smartFilter = new JCSmartFilter('<? echo CUtil::JSEscape($arResult["FORM_ACTION"]) ?>');
    </script>
</div>

 
    <?/*
                <?
            if ($arItem["PROPERTY_TYPE"] == "N" || isset($arItem["PRICE"])):
                $minValue = round($arItem["VALUES"]["MIN"]["VALUE"]);
                $maxValue = round($arItem["VALUES"]["MAX"]["VALUE"]);
                if (!$minValue || !$maxValue || $minValue == $maxValue)
                    continue;
                $value30 = round(($maxValue + $minValue) * 0.5);
                $value70 = round(($maxValue * 0.8 + $minValue * 0.2));
                if (!empty($_GET[$arItem["VALUES"]["MIN"]["CONTROL_NAME"]]))
                    $curValueMin = round($_GET[$arItem["VALUES"]["MIN"]["CONTROL_NAME"]]);
                else
                    $curValueMin = $minValue;
                if (!empty($_GET[$arItem["VALUES"]["MAX"]["CONTROL_NAME"]]))
                    $curValueMax = round($_GET[$arItem["VALUES"]["MAX"]["CONTROL_NAME"]]);
                else
                    $curValueMax = $maxValue;
                ?>
                <div class="row catalog-filter__row">
                    <div class="col-sm-6">
                        <p class="catalog-filter__caption"><?= $arItem["NAME"] ?></p>
                        <div class="range-slider" id="ul_<? echo $arItem["ID"] ?>">
                            <div class="range-start">от</div>
                            <div class="range-stop">до</div>
                            <input class="min-price" type="text" name="<?= $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                   id="<?= $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>" value="<?= $curValueMin ?>"
                                   size="5" style="display:none;"/>
                            <input class="max-price" type="text" name="<?= $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                   id="<?= $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>" value="<?= $curValueMax ?>"
                                   size="5" style="display:none;"/>
                            <div class="slider" id="price-range" data-range="<?= $minValue ?>,<?= $maxValue ?>" data-start="<?= $curValueMin ?>,<?= $curValueMax ?>"
                                 data-pricemin="<?= $minValue ?>" data-pricemax="<?= $maxValue ?>"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="catalog-filter__footer">
                            <div class="modef catalog-filter__results" id="modef" <? if (!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"'; ?>>
        <? echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">' . intval($arResult["ELEMENT_COUNT"]) . '</span>')); ?>
                            </div>
                            <div class="catalog-filter__buttons">
                                <button id="del_filter" class="btn-transparent" title="Сбросить" type="submit" name="del_filter"><span class="flaticon-reload"></span></button>
                                <button id="set_filter" name="set_filter" type="submit" class="btn btn--sky">Показать</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(function () {
                        var slider, pricemin, pricemax, fieldMin, fieldMax, form;
                        fieldMin = '<?= $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>';
                        fieldMax = '<?= $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>';
                        form = $(".smartfilter");
                        slider = $('#price-range');
                        pricemin = parseInt(slider.data('pricemin'));
                        pricemax = parseInt(slider.data('pricemax'));
                        slider.noUiSlider({
                            start: [<?= $curValueMin ?>, <?= $curValueMax ?>],
                            step: 100,
                            range: {
                                'min': [pricemin],
                                '30%': [<?= $value30 ?>],
                                '70%': [<?= $value70 ?>],
                                'max': [pricemax]
                            }
                        });
                        var formatOpt = {
                            postfix: ' <spam class="rouble">&#8399;</spam>',
                            decimals: 0,
                            thousand: ' '
                        };
                        slider.on({
                            'slide': function () {
                                slider.Link('lower').to($('#priceMin'), null, wNumb(formatOpt));
                                slider.Link('upper').to($('#priceMax'), null, wNumb(formatOpt));
                            },
                            'set': function () {
                                slider.Link('lower').to($('.min-price'));
                                slider.Link('upper').to($('.max-price'));
                                form.submit();
                            }
                        });
                    });
                </script>
                                      <? elseif (!empty($arItem["VALUES"])): ?>
                <div class="col-sm-4"> <a href="#" onclick="BX.toggle(BX('ul_<? echo $arItem["ID"] ?>'));
                        return false;" class="showchild"><?= $arItem["NAME"] ?></a>
                    <ul id="ul_<? echo $arItem["ID"] ?>">
        <? foreach ($arItem["VALUES"] as $val => $ar): ?>
                            <li class="lvl2<? echo $ar["DISABLED"] ? ' lvl2_disabled' : '' ?>"><input
                                    type="checkbox"
                                    value="<? echo $ar["HTML_VALUE"] ?>"
                                    name="<? echo $ar["CONTROL_NAME"] ?>"
                                    id="<? echo $ar["CONTROL_ID"] ?>"
                                <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                    onclick="smartFilter.click(this)"
                                    /><label for="<? echo $ar["CONTROL_ID"] ?>"><? echo $ar["VALUE"]; ?></label></li>
                <? endforeach; ?>
                    </ul>
                </div>
    <? endif; ?>
     * */?>
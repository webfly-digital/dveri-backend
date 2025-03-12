<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$showFilter = false;

foreach ($arResult["ITEMS"] as $arItem) {
    if (empty($arItem["VALUES"]) || isset($arItem["PRICE"])) continue;
    if ($arItem["DISPLAY_TYPE"] == "A" && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)) continue;
    $showFilter = true;
}
if (!$showFilter) return;


$arCombo = [];
foreach ($arResult["COMBO"] as $arItem) {
    foreach ($arItem as $key => $item) {
        $arCombo[$item]++;
    }
}


?>
<div class="catalog-filter super-accordion-item">
    <div class="toggler">
        <div class="h4">Подбор по параметрам</div>
    </div>
    <div class="wrapper">
        <form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>"
              method="get" class="smartfilter">
            <? foreach ($arResult["HIDDEN"] as $arItem): ?>
                <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>"
                       value="<? echo $arItem["HTML_VALUE"] ?>"/>
            <? endforeach; ?>
            <?
            $countFields = 0;
            $row = '';
            $classBlock = 'col-sm-4';
            $opened = false;
            foreach ($arResult["ITEMS"] as $key => $arItem) {

            foreach ($arItem["VALUES"] as $val => $ar) {
                if ($arCombo[$ar["VALUE"]] && count($arResult["COMBO"]) == $arCombo[$ar["VALUE"]])  $arItem["VALUES"] = [];
            }

            if (
                empty($arItem["VALUES"]) || isset($arItem["PRICE"])
            )
                continue;

            if (
                $arItem["DISPLAY_TYPE"] == "A" && (
                    $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
                )
            )
                continue;
            $arCur = current($arItem["VALUES"]);
            switch ($arItem["DISPLAY_TYPE"]) {
            case "A"://NUMBERS_WITH_SLIDER
            ?>
            <? if ($opened) echo "</div>"; ?>
            <div class="row catalog-filter__row"><!--close ib form footer-->
                <div class="col-sm-6">
                    <p class="catalog-filter__caption"><?= $arItem["NAME"] ?></p>
                    <div class="range-slider">
                        <div class="range-start">от</div>
                        <div class="range-stop">до</div>
                        <input
                                class="min-price"
                                type="text"
                                name="<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                id="<? echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                value="<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                size="5"
                                onkeyup="smartFilter.keyup(this)"
                                style="display:none;"
                        />
                        <input
                                class="max-price"
                                type="text"
                                name="<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                id="<? echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                value="<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                size="5"
                                onkeyup="smartFilter.keyup(this)"
                                style="display:none;"
                        />
                        <div class="slider" id="price-range"
                             data-range="<? echo $arItem["VALUES"]["MIN"]["VALUE"] ?>,<? echo $arItem["VALUES"]["MAX"]["VALUE"] ?>"
                             data-start="<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?: $arItem["VALUES"]["MIN"]["VALUE"] ?>,<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?: $arItem["VALUES"]["MAX"]["VALUE"] ?>"></div>
                    </div>
                </div>
                <?
                break;
                case "P"://DROPDOWN
                    $countFields++;
                    if ($countFields == 1 or $countFields == 4) {
                        $opened = true;
                        if ($countFields == 1) {
                            $row = '<div class="row catalog-filter__row">';
                            $classBlock = 'col-sm-4';
                        } else {
                            $row = '</div><div class="row catalog-filter__row">';
                            $classBlock = 'col-sm-4';
                        }
                    } else {
                        $row = '';
                    }
                    $checkedItemExist = false;
                    foreach ($arItem["VALUES"] as $val => $ar) {
                        if ($ar["CHECKED"]) {
                            $checkedItemExist = true;
                        }
                    }
                    ?>
                    <?= $row ?>
                    <div class="<?= $classBlock ?>">
                        <p class="catalog-filter__caption"><?= $arItem["NAME"] ?></p>
                        <input
                                style="display: none"
                                type="radio"
                                name="<?= $arCur["CONTROL_NAME_ALT"] ?>"
                                id="<? echo "all_" . $arCur["CONTROL_ID"] ?>"
                                value=""
                        />
                        <? foreach ($arItem["VALUES"] as $val => $ar): ?>
                            <input
                                    style="display: none"
                                    type="radio"
                                    name="<?= $ar["CONTROL_NAME_ALT"] ?>"
                                    id="<?= $ar["CONTROL_ID"] ?>"
                                    value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                            />
                        <? endforeach ?>
                        <select name="<? echo $arItem["CODE"] ?>" class="chosen-single--noselect"
                                onchange="smartFilter.selectDropDownItem(this)">
                            <option value=""<?= !$checkedItemExist ? ' selected' : '' ?>
                                    data-role="<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                    id="<?= "all_" . $arCur["CONTROL_ID"] ?>" name="<?= $arCur["CONTROL_NAME_ALT"] ?>">
                                Не важно
                            </option>
                            <?
                            foreach ($arItem["VALUES"] as $val => $ar):
                                $class = "";
                                if ($ar["CHECKED"])
                                    $class .= " selected";
                                if ($ar["DISABLED"])
                                    $class .= " disabled";
                                ?>
                                <option value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                        name="opt_<?= $ar["CONTROL_NAME_ALT"] ?>"
                                        data-role="<? echo $ar["CONTROL_ID"] ?>"<? echo $class ?>
                                >
                                    <? echo $ar["VALUE"] ?>
                                </option>
                            <? endforeach; ?>
                        </select>
                    </div>
                    <?
                    break;
                default://CHECKBOXES
                    $countFields++;
                    if ($countFields == 1 or $countFields == 4) {
                        $opened = true;
                        if ($countFields == 1) {
                            $row = '<div class="row catalog-filter__row">';
                            $classBlock = 'col-sm-4';
                        } else {
                            $row = '</div><div class="row catalog-filter__row">';
                            $classBlock = 'col-sm-4';
                        }
                    } else {
                        $row = '';
                    }

                    $checkedItemExist = false;
                    foreach ($arItem["VALUES"] as $val => $ar) {
                        if ($ar["CHECKED"]) {
                            $checkedItemExist = true;
                        }
                    } ?>
                    <?= $row ?>
                    <div class="<?= $classBlock ?>">
                        <p class="catalog-filter__caption"><?= $arItem["NAME"] ?></p>
                        <? foreach ($arItem["VALUES"] as $val => $ar): ?>
                            <div class="">
                                <label data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                       class="bx-filter-param-label <? echo $ar["DISABLED"] ? 'disabled' : '' ?>"
                                       for="<? echo $ar["CONTROL_ID"] ?>">
													<span class="bx-filter-input-checkbox">
														<input
                                                                type="checkbox"
                                                                value="<? echo $ar["HTML_VALUE"] ?>"
                                                                name="<? echo $ar["CONTROL_NAME"] ?>"
                                                                id="<? echo $ar["CONTROL_ID"] ?>"
															<? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
															onclick="smartFilter.click(this)"
                                                        />
														<span class="bx-filter-param-text"
                                                              title="<?= $ar["VALUE"]; ?>"><?= $ar["VALUE"]; ?><?
                                                            if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                                ?>&nbsp;(<span
                                                                    data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                            endif; ?></span>
													</span>
                                </label>
                            </div>
                        <? endforeach; ?>
                    </div>
                <?
                }
                ?>
                <?
                }
                ?>
                <div class="col-sm-6">
                    <div class="catalog-filter__footer">
                        <!--<span class="bx-filter-container-modef"></span>-->
                        <div class="bx-filter-popup-result catalog-filter__results"
                             id="modef" <? if (!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"'; ?>
                             style="display: inline-block;">
                            <? echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">' . intval($arResult["ELEMENT_COUNT"]) . '</span>')); ?>
                            <a href="<? echo $arResult["FILTER_URL"] ?>" target=""
                               style="display:none;"><? echo GetMessage("CT_BCSF_FILTER_SHOW") ?></a>
                        </div>
                        <div class="catalog-filter__buttons">
                            <button class="btn-transparent" title="Сбросить" type="submit"
                                    id="del_filter"
                                    name="del_filter"><span class="flaticon-reload"></span>
                            </button>
                            <button type="submit"
                                    id="set_filter"
                                    name="set_filter" class="btn btn--sky">Показать
                            </button>
                        </div>
                        <? /*<input
                      class="btn btn-themes"
                      type="submit"
                      id="set_filter"
                      name="set_filter"
                      value="<?= GetMessage("CT_BCSF_SET_FILTER") ?>"
                      />
                      <input
                      class="btn btn-link"
                      type="submit"
                      id="del_filter"
                      name="del_filter"
                      value="<?= GetMessage("CT_BCSF_DEL_FILTER") ?>"
                      /> */ ?>
                    </div>
                </div>
                <? if ($opened) echo "</div><!--open in price block row catalog-filter__row-->"; ?>
        </form>
    </div>
</div>
<script>
    var smartFilter = new JCSmartFilter('<? echo CUtil::JSEscape($arResult["FORM_ACTION"]) ?>', '<?= CUtil::JSEscape($arParams["FILTER_VIEW_MODE"]) ?>', <?= CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"]) ?>);
</script>

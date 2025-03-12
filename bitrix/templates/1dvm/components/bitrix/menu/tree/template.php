<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$this->addExternalJs(SITE_TEMPLATE_PATH . "/components/bitrix/menu/tree/script/script.js");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/components/bitrix/menu/tree/style/style.css", true);
?>

<? if (!empty($arResult)): ?>
    <div class="super-accordion-item">
    <div class="toggler first-level"> Разделы</div>
    <div class="wrapper">
    <? foreach ($arResult

                as $arItem):
        $tag = 'a';
        if ($arItem["SELECTED"]) $tag = 'span';
        ?>
    <div class="sect <?= $arItem["IS_PARENT"] == true ? "super-accordion-item " : "" ?> <? if ($arItem["SELECTED"] == true) { ?> show <? } ?> ">
        <div class="df">
            <div class="<?= $arItem["IS_PARENT"] == true ? "toggler" : "" ?>"></div>
            <<?= $tag ?> href="<?= $arItem["LINK"] ?>" class="sect-title"><?= $arItem["TEXT"] ?> </<?= $tag ?>>
        </div>
        <div class="wrapper">
        <div class="main-list">
        <? foreach ($arItem ["PARAMS"]["children"] as $arItem2): ?>
        <div class="group">
        <div class="group-title"><?= $arItem2["TEXT"] ?></div>
        <? foreach ($arItem2["PARAMS"]["children"] as $arItem3):
            $tag3 = 'a';
            if ($arItem3["SELECTED"]) $tag3 = 'span';
            ?>
            <? if (!empty($arItem3["PARAMS"]["children"])): ?>
            <div class="super-accordion-item <? if ($arItem3["SELECTED"] == true) { ?> show <? } ?>">
                <div class="df">
                    <div class="toggler"></div>
                    <<?= $tag3 ?> href="<?= $arItem3["LINK"] ?>"><?= $arItem3["TEXT"] ?></<?= $tag3 ?>>
            </div>
            <div class="wrapper" >
        <? else: ?>
            <<?= $tag3 ?><? if ($arItem3["SELECTED"] == true) {
                ?> class='show' <? } ?>
            href="<?= $arItem3["LINK"] ?>"><?= $arItem3["TEXT"] ?></<?= $tag3 ?>>
        <? endif ?>
            <? foreach ($arItem3["PARAMS"]["children"] as $arItem4):
            $tag4 = 'a';
            if ($arItem4["SELECTED"]) $tag4 = 'span';
            ?>
            <<?= $tag4 ?><? if ($arItem4["SELECTED"] == true) {
            ?> class='show' <? } ?>
            href="<?= $arItem4["LINK"] ?>"><?= $arItem4["TEXT"] ?></<?= $tag4 ?>>
        <? endforeach ?>
            <? if (!empty($arItem3["PARAMS"]["children"])): ?>
            </div>
            </div>
        <? endif ?>
        <? endforeach ?>
        </div>
    <? endforeach ?>
        </div>
        </div>
        </div>
    <? endforeach ?>
    </div>
    </div>
<? endif ?>



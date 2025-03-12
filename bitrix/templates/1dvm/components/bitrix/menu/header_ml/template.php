<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? if (!empty($arResult)) { ?>
    <ul class="nav-main hidden-xs" id="horizontal-multilevel-menu">
    <? $previousLevel = 0;
foreach ($arResult    as $arItem){
    $tag = 'a';
    if ($arItem["LINK"] == $APPLICATION->GetCurDir()) $tag = 'span';
    ?>
    <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) { ?>
        <?= str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
    <? } ?>
    <? if ($arItem["IS_PARENT"]){ ?>
    <? if ($arItem["DEPTH_LEVEL"] == 1){ ?>
    <li class="nav-main__item <?= $arItem["SELECTED"] ? 'active' : '' ?> dd">
        <<?= $tag ?> href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?><span class="icon-arrow-left"></span>
    </<?= $tag ?>>
    <ul class="menu-dropdown">
    <? } else { ?>
    <li class="<?= $arItem["SELECTED"] ? 'active' : '' ?> dd">
        <<?= $tag ?> href="<?= $arItem["LINK"] ?>" class="parent"><?= $arItem["TEXT"] ?><span
                class="icon-arrow-left"></span></<?= $tag ?>>
    <ul class="menu-dropdown">
    <? } ?>
    <? } else { ?>
        <? if ($arItem["PERMISSION"] > "D") { ?>
            <? if ($arItem["DEPTH_LEVEL"] == 1) { ?>
            <li class="nav-main__item <?= $arItem["SELECTED"] ? 'active' : '' ?>">
                <<?= $tag ?> href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></<?= $tag ?>>
                </li>
            <? } else { ?>
            <li class="<?= $arItem["SELECTED"] ? 'active' : '' ?>">
                <<?= $tag ?> href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></<?= $tag ?>>
                </li>
            <? } ?>
        <? } else { ?>
            <? if ($arItem["DEPTH_LEVEL"] == 1) { ?>
            <li class="nav-main__item <?= $arItem["SELECTED"] ? 'active' : '' ?>">
                <<?= $tag ?> href="" title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>
                "><?= $arItem["TEXT"] ?></<?= $tag ?>>
                </li>
            <? } else { ?>
            <li class="<?= $arItem["SELECTED"] ? 'active' : '' ?> dd">
                <<?= $tag ?> href="" class="denied"
                title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>"><?= $arItem["TEXT"] ?></<?= $tag ?>>
                </li>
            <? } ?>
        <? } ?>
    <? } ?>
    <? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>
<? } ?>
    <? if ($previousLevel > 1) {//close last item tags?>
        <?= str_repeat("</ul></li>", ($previousLevel - 1)); ?>
    <? } ?>
    </ul>
    <div class="menu-clear-left"></div>
<? }
?>
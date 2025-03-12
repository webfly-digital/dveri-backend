<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <div id="vertical-multilevel-menu" class="mobile-spoiler main">

    <?
    $previousLevel = 0;
    foreach ($arResult   as $arItem): ?>

        <? if ($previousLevel == 4 && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
            <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                </div>
                </div>
                </div>
                </div>
            <? endif ?>
            <? if ($arItem["DEPTH_LEVEL"] == 3): ?>
                </div>
            <? endif ?>
            <? if ($arItem["DEPTH_LEVEL"] == 2): ?>
                </div>
                </div>
                </div>
            <? endif ?>
        <? elseif ($previousLevel == 5 && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
            </div>
            </div>
            <? if ($arItem["DEPTH_LEVEL"] == 3): ?>
                </div>
            <? endif ?>
        <? endif ?>

        <? if ($arItem["IS_PARENT"]) { ?>

            <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                <div class="mobile-spoiler-header">
                    <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                    <div class="mobile-toggler"></div>
                </div>
                <div class="mobile-content">
            <? elseif ($arItem["DEPTH_LEVEL"] == 2): ?>
                <div class="mobile-spoiler second">
                <div class="mobile-spoiler-header">
                    <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                    <div class="mobile-toggler"></div>
                </div>
                <div class="mobile-content">
            <? elseif ($arItem["DEPTH_LEVEL"] == 3): ?>
                <div class="group">
                <div class="group-title"><?= $arItem["TEXT"] ?></div>
            <? elseif ($arItem["DEPTH_LEVEL"] == 4): ?>
                <div class="mobile-spoiler third">
                <div class="mobile-spoiler-header">
                    <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                    <div class="mobile-toggler"></div>
                </div>
                <div class="mobile-content">
            <? else: ?>

            <? endif ?>
        <? } else { ?>
            <? if ($arItem["PERMISSION"] > "D"): ?>
                <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                    <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                <? else: ?>
                    <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
                <? endif ?>
            <? endif ?>

        <? } ?>


        <? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>
    <? endforeach ?>
    <? if ($previousLevel > 1)://close last item tags?>
        <? //= str_repeat("</div>", ($previousLevel - 1)); ?>
    <? endif ?>

    </div>
<? endif ?>
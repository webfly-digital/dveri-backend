<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <ul class="mobile-menu list-unstyled">
        <?
        $delimeter = false;
        foreach ($arResult as $arItem):
            if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                continue;
            ?>
            <? if ($arItem["SELECTED"]): ?>
                <a href="<?= $arItem["LINK"] ?>" class="active"><?= $arItem["TEXT"] ?></a>
            <? else: ?>
                <a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a>
            <? endif ?>
        <? endforeach ?>
    </ul>
<?endif?>
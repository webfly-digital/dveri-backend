<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>


<? if (!empty($arResult)): ?>

                <div class="h5">Информация</div>
   <ul class="footer-menu">
        <?
        foreach ($arResult as $arItem):

            $tag = 'a';
            if ($arItem["SELECTED"]) $tag = 'span';

            if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                continue;
            ?>
            <li><<?=$tag?> href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></<?=$tag?>></li>
    <? endforeach ?>
    </ul>

    <?

endif?>
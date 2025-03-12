<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<? if (!empty($arResult)): ?>
    <aside class="col-md-3">
        <nav class="nav-about">
            <ul class="nav-about-menu">
                <?
                foreach ($arResult as $arItem):
                    if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                        continue;
                    ?>
                    <? if ($arItem["SELECTED"]): ?>
                        <li class="active"><span href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></span></li>
                        <? else: ?>
                        <li><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
                    <? endif ?>
                <? endforeach ?>
            </ul>
        </nav>
    </aside>
    <?
endif?>
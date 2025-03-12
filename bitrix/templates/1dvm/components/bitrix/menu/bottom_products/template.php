<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <div class="col-md-6 col-sm-4">
        <div class="h5">Продукция</div>
        <ul class="list-2-col footer-menu">
            <?
            $delimeter = false;
            foreach ($arResult as $arItem):
                $tag = 'a';
                if ($arItem["LINK"] == $APPLICATION->GetCurDir()) $tag = 'span';

                if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
                    continue;
                ?>
                <?
                $aClass = "";
                if (!$arItem["PARAMS"]["FROM_IBLOCK"]) {
                    if (!$delimeter) {
                        $delimeter = true;
                        echo '<li class="divider"></li>';
                    }
                    $aClass = "text--sky";
                }
                ?>
                <li><<?=$tag?> href="<?= $arItem["LINK"] ?>" class="<?= $aClass ?>"><?= $arItem["TEXT"] ?></<?=$tag?> ></li>
            <? endforeach ?>
        </ul>
    </div>
<?


endif ?>
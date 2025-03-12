<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? if (!empty($arResult)) { ?>
<ul class="nav-main hidden-xs" id="horizontal-multilevel-menu">
    <? $previousLevel = 0;
    foreach ($arResult

    as $arItem) {
    $tag = 'a';
    if ($arItem["LINK"] == $APPLICATION->GetCurDir()) $tag = 'span';
    ?>
    <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel) { ?>
        <?= str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
    <? } ?>
    <? if ($arItem["MENU"]) { ?>
    <li class="nav-main__item <?= $arItem["SELECTED"] ? 'active' : '' ?> dd">
        <<?= $tag ?> href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?><span class="icon-arrow-left"></span>
        </<?= $tag ?>>
        <ul class="menu-dropdown">
            <? foreach ($arItem["MENU"] as $arMenu):
                $tag1 = 'a';
                if ($arMenu["LINK"] == $APPLICATION->GetCurDir()) $tag1 = 'span'; ?>
            <li class="<?= $arMenu["IS_PARENT"] ? 'dd' : '' ?>">
                <<?= $tag1 ?> href="<?= $arMenu["LINK"] ?>" class="parent"><?= $arMenu["TEXT"] ?>
                <span class="icon-arrow-left"></span>
                </<?= $tag1 ?>>
                <ul class="menu-dropdown">
                    <? foreach ($arMenu ["PARAMS"]["children"] as $arItem2): ?>
                        <li class="group">
                            <ul class="group-ul">
                                <li class="group-ul-title"><?= $arItem2['TEXT'] ?></li>
                                <? foreach ($arItem2["PARAMS"]["children"] as $arItem3):
                                    $tag3 = 'a';
                                    if ($arItem3["LINK"] == $APPLICATION->GetCurDir()) $tag3 = 'span';
                                    ?>
                                <li class="<?= $arItem3["IS_PARENT"] ? 'dd' : '' ?>">
                                    <<?= $tag3 ?> href="<?= $arItem3["LINK"] ?>" class="parent"><?= $arItem3["TEXT"] ?>
                                    <span class="icon-arrow-left"></span>
                                    </<?= $tag3 ?>>
                                    <ul class="menu-dropdown">
                                        <? foreach ($arItem3["PARAMS"]["children"] as $arItem4):
                                            $tag4 = 'a';
                                            if ($arItem4["LINK"] == $APPLICATION->GetCurDir()) $tag4 = 'span';
                                            ?>
                                            <li class="">
                                            <<?= $tag4 ?> href="<?= $arItem4["LINK"] ?>
                                            "><?= $arItem4["TEXT"] ?></<?= $tag4 ?>>
                                            </li>
                                        <? endforeach ?>
                                    </ul>
                                    </li>
                                <? endforeach ?>
                            </ul>
                        </li>
                    <? endforeach ?>
                </ul>
                </li>
            <? endforeach ?>
        </ul>
    <? } else {
    if ($arItem["IS_PARENT"]) { ?>

    <? if ($arItem["DEPTH_LEVEL"] == 1) { ?>
    <li class="nav-main__item <?= $arItem["SELECTED"] ? 'active' : '' ?> dd">
        <<?= $tag ?> href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"]  ?> <span
                class="icon-arrow-left"></span>
    </<?= $tag ?>>
    <ul class="menu-dropdown" >
        <? } else {?>
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
                    <? } else {
                        $arUrl = explode('.', $_SERVER['HTTP_HOST']);
                        if ($arUrl[0] == 'msk' && strrpos($arItem["LINK"], '/articles/') > 0) {
                            $arItem["LINK"] = str_replace("1dvm", "msk.1dvm", $arItem["LINK"]);
                        }
                        ?>
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
            <? }
            } ?>
            <? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>
            <? } ?>
            <? if ($previousLevel > 1) {//close last item tags?>
                <?= str_repeat("</ul></li>", ($previousLevel - 1)); ?>
            <? } ?>
        </ul>
        <div class="menu-clear-left"></div>
        <? }
        ?>

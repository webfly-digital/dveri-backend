<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? if ($arResult["SECTIONS"]): ?>
    <div class="super-accordion">
        <div class=" nav-pic-accordion  super-accordion-item">
            <div class="toggler"> Категории</div>
            <div class="wrapper">
                <ul class="nav-pic">
                    <?
                    $sectCount = 0;
                    foreach ($arResult["SECTIONS"] as $arSection) {
                        ?>
                        <li class="nav-pic__item">
                            <a href="<?= $arSection["SECTION_PAGE_URL"] ?>">
                                <span class="nav-pic__pic">
                                <?if ($arSection["PICTURE"]['SRC']) {?>
                                    <img src="<?= $arSection["PICTURE"]['SRC'] ?>">
                                <?}?>
                                </span>
                                <span class="nav-pic__caption"><?= $arSection["NAME"] ?></span>
                            </a>
                        </li>
                    <? } ?>
                </ul>
            </div>
        </div>
    </div>
<? endif ?>


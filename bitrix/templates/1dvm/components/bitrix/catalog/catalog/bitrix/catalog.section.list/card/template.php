<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */

if ($arResult["SECTIONS"]) { ?>
    <div class="super-accordion">
        <div class=" nav-pic-accordion  super-accordion-item">
            <div class="toggler"> Категории</div>
            <div class="wrapper">
                <ul class="nav-pic">
                    <?php
                    $sectCount = 0;
                    foreach ($arResult["SECTIONS"] as $arSection) {
                        ?>
                        <li class="nav-pic__item">
                            <a href="<?= $arSection["SECTION_PAGE_URL"] ?>">
                                <span class="nav-pic__pic">
                                <?php if ($arSection["PICTURE"]['SRC']) { ?>
                                    <img src="<?= ImageCompressor::getCompressedSrcUniversal($arSection["PICTURE"]['SRC']) ?>">
                                <?php } ?>
                                </span>
                                <span class="nav-pic__caption"><?= $arSection["NAME"] ?></span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
<?php }
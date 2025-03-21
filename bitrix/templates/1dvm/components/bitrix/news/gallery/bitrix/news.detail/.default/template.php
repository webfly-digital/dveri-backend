<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */

$gallery = WFGeneral::GetGallery($arResult["PROPERTIES"]["GALLERY"]["VALUE"]); ?>
<div class="gal gal-v2">
    <?php
    if ($gallery):
        foreach ($gallery as $production):
            $pos = '';
            $desc = '';
            $art = '';
            if (!empty($production["DESCRIPTION"])) {
                $pos = strripos($production["DESCRIPTION"], 'Артикул');
                $desc = substr($production["DESCRIPTION"], 0, $pos);
                $art = substr($production["DESCRIPTION"], $pos, strlen($production["DESCRIPTION"]));
            }
            ?>
            <div class="gal-item">
                <?php if (!empty($art)): ?>
                    <div class="gal-item-article"><?= $art ?></div>
                <?php endif ?>
                <?php if (!empty($production["KEYWORDS"])): ?>
                    <div class="gal-item-price"><?= $production["KEYWORDS"] ?></div>
                <?php endif ?>
                <a href="<?= $production["PATH"] ?>" class="gal-item__preview"
                   title="<?= $production["NAME"] ?>"
                   style="background-image: url('<?= ImageCompressor::getCompressedSrc($production["ID"]) ?>');">
                </a>
                <div class="gal-item-subtitle"><?= $production["NAME"] ?></div>
                <?php if (!empty($desc)): ?>
                    <div class="gal-item-info"><?= $desc ?></div>
                <?php endif ?>
            </div>
        <?php
        endforeach;
    endif; ?>
</div>
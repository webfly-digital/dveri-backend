<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
?>
<div class="news-detail">
    <?php if ($arResult["DETAIL_PICTURE"]): ?>
        <div class="news-detail__cover">
            <img src="<?= ImageCompressor::getCompressedSrc($arResult["DETAIL_PICTURE"]["ID"]) ?>"
                 alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                 title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>">
        </div>
    <?php endif ?>
    <div class="text-content">
        <div class="news-detail__intro">
            <?php echo $arResult["PREVIEW_TEXT"]; ?>
        </div>
        <div class="news-detail__content">
            <?php echo $arResult["DETAIL_TEXT"]; ?>
        </div>
    </div>
</div>
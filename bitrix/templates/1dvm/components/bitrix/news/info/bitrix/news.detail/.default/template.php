<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */

?>
<?php if (empty($arResult["DETAIL_TEXT"])) { ?>
    Раздел в разработке!
<?php } else { ?>
    <?php if ($arResult["GALLERY"]) { ?>
        <div class="text-content">
            <?= $arResult["DETAIL_TEXT"][0] ?>
        </div>
        <?php $gallery = WFGeneral::GetGallery($arResult["PROPERTIES"]["GALLERY"]["VALUE"]); ?>
        <?php if ($gallery) { ?>
            <div class="gal gal-v1">
                <?php foreach ($gallery as $img) {
                    if (!empty($img["DESCRIPTION"])) {
                        $desc = $img["DESCRIPTION"];
                    } else {
                        $desc = $img["NAME"];
                    } ?>
                    <div class="gal-item">
                        <a href="<?= $img["PATH"] ?>" class="gal-item__preview" title="<?= $desc ?>">
                            <img alt="<?= $desc ?>" title="<?= $desc ?>" class="lazyload" data-original="<?= $img["THUMB_PATH"] ?>">
                        </a>
                        <div class="gal-item-subtitle"><?= $desc ?></div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="text-content">
            <?= $arResult["DETAIL_TEXT"][1] ?>
        </div>
    <?php } else { ?>
        <div class="text-content">
            <?= $arResult["DETAIL_TEXT"] ?>
        </div>
    <?php } ?>
<?php } ?>
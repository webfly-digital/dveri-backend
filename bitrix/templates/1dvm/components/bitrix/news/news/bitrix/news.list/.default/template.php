<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
?>
<div class="news-list--rows">
    <?php foreach ($arResult["ITEMS"] as $arItem): ?>
        <?php
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="news-card plugin-clickable" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="news-card__inner">
                <?php if ($arItem["PREVIEW_PICTURE"]["SRC"]): ?>
                    <div class="news-card__visual"
                         style="background-image: url('<?= ImageCompressor::getCompressedSrc($arItem["PREVIEW_PICTURE"]["ID"]) ?>');">
                    </div>

                <?php endif ?>
                <div class="news-card__details">
                    <h4 class="news-card__title"><a href="<?php echo $arItem["DETAIL_PAGE_URL"] ?>" class="link-detail"><?php echo $arItem["NAME"] ?></a></h4>
                    <p class="news-card__intro"><?php echo $arItem["PREVIEW_TEXT"]; ?></p>
                    <?php /*<p class="news-card__date"><? echo $arItem["DISPLAY_ACTIVE_FROM"] ?></p>*/?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
<?php endif; ?>
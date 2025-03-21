<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
?>
    <div class="albums">
        <?php foreach ($arResult["ITEMS"] as $arItem): ?>
            <?php
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), ["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);
            ?>
            <div class="album plugin-clickable" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <?php if ($arItem["PREVIEW_PICTURE"]["SRC"]): ?>
                    <div class="album__cover"
                         style="background-image: url('<?= ImageCompressor::getCompressedSrc($arItem["PREVIEW_PICTURE"]["ID"]) ?>');">
                        <div class="inner"></div>
                    </div>
                <?php endif ?>
                <h6 class="album__title"><a class="link-detail" href="<?php echo $arItem["DETAIL_PAGE_URL"] ?>"><?php echo $arItem["NAME"] ?></a></h6>
            </div>
        <?php endforeach; ?>
    </div>
<?php if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
<?php endif; ?>
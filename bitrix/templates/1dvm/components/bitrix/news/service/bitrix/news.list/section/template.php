<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */

$this->setFrameMode(true);
$seoH1 = $arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"];

if ($arResult['SECTION']['DESCRIPTION']) {
    $this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']["EDIT_LINK"], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT"));
    ?>
    <div class="text-content" id="<?= $this->GetEditAreaId($arResult['SECTION']['ID']); ?>">
        <?= $arResult['SECTION']['DESCRIPTION'] ?>
    </div>
    <?php
}

foreach ($arResult['ITEMS'] as $arItem) {
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    ?>
    <div id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
        <?= $arItem['PREVIEW_TEXT'] ?>
    </div>
<?php }
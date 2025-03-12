<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

foreach ($arResult['SECTIONS'] as $section) {
    if(empty($section['ITEMS'])) continue?>
    <section class="page-section-item">
        <?if (empty($arParams['HIDE_MENU'])) {?>
        <h3><?=$section['NAME']?></h3>
        <?}?>
        <div class="row row-flex works-list">
            <?foreach ($section['ITEMS'] as $arItem) {
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                ?>
                <div class="col-xs-12 col-sm-4" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="work-card">
                        <div class="work-card__pic"><img data-original="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" class="lazyload"></div>
                        <p class="work-card__caption"><?=$arItem['NAME']?></p>
                    </div>
                </div>
            <?}?>
        </div>
    </section>
<?}?>
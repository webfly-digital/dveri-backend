<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="albums">
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="album plugin-clickable" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <? if ($arItem["PREVIEW_PICTURE"]["SRC"]): ?>
                <div class="album__cover lazyload" data-original="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>">
                    <div class="inner"></div>
                </div>
            <? endif ?>
            <h6 class="album__title"><a class="link-detail" href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><? echo $arItem["NAME"] ?></a></h6>
        </div>
    <? endforeach; ?>
</div>
<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
<? endif; ?>
<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="clearfix"></div>
<div class="other-news">
    <h6>Другие новости</h6>
    <div class="news-list--rows">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <!--News list-->
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="news-card plugin-clickable" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <div class="news-card__inner">
                    <? if ($arItem["PREVIEW_PICTURE"]["SRC"]): ?>
                        <div class="news-card__visual lazyload" data-original="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"></div>
                    <? endif ?>
                    <div class="news-card__details">
                        <h4 class="news-card__title"><a href="<? echo $arItem["DETAIL_PAGE_URL"] ?>" class="link-detail"><? echo $arItem["NAME"] ?></a></h4>
                        <p class="news-card__intro"><? echo $arItem["PREVIEW_TEXT"]; ?></p>
                        <p class="news-card__date"><? echo $arItem["DISPLAY_ACTIVE_FROM"] ?></p>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
    <p><a href="<?=$arResult["LIST_PAGE_URL"]?>" class="text--sky">Все новости</a></p>
</div>


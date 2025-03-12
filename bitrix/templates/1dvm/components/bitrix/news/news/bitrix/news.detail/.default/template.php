<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<div class="news-detail">
    <? if ($arResult["DETAIL_PICTURE"]): ?>
        <div class="news-detail__cover">
            <img data-original="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>" title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"class="lazyload">
        </div>
    <? endif ?>
    <div class="text-content">
        <div class="news-detail__intro">
            <? echo $arResult["PREVIEW_TEXT"]; ?>
        </div>
        <div class="news-detail__content">
            <? echo $arResult["DETAIL_TEXT"]; ?>
        </div>
    </div>
</div>

<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
?>
<section class="page-section">
    <div class="container">
        <div class="text-content-wrapper">
            <div class="row">
                <div class="col-xs-12">
                    <?php $tagH2 = $arParams['TAG_H'] == 'N' ? 'div' : 'h2' ?>
                    <<?= $tagH2 ?> class="h2 page-section__title text-center">Статьи
                </<?= $tagH2 ?>>
                <div class="news-list">
                    <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                    <!--News list-->
                    <?php
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), ["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);
                    ?>
                    <div class="news-card plugin-clickable" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                        <div class="news-card__inner">
                            <?php if ($arItem["PREVIEW_PICTURE"]["SRC"]): ?>
                                <div class="news-card__visual"
                                     style="background-image: url('<?= ImageCompressor::getCompressedSrc($arItem["PREVIEW_PICTURE"]["ID"]) ?>');">
                                </div>
                            <?php endif ?>
                            <div class="news-card__details">
                                <?php $tagH4 = $arParams['TAG_H'] == 'N' ? 'div' : 'h4' ?>
                                <<?= $tagH4 ?> class="news-card__title h4">
                                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>" class="link-detail"><?= $arItem["NAME"] ?></a>
                            </<?= $tagH4 ?>>
                            <p class="news-card__intro"><?= $arItem["PREVIEW_TEXT"]; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <div class="page-section__footer">
                <a href="<?= $arResult["LIST_PAGE_URL"] ?>" class="btn btn--sky">Все статьи</a>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
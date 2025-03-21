<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */

if ($arResult["SECTIONS"]): ?>
    <section class="page-section" id="catalog-index">
        <h2 class="h1 page-section__title text-center">Противопожарная продукция в #WF_CITY_PRED#</h2>
        <!--Catalog tiles-->
        <div class="tiles catalog-items">
            <?php
            $sectCount = 0;
            foreach ($arResult["SECTIONS"] as $arSection) {
                $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
                $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), ["CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')]);
                $sectCount++;
                ?>
                <div class="tile <?= $arResult["GRID_TEMPLATE"][$sectCount]["MAIN"] ?>" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
                    <div class="tile__inner">
                        <div class="cat-item <?= $arResult["GRID_TEMPLATE"][$sectCount]["INNER"] ?> plugin-clickable">
                            <h4 class="cat-item__title"><a href="<?= $arSection["SECTION_PAGE_URL"] ?>"
                                                           class="link-detail"><?= $arSection["~UF_LIST_NAME"] ?: $arSection["NAME"] ?></a></h4>
                            <div class="cat-item__visual">
                                <?php if (count($arSection["PICS"]) > 1): ?>
                                    <div class="double-photo">
                                        <?php foreach ($arSection["PICS"] as $pkey => $pic):
                                            $picClass = [0 => "-top", 1 => "-bottom"]; ?>
                                            <div class="photo<?= $picClass[$pkey] ?>"
                                                 style="background-image: url('<?= ImageCompressor::getCompressedSrc($pic) ?>');">
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                <?php else: ?>
                                    <img class="photo" src="<?= ImageCompressor::getCompressedSrc($arSection["PICS"][0]) ?>"
                                         alt="Фото" title="Фото">
                                <?php endif ?>
                            </div>
                            <div class="cat-item__description">
                                <?php /*
                                <ul class="sub-ul list-unstyled">
                                <?foreach ($arSection['SUB'] as $sub) {?>
                                   <li><a href="<?=$sub['SECTION_PAGE_URL']?>"><?=$sub['NAME']?></a></li>
                                <?}?>
                                </ul>
                                */ ?>
                                <?php if ($arSection["UF_FIRE_RESIST"] == "1"): ?>
                                    <div class="fire-resistance">
                                        <div class="icon-fire"></div>
                                        <?= $arSection["~UF_FIRE_RESIST_TEXT"] ?: "" ?>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="page-section__footer">
            <a href="/catalog/" class="btn btn--lg btn--sky">Весь каталог</a>
        </div>
    </section>
<?php


endif ?>
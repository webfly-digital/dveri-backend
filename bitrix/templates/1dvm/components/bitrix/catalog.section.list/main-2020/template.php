<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */

if ($arResult["SECTIONS"]): ?>
    <section class="page-section" id="catalog-index">
        <h2 class="h1 page-section__title text-center">Противопожарная продукция в #WF_CITY_PRED#</h2>
        <!--Catalog tiles-->
        <div class="container catalog-items">
            <div class="row catalog-sections">
                <?php
                $sectCount = 0;
                foreach ($arResult["SECTIONS"] as $arSection) {
                    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
                    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), ["CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')]);
                    $sectCount++;

                    if ($sectCount == 1 || $sectCount == 6)
                        $columnClasses = "col-xs-12 col-lg-6";
                    else
                        $columnClasses = "col-xs-12 col-sm-6 col-lg-3";

                    ?>
                    <div class="<?= $columnClasses ?>" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
                        <div class="cat-section">

                            <div class="cat-section__visual <?= $arResult["GRID_TEMPLATE"][$sectCount]["INNER"] ?>">
                                <a href="<?= $arSection["SECTION_PAGE_URL"] ?>">
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
                                        <img class="photo<?= $arSection["ID"] == 25 ? " image-position-bottom" : "" ?>"
                                             src="<?= ImageCompressor::getCompressedSrc($arSection["PICS"][0]) ?>"
                                             alt="<?= $arSection["NAME"] ?>">
                                    <?php endif ?>

                                    <?php if ($arSection["UF_FIRE_RESIST"] == "1"): ?>
                                        <div class="fire-resistance">
                                            <div class="icon-fire"></div>
                                            <?= $arSection["~UF_FIRE_RESIST_TEXT"] ?: "" ?>
                                        </div>
                                    <?php endif ?>
                                </a>
                            </div>
                            <div class="cat-section__description">
                                <h3 class="cat-section__title h4">
                                    <a href="<?= $arSection["SECTION_PAGE_URL"] ?>"><?= $arSection["~UF_LIST_NAME"] ?: $arSection["NAME"] ?></a>
                                </h3>
                                <ul class="sub-ul list-unstyled">
                                    <?php foreach ($arSection['SUB'] as $sub) { ?>
                                        <li><a href="<?= $sub['SECTION_PAGE_URL'] ?>"><?= $sub['NAME'] ?></a></li>
                                    <?php } ?>
                                </ul>

                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="page-section__footer">
            <a href="/catalog/" class="btn btn--lg btn--sky">Весь каталог</a>
        </div>
    </section>
<?php


endif ?>
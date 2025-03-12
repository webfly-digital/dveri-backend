<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? if ($arResult["SECTIONS"]): ?>
        <div class="tiles catalog-items">
            <?
            $sectCount = 0;
            foreach ($arResult["SECTIONS"] as $arSection) {
                $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
                $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
                $sectCount++;
                ?>
                <div class="tile <?= $arResult["GRID_TEMPLATE"][$sectCount]["MAIN"] ?>" id="<?= $this->GetEditAreaId($arSection['ID']); ?>">
                    <div class="tile__inner">
                        <div class="cat-item <?= $arResult["GRID_TEMPLATE"][$sectCount]["INNER"] ?> plugin-clickable">
                            <h4 class="cat-item__title"><a href="<?= $arSection["SECTION_PAGE_URL"] ?>"
                                                           class="link-detail"><?= $arSection["~UF_LIST_NAME"]? : $arSection["NAME"] ?></a></h4>
                            <div class="cat-item__visual">
                                <? if (count($arSection["PICS"]) > 1): ?>
                                    <div class="double-photo">
                                    <? foreach ($arSection["PICS"] as $pkey => $pic):
                                            $picClass=array(0=>"-top", 1=>"-bottom");?>
                                        <div class="photo<?=$picClass[$pkey]?> lazyload" data-original="<?= $pic ?>" ></div>
                                    <? endforeach ?>
                                    </div>
                                <?else:?>
                                    <img class="photo lazyload" data-original="<?= $arSection["PICS"][0] ?>" src="<?= $arSection["PICS"][0] ?>">
                                <? endif ?>
                            </div>

                            <div class="cat-item__description">
                                <? if ($arSection["UF_FIRE_RESIST"] == "1"): ?>
                                    <div class="fire-resistance">
                                        <div class="icon-fire"></div>
                                        <?= $arSection["~UF_FIRE_RESIST_TEXT"]? : "" ?>
                                    </div>
                                <? endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            <? } ?>
        </div>
<?endif?>
<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? if (empty($arResult["DETAIL_TEXT"])): ?>
    Раздел в разработке!
<? else: ?>
    <? if ($arResult["GALLERY"]): ?>
    <div class="text-content">
        <?= $arResult["DETAIL_TEXT"][0] ?>
        </div>
        <? $gallery = WFGeneral::GetGallery($arResult["PROPERTIES"]["GALLERY"]["VALUE"]); ?>
        <? if ($gallery): ?>
            <div class="gal gal-v1">
                <? foreach ($gallery as $img):
                      if (!empty($img["DESCRIPTION"]))
                                $desc = $img["DESCRIPTION"];
                            else
                                $desc = $img["NAME"];?>
                    <div class="gal-item">
                        <a href="<?= $img["PATH"] ?>" class="gal-item__preview">
                            <img alt="<?=$desc?>" title="<?=$desc?>" class="lazyload" data-original="<?= $img["THUMB_PATH"] ?>">
                        </a>
                    </div>
                <? endforeach ?>
            </div>
        <? endif ?>
    <div class="text-content">
        <?= $arResult["DETAIL_TEXT"][1] ?> 
        </div>
    <? else: ?>
    <div class="text-content">
        <?= $arResult["DETAIL_TEXT"] ?> 
        </div>
    <? endif ?>
            <? endif ?>

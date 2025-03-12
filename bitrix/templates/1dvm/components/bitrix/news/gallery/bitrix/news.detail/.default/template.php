<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
$gallery = WFGeneral::GetGallery($arResult["PROPERTIES"]["GALLERY"]["VALUE"]); ?>
<div class="gal gal-v2">
    <?
    if ($gallery):
        foreach ($gallery as $production):
            $pos = '';
            $desc = '';
            $art = '';
            if (!empty($production["DESCRIPTION"])) {
                $pos = strripos($production["DESCRIPTION"], 'Артикул');
                $desc = substr($production["DESCRIPTION"], 0, $pos);
                $art = substr($production["DESCRIPTION"], $pos, strlen($production["DESCRIPTION"]));
            }
            ?>
            <div class="gal-item">
                <? if (!empty($art)): ?>
                    <div class="gal-item-article"><?= $art ?></div>
                <? endif ?>
                <? if (!empty($production["KEYWORDS"])): ?>
                    <div class="gal-item-price"><?= $production["KEYWORDS"] ?></div>
                <? endif ?>
                <a href="<?= $production["PATH"] ?>" class="gal-item__preview lazyload"
                   title="<?= $production["NAME"] ?>"
                   data-original="<?= $production["PATH"] ?>"></a>
                <div class="gal-item-subtitle"><?= $production["NAME"] ?></div>
                <? if (!empty($desc)): ?>
                    <div class="gal-item-info"><?= $desc ?></div>
                <? endif ?>
            </div>
        <?
        endforeach;
    endif; ?>
</div>

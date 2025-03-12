<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
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
?>
<div class="top-screen__slider">
    <!--Фотки должны быть в соотношении сторон 16/10-->
    <?
    if ($arResult["PHOTOS"]):
        foreach ($arResult["PHOTOS"] as $photo):
            ?>
            <div class="slide">
                <div class="inner"><img data-lazy="<?= $photo["src"] ?>" /></div>
            </div>
        <?
        endforeach;
    endif
    ?>        
</div>
<div class="top-screen__content">
    <div class="container">
        <div class="row content-top">
            <div class="col-sm-8">
                <h1><?=$arResult["NAME"]?></h1>
                    <? if ($arResult["PROPERTIES"]["PREVIEW_TEXT"]["~VALUE"]["TEXT"]): ?>
                    <div class="top-screen__description">
                    <?= $arResult["PROPERTIES"]["PREVIEW_TEXT"]["~VALUE"]["TEXT"] ?>
                    </div>
<? endif ?>
                <div class="top-screen__cta">
                    <a href="#modalUniversal" data-options="Получить прайс-лист|.input-phone,.input-comment" class="btn btn--sky btn--lg modal-universal-button">Получить прайс-лист</a>
                    <span class="flaticon-message"></span>
                </div>
            </div>
<? if ($arResult["VIDEO"]): ?>
                <div class="col-sm-4" id="video_container">
                    <div class="top-screen__video show-video youtube" data-video="<?= $arResult["VIDEO"] ?>">
                        <span class="flaticon-play-button"></span>
                <?= $arResult["PROPERTIES"]["VIDEO_TEXT"]["~VALUE"]["TEXT"]? : '' ?>
                    </div>
                </div>
<? endif ?>
        </div>
        <div class="row content-bottom">
            <div class="col-xs-12">
                <ul class="top-screen__menu">
                    <li>
                        <a class="slow-scroll" href="#filter-section">
                            <span class="flaticon-settings-2"></span>
                            <span class="caption">Выбрать двери<br/>по&nbsp;параметрам</span>
                        </a>
                    </li>
                    <li>
                        <a class="slow-scroll" href="#catalog-index">
                            <span class="flaticon-shield"></span>
                            <span class="caption">Смотреть каталог изделий</span>
                        </a>
                    </li>
                    <li>
                        <a class="slow-scroll" href="#calculate">
                            <span class="flaticon-calculator"></span>
                            <span class="caption">Рассчитать стоимость двери</span>
                        </a>
                    </li>
                    <li>
                        <a class="slow-scroll" href="#gallery">
                            <span class="flaticon-photo-camera"></span>
                            <span class="caption">Смотреть галерею работ</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
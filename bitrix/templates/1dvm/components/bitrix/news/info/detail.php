<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="col-md-9">
<?$ElementID = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"",
	Array(
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => $arParams["DISPLAY_NAME"],
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"FIELD_CODE" => $arParams["DETAIL_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["DETAIL_PROPERTY_CODE"],
		"DETAIL_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL"	=>	$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"META_KEYWORDS" => $arParams["META_KEYWORDS"],
		"META_DESCRIPTION" => $arParams["META_DESCRIPTION"],
		"BROWSER_TITLE" => $arParams["BROWSER_TITLE"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
        "SHOW_404" => $arParams["SHOW_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"ADD_SECTIONS_CHAIN" => $arParams["ADD_SECTIONS_CHAIN"],
		"ACTIVE_DATE_FORMAT" => $arParams["DETAIL_ACTIVE_DATE_FORMAT"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"DISPLAY_TOP_PAGER" => $arParams["DETAIL_DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DETAIL_DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["DETAIL_PAGER_TITLE"],
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => $arParams["DETAIL_PAGER_TEMPLATE"],
		"PAGER_SHOW_ALL" => $arParams["DETAIL_PAGER_SHOW_ALL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"USE_SHARE" 			=> $arParams["USE_SHARE"],
		"SHARE_HIDE" 			=> $arParams["SHARE_HIDE"],
		"SHARE_TEMPLATE" 		=> $arParams["SHARE_TEMPLATE"],
		"SHARE_HANDLERS" 		=> $arParams["SHARE_HANDLERS"],
		"SHARE_SHORTEN_URL_LOGIN"	=> $arParams["SHARE_SHORTEN_URL_LOGIN"],
		"SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
          "ADD_ELEMENT_CHAIN"=>$arParams["ADD_ELEMENT_CHAIN"]
	),
	$component
);
?>
</div>
<?
if ($arResult['VARIABLES']["ELEMENT_CODE"] == 'devel') {?>

    <!--Фотки-->
    <? $gallery3 = WFGeneral::GetGallery(3); ?>
    <? if ($gallery3): ?>

                    <div class="col-xs-12 page-section-item pt-5">
                        <h3 class="h3 page-section__title text-center">Галерея фотографий с производства</h3>
                        <!--Gallery-->
                        <div class="gal gal-v2">
                            <?
                            foreach ($gallery3 as $production):
                                if (!empty($production["DESCRIPTION"]))
                                    $production_desc = $production["DESCRIPTION"];
                                else
                                    $production_desc = $production["NAME"];
                                ?>
                                <div class="gal-item">
                                    <a href="<?= $production["PATH"] ?>" class="gal-item__preview lazyload" title="<?= $production_desc ?>"
                                       data-original="<?= $production["PATH"] ?>"></a>
                                </div>
                            <? endforeach ?>
                        </div>
                        <!--/gallery-->
                        <div class="page-section__footer">
                            <?
                            $APPLICATION->IncludeFile(
                                SITE_DIR . "include/main/button-2.php", Array(), Array("NAME" => "кнопку", "MODE" => "html")
                            );
                            ?>
                        </div>
                    </div>

    <? endif ?>
    <!--/Фотки-->
    <!--Сертификаты-->
    <? $gallery4 = WFGeneral::GetGallery(4); ?>
    <? if (is_array($gallery4)): ?>
                <div class="page-section-item">
                    <h3 class="h3 page-section__title text-center">Сертификаты и ГОСТы</h3>
                    <div class="gal gal-v1">
                        <?
                        foreach ($gallery4 as $cert):
                            if (!empty($cert["DESCRIPTION"]))
                                $cert_desc = $cert["DESCRIPTION"];
                            else
                                $cert_desc = $cert["NAME"];
                            ?>
                            <div class="gal-item">
                                <a href="<?= $cert["PATH"] ?>" class="gal-item__preview">
                                    <img alt="<?= $cert_desc ?>" title="<?= $cert_desc ?>" class="lazyload" data-original="<?= $cert["PATH"] ?>">
                                </a>
                            </div>
                        <? endforeach ?>
                    </div>
                    <div class="page-section__footer">
                        <?
                        $APPLICATION->IncludeFile(
                            SITE_DIR . "include/main/button-1.php", Array(), Array("NAME" => "кнопку", "MODE" => "html")
                        );
                        ?>
                    </div>
                </div>
    <? endif ?>

    <?$APPLICATION->IncludeComponent(
        "bitrix:news",
        "objects",
        array(
            "ADD_ELEMENT_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "N",
            "BROWSER_TITLE" => "-",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "CHECK_DATES" => "N",
            "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
            "DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
            "DETAIL_DISPLAY_TOP_PAGER" => "N",
            "DETAIL_FIELD_CODE" => [],
            "DETAIL_PAGER_SHOW_ALL" => "N",
            "DETAIL_PAGER_TEMPLATE" => "",
            "DETAIL_PAGER_TITLE" => "",
            "DETAIL_PROPERTY_CODE" => [],
            "DETAIL_SET_CANONICAL_URL" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_DATE" => "N",
            "DISPLAY_NAME" => "N",
            "DISPLAY_PICTURE" => "N",
            "DISPLAY_PREVIEW_TEXT" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "FILE_404" => "",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "IBLOCK_ID" => "21",
            "IBLOCK_TYPE" => "news",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
            "LIST_FIELD_CODE" => [],
            "LIST_PROPERTY_CODE" => [],
            "MESSAGE_404" => "",
            "META_DESCRIPTION" => "-",
            "META_KEYWORDS" => "-",
            "NEWS_COUNT" => "20",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "dvm",
            "PAGER_TITLE" => "Новости",
            "PREVIEW_TRUNCATE_LEN" => "",
            "SEF_FOLDER" => "",
            "SEF_MODE" => "N",
            "SET_LAST_MODIFIED" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "N",
            "SHOW_404" => "N",
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_BY2" => "SORT",
            "SORT_ORDER1" => "DESC",
            "SORT_ORDER2" => "ASC",
            "STRICT_SECTION_CHECK" => "N",
            "USE_CATEGORIES" => "N",
            "USE_FILTER" => "N",
            "USE_PERMISSIONS" => "N",
            "USE_RATING" => "N",
            "USE_RSS" => "N",
            "USE_SEARCH" => "N",
            "USE_SHARE" => "N",
            "SEF_URL_TEMPLATES" => [
                "news" => "",
                "section" => "/objects/",
                "detail" => "/objects/#ELEMENT_CODE#/",
            ]
        ),
        false
    );?>
<?}
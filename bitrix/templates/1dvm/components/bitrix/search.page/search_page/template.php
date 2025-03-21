<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
?>
<div class="search-page">
    <form action="" method="get" class="header-search">
            <? if ($arParams["USE_SUGGEST"] === "Y"):
                if (mb_strlen($arResult["REQUEST"]["~QUERY"]) && is_object($arResult["NAV_RESULT"])) {
                    $arResult["FILTER_MD5"] = $arResult["NAV_RESULT"]->GetFilterMD5();
                    $obSearchSuggest = new CSearchSuggest($arResult["FILTER_MD5"], $arResult["REQUEST"]["~QUERY"]);
                    $obSearchSuggest->SetResultCount($arResult["NAV_RESULT"]->NavRecordCount);
                }
                ?>
                <? $APPLICATION->IncludeComponent(
                "bitrix:search.suggest.input",
                "",
                array(
                    "NAME" => "q",
                    "VALUE" => $arResult["REQUEST"]["~QUERY"],
                    "INPUT_SIZE" => 40,
                    "DROPDOWN_SIZE" => 10,
                    "FILTER_MD5" => $arResult["FILTER_MD5"],
                ),
                $component, array("HIDE_ICONS" => "Y")
            ); ?>
            <? else: ?>
                <input type="text" name="q" value="<?= $arResult["REQUEST"]["QUERY"] ?>" size="40"/>
            <? endif; ?>

            <input type="submit" value="<?= GetMessage("SEARCH_GO") ?>"/>
            <input type="hidden" name="how" value="<? echo $arResult["REQUEST"]["HOW"] == "d" ? "d" : "r" ?>"/>
    </form>
    <br/>

    <? if (isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):
        ?>
        <div class="search-language-guess">
            <? echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#" => '<a href="' . $arResult["ORIGINAL_QUERY_URL"] . '">' . $arResult["REQUEST"]["ORIGINAL_QUERY"] . '</a>')) ?>
        </div><br/><?
    endif; ?>

    <? if ($arResult["REQUEST"]["QUERY"] === false && $arResult["REQUEST"]["TAGS"] === false): ?>
    <? elseif ($arResult["ERROR_CODE"] != 0): ?>
        <p><?= GetMessage("SEARCH_ERROR") ?></p>
        <? ShowError($arResult["ERROR_TEXT"]); ?>
        <p><?= GetMessage("SEARCH_CORRECT_AND_CONTINUE") ?></p>
        <br/><br/>
        <p><?= GetMessage("SEARCH_SINTAX") ?><br/><b><?= GetMessage("SEARCH_LOGIC") ?></b></p>
        <table border="0" cellpadding="5">
            <tr>
                <td align="center" valign="top"><?= GetMessage("SEARCH_OPERATOR") ?></td>
                <td valign="top"><?= GetMessage("SEARCH_SYNONIM") ?></td>
                <td><?= GetMessage("SEARCH_DESCRIPTION") ?></td>
            </tr>
            <tr>
                <td align="center" valign="top"><?= GetMessage("SEARCH_AND") ?></td>
                <td valign="top">and, &amp;, +</td>
                <td><?= GetMessage("SEARCH_AND_ALT") ?></td>
            </tr>
            <tr>
                <td align="center" valign="top"><?= GetMessage("SEARCH_OR") ?></td>
                <td valign="top">or, |</td>
                <td><?= GetMessage("SEARCH_OR_ALT") ?></td>
            </tr>
            <tr>
                <td align="center" valign="top"><?= GetMessage("SEARCH_NOT") ?></td>
                <td valign="top">not, ~</td>
                <td><?= GetMessage("SEARCH_NOT_ALT") ?></td>
            </tr>
            <tr>
                <td align="center" valign="top">( )</td>
                <td valign="top">&nbsp;</td>
                <td><?= GetMessage("SEARCH_BRACKETS_ALT") ?></td>
            </tr>
        </table>
    <? elseif (count($arResult["SEARCH"]) > 0): ?>
        <? if ($arParams["DISPLAY_TOP_PAGER"] != "N") echo $arResult["NAV_STRING"] ?>
        <br/>
        <hr/>
        <? foreach ($arResult["SEARCH"] as $arItem): ?>
            <a href="<? echo $arItem["URL"] ?>"><? echo $arItem["TITLE_FORMATED"] ?></a>
            <p><? echo $arItem["BODY_FORMATED"] ?></p>
            <? if (
                $arParams["SHOW_RATING"] == "Y"
                && $arItem["RATING_TYPE_ID"] <> ''
                && $arItem["RATING_ENTITY_ID"] > 0
            ): ?>
                <div class="search-item-rate"><?
                    $APPLICATION->IncludeComponent(
                        "bitrix:rating.vote", $arParams["RATING_TYPE"],
                        array(
                            "ENTITY_TYPE_ID" => $arItem["RATING_TYPE_ID"],
                            "ENTITY_ID" => $arItem["RATING_ENTITY_ID"],
                            "OWNER_ID" => $arItem["USER_ID"],
                            "USER_VOTE" => $arItem["RATING_USER_VOTE_VALUE"],
                            "USER_HAS_VOTED" => $arItem["RATING_USER_VOTE_VALUE"] == 0 ? 'N' : 'Y',
                            "TOTAL_VOTES" => $arItem["RATING_TOTAL_VOTES"],
                            "TOTAL_POSITIVE_VOTES" => $arItem["RATING_TOTAL_POSITIVE_VOTES"],
                            "TOTAL_NEGATIVE_VOTES" => $arItem["RATING_TOTAL_NEGATIVE_VOTES"],
                            "TOTAL_VALUE" => $arItem["RATING_TOTAL_VALUE"],
                            "PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER_PROFILE"],
                        ),
                        $component,
                        array("HIDE_ICONS" => "Y")
                    ); ?>
                </div>
            <? endif; ?>
            <?
            if ($arItem["CHAIN_PATH"]):?>
                <small><?= GetMessage("SEARCH_PATH") ?>&nbsp;<?= $arItem["CHAIN_PATH"] ?></small><?
            endif;
            ?>
            <hr/>
        <? endforeach; ?>
        <? if ($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"] ?>
    <? else: ?>
        <? ShowNote(GetMessage("SEARCH_NOTHING_TO_FOUND")); ?>
    <? endif; ?>
</div>
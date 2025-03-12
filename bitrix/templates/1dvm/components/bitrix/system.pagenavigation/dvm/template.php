<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}
?>
<ul class="pagination">
    <?
    $strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
    $strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
    ?>
    <?
    if ($arResult["bDescPageNumbering"] === true):
        $bFirst = true;
        if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
            if ($arResult["bSavePage"]):
                ?>
                <li class="pagination__link">
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>">Назад</a>
                </li>
                <?
            else:
                if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"] + 1)):
                    ?>
                    <li class="pagination__link">
                        <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">Назад</a>
                    </li>    
                    <?
                else:
                    ?>
                    <li class="pagination__link">
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>">Назад</a>
                    </li>
                <?
                endif;
            endif;

            if ($arResult["nStartPage"] < $arResult["NavPageCount"]):
                $bFirst = false;
                if ($arResult["bSavePage"]):
                    ?>
                    <li class="pagination__button">
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>">1</a>
                    </li>
                    <?
                else:
                    ?>
                    <li class="pagination__button">
                        <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">1</a>
                    </li>
                <?
                endif;
                if ($arResult["nStartPage"] < ($arResult["NavPageCount"] - 1)):
                    ?>
                    <li class="pagination__button">
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= intVal($arResult["nStartPage"] + ($arResult["NavPageCount"] - $arResult["nStartPage"]) / 2) ?>">&#8230;</a>
                    </li>
                    <?
                endif;
            endif;
        endif;
        do {
            $NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;

            if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
                ?>
                <li class="pagination__button active">
                    <a href=""><?= $NavRecordGroupPrint ?></a>
                </li>
                <?
            elseif ($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):
                ?>
                <li class="pagination__button">
                    <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $NavRecordGroupPrint ?></a>
                </li>
                <?
            else:
                ?>
                <li class="pagination__button">
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"<?
                ?>><?= $NavRecordGroupPrint ?></a>
                </li>
            <?
            endif;

            $arResult["nStartPage"] --;
            $bFirst = false;
        } while ($arResult["nStartPage"] >= $arResult["nEndPage"]);

        if ($arResult["NavPageNomer"] > 1):
            if ($arResult["nEndPage"] > 1):
                if ($arResult["nEndPage"] > 2):
                    ?>
                    <li class="pagination__button">
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= round($arResult["nEndPage"] / 2) ?>">&#8230;</a>
                    </li> 
                    <?
                endif;
                ?>
                <li class="pagination__button">
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1"><?= $arResult["NavPageCount"] ?></a>
                </li>
                <?
            endif;
            ?>
            <li class="pagination__link">
                <a class="modern-page-next" href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>">Вперед</a>
            </li>
            <?
        endif;

    else:
        $bFirst = true;

        if ($arResult["NavPageNomer"] > 1):
            if ($arResult["bSavePage"]):
                ?>
                <li class="pagination__link">
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>">Назад</a>
                </li>
                <?
            else:
                if ($arResult["NavPageNomer"] > 2):
                    ?>
                    <li class="pagination__link">
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] - 1) ?>">Назад</a>
                    </li>
                    <?
                else:
                    ?>
                    <li class="pagination__link">
                        <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">Назад</a>
                    </li>
                <?
                endif;

            endif;

            if ($arResult["nStartPage"] > 1):
                $bFirst = false;
                if ($arResult["bSavePage"]):
                    ?>
                    <li class="pagination__button">
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=1">1</a>
                    </li>
                    <?
                else:
                    ?>
                    <li class="pagination__button">
                        <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>">1</a>
                    </li>
                <?
                endif;
                if ($arResult["nStartPage"] > 2):
                    ?>
                    <li class="pagination__button">
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= round($arResult["nStartPage"] / 2) ?>">&#8230;</a>
                    </li>
                    <?
                endif;
            endif;
        endif;

        do {
            if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
                ?>
                <li class="pagination__button active">
                    <a href=""><?= $arResult["nStartPage"] ?></a>
                </li>
                <?
            elseif ($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
                ?>
                <li class="pagination__button">
                    <a href="<?= $arResult["sUrlPath"] ?><?= $strNavQueryStringFull ?>"><?= $arResult["nStartPage"] ?></a>
                </li>
                <?
            else:
                ?>
                <li class="pagination__button">
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["nStartPage"] ?>"<?
                ?>><?= $arResult["nStartPage"] ?></a>
                </li>
            <?
            endif;
            $arResult["nStartPage"] ++;
            $bFirst = false;
        } while ($arResult["nStartPage"] <= $arResult["nEndPage"]);

        if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
            if ($arResult["nEndPage"] < $arResult["NavPageCount"]):
                if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)):
                    ?>
                    <li class="pagination__button">
                        <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= round($arResult["nEndPage"] + ($arResult["NavPageCount"] - $arResult["nEndPage"]) / 2) ?>">&#8230;</a>
                    </li>
                    <?
                endif;
                ?>
                <li class="pagination__button">
                    <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageCount"] ?>"><?= $arResult["NavPageCount"] ?></a>
                </li>
                <?
            endif;
            ?>
            <li class="pagination__link">
                <a href="<?= $arResult["sUrlPath"] ?>?<?= $strNavQueryString ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= ($arResult["NavPageNomer"] + 1) ?>">Вперед</a>
            </li>
            <?
        endif;
    endif;
    ?>
</ul>
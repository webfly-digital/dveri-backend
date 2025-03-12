<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$cur_page_no_index = $APPLICATION->GetCurPage(false);
?>
<nav class="nav-about">
    <div class="visible-sm visible-xs nav-about-control">
        <button class="btn btn--gray" data-toggle="collapse" data-target="#nav-left">Навигация по разделу</button>
    </div>
<? if ($arResult["SECTIONS"]): ?>
    <ul class="nav-about-menu collapse-sm" id="nav-left">
        <?foreach ($arResult["TREE_SECTIONS"] as $arSection) {
            $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
            //$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <li class="<?=$cur_page_no_index == $arSection["SECTION_PAGE_URL"] ? 'active':''?>"><a href="<?= $arSection["SECTION_PAGE_URL"] ?>"><?= $arSection["~UF_LIST_NAME"]? : $arSection["NAME"] ?></a>
                <?if (!empty($arSection['CHILDS'])) {?>
                <ul class="list-unstyled submenu">
                <?foreach ($arSection['CHILDS'] as $child) {?>
                    <li class="<?=$cur_page_no_index == $child["SECTION_PAGE_URL"] ? 'active':''?>"><a href="<?=$child['SECTION_PAGE_URL']?>"><?=$child['NAME']?></a></li>
                <?}?>
                </ul>
                <?}?>
            </li>
    <? } ?>
    </ul>
    <?
endif;?>
</nav>
<?return;?>

<aside class="col-md-3">
    <nav class="nav-about">
        <div class="visible-sm visible-xs nav-about-control">
            <button class="btn btn--gray" data-toggle="collapse" data-target="#nav-left">Навигация по разделу</button>
        </div>
        <ul class="nav-about-menu collapse-sm" id="nav-left">
            <li class="active"><a href="">Противопожарные двери</a>
                <ul class="list-unstyled submenu">
                    <li><a href="">Однопольные</a></li>
                    <li><a href="">Полуторные</a></li>
                    <li><a href="">Двупольные</a></li>
                    <li><a href="">Огнестойкость 1-го типа (Ei 90)</a></li>
                    <li class="active"><a href="">Огнестойкость 2-го типа (Ei 60)</a></li>
                    <li><a href="">Огнестойкость 3-го типа (Ei 30)</a></li>
                    <li><a href="">Дымогазонепроницаемые</a></li>
                    <li><a href="">С прямоугольным остеклением</a></li>
                    <li><a href="">С круглым остеклением</a></li>
                    <li><a href="">С системой «антипаника»</a></li>
                    <li><a href="">С автопорогом</a></li>
                    <li><a href="">Вентиляционные с решеткой</a></li>
                    <li><a href="">С фрамугой</a></li>
                </ul>
            </li>
            <li class=""><a href="">Противопожарные люки</a></li>
            <li class=""><a href="">Противопожарные ворота</a></li>
            <li class=""><a href="">Дымогазонепроницаемые ворота</a></li>
            <li class=""><a href="">Дымогазонепроницаемые двери</a></li>
            <li class=""><a href="">Технические двери</a></li>
            <li class=""><a href="">Технические ворота</a></li>
            <li class=""><a href="">Технические люки</a></li>
            <li class="">
                <a href="">Входные двери в квартиру</a>
            </li>
        </ul>
    </nav>
</aside>

<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div style="overflow: hidden">
<?foreach($arResult["ITEMS"] as $k=>$arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
<?
   /* if ($k%3==0) {
    echo(($k!=0?'</div>':'').'<div style="overflow: hidden">   ');
    }*/
?>
<div class="jinn" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"  class="somehead ajaxview"><?echo $arItem["NAME"]?></a>
    <div class="sometext"><?echo $arItem["PREVIEW_TEXT"]?></div>
</div>

<?endforeach;?>
</div>


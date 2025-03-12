<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
//determine if child selected

$bWasSelected = false;
$arParents = array();
$depth = 1;
foreach($arResult as $i=>$arMenu)
{
	$depth = $arMenu['DEPTH_LEVEL'];

	if($arMenu['IS_PARENT'] == true)
	{
		$arParents[$arMenu['DEPTH_LEVEL']-1] = $i;
	}
	elseif($arMenu['SELECTED'] == true)
	{
		$bWasSelected = true;
		break;
	}
}

if($bWasSelected)
{
	for($i=0; $i<$depth-1; $i++)
		$arResult[$arParents[$i]]['SELECTED'] = true;
}
?>

<?php
$new = array();
foreach ($arResult as $a) {
	$new[$a['PARAMS']["IBLOCK_SECTION_ID_PARENT"]][] = $a;
}
if (!function_exists('createTree1')) {
	function createTree1(&$list, $parent)
	{
		$tree = array();
		foreach ($parent as $k => $l) {
			if (isset($list[$l['PARAMS']['IBLOCK_SECTION_ID_PARENT']])) {
				$l['PARAMS']['children'] = createTree1($list, $list[$l['PARAMS']['ID_SECT']]);
			}
			$tree[] = $l;
		}
		return $tree;
	}
}
$tree = createTree1($new, $new[0]); // changed
$arResult = $tree;

?>

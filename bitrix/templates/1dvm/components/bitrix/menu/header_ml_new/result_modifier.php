<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();


$new = array();
foreach ($arResult as $a) {
    if (key_exists("IBLOCK_SECTION_ID_PARENT", $a['PARAMS'])) $new[$a['PARAMS']["IBLOCK_SECTION_ID_PARENT"]][] = $a;
    else $menu[] = $a;
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
if($menu[0]['LINK'] == '/catalog/') {
    $menu[0]['IS_PARENT'] = false;
    $menu[0]['MENU'] = $tree;
}
$arResult = $menu;

?>

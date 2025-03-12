<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
//Шаблон сетки
if ($arResult["SECTIONS"]){
    $arResult["GRID_TEMPLATE"]=array(
      1=>array("MAIN"=>"tile--h", "INNER"=>"theme-dark-grad"),
      2=>array("MAIN"=>"tile--sq", "INNER"=>"theme-gray-2"),
      3=>array("MAIN"=>"tile--sq", "INNER"=>"theme-gray"),
      4=>array("MAIN"=>"tile--sq", "INNER"=>"theme-gray-grad"),
      5=>array("MAIN"=>"tile--sq", "INNER"=>"theme-default"),
      6=>array("MAIN"=>"tile--h", "INNER"=>"theme-sun-grad")
    );
    //Получение изображений раздела
    foreach ($arResult["SECTIONS"] as $key => &$arSection){
        if ($arSection["UF_PICS"]){
            foreach ($arSection["UF_PICS"] as $pKey => &$pic){
                if ($pKey>1)
                    break;
                $arSection["PICS"][] = CFile::GetPath($pic);
            }
        }
    }
}
?>

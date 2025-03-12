<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//Шаблон сетки
if ($arResult["SECTIONS"]) {
    $arResult["GRID_TEMPLATE"] = array(
      1 => array("MAIN" => "tile--h", "INNER" => "theme-dark-grad"),
      2 => array("MAIN" => "tile--sq", "INNER" => "theme-gray-2"),
      3 => array("MAIN" => "tile--sq", "INNER" => "theme-gray"),
      4 => array("MAIN" => "tile--sq", "INNER" => "theme-gray-grad"),
      5 => array("MAIN" => "tile--sq", "INNER" => "theme-default"),
      6 => array("MAIN" => "tile--h", "INNER" => "theme-sun-grad"),
      7 => array("MAIN" => "tile--h", "INNER" => "theme-blood"),
      8 => array("MAIN" => "tile--sq", "INNER" => "theme-gray-grad"),
      9 => array("MAIN" => "tile--sq", "INNER" => "theme-gray-2"),
      10 => array("MAIN" => "tile--sq", "INNER" => "theme-gray"),
      11 => array("MAIN" => "tile--sq", "INNER" => "theme-gray-2"),
      12 => array("MAIN" => "tile--h", "INNER" => "theme-dark photo-bg center lazyload"),
      13 => array("MAIN" => "tile--sq", "INNER" => "theme-gray photo-bg center lazyload"),
      14 => array("MAIN" => "tile--sq", "INNER" => "theme-dark photo-bg cover"),
      15 => array("MAIN" => "tile--sq", "INNER" => "theme-default"),
      16 => array("MAIN" => "tile--sq", "INNER" => "photo-bg cover lazyload"),
    );
    //Получение изображений раздела
    foreach ($arResult["SECTIONS"] as $key => &$arSection) {
        if (empty($arSection["PICTURE"]))
            if ($arSection["UF_PICS"]) {
                $path = \CFile::GetPath(current($arSection["UF_PICS"]));
                if ($path) $arSection["PICTURE"] = ['SRC' => $path];
            }

    }
}


<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */

//Шаблон сетки
if ($arResult["SECTIONS"]) {
    $arResult["GRID_TEMPLATE"] = [
        1 => ["MAIN" => "tile--h", "INNER" => "theme-dark-grad"],
        2 => ["MAIN" => "tile--sq", "INNER" => "theme-gray-2"],
        3 => ["MAIN" => "tile--sq", "INNER" => "theme-gray"],
        4 => ["MAIN" => "tile--sq", "INNER" => "theme-gray-grad"],
        5 => ["MAIN" => "tile--sq", "INNER" => "theme-default"],
        6 => ["MAIN" => "tile--h", "INNER" => "theme-sun-grad"],
        7 => ["MAIN" => "tile--h", "INNER" => "theme-blood"],
        8 => ["MAIN" => "tile--sq", "INNER" => "theme-gray-grad"],
        9 => ["MAIN" => "tile--sq", "INNER" => "theme-gray-2"],
        10 => ["MAIN" => "tile--sq", "INNER" => "theme-gray"],
        11 => ["MAIN" => "tile--sq", "INNER" => "theme-gray-2"],
        12 => ["MAIN" => "tile--h", "INNER" => "theme-dark photo-bg center"],
        13 => ["MAIN" => "tile--sq", "INNER" => "theme-gray photo-bg center"],
        14 => ["MAIN" => "tile--sq", "INNER" => "theme-dark photo-bg cover"],
        15 => ["MAIN" => "tile--sq", "INNER" => "theme-default"],
        16 => ["MAIN" => "tile--sq", "INNER" => "photo-bg cover"],
    ];

    //Получение изображений раздела
    foreach ($arResult["SECTIONS"] as $key => &$arSection) {
        if (empty($arSection["PICTURE"]))
            if ($arSection["UF_PICS"]) {
                $path = \CFile::GetPath(current($arSection["UF_PICS"]));
                if ($path) $arSection["PICTURE"] = ['SRC' => $path];
            }

    }
}
<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?

//Платные дополнения к базовой комплектации START
if ($arResult["PROPERTIES"]["DOP_COMPLECTATION"]["VALUE"]) {

    $cmplct = CIBlockElement::GetList(array(), array("IBLOCK_ID" => WF_ADDITIONAL_COMPLECT, "ID" => $arResult["PROPERTIES"]["DOP_COMPLECTATION"]["VALUE"], "ACTIVE" => "Y"), false, false, array("ID", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "PROPERTY_PRICE"));
    while ($ob_cmplct = $cmplct->Fetch()) {
        if ($ob_cmplct["PREVIEW_PICTURE"]) {
            $ob_cmplct["PHOTO"] = CFile::ResizeImageGet($ob_cmplct["PREVIEW_PICTURE"], array("width" => 65, "height" => 65), BX_RESIZE_IMAGE_EXACT, true);
        }
        if ($ob_cmplct["PROPERTY_PRICE_VALUE"]) {
            if ($ob_cmplct["PROPERTY_PRICE_VALUE"] > 0)
                $ob_cmplct["PRICE_FORMAT"] = number_format($ob_cmplct["PROPERTY_PRICE_VALUE"], 0, '', ' ');
        }
        $complects[$ob_cmplct["ID"]] = $ob_cmplct;
    }
    //Сортировка платных дополнений по тому как выбрано
    $arResult["DOP_COMPLECTATION"] = array();
    foreach ($arResult["PROPERTIES"]["DOP_COMPLECTATION"]["VALUE"] as $cmplctID) {
        foreach ($complects as $cid => $complect) {
            if ($cmplctID == $cid)
                $arResult["DOP_COMPLECTATION"][$cmplctID] = $complect;
        }
    }
}
//Платные дополнения к базовой комплектации END
//УТП START
$utp = CIBlockElement::GetList(array('sort' => 'asc'), array("IBLOCK_ID" => WF_DETAIL_UTP, "ACTIVE" => "Y"), false, false, array("ID", "NAME", "PREVIEW_TEXT", "PROPERTY_LINK", "PROPERTY_MEDIALIBRARY"));
while ($ob_utp = $utp->Fetch()) {
    if ($ob_utp["PROPERTY_MEDIALIBRARY_VALUE"]) {
        $ob_utp["GALLERY"] = WFGeneral::GetGallery($ob_utp["PROPERTY_MEDIALIBRARY_VALUE"]);
    }
    $arResult["UTP"][$ob_utp["ID"]] = $ob_utp;
}
//УТП END
//Фото START
$arResult["MERGE_PHOTOS"] = array();
if ($arResult["MORE_PHOTO"] and $arResult["DETAIL_PICTURE"]) {
    $arResult["PICTURE"]["PREVIEW"] = $arResult["DETAIL_PICTURE"];
    $arResult["MERGE_PHOTOS"] = array_merge($arResult["PICTURE"], $arResult["MORE_PHOTO"]);
}
elseif ($arResult["MORE_PHOTO"]) {
    $arResult["MERGE_PHOTOS"] = $arResult["MORE_PHOTO"];
}
elseif ($arResult["DETAIL_PICTURE"]) {
    $arResult["MERGE_PHOTOS"][] = $arResult["DETAIL_PICTURE"];
}
if (count($arResult["MERGE_PHOTOS"]) > 0) {
    foreach ($arResult["MERGE_PHOTOS"] as $pkey => $photo) {
        $curPhotoBig = CFIle::ResizeImageGet($photo["ID"], array("width" => 900, "height" => 900), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        if (!empty($photo["ALT"]))
            $curPhotoBig["ALT"] = $photo["ALT"];
        elseif (!empty($photo["DESCRIPTION"]))
            $curPhotoBig["ALT"] = $photo["DESCRIPTION"];
        if (!empty($photo["TITLE"]))
            $curPhotoBig["TITLE"] = $photo["TITLE"];
        elseif (!empty($photo["DESCRIPTION"]))
            $curPhotoBig["TITLE"] = $photo["DESCRIPTION"];
        $arResult["PHOTOS"]["BIG"][] = $curPhotoBig;
        $arResult["PHOTOS"]["SMALL"][] = CFIle::ResizeImageGet($photo["ID"], array("width" => 500, "height" => 500), BX_RESIZE_IMAGE_PROPORTIONAL, true);
    }
}
if (!empty($arResult["PHOTOS"]["BIG"]) && count($arResult["PHOTOS"]["BIG"]) < 1) {
    $arResult["PHOTOS"]["BIG"][]["src"] = SITE_TEMPLATE_PATH . "/img/no_photo.png";
    $arResult["PHOTOS"]["SMALL"][]["src"] = SITE_TEMPLATE_PATH . "/img/no_photo.png";
}
//Фото END
//Варианты окраски START
if ($arResult["IBLOCK_SECTION_ID"]) {
    $colors = CIBlockSection::GetList(array(), array("IBLOCK_ID" => $arResult["IBLOCK_ID"], "ID" => $arResult["IBLOCK_SECTION_ID"], "ACTIVE" => "Y"), false, array("IBLOCK_ID", "ID", "UF_COLORS"), false)->Fetch();

    $clrs_res = CIBlockElement::GetList(array(), array("IBLOCK_ID" => WF_COLORS, "ACTIVE" => "Y","ID"=>$colors["UF_COLORS"]), false, false, array("ID", "NAME", "PREVIEW_PICTURE", "PROPERTY_DOP_NAME"));
    while ($ob_clrs_res = $clrs_res->Fetch()) {
        if ($ob_clrs_res["PREVIEW_PICTURE"]) {
            $ob_clrs_res["PHOTO"] = CFile::ResizeImageGet($ob_clrs_res["PREVIEW_PICTURE"], array("width" => 60, "height" => 60), BX_RESIZE_IMAGE_EXACT, true);
        }
        $colors_result[$ob_clrs_res["ID"]]=$ob_clrs_res;
    }
    //Сортировка цветов по тому как выбрано
    $arResult["COLORS"] = array();
    foreach ($colors["UF_COLORS"] as $colorID) {
        foreach ($colors_result as $colid => $colorres) {
            if ($colorID == $colid)
                $arResult["COLORS"][$colorID] = $colorres;
        }
    }
}
//Варианты окраски END
?>
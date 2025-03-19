<?
class CWebflyIBElements {

   static function ClearURLAdd(&$arFields) {
        $res = CIBlock::GetByID($arFields["IBLOCK_ID"]);
        if ($ar_res = $res->Fetch())
            $iblockCode = $ar_res["CODE"];
        if ($iblockCode == WF_SEO_IBLOCK) {
            $arFields["NAME"] = trim(str_replace(array('http://', 'https://'), '', $arFields["NAME"]));
        }
    }

   static function ClearURLUpdate(&$arFields) {
        $res = CIBlock::GetByID($arFields["IBLOCK_ID"]);
        if ($ar_res = $res->Fetch())
            $iblockCode = $ar_res["CODE"];
        if ($iblockCode == WF_SEO_IBLOCK) {
            $arFields["NAME"] = trim(str_replace(array('http://', 'https://'), '', $arFields["NAME"]));
        }
    }

}
?>

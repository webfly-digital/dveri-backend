<?php
if(!$USER->IsAdmin()) return;
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/options.php");
IncludeModuleLangFile(__FILE__);
CModule::IncludeModule("webfly.utils");
$filter = Array("ACTIVE" => "Y", "GROUPS_ID" => 1);
$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter);
$adminUsers = array();
while($arUser = $rsUsers->Fetch()){
  $adminUsers[] = array("ID" => $arUser["ID"], "NAME" => "[".$arUser["ID"]."] ".$arUser["NAME"]." ".$arUser["LAST_NAME"]);
}

$arSetOptions = Array(
    array("admin_user_id", GetMessage("ADMIN_USER_TEXT"),array("list",1,$adminUsers)),
);
$aTabs = array(
    array("DIV" => "system_user", "TAB" => GetMessage("MAIN_TAB_TEXT"), "ICON" => "settings", "TITLE" => GetMessage("MAIN_TAB_TITLE_TEXT")),
    array("DIV" => "desc", "TAB" => GetMessage("DESC_TAB_TEXT"), "ICON" => "settings", "TITLE" => GetMessage("DESC_TAB_TITLE_TEXT")),
);
$tabControl = new CAdminTabControl("tabControl", $aTabs);
if($REQUEST_METHOD=="POST" && strlen($Update.$Apply.$RestoreDefaults)>0 && check_bitrix_sessid()){
    BXClearCache(true,"/webfly/utils/parameters/");
    if(strlen($RestoreDefaults)>0){
        COption::RemoveOption("webfly.utils","admin_user_id");
    }
    else{
        foreach($arSetOptions as $arOption){
            $name = $arOption[0];
            $val = $_REQUEST[$name];
            if($arOption[2][0] == "checkbox" && $val != "Y") $val = "N";
            COption::SetOptionString("webfly.utils", $name, $val, $arOption[1]);
        }
    }
    if(strlen($Update)>0 && strlen($_REQUEST["back_url_settings"])>0){
        LocalRedirect($_REQUEST["back_url_settings"]);
    }else{
        $url = $APPLICATION->GetCurPage()."?mid=".urlencode($mid)."&lang=".urlencode(LANGUAGE_ID)."&back_url_settings=".urlencode($_REQUEST["back_url_settings"])."&".$tabControl->ActiveTabParam();
        LocalRedirect($url);
    }
}
$tabControl->Begin();
?>
<form method="post" action="<?= $APPLICATION->GetCurPage()?>?mid=<?=urlencode($mid)?>&amp;lang=<?= LANGUAGE_ID?>">
    <?$tabControl->BeginNextTab();
    foreach($arSetOptions as $arOption):
        $val = COption::GetOptionString("webfly.utils", $arOption[0]);
        $type = $arOption[2];
        if($type[0] == "list") $list = $type[2];
    ?>
    <tr>
        <td valign="top" width="20%"><?= $arOption[1]?>:</td>
        <td valign="top" width="80%">
            <?switch($type[0]):
                case "checkbox":?>
                    <input type="checkbox" id="<?= htmlspecialchars($arOption[0])?>" class="adm-designed-checkbox"
                        name="<?= htmlspecialchars($arOption[0])?>" value="Y" <?=($val=="Y")?"checked":"";?>/>
                <label for="<?= htmlspecialchars($arOption[0])?>" class="adm-designed-checkbox-label"></label>
                    <?break;
                case "text":default:?>
                    <input type="text" size="<?=$type[1]?>" maxlength="255" value="<?= htmlspecialchars($val)?>"
                       name="<?= htmlspecialchars($arOption[0])?>"/>
                    <?break;
                case "number":?>
                    <input type="number" min="<?=$type[1]?>" max="<?=$type[2]?>" value="<?= $val?>" name="<?= htmlspecialchars($arOption[0])?>"/>
                    <?break;
                case "textarea":?>
                    <textarea rows="<?= $type[1]?>" cols="<?= $type[2]?>" name="<?= htmlspecialchars($arOption[0])?>">
                        <?= htmlspecialchars($val)?></textarea>
                    <?break;
                case "list":?>
                    <select size="<?=$type[1]?>" name="<?= htmlspecialchars($arOption[0])?>">
                        <?foreach($list as $item):
                            if(!is_array($item)):?>
                                <option <?=($item == $val)? "selected":"";?>><?=$item?></option>
                            <?else:?>
                                <option <?=($item["ID"] == $val)? "selected":"";?> value="<?=$item["ID"]?>"><?=$item["NAME"]?></option>
                            <?endif?>
                        <?endforeach?>
                    </select>
            <?endswitch?>
        </td>
    </tr>
    <?endforeach?>
    <?$tabControl->BeginNextTab();?>
    <p><?=GetMessage("UTILITY_DESCRIPTION")?></p>
    <?$tabControl->Buttons();?>
        <input type="submit" name="Update" value="<?=GetMessage("MAIN_SAVE")?>" title="<?=GetMessage("MAIN_OPT_SAVE_TITLE")?>">
        <input type="submit" name="Apply" value="<?=GetMessage("MAIN_OPT_APPLY")?>" title="<?=GetMessage("MAIN_OPT_APPLY_TITLE")?>">
        <?if(strlen($_REQUEST["back_url_settings"])>0):?>
            <input type="button" name="Cancel" value="<?=GetMessage("MAIN_OPT_CANCEL")?>" title="<?=GetMessage("MAIN_OPT_CANCEL_TITLE")?>" onclick="window.location='<?= htmlspecialchars(CUtil::addslashes($_REQUEST["back_url_settings"]))?>'">
            <input type="hidden" name="back_url_settings" value="<?=htmlspecialchars($_REQUEST["back_url_settings"])?>">
        <?endif?>
        <input type="submit" name="RestoreDefaults" title="<?= GetMessage("MAIN_HINT_RESTORE_DEFAULTS")?>" OnClick="return confirm('<?= AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING"))?>')" value="<?= GetMessage("MAIN_RESTORE_DEFAULTS")?>">
        <?=bitrix_sessid_post();?>
    <?$tabControl->End();?>
</form>
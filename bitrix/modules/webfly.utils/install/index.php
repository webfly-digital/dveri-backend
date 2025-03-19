<?
$LangFile = str_replace("\\", "/", __FILE__);
$LangFile = substr($LangFile, 0, strlen($LangFile) - strlen("/install/index.php"));
IncludeModuleLangFile($LangFile."/install.php");

Class webfly_utils extends CModule{
	var $MODULE_ID = "webfly.utils";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;

	function webfly_utils(){
		$arModuleVersion = array();

		$path = str_replace("\\", "/", __FILE__);
		$path = substr($path, 0, strlen($path) - strlen("/index.php"));
		include($path."/version.php");

		if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)){
			$this->MODULE_VERSION = $arModuleVersion["VERSION"];
			$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		}else{
			$this->MODULE_VERSION = "1.0.0";
			$this->MODULE_VERSION_DATE = "13-03-2015";
		}

		$this->MODULE_NAME = GetMessage("WU_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("WU_DESCRIPTION");

		$this->PARTNER_NAME = GetMessage("WU_PARTNER_NAME");
		$this->PARTNER_URI = GetMessage("WU_PARTNER_URI");
	}

	function DoInstall(){
    RegisterModule("webfly.utils");
	}

	function DoUninstall(){
    UnRegisterModule("webfly.utils");
	}
}
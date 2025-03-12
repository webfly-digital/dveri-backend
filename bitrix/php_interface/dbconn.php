<?

//error_reporting(E_ALL ^ E_NOTICE);
//ini_set("display_errors", 1);

define("DBPersistent", false);
$DBType = "mysql";
$DBHost = "localhost";
$DBLogin = "u0402568_default";
$DBPassword = "FYeyPX6_";
$DBName = "u0402568_default";
$DBDebug = false;
$DBDebugToFile = false;
define("MYSQL_TABLE_TYPE", "INNODB");

@set_time_limit(60);

define("DELAY_DB_CONNECT", true);
define("CACHED_b_file", 3600);
define("CACHED_b_file_bucket_size", 10);
define("CACHED_b_lang", 3600);
define("CACHED_b_option", 3600);
define("CACHED_b_lang_domain", 3600);
define("CACHED_b_site_template", 3600);
define("CACHED_b_event", 3600);
define("CACHED_b_agent", 3660);
define("CACHED_menu", 3600);

define("BX_USE_MYSQLI", true);
define("BX_UTF", true);
define("BX_FILE_PERMISSIONS", 0666);
define("BX_DIR_PERMISSIONS", 0777);
@umask(~BX_DIR_PERMISSIONS);
define("BX_DISABLE_INDEX_PAGE", true);


?>
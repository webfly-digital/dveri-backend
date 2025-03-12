<?
$DB->Query("SET NAMES 'utf8'");
$DB->Query('SET collation_connection = "utf8_unicode_ci"');
$DB->Query('SET collation_database = "utf8_unicode_ci"');
$DB->Query('SET collation_server = "utf8_unicode_ci"');
$DB->Query("SET innodb_strict_mode=0");
$DB->Query("SET sql_mode=''");
?>
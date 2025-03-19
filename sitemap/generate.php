<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('iblock');

global $USER;
if (!$USER->isAdmin()) die();
$res = CIBlockElement::GetList([], ['IBLOCK_CODE' => 'webfly_cities'], false, false, ['ID', 'NAME', 'PROPERTY_WF_SUBDOMAIN']);

$f = scandir($_SERVER['DOCUMENT_ROOT']);
foreach ($f as $file) {
    if (preg_match('/\.(xml)/', $file)) { // Выводим только .png
        $pos = strpos($file, 'sitemap');
        if ($pos !== false) {
            $fc = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/' . $file);
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/sitemap/default/' . $file, $fc);
        }
    }
}

while ($el = $res->fetch()) {

    if (!empty($el["PROPERTY_WF_SUBDOMAIN_VALUE"])) {
        @mkdir($_SERVER["DOCUMENT_ROOT"] . "/sitemap/" . $el["PROPERTY_WF_SUBDOMAIN_VALUE"]);

        $subdomain = $el["PROPERTY_WF_SUBDOMAIN_VALUE"];
        foreach (new DirectoryIterator('default') as $fileInfo) {

            if ($fileInfo->isDot()) continue;
            $fileName = $fileInfo->getFilename();
            $fc = file_get_contents('default/' . $fileName);
            if ($fileName == 'sitemap.xml')
                $fcReplaced = str_replace(['https://1dvm.ru/'], ["https://$subdomain.1dvm.ru/sitemap/$subdomain/"], $fc);
            else
                $fcReplaced = str_replace(['https://1dvm.ru/'], ["https://$subdomain.1dvm.ru/"], $fc);
            file_put_contents($subdomain . '/' . $fileName, $fcReplaced);

        }
        $hta .= "RewriteCond  %{HTTP_HOST} $subdomain.1dvm.ru$" . PHP_EOL
            . "RewriteRule ^sitemap.xml$ /sitemap/$subdomain/sitemap.xml [L]" . PHP_EOL;
    }
}
file_put_contents('.htaccess.txt', $hta);

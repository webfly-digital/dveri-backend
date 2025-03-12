<?
$eventManager = \Bitrix\Main\EventManager::getInstance();

// удяляем скрипты ядра при отдаче сайта пользователям
$eventManager->addEventHandler("main", "OnEndBufferContent", "deleteKernelJs");

// удяляем css ядра при отдаче сайта пользователям
$eventManager->addEventHandler("main", "OnEndBufferContent", "deleteKernelCss");
// удяляем скрипты ядра при отдаче сайта пользователям
function deleteKernelJs(&$content) {
    global $USER, $APPLICATION;
    if((is_object($USER) && $USER->IsAuthorized()) || strpos($APPLICATION->GetCurDir(), "/bitrix/")!==false) return;
    if($APPLICATION->GetProperty("save_kernel") == "Y") return;

    $arPatternsToRemove = Array(
        '/<script.+?src=".+?kernel_main\/kernel_main_v1\.js\?\d+"><\/script\>/',
    );

    $content = preg_replace($arPatternsToRemove, "", $content);
    $content = preg_replace("/\n{2,}/", "\n\n", $content);
}

// удяляем css ядра при отдаче сайта пользователям
function deleteKernelCss(&$content) {
    global $USER, $APPLICATION;
    if((is_object($USER) && $USER->IsAuthorized()) || strpos($APPLICATION->GetCurDir(), "/bitrix/")!==false) return;
    if($APPLICATION->GetProperty("save_kernel") == "Y") return;

    $arPatternsToRemove = Array(
        '/<link.+?href=".+?kernel_main\/kernel_main\.css\?\d+"[^>]+>/',
        '/<link.+?href=".+?bitrix\/js\/main\/core\/css\/core[^"]+"[^>]+>/',
        '/<link.+?href=".+?bitrix\/templates\/[\w\d_-]+\/styles.css[^"]+"[^>]+>/',
        '/<link.+?href=".+?bitrix\/templates\/[\w\d_-]+\/template_styles.css[^"]+"[^>]+>/',
    );

    $content = preg_replace($arPatternsToRemove, "", $content);
    $content = preg_replace("/\n{2,}/", "\n\n", $content);
}
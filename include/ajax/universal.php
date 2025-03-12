<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php"); ?>
<?
$valid = (($_POST["ajaxm"] == "Y") and check_bitrix_sessid());
$name = htmlentities($_POST['name']);
$email = htmlentities($_POST['email']);
$phone = htmlentities($_POST['phone']);
$comment = htmlentities($_POST['comment']);
$ordername = htmlentities($_POST['ordername']);
$site = $_SERVER['HTTP_HOST'];
if($valid) {
?>
<?
$APPLICATION->IncludeComponent(
    "webfly:message.add", "universal", array(
  "OK_TEXT" => GetMessage("WF_OK_TEXT"),
  "EMAIL_TO" => "",
  "IBLOCK_TYPE" => "feedback",
  "IBLOCK_ID" => "19",
  "EVENT_MESSAGE_ID" => array(
    0 => "11",
  ),
  "CACHE_TYPE" => "A",
  "CACHE_TIME" => "36000000",
  "SET_TITLE" => "N",
  "COMPONENT_TEMPLATE" => "universal"
    ), false, array(
  "HIDE_ICONS" => "N"
    )
);?>
<?
// Параметры подключения к вашему облачному Битрикс24
define('CRM_HOST', 'dverim.bitrix24.ru'); // укажите здесь ваш домен в Битрикс
define('CRM_PORT', '443'); // порт для подключения. Здесь оставляем все как есть
define('CRM_PATH', '/crm/configs/import/lead.php'); // Путь к PHP файлу, к которому будем подлючаться. Здесь оставляем все как есть
// // Параметры авторизации
define('CRM_LOGIN', 'head@webfly.ru'); // логин пользователя, которого мы создали для подключения
define('CRM_PASSWORD', 'SaM612505'); // пароль пользователя CRM


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $leadData = $_POST['DATA']; // представляем массив
        $postData = array(
            'TITLE' => $ordername." - ". $name,
            'NAME' => $name,
            'EMAIL_WORK' => $email,
            'PHONE_MOBILE' => $phone,
            'ASSIGNED_BY_ID' => '3216',
            'SOURCE_ID' => 'WEB',
            'COMMENTS' => "Сайт: $site<br/>Форма: $ordername<br/>Имя: $name<br/>Телефон: $phone<br/>E-mail: $email<br/>Дата: ".date("d.m.Y H:i")."<br/><br/>Комментарий: $comment"
        );

        // добавляем в массив параметры авторизации
        if (defined('CRM_AUTH')) {
            $postData['AUTH'] = CRM_AUTH;
        } else {
            $postData['LOGIN'] = CRM_LOGIN;
            $postData['PASSWORD'] = CRM_PASSWORD;
        }

        // открываем сокет соединения к облачной CRM
        $fp = fsockopen("ssl://".CRM_HOST, CRM_PORT, $errno, $errstr, 30);
        if ($fp) {
            // производим URL-кодирование строки
            $strPostData = '';
            foreach ($postData as $key => $value) {
                $strPostData .= ($strPostData == '' ? '' : '&').$key.'='.urlencode($value);
            }
            // подготавливаем заголовки
            $str = "POST ".CRM_PATH." HTTP/1.0\r\n";
            $str .= "Host: ".CRM_HOST."\r\n";
            $str .= "Content-Type: application/x-www-form-urlencoded\r\n";
            $str .= "Content-Length: ".strlen($strPostData)."\r\n";
            $str .= "Connection: close\r\n\r\n";
            $str .= $strPostData;
            fwrite($fp, $str);
            $result = ''; while (!feof($fp)) {
                $result .= fgets($fp, 128);
            }
            fclose($fp);
            $response = explode("\r\n\r\n", $result);
            $output = '
    '.print_r($response[1], 1).'
    ';
        } else {
            echo 'Не удалось подключиться к CRM '.$errstr.' ('.$errno.')';
        }
    } else {
    }
    //echo "<pre>";
    //var_dump( $output );
    //echo "</pre>";
}
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
?>
<?

if ($_FILES['file-0'])
{




$rsSites = CSite::GetByID("s1");
$arSite = $rsSites->Fetch();
/*$mail_to = $arSite["EMAIL"];

    $arEventFields = array(
    "AUTHOR"                  => htmlspecialcharsEx($_REQUEST['user_name']),
    "AUTHOR_EMAIL"             => htmlspecialcharsEx($_REQUEST['user_email']),
    "TEXT"            => htmlspecialcharsEx($_REQUEST['MESSAGE']),
    "SUBJECT"            =>SITE_NAME.": Уведомление о заказе звонка",
    "EMAIL_TO"         => "henly@mail.ru"
    );
if (CModule::IncludeModule("main")):
   if (CEvent::Send("FEEDBACK_FORM", "s1", $arEventFields)):
      echo "ok";
   endif;
endif;

 */
$mailTo = $arSite["EMAIL"];
$mailFrom = $arSite["EMAIL"];
$mailFromName = $arSite['NAME'];
$mailSubject = $arSite['NAME']." - новое резюме";
$mailMessage = "Здравствуйте,

К вам поступила новое резюме на вакансию: ".mb_convert_encoding($_POST['theme'],'UTF-8','windows-1251')."

------------------------------------------


Перейти на портал: http://".$_SERVER["HTTP_HOST"]."
";
$mailCharset = "UTF-8";
function xmail( $from, $to, $subj, $text, $filename) {

$f         = fopen($filename['tmp_name'],"rb");
$un        = strtoupper(uniqid(time()));
$head      = "From: $from\n";
$head     .= "To: $to\n";
$head     .= "Subject: $subj\n";
$head     .= "X-Mailer: PHPMail Tool\n";
$head     .= "Reply-To: $from\n";
$head     .= "Mime-Version: 1.0\n";
$head     .= "Content-Type:multipart/mixed;";
$head     .= "boundary=\"----------".$un."\"\n\n";
$zag       = "------------".$un."\nContent-Type:text/html;\n";
$zag      .= "Content-Transfer-Encoding: 8bit\n\n$text\n\n";
$zag      .= "------------".$un."\n";
$zag      .= "Content-Type: application/octet-stream;";
$zag      .= "name=\"".basename($filename['name'])."\"\n";
$zag      .= "Content-Transfer-Encoding:base64\n";
$zag      .= "Content-Disposition:attachment;";
$zag      .= "filename=\"".basename($filename['name'])."\"\n\n";
$zag      .= chunk_split(base64_encode(fread($f,filesize($filename['tmp_name']))))."\n";

return @mail("$to", "$subj", $zag, $head, "-f ".$from);
}
$s=xmail($mailFrom,$mailTo, $mailSubject, $mailMessage,$_FILES['file-0']);


exit('<b style="font-size:15px">Спасибо. Мы вам скоро перезвоним.</b>');

//exit(mb_convert_encoding('<b style="font-size:15px">Спасибо. Мы вам скоро перезвоним.</b>','windows-1251','UTF-8'));
}

?>
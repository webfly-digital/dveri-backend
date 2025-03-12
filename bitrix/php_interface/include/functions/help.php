<?
function wf_ucfirst($str) {
    $fc = mb_strtoupper(mb_substr($str, 0, 1));
    return $fc . mb_substr($str, 1);
}

function wf_curdir() {
    global $APPLICATION;
    $dir = $APPLICATION->GetCurDir();
    $dirExplode = explode("/", $dir);

    $dirExplode = array_filter(
        $dirExplode, function($el) {
        return !empty($el);
    }
    );
    $countDir = count($dirExplode);
    $dirInfo = array("CHAIN"=>$dirExplode, "DIR"=>$dir, "COUNT"=>$countDir);
    return $dirInfo;
}

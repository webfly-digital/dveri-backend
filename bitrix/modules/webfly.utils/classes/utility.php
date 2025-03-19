<?
class CWebflyUtility {
    /**
     * Rebuild array
     * @param array $array array disrupted by unset
     * @return array reconstructed array
     * @version 0.1
     * @author aga <dev@webfly.pro>
     */
    public static function refreshArray($array) {
        $new = array();
        foreach ($array as $value) {
            $new[] = $value;
        }
        return $new;
    }
    public static function getFirstElement($array){
        if(empty($array)) return false;
        $array = array_reverse($array);
        return array_pop($array);
    }
    /**
     * Upgraded var_dump
     * @global object $USER CUser object
     * @param mixed $var variable to dump
     * @param boolean $die die() if true
     * @param boolean $all show to all
     * @return boolean
     * @version 0.2
     * @author aga <dev@webfly.pro>
     */
    public static function dump($var, $die = false, $all = false) {
        global $USER;
        $utilityUserId = COption::GetOptionString("webfly.utils", "admin_user_id");
        if ($USER->GetID() != $utilityUserId and ! $all)
            return false;
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
        if ($die)
            die("end!");
    }
    /**
     * Shows all php errors
     * @version 0.1
     * @author aga <dev@webfly.pro>
     */
    public static function showErrors() {
        error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
        ini_set("display_errors", 1);
    }
    /**
     * Пользовователь требуемого типа
     * @global object $USER объект CUser
     * @param int $userID индекс пользователя
     * @return boolean
     */
    public static function isUserID($userID = 1) {
        global $USER;
        if ($USER->GetID() != $userID)
            return false;
        else
            return true;
    }
    /**
     * Parses CSV to an array
     * @param string $path path to csv
     * @return array
     */
    public static function parseCSVToArray($path) {
        $CSV = array();
        if (($handle = fopen($path, "r")) !== false) {
            while (($data = fgetcsv($handle, 400, ";")) !== false) {
                $CSV[] = $data;
            }
            fclose($handle);
        }
        return $CSV;
    }
    /**
     * Strict version of in_array()
     * @param string $needle needle
     * @param array $haystack haystack
     * @return boolean result of checking
     */
    public static function inArray($needle, $haystack) {
        foreach ($haystack as $item) {
            if ($item === $needle)
                return true;
        }
        return false;
    }
    /**
     * Creates noded tree version from array
     * @param array $array initail array
     * @return array resulting array
     */
    public static function makeTree($array) {
        $newArray = array();
        if (!empty($array)) {
            foreach ($array as $arr) {
                $newArray[$arr["ID"]] = $arr;
            }
        }
        return $newArray;
    }
    /**
     * Creates noded tree version from array with property as node
     * @param array $array initial array
     * @param string $property as name suggests
     * @return array result
     */
    public static function makeTreeEx($array, $property) {
        $newArray = array();
        if (!empty($array)) {
            foreach ($array as $arr) {
                $newArray[$arr[$property]] = $arr;
            }
        }
        return $newArray;
    }
    /**
     * Checks if file is image
     * @param string $fileName as name suggests
     * @return boolean result
     */
    public static function isImage($fileName) {
        $fileName = explode(".", $fileName);
        $count = count($fileName);
        $lastPart = $fileName[$count - 1];
        if (in_array($lastPart, array("jpg", "png", "gif")))
            return true;
        return false;
    }
}

class CWebflyHTML {
    public static function paragraph($params) {
        $p = '<p';
        foreach ($params["attr"] as $key => $attr) {
            $p .= ' ' . $key . '="' . $attr . '"';
        }
        $p .= '>' . $params["text"] . '</p>';
        return $p;
    }
    public static function heading($params){
        $h = '<h'.$params["int"];
        foreach ($params["attr"] as $key => $attr) {
            $h .= ' ' . $key . '="' . $attr . '"';
        }
        $h .= '>' . $params["text"] . '</h'.$params["int"].'>';
        return $h;
    }
    public static function input($params) {
        $input = '<input';
        foreach ($params["attr"] as $key => $attr) {
            $input .= ' ' . $key . '="' . $attr . '"';
        }
        $input .= '/>';
        return $input;
    }
    public static function select($params) {
        $select = '<select';
        foreach ($params["attr"] as $key => $attr) {
            $select .= ' ' . $key . '="' . $attr . '"';
        }
        $select .= '>';
        if (!empty($params["options"])) {
            foreach ($params["options"] as $option) {
                $select .= '<option value="' . $option["value"] . '">' . $option["text"] . '</option>';
            }
        }
        $select .= '</select>';
        return $select;
    }
    public static function anchor($params) {
        $anchor = '<a';
        foreach ($params["attr"] as $key => $attr) {
            $anchor .= ' ' . $key . '="' . $attr . '"';
        }
        $anchor .= '>' . $params["text"] . '</p>';
        return $anchor;
    }
}
?>
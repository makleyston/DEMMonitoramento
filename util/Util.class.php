<?php
ob_start();

class Util {

    private $root = "http://localhost/DEMMonitoramento/";

    function __construct() {

    }

    public function getRoot() {
        return $this->root;
    }

    function redirectPage($url, $time = 0) {
        $url = str_replace('&amp;', '&', $url);

        if ($time > 0) {
            header("Refresh: $time; URL=$url");
        } else {
            //@ob_flush();
           // @ob_end_clean();
            header("Location: " . $url);
            exit;
        }
    }
//'Ã ', 'Ã¡', 'Ã¢', 'Ã£', 'Ã¤', 'Ã¥', 'Ã§', 'Ã¨', 'Ã©', 'Ãª', 'Ã«', 'Ã¬', 'Ã­', 'Ã®', 'Ã¯', 'Ã±', 'Ã²', 'Ã³', 'Ã´', 'Ãµ', 'Ã¶', 'Ã¹', 'Ã¼', 'Ãº', 'Ã¿', 'Ã€', 'Ã', 'Ã‚', 'Ãƒ', 'Ã„', 'Ã…', 'Ã‡', 'Ãˆ', 'Ã‰', 'ÃŠ', 'Ã‹', 'ÃŒ', 'Ã', 'ÃŽ', 'Ã', 'Ã‘', 'Ã’', 'Ã“', 'Ã”', 'Ã•', 'Ã–', 'O', 'Ã™', 'Ãœ', 'Ãš', 'Å¸'
    public function removeAccent($texto) {
        $trocarIsso = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú', 'Ÿ',);
        $porIsso =    array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'Y',);
        $titletext = str_replace($trocarIsso, $porIsso, $texto);
        return $titletext;
    }

    public function prepareLink($text) {
        $link = $this->removeAccent(strtolower($text));
        $link = str_replace(" ", "-", $link);
        $link = str_replace("/", "-", $link);
        return $link;
    }

    public function my_file_get_contents($site_url) {
        $ch = curl_init();
        $timeout = 10;
        curl_setopt($ch, CURLOPT_URL, $site_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $file_contents = curl_exec($ch);
        curl_close($ch);
        return $file_contents;
    }

}

?>

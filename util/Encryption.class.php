<?php
/**
 * Description of Encryption
 *
 * @author Klismark
 */
final class Encryption {

    static $pass = "k98876534k";
    private static $encryption;

    private function __construct() {
        
    }

    private function __clone() {
        
    }

    public static function getInstaceOf() {
        if (!isset(self::$encryption)) {
            self::$encryption = new self;
        }
        return self::$encryption;
    }

    
    /**
     * @author Klismark
     * @param $text, Texto a ser criptografado
     * @return Retorna o texto criptografado
     * Função responsável por criptografar algum texto
     */
    public static function encode($text) {//Texto        
        return str_replace("=", "", strrev(base64_encode(strrev(str_replace("=", "", base64_encode(strrev($text)))))));
    }

    
    /**
     * @author Klismark
     * @param $text, Texto a ser descriptografado
     * @return Retorna o texto descriptografado
     * Função responsável por descriptografar algum texto
     */
    public static function decode($text) {

        return strrev(
                base64_decode(
                        strrev(
                                base64_decode(
                                        strrev($text)
        ))));
    }

}

?>

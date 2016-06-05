<?php

/**
 * Description of AutoLoader
 *
 * @author Makleyston
 */
class AutoLoader {

    private static $instance;
    private static $root;

    public static function init($root) {
        self::$root = $root;
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
        return self::$instance;
    }

    private function __construct() {
        spl_autoload_register(array($this, "autoLoadModel"));
        spl_autoload_register(array($this, "autoLoadUtil"));
        spl_autoload_register(array($this, "autoLoadManager"));
        spl_autoload_register(array($this, "autoLoadExceptions"));
        spl_autoload_register(array($this, "autoLoadDao"));
        spl_autoload_register(array($this, "autoLoadConnection"));
    }

    private function autoLoadUtil($className) {
        $filename = self::$root . "util/" . $className . ".class.php";
        if (is_readable($filename)) {
            require_once $filename;
        }
    }

    private function autoLoadModel($className) {
        $filename = self::$root . "model/VO/" . $className . ".class.php";
        if (is_readable($filename)) {
            require_once $filename;
        }
    }

    private function autoLoadManager($className) {
        $filename = self::$root . "controller/manager/" . $className . ".class.php";
        if (is_readable($filename)) {
            require_once $filename;
        }
    }

    private function autoLoadDao($className) {
        $filename = self::$root . "model/DAO/" . $className . ".class.php";
        if (is_readable($filename)) {
            require_once $filename;
        }
    }

    private function autoLoadConnection($className) {
        $filename = self::$root . "controller/connection/" . $className . ".class.php";
        if (is_readable($filename)) {
            require_once $filename;
        }
    }

    private function autoLoadExceptions($className) {
        $filename = self::$root . "exceptions/" . $className . ".class.php";
        if (is_readable($filename)) {
            require_once $filename;
        }
    }

}

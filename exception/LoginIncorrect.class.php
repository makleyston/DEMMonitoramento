<?php

/**
 * Description of LoginIncorrect
 *
 * @author Klismark
 */
class LoginIncorrect extends Exception {

    function __construct($code = 0, $message = "", $previous = null) {
        parent::__construct($message);
    }

}

<?php
/**
 * Description of LoginIncorrect
 *
 * @author Makleyston
 */
class FieldRequireds extends Exception {

    function __construct($code = 0, $message = "", $previous = null) {		
        parent::__construct($message, $code);
    }
    
}

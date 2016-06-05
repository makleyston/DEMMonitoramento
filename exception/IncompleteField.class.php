<?php

class IncompleteField extends Exception{
    function __construct($code = 0, $message = "", $previous = null) {
        parent::__construct("Preencha corretamente os campos!");
    }
}
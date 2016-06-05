<?php

class User {

    private $id;
    private $name;
    private $login;
    private $password;

    function __construct($id, $nmUser) {
        $this->id = $id;
        $this->name = $nmUser;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getLogin() {
        return $this->login;
    }

    function getPassword() {
        return $this->password;
    }
	
    function setId($id) {
        $this->id = $id;
    }

    function setName($nmUser) {
        $this->name = $nmUser;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setPassword($password) {
        $this->password = $password;
    }

}


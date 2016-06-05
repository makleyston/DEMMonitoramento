<?php

class ManagerUser extends Manager {

    private $data;
    private $dao;

    function __construct($data) {
        $this->data = $data;
        $this->dao = new UserDAO();
    }

    public function delete() {
        $id = $this->data['id'];
        if ($this->dao->delete($id)) {
            return 1;
        }
    }

    public function sign() {
        $result = $this->verifyData();
        if ($result) {
            $nmUser = $this->data['name-user'];
            $login = $this->data['login-user'];
            $pass = $this->data['pass-user'];
            
            $user = new User("", $nmUser);
            $user->setLogin($login);
            $user->setPassword(Encryption::encode($pass));
            if ($this->dao->insert($user)) {
                return 1;
            }
        } else {
            throw new FieldRequireds();
        }
    }

    public function update() {
        $result = $this->verifyData();
        if ($result) {
            if (!isset($this->data['pass-user'])) {
                $pass = Encryption::decode($this->data['oldPass']);
            }else{
                $pass = $this->data['pass-user'];
            }
            $id = $this->data['idUser'];
            $nmUser = $this->data['name-user'];
            $login = $this->data['login-user'];
			
            $user = new User(Encryption::decode($id), $nmUser);
            $user->setLogin($login);
            $user->setPassword(Encryption::encode($pass));
            if ($this->dao->update($user)) {
                return 1;
            }
        } else {
            throw new FieldRequireds();
        }
    }

    public function login() {
        $login = $this->data['user-login'];
        $pass = Encryption::encode($this->data['pass-login']);

        if (strlen($pass) < 6) {
            throw new LoginIncorrect();
        }

        $user = new User("", "");
        $user->setLogin($login);
        $user->setPassword($pass);
        $us = $this->dao->login($user);

        if ($us === false) {
            throw new LoginIncorrect();
        } else {
            //Loga o usuário
            $_SESSION['s_login'] = Encryption::encode($us->getLogin());
            return 1;
        }
    }

    private function verifyData() {
        if (strlen($this->data['name-user']) < 3) {
            return false;
        }
        if (strlen($this->data['login-user']) < 3) {
            return false;
        }
        if (isset($this->data['pass-user'])) {
			if (strlen($this->data['pass-user']) < 6) {
				throw new IncompleteField;
			}else if($this->data['pass-user'] != $this->data['re-pass-user']){
				throw new Exception("Repita sua senha novamente.");
			}
        }
        return true;
    }

}

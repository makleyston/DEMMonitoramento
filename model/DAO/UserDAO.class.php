<?php

class UserDAO extends DAO {
    
    public function __construct() {
        parent::connect();
    }
    
    public function delete($idUser) {
        $q = parent::prepare("UPDATE tb_user SET isActive = 0 WHERE idUser = :idUser");
        $id = Encryption::decode($idUser);
        $q->bindParam("idUser", $id);
        $q->execute() or die(parent::printError($q->errorInfo()));
        $this->parent = null;
        return true;
    }

    public function insert($user) {
        $q = parent::prepare("INSERT INTO tb_user(nmUser, Password, Login) VALUES (
                              :nmUsuario, :Password, :Login)");
        
        $nmUser = $user->getName();
        $pass = $user->getPassword();
        $login = $user->getLogin();

        $q->bindParam(":nmUser", $nmUser);
        $q->bindParam(":Password", $pass);
        $q->bindParam(":Login", $login);

        $q->execute() or die(parent::printError($q->errorInfo()));
        $this->parent = null;
        return true;
    }

    public function update($user) {
        $q = parent::prepare("UPDATE tb_user SET nmUsser = :nmUser, 
                             Password = :Password, Login = :Login
                             WHERE idUser = :idUser");
        
        $idUser = $user->getId();
        $nmUser = $user->getName();
        $password = $user->getPassword();
        $login = $user->getLogin();
        
        $q->bindParam(":nmUser", $nmUser);
        $q->bindParam(":Password", $password);
        $q->bindParam(":Login", $login);
        $q->bindParam(":idUser", $idUser);
        $q->execute() or die(parent::printError($q->errorInfo()));
        $this->parent = null;
        return true;
    }

    public function read($user) {
        $q = parent::prepare("SELECT us.* FROM TB_Usuario AS us WHERE idUsuario = :id");
        $id = $user->getId();
        $q->bindParam(":id", $id);
        $q->execute() or die(parent::printError($q->errorInfo()));
        $reg = $q->fetch();
        $this->parent = null;

        if (!$reg) {
            return false;
        }
        $user = new User($reg['idUsuario'], $reg['nmUsuario']);
        $user->setLogin($reg['Login']);
        $user->setPassword($reg['Senha']);
		$user->setAccess(array(
			"cities"=>$reg['acessoCidades'],
			"categories"=>$reg['acessoCategorias'],
			"establishments"=>$reg['acessoEstabelecimentos'],
			"users"=>$reg['acessoUsuarios'],
			"sync"=>$reg['acessoSincronismo'],
		));
        return $user;
    }

    public function search($search, $init = 0, $end = 0) {
        $limit = "";
        if ($init != 0 && $end == 0) {
            $limit = "LIMIT " . $init;
        } else if ($init != 0 && $end != 0 || $init == 0 && $end != 0) {
            $limit = "LIMIT " . $init . "," . $end;
        }
        $q = parent::prepare("SELECT us.* FROM tb_user AS us WHERE nmUser LIKE '%" . $search . "%' AND isActive = 1 " . $limit);
        $q->execute() or die(parent::printError($q->errorInfo()));
        $r = $q->fetchAll();
        $this->parent = null;

        if (!$r) {
            return false;
        }
        $users = array();
        foreach ($r as $reg) {
            $user = new User($reg['idUser'], $reg['nmUser']);
            $user->setLogin($reg['Login']);
            $user->setPassword($reg['Password']);			
            $users[] = $user;
        }
        return $users;
    }

    public function readAll($init = 0, $end = 0) {
        $limit = "";
        if ($init != 0 && $end == 0) {
            $limit = "LIMIT " . $init;
        } else if ($init != 0 && $end != 0 || $init == 0 && $end != 0) {
            $limit = "LIMIT " . $init . "," . $end;
        }
        $q = parent::prepare("SELECT us.* FROM tb_user AS us WHERE isActive = 1 " . $limit);
        $q->execute() or die(parent::printError($q->errorInfo()));
        $r = $q->fetchAll();
        $this->parent = null;

        if (!$r) {
            return false;
        }
        $users = array();
        foreach ($r as $reg) {
            $user = new User($reg['idUser'], $reg['nmUser']);
            $user->setLogin($reg['Login']);
            $user->setPassword($reg['Password']);
            $users[] = $user;
        }
        return $users;
    }

    public function readByLogin($user) {
        $q = parent::prepare("SELECT us.* FROM tb_user AS us WHERE Login = :login");
        $login = $user->getLogin();
        $q->bindParam(":login", $login);
        $q->execute() or die(parent::printError($q->errorInfo()));
        $reg = $q->fetch();
        $this->parent = null;

        if (!$reg) {
            return false;
        }
        $user = new User($reg['idUser'], $reg['nmUser']);
        $user->setLogin($reg['Login']);
        $user->setPassword($reg['Password']);
        return $user;
    }

    public function login($user) {
        $q = parent::prepare("SELECT us.* FROM tb_user AS us WHERE Login = :login "
                        . "AND Password = :password AND isActive = 1");
        $login = $user->getLogin();
        $pass = $user->getPassword();
        $q->bindParam(":login", $login);
        $q->bindParam(":password", $pass);
        $q->execute() or die(parent::printError($q->errorInfo()));
        $reg = $q->fetch();
        $this->parent = null;
        if (!$reg) {
            return false;
        }

        $user = new User($reg['idUser'], $reg['nmUser']);
        $user->setLogin($reg['Login']);
        $user->setPassword($reg['Password']);
		
        return $user;
    }

}

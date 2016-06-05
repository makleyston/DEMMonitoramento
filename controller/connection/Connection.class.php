<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of connection
 *
 * @author makleyston
 */

class Connection extends PDO {

    //put your code here
    private $host = "127.0.0.1";//"clikped.com.br";
    private $bd = "demmonitoramento_db";
    private $usuario = "root";
    private $senha = "";
    protected $con = null;

    function __construct() {        
        
    }
    
    protected function connect(){
        $con = parent::__construct('mysql:host=' . $this->host . ';port=3306;dbname=' . $this->bd, $this->usuario, $this->senha);
    }
    
    public function printError($error) {
        return "Erro: ".$error[1]."<br>".$error[2];
    }

    public static function closeConnection() {
        $con = null;
    }

}

?>


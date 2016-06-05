<?php
//include '../../controller/connection/Connection.class.php';
abstract class DAO extends Connection {

    public abstract function insert($object);

    public abstract function update($object);

    public abstract function delete($object);
    
    public abstract function read($object);
}

?>

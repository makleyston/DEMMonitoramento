<?php

/**
 * Description of DeviceDAO
 *
 * @author Klismark
 */
class DeviceDAO extends DAO {
    
    public function __construct() {
        parent::connect();
    }

    public function delete($object) {
        
    }

    public function insert($device) {
        $q = parent::prepare("INSERT INTO tb_dispositivo (`VersionSO`,
                            `Storage`,
                            `CPU`,
                            `ProcessorMake`,
                            `CPUCore`) 
                             VALUES (
                             :storage,
                             :CPU,
                             :processor,
                             :CPUCore)");
        $q->bindParam(":storage", $device->getStorage());
        $q->bindParam(":CPU", $device->getCPU());
        $q->bindParam(":processor", $device->getProcessor());
        $q->bindParam(":CPUCore", $device->getCPUCore());
        $q->execute() or die(parent::printError($q->errorInfo()));
        $this->parent = null;
    }

    public function read($object) {
        
    }

    public function update($object) {
        
    }

}

<?php

/**
 * Description of Device
 *
 * @author makleyston
 */
class Device {
    private $idDevice;
    private $version;
    private $storage;
    private $CPU;
    private $processor;
    private $CPUCore;
    private $location; //Array of Object of the type HistoryDevice
    private $information;
    
    function __construct($idDevice) {
        $this->idDevice = $idDevice;
    }

    function getIdDevice() {
        return $this->idDevice;
    }

    function getVersion() {
        return $this->version;
    }

    function getStorage() {
        return $this->storage;
    }

    function getCPU() {
        return $this->CPU;
    }

    function getProcessor() {
        return $this->processor;
    }

    function getCPUCore() {
        return $this->CPUCore;
    }

    function getLocation() {
        return $this->location;
    }

    function getInformation() {
        return $this->information;
    }

    function setIdDevice($idDevice) {
        $this->idDevice = $idDevice;
    }

    function setVersion($version) {
        $this->version = $version;
    }

    function setStorage($storage) {
        $this->storage = $storage;
    }

    function setCPU($CPU) {
        $this->CPU = $CPU;
    }

    function setProcessor($processor) {
        $this->processor = $processor;
    }

    function setCPUCore($CPUCore) {
        $this->CPUCore = $CPUCore;
    }

    function setLocation($location) {
        $this->location = $location;
    }

    function setInformation($information) {
        $this->information = $information;
    }

}

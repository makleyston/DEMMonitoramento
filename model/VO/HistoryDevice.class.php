<?php

/**
 * Description of HistoryDevice
 *
 * @author makleyston
 */
class HistoryDevice {
    private $idHistoryDevice;
    private $latitude;
    private $longitude;
    private $dthrLocation;
    
    function __construct($idHistoryDevice, $latitude, $longitude, $dthrLocation) {
        $this->idHistoryDevice = $idHistoryDevice;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->dthrLocation = $dthrLocation;
    }

    function getIdHistoryDevice() {
        return $this->idHistoryDevice;
    }

    function getLatitude() {
        return $this->latitude;
    }

    function getLongitude() {
        return $this->longitude;
    }

    function getDthrLocation() {
        return $this->dthrLocation;
    }

    function setIdHistoryDevice($idHistoryDevice) {
        $this->idHistoryDevice = $idHistoryDevice;
    }

    function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    function setDthrLocation($dthrLocation) {
        $this->dthrLocation = $dthrLocation;
    }
    
}

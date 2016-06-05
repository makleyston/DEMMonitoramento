<?php

/**
 * Description of Fleet
 *
 * @author makleyston
 */
class Fleet {
    private $idFleet;
    private $bus; //Array of Objetcts Bus: all bus of fleet
    private $nmFleet;
    private $nmRouter; //Object Router
    
    function __construct() {
        
    }
    
    function getIdFleet() {
        return $this->idFleet;
    }

    function getBus() {
        return $this->bus;
    }

    function getNmFleet() {
        return $this->nmFleet;
    }

    function setIdFleet($idFleet) {
        $this->idFleet = $idFleet;
    }

    function setBus($bus) {
        $this->bus = $bus;
    }

    function setNmFleet($nmFleet) {
        $this->nmFleet = $nmFleet;
    }

    function getNmRouter() {
        return $this->nmRouter;
    }

    function setNmRouter($nmRouter) {
        $this->nmRouter = $nmRouter;
    }
    
}

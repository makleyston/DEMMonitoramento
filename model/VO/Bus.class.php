<?php

/**
 * Description of Bus
 *
 * @author makleyston
 */
class Bus {
    private $idBus;
    private $numberBus;
    private $fleet; //Object Fleet
    private $router; //Objeto Router
    
    function __construct($numberBus) {
        $this->numberBus = $numberBus;
    }

    function getIdBus() {
        return $this->idBus;
    }

    function getNumberBus() {
        return $this->numberBus;
    }

    function getFleet() {
        return $this->fleet;
    }

    function getRouter() {
        return $this->router;
    }

    function setIdBus($idBus) {
        $this->idBus = $idBus;
    }

    function setNumberBus($numberBus) {
        $this->numberBus = $numberBus;
    }

    function setFleet($fleet) {
        $this->fleet = $fleet;
    }

    function setRouter($router) {
        $this->router = $router;
    }
    
}

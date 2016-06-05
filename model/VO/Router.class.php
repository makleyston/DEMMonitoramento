<?php

/**
 * Description of Router
 *
 * @author makleyston
 */
class Router {
    private $nmRouter;
    private $way;
    private $location;
    private $fleet; //Object Fleet
    private $way; //Array of String
    
    function __construct($nmRouter) {
        $this->nmRouter = $nmRouter;
    }
    function getNmRouter() {
        return $this->nmRouter;
    }

    function getWay() {
        return $this->way;
    }

    function getLocation() {
        return $this->location;
    }

    function getFleet() {
        return $this->fleet;
    }

    function getWay() {
        return $this->way;
    }

    function setNmRouter($nmRouter) {
        $this->nmRouter = $nmRouter;
    }

    function setWay($way) {
        $this->way = $way;
    }

    function setLocation($location) {
        $this->location = $location;
    }

    function setFleet($fleet) {
        $this->fleet = $fleet;
    }

    function setWay($way) {
        $this->way = $way;
    }


}

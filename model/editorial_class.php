<?php

class editorial_class {
    protected $idEditorial;
    protected $nombreEditorial;
    protected $ciudad;
    
    function getIdEditorial() {
        return $this->idEditorial;
    }

    function getNombreEditorial() {
        return $this->nombreEditorial;
    }

    function getCiudad() {
        return $this->ciudad;
    }
    function setIdEditorial($idEditorial) {
        $this->idEditorial = $idEditorial;
    }

    function setNombreEditorial($nombreEditorial) {
        $this->nombreEditorial = $nombreEditorial;
    }

    function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }
    function getObjectVars()
    {
        $vars = get_object_vars($this);
        return  $vars;
    }


}

<?php

class libro_class
{
    protected $id;
    protected $titulo;
    protected $autor;
    protected $numPag;
    protected $idEditorial;
    
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getAutor() {
        return $this->autor;
    }

    function getNumPag() {
        return $this->numPag;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setAutor($autor) {
        $this->autor = $autor;
    }

    function setNumPag($numPag) {
        $this->numPag = $numPag;
    }  
    function getIdEditorial() {
        return $this->idEditorial;
    }
    function setIdEditorial($idEditorial) {
        $this->idEditorial = $idEditorial;
    }
    function getObjectVars()
    {
        $vars = get_object_vars($this);
        return  $vars;
    }
}


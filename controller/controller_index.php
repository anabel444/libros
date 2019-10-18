<?php
include_once ("../model/libro_model.php");

$libro= new libro_model();
$libro->setList(); 

$listaLibrosJSON=$libro->getListJsonString();

echo $listaLibrosJSON;

unset ($libro);

?>
<?php
include_once ("../model/editorial_model.php");

$editorial= new editorial_model();
$editorial->setList(); 

$listaEditorialesJSON=$editorial->getListJsonString();

echo $listaEditorialesJSON;

unset ($editorial);
?>
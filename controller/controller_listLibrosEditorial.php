<?php


 include_once ("../model/editorial_model.php");

$editorial= new editorial_model();

$editorial->setIdEditorial(filter_input(INPUT_GET,'idEditorial'));
//$editorial->setNombreEditorial(filter_input(INPUT_GET,'nombreEditorial'));

$editorial->setListaLibros();   //listaLibros betetzen da
                                //se rellena listaLibros
//echo print_r($editorial->getListaLibros());    //ondo honaino


$listaLibrosEditorialJSON=$editorial->getListLibrosJsonString();

echo $listaLibrosEditorialJSON;

unset ($libro);



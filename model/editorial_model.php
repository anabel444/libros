<?php

include_once ("connect_data.php");
include_once ("editorial_class.php");
include_once ("libro_model.php");

class editorial_model extends editorial_class
{
    private $link;
    private $list=array();         //editorial guztien lista - lista de todas editoriales
    private $listaLibros=array(); // editorial honen liburu guztiak - libros de una editorial
    
    public function getList() {
        return $this->list;
    }
    
    public function OpenConnect()
    {
    $konDat=new connect_data();
    try
    {
         $this->link=new mysqli($konDat->host,$konDat->userbbdd,$konDat->passbbdd,$konDat->ddbbname);
         // mysqli klaseko link objetua sortzen da dagokion konexio datuekin
         // se crea un nuevo objeto llamado link de la clase mysqli con los datos de conexión. 
    }
    catch(Exception $e)
    {
    echo $e->getMessage();
    }
        $this->link->set_charset("utf8"); // honek behartu egiten du aplikazio eta 
        //                  //databasearen artean UTF -8 erabiltzera datuak trukatzeko
    }                   
 
    public function CloseConnect()
    {
         mysqli_close ($this->link);
    }
 
    public function findIdEditorial()
    {
        $idEditorial=$this->getIdEditorial();
       
        $this->OpenConnect();  
        $sql = "CALL spFindIdEditorial($idEditorial)";
               
        $result = $this->link->query($sql);    
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                
            $this->setIdEditorial($row['idEditorial']);
            $this->setNombreEditorial($row['nombreEditorial']);
            $this->setCiudad($row['ciudad']);  
        }
       mysqli_free_result($result); 
       $this->CloseConnect();
       return $this;
    }   

    public function setListaLibros()
    {
        $this->OpenConnect();  // konexioa zabaldu  - abrir conexión
        
        $idEditorial=$this->getIdEditorial();
        
        $listaLibrosEditorial=new libro_model(); //para llamar a la función de libro_model
       
        $this->listaLibros=$listaLibrosEditorial->findEditorialBooks($idEditorial);
        
        
        unset($listaLibrosEditorial);
        $this->CloseConnect();
    }
    
    public function getListaLibros()
    {
        return $this->listaLibros;
    }

    function getListJsonString() {
        
        // returns the list of objects in a srting with JSON format
        $arr=array();
        
        foreach ($this->list as $object)
        {
            $vars = $object->getObjectVars(); // set the tasks list for each visit
            array_push($arr, $vars);
        }
        return json_encode($arr);
    }
    function getListLibrosJsonString() {
        
        // returns the list of objects in a srting with JSON format

        $arr=array();

        foreach ($this->listaLibros as $object)
        {
            $vars = $object->getObjectVars(); // set the tasks list for each visit
            array_push($arr, $vars);
        }
        return json_encode($arr);
    }
   
  
}

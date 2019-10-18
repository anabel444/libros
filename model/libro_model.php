<?php
include_once ("connect_data.php");  // klase honetan gordetzen dira datu basearen datuak. erabiltzailea...
include_once ("libro_class.php");
include_once ("editorial_model.php");

class libro_model extends libro_class
{
    private $link;  // datu basera lotura - enlace a la bbdd
    private $list=array();  // datu basetik ekarritako datuak gordeko diren array-a 
    private $objectEditorial;  //editorialaren datuak gordeko dira hemen objetu bezala
         
 public function getList() {
        return $this->list;
    }
    
 public function getObjectEditorial() 
 {
        return $this->objectEditorial;
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
     //mysqli_close ($this->link);
     $this->link->close();
 }
 
 public function setList()
 {
        $this->OpenConnect();  // konexioa zabaldu  - abrir conexión
        $sql = "CALL spAllBooks()"; // SQL sententzia - sentencia SQL
        
        $result = $this->link->query($sql); // result-en ddbb-ari eskatutako informazio dena gordetzen da
                                             // se guarda en result toda la información solicitada a la bbdd
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            
            $nuevoLibro=new libro_model(); // self() 
            $nuevoLibro->setId($row['id']);
            $nuevoLibro->setTitulo($row['titulo']);
            //print_r($nuevoLibro->getTitulo());
            $nuevoLibro->setAutor($row['autor']);
            $nuevoLibro->setNumPag($row['numPag']);
            $nuevoLibro->setIdEditorial($row['idEditorial']);
          
            $editorial=new editorial_model(); 
            $editorial->setIdEditorial($row['idEditorial']);
            
            $nuevoLibro->objectEditorial=$editorial->findIdEditorial(); // honek itzultzen digu editorialaren datua objetu baten.
                                                                         //devuelve la editorial de un libro             
            array_push($this->list, $nuevoLibro);  
        }
       mysqli_free_result($result); 
       unset($editorial);
       $this->CloseConnect();
 }

 public function insert()
 {
     
      $this->OpenConnect();  // konexio zabaldu  - abrir conexión     
      $titulo="'". $this->getTitulo()."'";
      $autor= "'".$this->getAutor()."'";
      $numPag= $this->getNumPag();
      $idEditorial= $this->getIdEditorial();
      $sql = "CALL spInsertLibro($titulo, $autor, $numPag,$idEditorial)";
      
      if ($this->link->query($sql))
      {
          return "Libro insertado con exito";
      } else {
          return "Falla la insercion del libro: (" . $this->link->errno . ") " . $this->link->error;
      }
      
          
      $this->CloseConnect();
 }
 
 public function findEditorialBooks($idEditorial) //editorial baten liburuak
                                     //libros de una editorial
 {
     
     $this->OpenConnect();  // konexioa zabaldu  - abrir conexión
     $sql = "CALL spEditorialBooks($idEditorial)"; // SQL sententzia - sentencia SQL
     
     $editorialBooks = array(); // objetuaren list atributua array bezala deklaratzen da -
                             //se declara como array el atributo list del objeto
     
     $result = $this->link->query($sql); // result-en ddbb-ari eskatutako informazio dena gordetzen da
     // se guarda en result toda la información solicitada a la bbdd
     //echo $sql;
     while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
         
         $new=new libro_class();
         $new->setId($row['id']);
         $new->setTitulo($row['titulo']);
         $new->setAutor($row['autor']);
         $new->setNumPag($row['numPag']);
         $new->setIdEditorial($row['idEditorial']);
 
         array_push( $editorialBooks, $new);
     }
     mysqli_free_result($result);
     $this->CloseConnect();
     return $editorialBooks;
     
 }
     function getListJsonString() {
         
         // returns the list of objects in a srting with JSON format
         $arr=array();
         foreach ($this->list as $object)
         {
             $vars = $object->getObjectVars();
             $objEditorial=$object->getObjectEditorial()->getObjectVars();
            
             $vars['objectEditorial']=$objEditorial; 
             array_push($arr, $vars);
         }
         return json_encode($arr);
     }
 }
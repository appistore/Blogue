<?php  
// information pour la connection à le DB locale
//=========================================
$host = '185.98.131.91';
$user = 'obser1116849';
$pass = 'aer8odslce';
$db = 'obser1116849';
// $link = mysqli_connect("localhost","my_user","my_password","my_db");
$link = mysqli_connect($host,$user,$pass,$db);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//Change charracter set to utf8 
// mysqli_set_charset ($link,'UTF8');
 // =========================================


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class Eburny
{
	    private static $serveur='mysql:host=185.98.131.91';
      	private static $bdd='dbname=obser1116849';   		
      	private static $user='obser1116849' ;    		
      	private static $mdp='aer8odslce' ;	
		private static $monPdo;
		private static $Eburny = null; 
		
		private function __construct()
	    {
		 try{
    		Eburny::$monPdo = new PDO(Eburny::$serveur.';'.Eburny::$bdd, Eburny::$user, Eburny::$mdp,array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 
			Eburny::$monPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		   }
			
         catch (PDOException $error) 
                 {	
                     echo 'N° : '.$error->getCode().'<br />';
                     die ('Erreur : '.$error->getMessage().'<br />');
                 }
	   }
	   
	    public function _destruct(){
		       Eburny::$monPdo = null;
	          } 
	    public  static function getPdoEburny()
	    {
		    if( Eburny::$Eburny == null)
		    {
			    Eburny::$Eburny= new  Eburny();
		    }
		    return  Eburny::$Eburny;  
	    }    // variables
		
 // constructor:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 		

	
	
	
	
	
	
<?php  
// information pour la connection à le DB locale
//=========================================
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'blogue-db';
$link = mysqli_connect($host,$user,$pass,$db);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Change charracter set to utf8 
mysqli_set_charset ($link,'UTF8');
 // =========================================



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class Eburny
{
	    private static $serveur='mysql:host=localhost';
      	private static $bdd='dbname=blogue-db';   		
      	private static $user='root' ;    		
      	private static $mdp='' ;	
		private static $monPdo;
		private static $Eburny = null; 
		
		private function __construct()
	    {
		 try{
    		Eburny::$monPdo = new PDO(Eburny::$serveur.';'.Eburny::$bdd, Eburny::$user, Eburny::$mdp,array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 
			Eburny::$monPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		   }
			
         catch (PDOException $error) 
                 {	
                     echo 'N° : '.$error->getCode().'<br />';
                     die ('Erreur : '.$error->getMessage().'<br />');
                 }
	   }
	   
	    public function _destruct(){
		       Eburny::$monPdo = null;
	          } 
	    public  static function getPdoEburny()
	    {
		    if( Eburny::$Eburny == null)
		    {
			    Eburny::$Eburny= new  Eburny();
		    }
		    return  Eburny::$Eburny;  
	    }    // variables

    // constructor:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 
 
 
 
 
 
 
 
 
 
 
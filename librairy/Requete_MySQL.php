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
 		
	
  
	   // ****************************Gestion des membre****************************************
	   public function creerMembre($idGroupe,$codeMembre,$emailMembre,$pwdMembre,$pwdConfMembre,$nomMembre,$telMembre,$statutMembre,$dateDuJour)
	   {
		$req = "INSERT INTO membre (idGroupe,codeMembre,emailMembre,pwdMembre,pwdConfMembre,nomMembre,telMembre,statutMembre,dateDuJour)
	               VALUES ('$idGroupe','$codeMembre','$emailMembre','$pwdMembre','$pwdConfMembre','$nomMembre','$telMembre','$statutMembre','$dateDuJour')";
		$res = Eburny::$monPdo->exec($req);
       }
	   //Permet de selectionner le plus grand id membre
	   public function getMaxIdMembre() 
	   {
		$sql="SELECT MAX(idMembre) as IdMembre FROM membre";
		$res = Eburny::$monPdo->query($sql);
		$ligne = $res->fetch();
		return $ligne;
	   }
	   //Recupère les infos du membre a partir de son id
	   public function getMembreInfosById($idMembre) 
	   {
		$sql="SELECT * FROM membre WHERE idMembre='".$idMembre."';";
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetch();
		return $ligne;
	   }
	   //Recupère les infos du membre a partir de son codeMembre_Parrain
	   public function getMembreInfosByCode($codeMembre) 
	   {
		$sql="SELECT * FROM membre WHERE codeMembre='".$codeMembre."';";
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetch();
		return $ligne;
	   }
	   //Recupère l'idMembre d'un membre a partir du codeMembre
	   public function getIdMembreByCode($codeMembre) 
	   {
		$sql="SELECT idMembre as IdMembre FROM membre WHERE codeMembre='".$codeMembre."';";
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetch();
		return $ligne;
	   }
	   //condition de creation du membre : avant de créer un membre, On verifie si le membre n'existe pas deja
	   public function VerifMembre($idGroupe,$emailMembre,$pwdMembre,$pwdConfMembre,$nomMembre,$telMembre)
	   {
		$sql="SELECT * FROM membre WHERE idGroupe='".$idGroupe."'
									AND emailMembre='".$emailMembre."'
									AND pwdMembre='".$pwdMembre."'
									AND pwdConfMembre='".$pwdConfMembre."'
									AND nomMembre='".$nomMembre."'
									AND telMembre='".$telMembre."';";	
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetchAll();
		return $ligne;
	   }
	   //Recupère la liste des membres inscrits
	   public function getListeMembre() 
	   {
		$sql="SELECT * FROM membre";	
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetchAll();
		return $ligne;
	   }
	   
	   
	   //Modification du membres à partir de son id
	   public function ModifierMembre($idMembre,$emailMembre,$pwdMembre,$pwdConfMembre,$nomMembre,$telMembre,$modifier,$dateDuJourMod)
	   {
			$reqel=" UPDATE membre SET emailMembre='".$emailMembre."',
								pwdMembre='".$pwdMembre."',
								pwdConfMembre='".$pwdConfMembre."',
								nomMembre='".$nomMembre."',
								telMembre='".$telMembre."', 	
								modifier='".$modifier."',
								dateDuJourMod='".$dateDuJourMod."'
								WHERE idMembre='".$idMembre."';";
			$resel = Eburny::$monPdo->exec($reqel);
	   }	

	   
	   //Modification du membres à partir de son id
	   public function ModifierMembreInfos($idMembre,$emailMembre,$nomMembre,$telMembre,$modifier,$dateDuJourMod)
	   {
			$reqel=" UPDATE membre SET emailMembre='".$emailMembre."',	
								nomMembre='".$nomMembre."',
								telMembre='".$telMembre."', 	
								modifier='".$modifier."',
								dateDuJourMod='".$dateDuJourMod."'
								WHERE idMembre='".$idMembre."';";
			$resel = Eburny::$monPdo->exec($reqel);
	   }	
	   //Modification du mot de passe d'un membre à partir de son email
	   public function ModifierPwdMembreBy($idMembre,$pwdMembre,$pwdConfMembre,$ancPwdMembre,$modifier,$dateDuJourMod)
	   {
			$reqel=" UPDATE membre SET pwdMembre='".$pwdMembre."',
								pwdConfMembre='".$pwdConfMembre."',
								ancPwdMembre='".$ancPwdMembre."',
								modifier='".$modifier."',
								dateDuJourMod='".$dateDuJourMod."'
								WHERE idMembre='".$idMembre."';";
			$resel = Eburny::$monPdo->exec($reqel);
	   }	
	   
		//PAGINATION : Recupère la liste de tous les membres enregistrés ds la table membre
	   public function getListeMembreByPage($premierMembreAafficher,$nombreDeMembreParPage) 
	   {	
		$sql="SELECT * FROM membre ORDER BY idMembre DESC LIMIT $premierMembreAafficher,$nombreDeMembreParPage";	
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetchAll();
		return $ligne;
	   } 
	    	   
		//PAGINATION : Recupère la liste de tous les membres enregistrés et activé
	   public function getListeMembreStatActByPage($premierMembreAafficher,$nombreDeMembreParPage) 
	   {	
		$sql="SELECT * FROM membre WHERE statutMembre='active' ORDER BY idMembre DESC LIMIT $premierMembreAafficher,$nombreDeMembreParPage";	
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetchAll();
		return $ligne;
	   } 	   
	   //Suppression du membre à partir de son id
	   public function SupprimerMembre($idMembre) 
	   {
		$sql="DELETE FROM membre WHERE idMembre='".$idMembre."';";
		$res = Eburny::$monPdo->query($sql);
		// $ligne = $res->fetch();
		// return $ligne;
	   } 
	   
	   
	   //condition1 : verifie si un Membre existe dans la table membre a partir de son codeMembre
	   public function VerifCodeMembre($codeMembre)
	   {
		$sql="SELECT * FROM membre WHERE codeMembre='".$codeMembre."';";	
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetchAll();
		return $ligne;
	   }
	   //Recupère le codeMembre d'un membre a partir se son idMembre
	   public function getCodeMembreById($idMembre) 
	   {
		$sql="SELECT (codeMembre) as CodeMembre FROM membre WHERE idMembre='".$idMembre."';";
		$res = Eburny::$monPdo->query($sql);
		$ligne = $res->fetch();
		return $ligne;
	   }

	   //condition de creation du membre : avant de créer un membre, On verifie si l'email n'existe pas deja
	   public function VerifEmailInMembre($emailMembre)
	   {
		$sql="SELECT * FROM membre WHERE emailMembre='".$emailMembre."';";	
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetchAll();
		return $ligne;
	   }
	   
	   
	   //condition de modification du membre : avant de créer un membre, On verifie si l'email n'existe pas deja
	   public function VerifEmailInMembreForModif($idMembre,$emailMembre)
	   {
		$sql="SELECT * FROM membre WHERE emailMembre='".$emailMembre."' AND idMembre!='".$idMembre."';";	
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetchAll();
		return $ligne;
	   }

  
	   //Modifis le statut du membre en statut active a partir de son id 
	   public function ModifSatutMembreAct($idMembre)
	   {
			$req ="UPDATE membre SET statutMembre ='active' WHERE idMembre='".$idMembre."';";
			$res = Eburny::$monPdo->exec($req);
	   }	   	   
	   //Modifi le statut du membre en statut desactive a partir de son id 
	   public function ModifSatutMembreDes($idMembre)
	   {
			$req ="UPDATE membre SET statutMembre ='desactive' WHERE idMembre='".$idMembre."';";
			$res = Eburny::$monPdo->exec($req);
	   }
  
	   //condition de login membre
	   public function VerifLoginMembre($emailMembre,$pwdMembre)
	   {
		$sql = "SELECT * FROM membre,groupe WHERE membre.idGroupe=groupe.idGroupe
								  AND membre.emailMembre='".$emailMembre."' 	
								  AND groupe.statutGroupe='active' 	
								  AND membre.statutMembre='active' 	
								  AND membre.pwdMembre='".$pwdMembre."'";	
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetch();
		return $ligne;
	   }	 
  
		// ****************************Gestion de groupe****************************************
	  
  	
	   //Recupère la liste de tous les groupe
	   public function getListeGroupe() 
	   {
		$sql="SELECT * FROM groupe";	
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetchAll();
		return $ligne;
	   }
	   
	   // ****************************Gestion des ARTICLES ****************************************
	   
	   public function creerArticle($idCat,$idMembre,$titre,$fichier,$contenu,$statutArticle,$dateDuJour)
	   {
		  $req = "INSERT INTO article (idCat,idMembre,titre,photo,contenu,statutArticle,dateDuJour) 
	               VALUES('$idCat','$idMembre','$titre','$fichier','$contenu','$statutArticle','$dateDuJour')";
		$res = Eburny::$monPdo->exec($req);
       }	
	   //Recupère la liste de tous les articles
	   public function getListeArticle() 
	   {
		$sql="SELECT * FROM article";	
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetchAll();
		return $ligne;
	   }
	   	
	   //récupère le nombre total de article
	   public function getNombreArticle() 
	   {
		$sql = ("SELECT COUNT(*) AS nb_article FROM article");
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetch();
		return $ligne;
	   }
	   
	   //récupère le nombre d'article d'une categorie a partir de son libCat
	   public function getNombreArticleCategorie($libCat) 
	   {
		$sql = ("SELECT COUNT(*) AS nb_article FROM article WHERE statutArticle='active' AND idCat IN (SELECT idCat FROM categorie WHERE libCat='$libCat')");	
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetch();
		return $ligne;
	   }
	   
	   
	   //Recupère la liste de 3  dernier articles d'une même categorie enregistré à partir de l'id Categorie (sauf l'article affiché)
	   public function getListe3ArtByIdCat($idCat,$idArticle) 
	   {
		$sql="SELECT * FROM article WHERE statutArticle='active' AND idCat IN (SELECT idCat FROM categorie WHERE idCat='".$idCat."') AND idArticle !='".$idArticle."' ORDER BY idArticle DESC LIMIT 0,3";	
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetchAll();
		return $ligne;
	   }
	   //Modification du article à partir de son id
	   public function ModifierArticle($idArticle,$idCat,$titre,$fichier,$resultat,$modifier,$dateDuJourMod)
	   {
			$reqel=" UPDATE article SET titre='".$titre."',
								idCat='".$idCat."', 
								photo='".$fichier."', 
								contenu='".$resultat."', 			
								modifier='".$modifier."',
								dateDuJourMod='".$dateDuJourMod."'
								WHERE idArticle='".$idArticle."';";
			$resel = Eburny::$monPdo->exec($reqel);
	   }
	   
	   //MAJ : insertion du contenu de l'article à partir de son id
	   public function MAJArticle($idArticle,$resultat)
	   {
			$reqel=" UPDATE article SET contenu='".$resultat."'
								WHERE idArticle='".$idArticle."';";
			$resel = Eburny::$monPdo->exec($reqel);
	   }
	   //MAJ : insertion des visites de l'article à partir de son id
	   public function MAJVisiteArticle($idArticle,$visite)
	   {
			$reqel=" UPDATE article SET visite='".$visite."'
								WHERE idArticle='".$idArticle."';";
			$resel = Eburny::$monPdo->exec($reqel);
	   }
	   //Permet de selectionner le plus grand id article
	   public function getMaxIdArticle() 
	   {
		$sql="SELECT MAX(idArticle) as IdArticle FROM article";
		$res = Eburny::$monPdo->query($sql);
		$ligne = $res->fetch();
		return $ligne;
	   }
	   //Recupère les infos de l'article a partir de son id
	   public function getArticleInfosById($idArticle) 
	   {
		$sql="SELECT * FROM article WHERE idArticle='".$idArticle."';";
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetch();
		return $ligne;
	   }
	   //Recupère les infos de l'article et de sa categorie a partir de son id
	   public function getArticleEtCategorieInfosById($idArticle,$idCat) 
	   {
		$sql="SELECT * FROM article,categorie WHERE article.idCat=categorie.idCat AND idArticle='".$idArticle."';";	
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetch();
		return $ligne;
	   }  
	   //Modifi le statut du article en statut active a partir de son id 
	   public function ModifSatutArticleAct($idArticle)
	   {
			$req ="UPDATE article SET statutArticle ='active' WHERE idArticle='".$idArticle."';";
			$res = Eburny::$monPdo->exec($req);
	   }	   	   
	   //Modifi le statut du article en statut desactive a partir de son id 
	   public function ModifSatutArticleDes($idArticle)
	   {
			$req ="UPDATE article SET statutArticle ='desactive' WHERE idArticle='".$idArticle."';";
			$res = Eburny::$monPdo->exec($req);
	   }	   	
	   //Suppression du article à partir de son id
	   public function SupprimerArticle($idArticle) 
	   {
		$sql="DELETE FROM article WHERE idArticle='".$idArticle."';";
		$res = Eburny::$monPdo->query($sql);
		// $ligne = $res->fetch();
		// return $ligne;
	   }
	   
		//PAGINATION : Recupère la liste des article enregistré 
	   public function getListeArticleByPage($premierArticleAafficher,$nombreDeArticleParPage) 
	   {	
		$sql="SELECT * FROM article ORDER BY idArticle DESC LIMIT $premierArticleAafficher,$nombreDeArticleParPage";	
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetchAll();
		return $ligne;
	   }
	   
	   //Recupère la liste de tous les articles et leur categorie
	   public function getListeArticleAndCategorie() 
	   {
		$sql="SELECT * FROM article,categorie where article.idCat=categorie.idCat AND statutArticle='active'";	
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetchAll();
		return $ligne;
	   }
	   
	   
	   
	   
		   
	   
	   
	      
	   
	   
	   
	   
	   

	  // ****************************Gestion des CATEGORIES ****************************************
	   public function creerCategories($codeCat,$libCat,$description,$statutCat,$dateDuJour)
	   {
		  $req = "INSERT INTO categorie (codeCat,libCat,description,statutCat,dateDuJour) 
	               VALUES('$codeCat','$libCat','$description','$statutCat','$dateDuJour')";
		  $res = Eburny::$monPdo->exec($req);
       }	   
	   public function getListeCategorie() 
	   {
		$sql="SELECT * FROM categorie";	
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetchAll();
		return $ligne;
	   }		   
	   public function getListeCategorieByLibCat($libCat) 
	   {
		$sql="SELECT * FROM categorie WHERE libCat='".$libCat."';";	
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetchAll();
		return $ligne;
	   }		
	   //Recupère les infos de la categorie a partir de son id
	   public function getCategorieInfosById($idCat) 
	   {
		$sql="SELECT * FROM categorie WHERE idCat='".$idCat."';";
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetch();
		return $ligne;
	   } 	
	   
	   //Recupère les infos de la categorie a partir de son libCat
	   public function getCategorieInfosByLibCat($libCat) 
	   {
		$sql="SELECT * FROM categorie WHERE libCat='".$libCat."';";
		$res = Eburny::$monPdo->query($sql); 
		$ligne = $res->fetch();
		return $ligne;
	   } 
	   
	   
	   
	   
	   
	   
	   
	   
	   
	
		// **************************** Gestion des fonct*************************************
			
		

}


?>
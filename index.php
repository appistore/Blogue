<?php
session_start();
header('Content-Type: text/html; charset=utf-8');

$dateDuJour=date('Y').'-'.date('m').'-'.date('d');
$dateDuJourMod=date('Y').'-'.date('m').'-'.date('d');

// repertoire du fichier images
$repertoire = "nom_de_mon_repertoire/fichierArticle/";
	
//inclure les fichiers fonctions et librairies
include ('librairy/Requete_MySQL.php');
include ('librairy/fonctions.php');

//instanciation de la classe eburny
$pdo = Eburny::getPdoEburny();


//Deconnexion
if(isset($_GET['controller']) AND $_GET['controller']=='deconnexion')
{		
	session_destroy();
	header('Location:../../index.php?controller=login&action=login');
	exit;
}
else
{		
	$controller='accueil';		
}


//inclure les entetes
include('vues/entete.php');


if(isset($_GET['controller']))
{
	$controller=$_GET['controller'];
}
else
{
	$controller='accueil';
}
switch ($controller)
{
case "accueil":
	include('controller/c_accueil.php');
	break;

case "article":
	include ('controller/c_article.php');
	break;
	
case "login":
	include ('controller/c_login.php');
	break;
	
case "profil":
	include ('controller/c_profil.php');
	break;
	
case "membre":
	include ('controller/c_membre.php');
	break;
	
		
	
}

//inclure les pieds de pages
include('vues/footer.php');


?>
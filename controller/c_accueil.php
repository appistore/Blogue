<?php 
if(isset($_GET['action']))
{
	$action=$_GET['action'];
}
else
{
	$action='accueil';
}
switch ($action)
{	
case "accueil":			
	//Recupère la liste des articles de la table article et categorie
	$listeArticleAndCategorie = $pdo->getListeArticleAndCategorie(); 
	$nblisteArticleAndCategorie =count($listeArticleAndCategorie);				
	include('vues/accueil/accueil.php');
	break;
		
	
}
?>
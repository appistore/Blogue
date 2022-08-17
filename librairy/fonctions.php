<?php

// **************************** Gestion des membres ****************************************
function controleInserMembre($idGroupe,$codeMembre,$emailMembre,$pwdMembre,$pwdConfMembre,$nomMembre,$telMembre)
{
	$Erreur=array();
	//Traitement des variables récuperés
	if(empty($idGroupe) OR ($idGroupe=""))
		{
			$Erreur[]="<font color=''>Votre groupe est incorrect</font>";
		}
	if(empty($codeMembre))
		{
			$Erreur[]="<font color=''>Votre code est incorrect</font>";
		}
	if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$emailMembre))
		{
			$Erreur[]="<font color=''> Votre Adresse Email est incorrecte </font>";
		}
	if(empty($pwdMembre) OR ($pwdMembre=""))
		{
			$Erreur[]="<font color=''> Votre Mot de passe est incorrect </font>";
		}
	if(empty($pwdConfMembre) OR $pwdConfMembre="")
		{
			$Erreur[]="<font color=''> Votre Mot de passe confirmé est incorrect </font>";
		}
	if($pwdMembre!=$pwdConfMembre)
		{
			$Erreur[]="<font color=''> Votre Mot de passe est différent du mot de passe confirmé</font>";
		}
	if(empty($nomMembre) OR ($nomMembre=""))
		{
			$Erreur[]="<font color=''> Votre Nom est incorrect  </font>";
		}
	return $Erreur;
}









function controleEditerMembre($emailMembre,$typeMembre,$nomMembre,$telMembre)
{
	$Erreur=array();
	//Traitement des variables récuperés
	if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$emailMembre))
		{
			$Erreur[]="<font color=''> Votre Adresse Email est incorrecte </font>";
		}
	if(empty($typeMembre) OR ($typeMembre=""))
		{
			$Erreur[]="<font color=''> Choisissez un type : Particulier ou Entreprise </font>";
		}
	if(empty($nomMembre) OR ($nomMembre=""))
		{
			$Erreur[]="<font color=''> Votre Nom est incorrect  </font>";
		}
	return $Erreur;
}








function controleEditerPassword($ancPwdMembre,$pwdMembre,$pwdConfMembre)
{
	$Erreur=array();
	//Traitement des variables récuperés
	if(empty($ancPwdMembre) OR ($ancPwdMembre=""))
		{
			$Erreur[]="<font color=''> Votre Mot de passe est incorrect </font>";
		}
	if(empty($pwdMembre) OR ($pwdMembre=""))
		{
			$Erreur[]="<font color=''> Votre Mot de passe est incorrect </font>";
		}
	if(empty($pwdConfMembre) OR $pwdConfMembre="")
		{
			$Erreur[]="<font color=''> Votre Mot de passe confirmé est incorrect </font>";
		}
	if($pwdMembre!=$pwdConfMembre)
		{
			$Erreur[]="<font color=''> Votre Mot de passe est différent du mot de passe confirmé</font>";
		}
	return $Erreur;
}









//Transforme tous les caracteres en majuscule
function strToUpperNoAccent($var) 
{ 
	$search =  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ'; 
	$replace = 'AAAAAACEEEEIIIIOOOOOUUUUYAAAAAACEEEEIIIIOOOOOOUUUUYY';
	return strtr(strtoupper($var),$search,$replace);
}
			



   
function getCodeMembre()
{	
	// Connexion a la db
	include('connect_db.php');
	
	//ON recupère le plus grand id eleve ds la table eleve
	$reqArt = ("SELECT MAX(idMembre) as IdMembre FROM membre");
	$result=mysqli_query($link,$reqArt) OR die ("Connexion impossible au serveur");
	$data = mysqli_fetch_array($result,MYSQLI_BOTH);
	//On increment plus 1
	$IdMembre = $data['IdMembre']+1;			
	$dateDeb=date('Y', time());
	// $dateFin=date('Y', time())-1999;
    return 'BLOG'.$dateDeb.'/'.sprintf("%05d", $IdMembre);		
}


// Coupe un texte à $longueur caractères, sur les espaces, et ajoute des points de suspension...
function tronque($chaine, $longueur = 200) 
{
 
	if (empty ($chaine)) 
	{ 
		return ""; 
	}
	elseif (strlen ($chaine) < $longueur) 
	{ 
		return $chaine; 
	}
	elseif (preg_match ("/(.{1,$longueur})\s./ms", $chaine, $match)) 
	{ 
		return $match [1] . "..."; 
	}
	else 
	{ 
		return substr ($chaine, 0, $longueur) . "..."; 
	}
	
	
	





}	
?>



<?php 
if(isset($_GET['action']))
{
	$action=$_GET['action'];
}
else
{
	$action='membre';
}
switch ($action)
{
case "membre":	
		include('vues/membre/membre.php');
		break;
		
case "inscription":	
		//Affiche la liste du groupe
		$listeGroupe = $pdo->getListeGroupe(); 
		$nbGroupe=count($listeGroupe);
		include('vues/membre/inscription.php');
		break;
	

	
	
case "RegisterAjoutMembre":
	if(isset($_POST['emailMembre']) && !isset($_POST['idMembre']))
	{
		// infos Membre
		$idGroupe=(htmlspecialchars(mysqli_real_escape_string($link,trim($_POST['idGroupe']))));
		$emailMembre=(htmlspecialchars(mysqli_real_escape_string($link,trim($_POST['emailMembre']))));
		$pwdMembre=(htmlspecialchars(mysqli_real_escape_string($link,trim($_POST['pwdMembre']))));
		$pwdConfMembre=(htmlspecialchars(mysqli_real_escape_string($link,trim($_POST['pwdConfMembre']))));
		$nomMembre=(htmlspecialchars(mysqli_real_escape_string($link,trim($_POST['nomMembre']))));
		$telMembre=(htmlspecialchars(mysqli_real_escape_string($link,trim($_POST['telMembre']))));
		//statut par defaut
		$statutMembre='active';	
		//code du membre
		$codeMembre = getCodeMembre();
		
		//Fonction de verification d'erreur ds membre
		$mesErreurMembre=controleInserMembre($idGroupe,$codeMembre,$emailMembre,$pwdMembre,$pwdConfMembre,$nomMembre,$telMembre);
		if(count($mesErreurMembre)!=0)//S'il ya erreur lors du traitement 
		{
			$mesMembre="<font color='red'>Erreur d'enregistrement !</font>";  $VarErreurMemb="ok";		
		}		
		//On verifi si le membre n'existe pas deja
		$listeVerifMembre = $pdo-> VerifMembre($idGroupe,$emailMembre,$pwdMembre,$pwdConfMembre,$nomMembre,$telMembre);
		$nbVerifMembre=count($listeVerifMembre);
		if($nbVerifMembre>0)
		{
			$mesDoublonMembre="Cet membre est déjà enregistrée !</font>";	$VarErreurMemb="ok";		
		}
		//On verifi la conformité des 2 password
		if($pwdMembre!=$pwdConfMembre)
		{
			$ErreurPassword="Votre Mot de passe est différent du mot de passe confirmé"; $VarErreurMemb="ok";
		}			
		//On verifi si l'email n'est pas deja enregistrée ds la table membre 
		$listeVerifEmailMembre = $pdo-> VerifEmailInMembre($emailMembre);
		$nbVerifEmailMembre=count($listeVerifEmailMembre);
		if(isset($nbVerifEmailMembre) && $nbVerifEmailMembre>0)
		{
			$mesDoublonMembreEmail="<font color=''> Cet email est déja associé à un compte</font>";	$VarErreurMemb="ok";		
		}		
		if(!isset($VarErreurMemb)) //S'il n'y a pas d'erreur lors du traitement, 
		{
			//Codage en md cinq
			$pwdMembre=md5($pwdMembre);
			$pwdConfMembre=md5($pwdConfMembre);
			//Requête d'insersion du membre dans la table membre
			$resMembre = $pdo->creerMembre($idGroupe,$codeMembre,$emailMembre,$pwdMembre,$pwdConfMembre,$nomMembre,$telMembre,$statutMembre,$dateDuJour);			
			$mesEngMemb="<font color='red'>Enr&eacute;gistrement effectu&eacute; avec succes !</font>";
			
			//Affiche la liste du groupe
			$listeGroupe = $pdo->getListeGroupe(); 
			$nbGroupe=count($listeGroupe);	 
			// Revenir sur le formulaire inscription
			include('vues/membre/inscription.php');
			break;		
		}
		else
		{
			$mesErreurEnrg="<font color=''>L'enr&eacute;gistrement du membre a &eacute;chou&eacute;</font>";
			//Affiche la liste du groupe
			$listeGroupe = $pdo->getListeGroupe(); 
			$nbGroupe=count($listeGroupe);
			// Revenir sur le formulaire inscription
			include('vues/membre/inscription.php');
			break;			 
		}	
	}

	
	

case "liste_membre":		
		// pagination
		include('RegisterListeMembre.php');
		include('vues/membre/liste_membre.php');
		break;	


case "profil_membre":	
	if(isset($_SESSION['idMembre']))
	{	
		//Recupère les infos du membre a partir de son id     
		$ListeInfosMembre= $pdo->getMembreInfosById($_SESSION['idMembre']); 
		$nbInfosMembre=count($ListeInfosMembre);
		
		include('vues/membre/profil_membre.php');
		break;	
	}
	else {	
		//Recupère la liste des articles de la table article et categorie
		$listeArticleAndCategorie = $pdo->getListeArticleAndCategorie(); 
		$nblisteArticleAndCategorie =count($listeArticleAndCategorie);
		include('vues/accueil/accueil.php');
		break;	
	}




case "edit_mdpMembre":	
	if(isset($_SESSION['idMembre']))
	{	
		include('vues/membre/edit_mdpMembre.php');
		break;	
	}
	else {	
		//Recupère la liste des articles de la table article et categorie
		$listeArticleAndCategorie = $pdo->getListeArticleAndCategorie(); 
		$nblisteArticleAndCategorie =count($listeArticleAndCategorie);
		include('vues/accueil/accueil.php');
		break;	
	}




case "envoi_emailMembre":	
	if(isset($_SESSION['idMembre']))
	{	
		include('vues/membre/envoi_emailMembre.php');
		break;	
	}
	else {
		include('vues/membre/envoi_emailMembre.php');
		break;
	}



case "fiche_membre":	
	if(isset($_GET['idMembre']))
	{	
		// echo "BBBBBBBBB";
		$idMembre=intval($_GET['idMembre']);
		//Recupère les infos du membre a partir de son id     
		$ListeInfosMembre= $pdo->getMembreInfosById($idMembre); 
		$nbInfosMembre=count($ListeInfosMembre);
		// pagination
		include('RegisterListeAnnonceMembreFiche.php');
		include('vues/membre/fiche_membre.php');
		break;	
	}


//********************************************ACTIVE membre ************************************************	
case "Active_membre":
		if(isset($_GET['idMembre']))
		{
			// intval — Retourne la valeur numérique entière équivalente d'une variable 
			$idMembre=intval($_GET['idMembre']);
			//Update statut du membre (activé) a partir de son id
			$listeActive = $pdo->ModifSatutMembreAct($idMembre); 
			
			// Pagination d'membre
			include('RegisterListeMembre.php');
			include('vues/membre/liste_membre.php');
			break;		
		}

//********************************************DESACTIVE membre ************************************************	
case "Desactive_membre":
		if(isset($_GET['idMembre']))
		{	
			$idMembre=$_GET['idMembre'];
			//Update statut du membre (activé) a partir de son id
			$listeDesactive = $pdo->ModifSatutMembreDes($idMembre); 
			// Pagination d'membre
			include('RegisterListeMembre.php');
			include('vues/membre/liste_membre.php');
			break;		
		}	

		
//********************************************Modifier membre ************************************************
case "RegisterModifier_membre":
	if(isset($_SESSION['idMembre']) && isset($_POST['okModifMembre']))
	{	
		// infos Membre
		$emailMembre=(htmlspecialchars(trim($_POST['emailMembre'])));
		$nomMembre=(htmlspecialchars(trim($_POST['nomMembre'])));
		$telMembre=(htmlspecialchars(trim($_POST['telMembre'])));
		
		//On verifi si l'email n'est pas deja enregistrée ds la table membre 
		$listeVerifEmailMembre = $pdo-> VerifEmailInMembreForModif($_SESSION['idMembre'],$emailMembre);
		$nbVerifEmailMembre=count($listeVerifEmailMembre);
		if(isset($nbVerifEmailMembre) && $nbVerifEmailMembre>0)
		{
			$mesDoublonMembreEmail="<font color=''> Cet email est déja associé à un compte, veuillez vous connecter avant de publier votre annonce</font>";	$VarErreurMemb="ok";		
		}	
		if(!isset($VarErreurMemb)) 
		{	
			//MAJ de la modif 
			$modifier='ok';		
			//Modification du produit à partir de son id
			$listeModifMembre = $pdo->ModifierMembreInfos($_SESSION['idMembre'],$emailMembre,$nomMembre,$telMembre,$modifier,$dateDuJourMod); 
				$mesModifMembre ="<font color='red'>Modification effectu&eacute;e</font>";	
				
				session_destroy();
				header('Location:index.php?controller=login&action=login');
				exit;
		}
		else
			{
			// Echec de modification
			$mesErreurModif="<font color=''>Modification à echouée</font>";			
			include('vues/membre/profil_membre.php');
			break;
			}	
	}	
	
	





case "RegisterModifierPassword":
	if(isset($_SESSION['idMembre']) && isset($_POST['okModifPw']))
	{	
		// infos Membre
		$ancPwdMembre=(htmlspecialchars(trim($_POST['pwdMembre'])));
		$pwdMembre=(htmlspecialchars(trim($_POST['newPwdMembre'])));
		$pwdConfMembre=(htmlspecialchars(trim($_POST['pwdConfMembre'])));
		
		
		//Codage en md5
		$pwdMembre=md5($pwdMembre);
		$ancPwdMembre=md5($ancPwdMembre);
		$pwdConfMembre=md5($pwdConfMembre);
							
		//Recupère 
		$listeLogin = $pdo->VerifLoginMembre($_SESSION['emailMembre'],$ancPwdMembre);
		$nbLogin=count((is_countable($listeLogin)?$listeLogin:[]));
		if(isset($nbLogin) AND $nbLogin<1)
		{		
			echo 'nnnnnnnnnn' .$nbLogin;
			$mesEreurPassword="<font color='rd'>Le mot de passe saisi est incorrecte !</font>";  $VarErreurMemb="ok";	

		}
		//On verifi la conformité des 2 password
		if($pwdMembre!=$pwdConfMembre)
		{
			$ErreurPassword="Votre Mot de passe est différent du mot de passe confirmé"; $VarErreurMemb="ok";
		}	
		//Fonction de verification d'erreur du formulaire
		$mesErreurPassword=controleEditerPassword($ancPwdMembre,$pwdMembre,$pwdConfMembre);
		if(count($mesErreurPassword)!=0)//S'il ya erreur lors du traitement 
		{
			$mesMembre="<font color=''>Erreur d'enregistrement !</font>";  $VarErreurMemb="ok";		
		}		
		if(!isset($VarErreurMemb)) 
		{	
			//MAJ de la modif 
			$modifier='ok';		
			//Modification du produit à partir de son id
			$listeModifPw = $pdo->ModifierPwdMembreBy($_SESSION['idMembre'],$pwdMembre,$pwdConfMembre,$ancPwdMembre,$modifier,$dateDuJourMod); 
				$mesModifPw ="<font color='red'>Modification effectu&eacute;e</font>";	
				
				session_destroy();
				header('Location:index.php?controller=login&action=login');
				exit;				
		}
		else
			{
			// Echec de modification
			$mesErreurModif="<font color=''>Modification à echouée</font>";			
			include('vues/membre/edit_mdpMembre.php');
			break;
			}	
	}	





	
}
?>
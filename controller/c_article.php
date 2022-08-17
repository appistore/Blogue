<?php 
if(isset($_GET['action']))
{
	$action=$_GET['action'];
}
else
{
	$action='ajout_article';
}
switch ($action)
{
case "ajout_article":
		//Affiche la liste des categories
		$listeCat = $pdo->getListeCategorie(); 
		$nbCat=count($listeCat);
		include('vues/article/ajout_article.php');
		break;

case "liste_article":
		// Pagination d'article
		include('RegisterListeArticle.php');
		include('vues/article/liste_article.php');
		break;		
		
	
case "RegisterAjoutArticle":
	if(isset($_POST['titre']) && isset($_POST['contenu']) && isset($_POST['idCat']))
	{
		$idCat=(htmlspecialchars(trim($_POST['idCat'])));
		$titre=(htmlspecialchars(trim($_POST['titre'])));
		
		if(isset($_SESSION['idMembre'])) { $idMembre = $_SESSION['nomMembre'];  }
		$contenu=$_POST['contenu'];
		//Statut de l'article par defaut lors de l'enrégistrement
		$statutArticle='active';
		if(isset($_SESSION['idMembre'])) { $idMembre=$_SESSION['idMembre'] ;}
		//*****************raitement du photo **********************************
		$dossier ='fichierArticle/';
		$fichier = basename($_FILES['photo']['name']);//Le nom original du fichier, comme sur le disque du visiteur (exemple : avatar.jpeg).
		$taille_maxi = 5000000; //la taille_maxi est 5 Mo
		$taille = filesize($_FILES['photo']['tmp_name']);//La taille du fichier en octets
		$extensions = array('.jpg', '.jpeg','.JPG','.JPEG','.png','.PNG','.gif','.GIF','.bmp','.BMP','.pdf','.PDF','.xlsx','.doc','.docx','.pptx');
		$extension = strrchr($_FILES['photo']['name'], '.'); 
					
		//On renome l'image de facon aleatoire
		$ext=strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
		$fichier =uniqid().'.'.$ext;
		
		//Début des vérifications de sécurité...
		if($_FILES['photo']['error']>0)   //On verifie si l'image n'est pas vide
		{
			// $mesEchec="<font color='red'>Erreur d&rsquo;enr&eacute;gistrement !</font>";$VarErreur="ok";
			$erreurFichier ="<font color=''>Changer le fichier t&eacute;l&eacute;vers&eacute; SVP...</font>";$VarErreur="ok";
		}
		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
			// $mesEchec="<font color=''>Erreur d&rsquo;enr&eacute;gistrement !</font>";$VarErreur="ok";
			$erreurExt ="<font color=''>Vous devez t&eacute;l&eacute;verser un fichier de type jpg, jpeg, JPG ou JPEG</font>";$VarErreur="ok";
		}
		if($taille>$taille_maxi)
		{
			// $mesEchec="<font color=''>Erreur d&rsquo;enr&eacute;gistrement !</font>";$VarErreur="ok";
			$erreurTaille = "<font color=''>Le fichier est trop gros...</font>";$VarErreur="ok";
		}
			
		if(!isset($VarErreur)) //S'il n'y a pas d'erreur lors du traitement, on upload et on ecrit la requette qui correspond a la bdd
		{
			//On formate le nom du fichier ici...
			$fichier = strtr($fichier, 
			  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
			  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
			$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
			//Si la fonction renvoie TRUE, c'est que ça a fonctionné...
			move_uploaded_file($_FILES['photo']['tmp_name'], $dossier . $fichier);
				
			//Enrégistrement ds la table article
			$resArticle = $pdo->creerArticle($idCat,$idMembre,addslashes($titre),$fichier,addslashes($contenu),$statutArticle,$dateDuJour);
			$mesArtEng="<font color=''>Enr&eacute;gistrement effectu&eacute; avec succ&egrave;s</font>";
			
			//Affiche la liste des categories
			$listeCat = $pdo->getListeCategorie(); 
			$nbCat=count($listeCat);
			
			// Revenir sur le formulaire article
			include('vues/article/ajout_article.php');
			break;			
		}
		else
			{
			//Affiche la liste des categories
			$listeCat = $pdo->getListeCategorie(); 
			$nbCat=count($listeCat);
		
			$mesErreurArt="<font color=''>Enrégistrement à echouée</font>";
			// Revenir sur le formulaire article
			include('vues/article/ajout_article.php');
			break;
			}
	}
	else
		{	
		//Affiche la liste des categories
		$listeCat = $pdo->getListeCategorie(); 
		$nbCat=count($listeCat);
			
		$mesErreurArt="<font color=''>Enrégistrement à echouée</font>";
		// Revenir sur le formulaire article
		include('vues/article/ajout_article.php');
		break;
		}

	
//*****************************AFFICHER DETAIL ARTICLE *********************************					
case "detail_article":
		if(isset($_GET['idArticle']))
		{
			// intval — Retourne la valeur numérique entière équivalente d'une variable 
			$idArticle=$_GET['idArticle'];
			
			//Recupère les infos de l'article a partir de son id
			$listeArtInfo = $pdo->getArticleInfosById($idArticle);
			$nbArtInfo=count($listeArtInfo);
			$idCat=$listeArtInfo['idCat'];
			
			//Recupère le libellé categorie à partir de l'idCatg
			$listeCatInfo = $pdo->getCategorieInfosById($idCat);
			$nbCatInfo=count($listeCatInfo);
			$libCat=$listeCatInfo['libCat'];
		
			include('vues/article/detail_article.php');
			break;		
		}

//********************************************ACTIVE ARTICLE ************************************************	
case "Active_article":
		if(isset($_GET['idArticle']))
		{
			// intval — Retourne la valeur numérique entière équivalente d'une variable 
			$idArticle=intval($_GET['idArticle']);
			//Update statut du article (activé) a partir de son id
			$listeActive = $pdo->ModifSatutArticleAct($idArticle); 
			
			//Recupère les infos de article a partir de son id
			$listeDetail = $pdo->getArticleInfosById($idArticle); 
			$nbDetail=count($listeDetail);
			
			// Pagination d'article
			include('RegisterListeArticle.php');
			include('vues/article/liste_article.php');
			break;							
		}

//*************************************DESACTIVE article ***********************************	
case "Desactive_article":
		if(isset($_GET['idArticle']))
		{
			$idArticle=$_GET['idArticle'];
			//Update statut du article (activé) a partir de son id
			$listeDesactive = $pdo->ModifSatutArticleDes($idArticle); 
			
			//Recupère les infos de article a partir de son id
			$listeDetail = $pdo->getArticleInfosById($idArticle); 
			$nbDetail=count($listeDetail);
			
			// Pagination d'article
			include('RegisterListeArticle.php');
			include('vues/article/liste_article.php');
			break;							
		}	

//********************************************Modifier article *****************************************
case "RecupModifier_article":
	if(isset($_GET['idArticle']) && isset($_GET['idCat']))
	{
		$idArticle=$_GET['idArticle'];
		$idCat=$_GET['idCat'];
		// echo "bbbbbbbbbbbbb";
		//Recupère les infos de article et de sa categorie a partir de son id
		$listeDetail = $pdo->getArticleEtCategorieInfosById($idArticle,$idCat); 
		$nbDetail=count($listeDetail);			
		
		//Affiche la liste des categories
		$listeCat = $pdo->getListeCategorie(); 
		$nbCat=count($listeCat);
					
		include('vues/article/modif_article.php');
		break;		
	}	

case "RegisterModifier_article":
		if(isset($_GET['idArticle']) && isset($_POST['resultat']))
		{			
			$idArticle=$_GET['idArticle'];	
			$idCat=$_POST['idCat'];	
			//Récuperation de l'ancienne photo
			$ancienPhoto=$_POST['ancienPhoto'];	
			
			//Récuperation des variables venus du foormulaire article 
			$titre=addslashes($_POST['titre']);	
			$resultat=addslashes($_POST['resultat']);	
			
			//Signifie qu'il ya eu modification du article 
			$modifier='ok';
		
		// $Traitement du photo 
		$dossier ='fichierArticle/';
		$fichier = basename($_FILES['photo']['name']);//Le nom original du fichier, comme sur le disque du visiteur (exemple : avatar.jpeg).
		
		if(!empty($fichier)) 
		{
			$taille_maxi = 5000000; //la taille_maxi est 5 Mo
			$taille = filesize($_FILES['photo']['tmp_name']);//La taille du fichier en octets
			$extensions = array('.jpg', '.jpeg','.JPG','.JPEG','.png','.PNG','.gif','.GIF','.bmp','.BMP');
			$extension = strrchr($_FILES['photo']['name'], '.'); 
						
			//On renome l'image de facon aleatoire
			$ext=strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
			$fichier =uniqid().'.'.$ext;
			
			//Début des vérifications de sécurité...
			if($_FILES['photo']['error']>0)   //On verifie si l'image n'est pas vide
			{
				$erreurFichier ="<font color='red'>Changer le fichier t&eacute;l&eacute;vers&eacute; SVP...</font>";$VarErreur="ok";
			}
			if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
			{
				$erreurExt ="<font color='red'>Vous devez t&eacute;l&eacute;verser un fichier de type jpg, jpeg, JPG ou JPEG</font>";$VarErreur="ok";
			}
			if($taille>$taille_maxi)
			{
				$erreurTaille = "<font color='red'>Le fichier est trop gros...</font>";$VarErreur="ok";
			}
			if(empty($titre) || empty($resultat))
			{
				$erreurVal = "<font color='red'>Erreur : certains champs sont vides !</font>";$VarErreur="ok"; 
			}						
			if($titre==" ")
			{
				$erreurVide = "<font color='red'>Erreur : veuillez remplir les champs correctement !</font>";$VarErreur="ok"; 
			}
			if(!isset($VarErreur)) //S'il n'y a pas d'erreur lors du traitement, on upload et on ecrit la requette qui correspond a la bdd
			{			
				//On formate le nom du fichier ici...
				$fichier = strtr($fichier, 
				  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
				  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
				$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
				//Si la fonction renvoie TRUE, c'est que ça a fonctionné...
				move_uploaded_file($_FILES['photo']['tmp_name'], $dossier . $fichier);
					
				//Modification du article à partir de son id
				$listeModifArt = $pdo->ModifierArticle($idArticle,$idCat,$titre,$fichier,$resultat,$modifier,$dateDuJourMod); 
					$mesModifArt="<font color='red'>Modification effectuée avec succès</font>";	
				
				//Recupère les infos de article a partir de son id
				$listeDetail = $pdo->getArticleInfosById($idArticle); 
				$nbDetail=count($listeDetail);
				
				// Pagination d'article
				include('RegisterListeArticle.php');			
				include('vues/article/liste_article.php');
				break;		
			
			}
			else
				{
				// Echec de modification
				$mesErreurModif="<font color='red'>Modification à echouée</font>";
				//Recupère les infos de leaugue et du article a partir de son id
				$listeDetail = $pdo->getArticleEtCategorieInfosById($idArticle,$idCat); 
				$nbDetail=count($listeDetail);
				
				//Affiche la liste des categories
				$listeCat = $pdo->getListeCategorie(); 
				$nbCat=count($listeCat);
			
				include('vues/article/modif_article.php');
				break;
				}
		}
		else
			{
			//Reinsertion de l'ancienne photo
			$fichier=$ancienPhoto;
			//Modification du article à partir de son id
			$listeModif = $pdo->ModifierArticle($idArticle,$idCat,$titre,$fichier,$resultat,$modifier,$dateDuJourMod); 
			$mesModif="<font color='red'>Modification effectuée avec succès</font>";	
		
			//Recupère les infos de article a partir de son id
			$listeDetail = $pdo->getArticleInfosById($idArticle); 
			$nbDetail=count($listeDetail);
				
			// Pagination d'article
			include('RegisterListeArticle.php');			
			include('vues/article/liste_article.php');
			break;		
			}
	}

case "Supprimer_article":
	//Requête de suppression d'un staff dans la bdd
	if(isset($_GET['idArticle']))
	{
		$idArticle=$_GET['idArticle'];
		//on supprime l'article a partir de l'id
			$listeSup = $pdo->SupprimerArticle($idArticle);
				$nbDetail=count((is_countable($listeSup)?$listeSup:[]));
				$mesDelArt="<font color='green'>Suppression effectue avec succes</font>";
		// Pagination d'article
		include('RegisterListeArticle.php');
		include('vues/article/liste_article.php');
		break;							
	}

	





		
}
?>
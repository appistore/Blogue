<?php	
		// On met dans une variable le nombre de article qu'on veut par page
		$nombreDeArticleParPage = 5; // Essayez de changer ce nombre pour voir :o)
		
		//On récupère le nombre total de article 
		$listeNombre = $pdo->getNombreArticle();
		$nbNombreArticle=count($listeNombre);
		$totalDesArticle = $listeNombre['nb_article'];
		
		// On calcule le nombre de pages à créer
		$nombreDePages  = ceil($totalDesArticle / $nombreDeArticleParPage);
		 
		if (isset($_GET['page']))
		{
				$page = $_GET['page']; // On récupère le numéro de la page indiqué dans l'adresse
		}
		else // La variable n'existe pas, c'est la première fois qu'on charge la page
		{
				$page = 1; // On se met sur la page 1 (par défaut)
		}
		  
		// On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
		$premierArticleAafficher = ($page - 1) * $nombreDeArticleParPage;
		// Recupère la liste de tous les article enregistré et activé de la categorie Projet
		$listeArticlePage = $pdo->getListeArticleByPage($premierArticleAafficher,$nombreDeArticleParPage) ;
		$nbArticlePage=count($listeArticlePage);		
			if($nbArticlePage>0)
			{
				$mesListeS="<font color='red'>Résultat affiché avec succès </font>";
			}
			else 
			{
				$mesListeE="<font color='red'>Accun article enrégistré </font>";
			}	
	
	//************* Fin pagination******************************
?>	
<?php	
		// On met dans une variable le nombre de membre qu'on veut par page
		$nombreDeMembreParPage = 20; // Essayez de changer ce nombre pour voir :o)		
		
		//On récupère le nombre total de article 
		$listeNombre = $pdo->getNombreMembre();
		$nbNombreMembre =count($listeNombre);
		$totalDesMembre = $listeNombre['nb_membre'];
		
		// echo "zzzzzzzzzzzzzzz" . $totalDesMembre;
		
	
		// On calcule le nombre de pages à créer
		$nombreDePages  = ceil($totalDesMembre / $nombreDeMembreParPage);
		 
		if (isset($_GET['page']))
		{
				$page = $_GET['page']; // On récupère le numéro de la page indiqué dans l'adresse
		}
		else // La variable n'existe pas, c'est la première fois qu'on charge la page
		{
				$page = 1; // On se met sur la page 1 (par défaut)
		}
		  
		// On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
		$premierMembreAafficher = ($page - 1) * $nombreDeMembreParPage;
		// Recupère la liste de tous les membre enregistré et activé de la categorie Projet
		$listeMembrePage = $pdo->getListeMembreByPage($premierMembreAafficher,$nombreDeMembreParPage) ;
		$nbMembrePage=count($listeMembrePage);		
			if($nbMembrePage>0)
			{
				$mesListeS="<font color='red'>Résultat affiché avec succès </font>";
			}
			else 
			{
				$mesListeE="<font color='red'>Accun membre enrégistré </font>";
			}	
	
	//************* Fin pagination******************************
?>	
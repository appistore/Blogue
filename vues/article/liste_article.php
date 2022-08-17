<?php
if(isset($_SESSION['emailMembre']) && isset($_SESSION['statutMembre']) && ($_SESSION['statutMembre']=='active'))
{?>

	
	<body>
		<!--navbar  -->
		<nav class="navbar navbar-default" role="navigation">	
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu_entete">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#"></a>
		</div>
		<div class="collapse navbar-collapse" id="menu_entete">
		  <ul class="nav navbar-nav">
			<li><a href="index.php"><i class="fa fa-home"></i> Blogue</a></li>
				<?php
				if(!isset($_SESSION['emailMembre']) && !isset($_SESSION['statutMembre']))
				{?>
				 <li><a href="?controller=login&action=login"> Connexion</a> </li>
				 <?php } ?> 
				<?php
				if(isset($_SESSION['emailMembre']) && isset($_SESSION['statutMembre']) && ($_SESSION['statutMembre']=='active') && isset($_SESSION['nomGroupe']) && ($_SESSION['nomGroupe']=='admin') && isset($_SESSION['statutGroupe']) && ($_SESSION['statutGroupe']=='active'))
				{?>
				<li><a href="?controller=article&action=ajout_article">Ajouter un article</a></li>				   
				<li><a class="active" class="active" href="?controller=article&action=liste_article">Liste des articles</a></li>					   
				<li><a href="?controller=membre&action=profil_membre">Mon Profil</a></li>				   
				<li><a href="vues/login/deconnexion.php">D&eacute;connexion</a></li>					   
				<?php } ?>	
		  </ul>
		  <ul class="nav navbar-nav navbar-right">
		  </ul>
		</div> 
		</nav>	
		<!-- // navbar -->
		
		<div class="bienvenue"> 
		<?php
			if(isset($_SESSION['nomMembre']))
			{
				echo 'Bienvenue '.$_SESSION['nomMembre']; 
				
			}
		?>	
		</div>
		
		<!--Corps -->
		<div class="file">
		  <h1>Liste des articles du Blogue</h1>
		</div>
		<!--Message d'erreur  -->
		<?php 
		include('ErorArticle.php');
		 ?>	
		<!--//Message d'erreur -->
		<div class="space"></div>	
		<div class="space"></div>	
		<div class="container">
			<div class="row">
				<div class="col-md-2">
				</div>
				<div class="col-md-8">	
						<?php 
						if(isset($nbArticlePage) && $nbArticlePage>0)
						{?>	
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th>id</th>
									<th>Caterogrie</th>
									<th>Titre</th>
									<th>Statut</th>
									<th colspan="5">Action</th>
								</tr>
							</thead>
						<?php
						foreach ($listeArticlePage as $data)
						{
						$idArticle = $data['idArticle'];
						$idCat = $data['idCat'];
						$user_image = $data['photo'];
						$user_titre = $data['titre'];
						$user_contenu = $data['contenu'];
						$statutArticle = $data['statutArticle'];
						//Conversion de la date au format francais
						$user_date = $data['dateDuJour'];			
						$date=explode('-',$user_date);
						$user_dateNew=$date['2'].'/'.$date['1'].'/'.$date['0'];
						//Recupère les infos de la categorie a partir de son id
						$liste = $pdo->getCategorieInfosById($idCat);
						$nb=count($liste);
						$descriptionCat=$liste['descriptionCat'];			
						?>		
						<tbody id="myTable">
							<tr class="success">
								<td><?php if(isset($idArticle)) echo $idArticle;?></td>
								<td><?php if(isset($descriptionCat)) echo $descriptionCat;?></td>
								<td><?php if(isset($user_titre)) echo $user_titre;?></td>
								<td><?php if(isset($statutArticle)) echo $statutArticle;?></td>
								<td style="background:#1e90ff"><a href="?controller=article&action=detail_article&idArticle=<?php if(isset($idArticle)) echo $idArticle;?>" title="Afficher la fiche de l'article" style="color:#fff"> <i class="fa fa-search fa-fw"></i> </a></td>
								<!----->
								<td style="background:#ffa500"><a href="?controller=article&action=Active_article&idArticle=<?php if(isset($idArticle)) echo $idArticle;?>" title="Activer article" style="cursor:pointer;color:#fff"><i class="fa fa-share fa-fw"></i></a></td>
								<td style="background:#7b68ee"><a href="?controller=article&action=Desactive_article&idArticle=<?php if(isset($idArticle)) echo $idArticle;?>" title="Désactiver article" style="cursor:pointer;color:#fff"><i class="fa fa-remove fa-fw"></i> </a></td>
								<!----->
								<td style="background:#ff4500"><a href="?controller=article&action=RecupModifier_article&idArticle=<?php if(isset($idArticle)) echo $idArticle;?>&idCat=<?php if(isset($idCat)) echo $idCat;?>" title="Modifier la fiche de l'article" style="color:#fff"><i class="fa fa-edit fa-fw"></i></a></td>
				
								<td style="background:#32cd32"><span onClick="confirme(<?php if(isset($idArticle)) echo $idArticle;?>)" title="Supprimer l'article" style="cursor:pointer;color:#fff"><i class="fa fa-trash fa-fw"></i></td>
							</tr>
						</tbody>
						<?php }	?> 
						</table>
						<?php }	?>
						<div class="space"></div>	
						
						<!----------- Debut Pagination suite ----------------> 
						<?php
						if(isset($nombreDePages))
						{
							echo '<ul class="pagination pagination-sm">';
							// echo 'Page : ';
							// Puis on fait une boucle pour écrire les liens vers chacune des pages
							for ($i = 1 ; $i <= $nombreDePages ; $i++)
							{
							   echo '<li><a href="?controller=article&action=liste_article&page=' . $i . '" title="page ' . $i . '">' . $i . '</a> </a></li>';
							}
							 echo'</ul>';
						}
						?>	
						<br />
						<br />
						<?php echo 'TOTAL : '.$nbArticlePage. ' article (s) enr&eacute;gistr&eacute;(s)'; ?>
						<div class="space"></div>
				</div>	
				<div class="col-md-2">
				</div>
			</div>	
		</div>	
		<!--//Corps -->
	</body>
</html>
<?php } ?>

		
		
		
<!--******************************************  Message js  **************************************************-->		

<!--Fonction de suppression -->
<script language="javascript">
      function confirme( identifiant )
      {
        var confirmation = confirm( "Voulez vous vraiment supprimer cet article ?" ) ;
		if( confirmation )
		{
		  document.location.href = "index.php?controller=article&action=Supprimer_article&idArticle="+identifiant ;
		}
      }
</script> 

 <?php 
	if(isset($mesModifArt) || isset($mesModif)) { ?>
		<script>
			alert ('Modification effectuée avec succès');
		</script>
 <?php  } ?>
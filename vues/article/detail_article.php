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
				<li><a class="active" href="?controller=article&action=liste_article">Liste des articles</a></li>					   
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
		  <h1>Détail de l'article</h1>
		</div>
		<?php	
		//Conversion de la date au format francais
		$user_date = $listeArtInfo['dateDuJour'];			
		$date=explode('-',$user_date);
		$user_dateNew=$date['2'].'/'.$date['1'].'/'.$date['0'];	
		{?>	 	
		<div class="container">
			<div class="main">
				<div class="col-md-1">
				</div>
				<div class="col-md-2">
					<div class="space"></div>
					<div class="space"></div>
					<a class="" href="#">
						<img class="img_responsive" src="<?php echo $repertoire.$listeArtInfo['photo']; ?>" alt="" />
					</a>
					<div class="space">  </div>
					<table class="table table-bordered table-striped table-hover">	
						<tbody id="myTable">
							<tr class="success">
								<td style="background:#ff4500"><a href="?controller=article&action=RecupModifier_article&idArticle=<?php if(isset($listeArtInfo['idArticle'])) echo $listeArtInfo['idArticle'];?>&idCat=<?php if(isset($idCat)) echo $idCat;?>" title="Modifier la fiche de l'article" style="color:#fff"><i class="fa fa-edit fa-fw"></i></a></td>
				
								<td style="background:#32cd32"><span onClick="confirme(<?php if(isset($listeArtInfo['idArticle'])) echo $listeArtInfo['idArticle'];?>)" title="Supprimer l'article" style="cursor:pointer;color:#fff"><i class="fa fa-trash fa-fw"></i></td>
							</tr>
						</tbody>
					</table>
				</div>	
				<div class="col-md-8">
					<div class="caption">
						<div class="space">  </div>
						<a class="" href="?controller=article&action=detail_article&idArticle=<?php if(isset($listeArtInfo['idArticle'])) echo $listeArtInfo['idArticle']; ?>">
							<h4 style="color:#ff4500;font-weight:bold;">
								<?php if(isset($listeArtInfo['titre'])) echo  htmlspecialchars_decode($listeArtInfo['titre']) ;?>
							</h4>
						</a>
						<p><?php if(isset($user_dateNew)) echo 'Cr&eacute;e le : ' .$user_dateNew;?></p>
						<p style="text-align:justify;"><?php if(isset($listeArtInfo['contenu'])) echo  htmlspecialchars_decode($listeArtInfo['contenu']); ?> </p>
						<p class="cat"><?php if(isset($libCat)) echo 'Cat&eacute;gorie : ' .$libCat;?></p>
					</div>
					<div class="space">  </div>
				</div>
			</div>
		</div>
		<?php }	?> 
		
		
		
		</div>
		<!--//Corps -->
	</body>


		
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
	
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
		  <h1>Modification d'un article</h1>
		</div>
		<!--Message d'erreur  -->
		<?php 
		include('ErorArticle.php');
		 ?>	
		<!--//Message d'erreur -->	
		
		<div class="space"> </div> 
		<div class="container">
			<div class="row">
				<div class="col-md-2">
				</div>
				<div class="col-md-8">	
					<!--Forulaire d'article  -->
					<form method="post" enctype="multipart/form-data" action="?controller=article&action=RegisterModifier_article&idArticle=<?php if(isset($listeDetail['idArticle'])) echo $listeDetail['idArticle']; ?>">					
					<div class="thumbnail" style="box-shadow: 2px 2px 20px black; background:#CFE2F1;"> 
						<p class="p2">Catégorie<font color="red">*</font> :</p> 						
							<?php
								if($nbCat>0)
								{?>
							
							<select name="idCat" class="form-control" required="">
							<option value="choix">-- Choix catégorie --</option>
							<?php
								foreach($listeCat as $list)
								{?>
							<option value="<?php echo $list['idCat'];?>"<?php if(isset($idCat) AND $idCat==$list['idCat']) echo "selected";?>><?php echo $list['descriptionCat'];?></option>
									
							<?php	}?>
							</select><?php if(isset($erreurCat)) echo $erreurCat; ?>
							<?php	}?>	
						<div class="space"> </div>						
						<p class="p2">Titre<font color="red">*</font> :</p> 
						<input type="text" name="titre" class="form-control" value="<?php if(isset($listeDetail['titre'])) echo htmlspecialchars_decode($listeDetail['titre']); ?>" required="" class="form_text">
						
						<div class="space"> </div>
							<!--On limite la taille de ll'avatar a 5Mo-->
							<input type="hidden" name="MAX_FILE_SIZE" value="5000000">						
							<p class="p2">Image/Photo<font color="red"> </font> :</p> 
							<input type="file" name="photo"  class="form-control"/>
						<div class="space"> </div>								
						<p class="p2">Contenu<font color="red">*</font> :</p> 
						<textarea id="resultat" style="height: 120px;" name="resultat" class="form-control"><?php if(isset($listeDetail['contenu'])) echo  stripslashes(htmlspecialchars_decode($listeDetail['contenu'])); ?></textarea>
						<div class="space"> </div>
						<div class="space"> </div> 
						<input class="btn_submit" id="submit" type="submit" value="MODIFIER" name="okModif" />
						<input type="hidden" name="ancienPhoto" value="<?php if(isset($listeDetail['photo'])) echo $listeDetail['photo']; ?>" />
						<div class="space"> </div>
						<div class="space"> </div> 
					</div>


					
				</form>
					<a href="?controller=article&action=liste_article"><input class="btn_submit_retour" type="submit" value="RETOUR" /></a>
					<div class="space"> </div> 
				</div>
				<div class="col-md-2">
				</div>
			</div>
		</div>
		<!--//Corps -->
	</body>
<?php } ?>

		
		
		
		
<!--******************************************MENU messages js **************************************************-->

<?php 
	if(isset($mesArtEng)) { ?>
		<script>
			alert ('Enregistrement effectué avec succès');
		</script>
 <?php  } ?> 
 
<!--Fonction d'erreur -->
<script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
}
</script>

<style>
.alert {
    padding: 20px;
    background-color: #f44336;
    color: white;
    opacity: 1;
    transition: opacity 0.6s;
    margin-bottom: 15px;
}

.alert.success {background-color: #4CAF50;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}

.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
}
</style>	

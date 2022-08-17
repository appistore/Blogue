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
				<li><a href="?controller=article&action=liste_article">Liste des articles</a></li>					   
				<li><a class="active" href="?controller=membre&action=profil_membre">Mon Profil</a></li>				   
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
		  <h1>Mon Profil</h1>
		</div>
		
        <div class="container">
			<div class="row">
				<div class="col-md-3">	
					<!--Message d'erreur membre -->
					<?php 
					include('vues/membre/ErorMembre.php');
					 ?>	
					<!--//Message d'erreur -->	
				</div>							
				<div class="col-md-6">							
					<div class="thumbnail" style="background:rgb(244,194,96);">
						<div class="caption" style="background:#fff;">
						<p style="color:#000;background:rgb(244,194,96);;font-size:1.2em;"><i class="fa fa-home fa-fw"></i>  Mon Profil</p>
						<form class="form" method="post" action="?controller=membre&action=RegisterModifier_membre">
						<div class="form-group">
							<label for="emailMembre" class="cols-sm-2 control-label">Votre Email</label> <font color="red"> *</font>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="email" class="form-control" name="emailMembre" id="emailMembre"  value="<?php if(isset($_SESSION['emailMembre'])) echo $_SESSION['emailMembre']; ?>"/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="nomMembre" class="cols-sm-2 control-label">Votre nom</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="nomMembre" id="nomMembre"  value="<?php if(isset($_SESSION['nomMembre'])) echo $_SESSION['nomMembre']; ?>"/>
								</div>
							</div>
						</div>	
						<div class="form-group">
							<label for="telMembre" class="cols-sm-2 control-label">Votre T&eacute;l&eacute;phone</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-phone fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="telMembre" id="telMembre"  value="<?php if(isset($_SESSION['telMembre'])) echo $_SESSION['telMembre']; ?>"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<a href="?controller=membre&action=edit_mdpMembre"> Modifier mon mot de passe ?</a><br />
								</div>
							</div>
						</div>
						<div class="space"></div>	
						<div class="space"></div>	
						<div class="row">
							<div class="col-xs-6 col-sm-6 col-md-6">
								<input type="submit" name="okModifMembre" class="btn btn-lg btn-success btn-block" value="Modifier" />
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<a href="index.php" class="btn btn-lg btn-primary btn-block">Sortir</a>
							</div>
						</div>	
						</form>	
						</div>
					</div>
				</div>
				<div class="col-md-3">	
				</div>
			
		</div>
	</div>

		<!--//Corps -->
	</body>
</html>



<?php } ?>



<!--******************************************  Message js  ***************************************-->

<?php 
	if(isset($mesEngMemb)) { ?>
		<script>
			alert ('Enr�gistrement effectu� avec succes ');
		</script>
<?php  } ?>	


<?php 
	if(isset($mesModifMembre)) { ?>
		<script>
			alert ('Modification effectu&eacute;e avec succ�s ');
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
    padding: 5px;
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


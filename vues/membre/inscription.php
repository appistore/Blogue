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
				<li><a  class="active" href="?controller=login&action=login">Connexion</a></li>	
		  </ul>
		  <ul class="nav navbar-nav navbar-right">
		  </ul>
		</div> 
		</nav>	
		<!-- // navbar -->
		
		<!--Corps -->
		<div class="file">
		  <h1>Créer un compte</h1>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!--Message d'erreur membre -->
					<?php 
					include('vues/membre/ErorMembre.php');
					 ?>	
					<!--//Message d'erreur -->	
				</div>
			</div>
		</div>
		<div class="space"></div>
		<div class="space"></div>
        <div class="container">
			<div class="row">
				<div class="col-md-3">	
				</div>							
				<div class="col-md-6">	
			<form method="post" enctype="multipart/form-data" action="?controller=membre&action=RegisterAjoutMembre">	
				<fieldset>	
				<div class="form-group">
					<label for="emailMembre" class="cols-sm-2 control-label">Choix du grouoe</label> <font color="red"> *</font>
					<div class="cols-sm-10">
						<div class="input-group">
								<?php
									if($nbGroupe>0)
									{?>
								
								<select name="idGroupe" class="form-control" required="">
								<option value="choix">-- Choix Groupeégorie --</option>
								<?php
									foreach($listeGroupe as $list)
									{?>
								<option value="<?php echo $list['idGroupe'];?>"<?php if(isset($idGroupe) AND $idGroupe==$list['idGroupe']) echo "selected";?>><?php echo $list['nomGroupe'];?></option>
										
								<?php	}?>
								</select>
								<?php	}?>	
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="emailMembre" class="cols-sm-2 control-label">Votre Email</label> <font color="red"> *</font>
					<div class="cols-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
							<input type="email" class="form-control" name="emailMembre" id="emailMembre"  placeholder="Entrer votre Email" required=""/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="pwdMembre" class="cols-sm-2 control-label">Mot de passe</label> <font color="red"> *</font>
					<div class="cols-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
							<input type="password" class="form-control" name="pwdMembre" id="pwdMembre"  placeholder="Entrer votre Mot de passe" required=""/>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="pwdConfMembre" class="cols-sm-2 control-label">Confirmer Mot de passe</label><font color="red"> *</font>
					<div class="cols-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
							<input type="password" class="form-control" name="pwdConfMembre" id="pwdConfMembre"  placeholder="Confirm votre Mot de passe" required=""/>
						</div>
					</div>
				</div>	
				<div class="form-group">
					<label for="nomMembre" class="cols-sm-2 control-label">Votre nom</label><font color="red"> *</font>
					<div class="cols-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
							<input type="text" class="form-control" name="nomMembre" id="nomMembre"  placeholder="Entrer votre Nom" required=""/>
						</div>
					</div>
				</div>	

				<div class="form-group">
					<label for="telMembre" class="cols-sm-2 control-label">Votre Téléphone</label><font color="red"> *</font>
					<div class="cols-sm-10">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-phone fa" aria-hidden="true"></i></span>
							<input type="text" class="form-control" name="telMembre" id="telMembre"  placeholder="Entrer votre Téléphone" required=""/>
						</div>
					</div>
				</div>
				<hr class="colorgraph">		
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
                        <input type="submit" name="ok" id="submit" class="btn btn-lg btn-success btn-block" value="Créer mon compte" />
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<a href="?controller=login&action=login" class="btn btn-lg btn-primary btn-block">J'ai déjà un compte</a>
					</div>
				</div>	
		</form>
			</div>
		<div class="col-md-3">	
		</div>
			
		</div>
	</div>
	<div class="space"></div>
		<!--//Corps -->
	</body>
</html>



<!--**********************************  Message js  ****************************-->	

 <?php 
	if(isset($mesEngMemb) || isset($mesEngMemb)) { ?>
		<script>
			alert ('Enrégistrement effectuée avec succès');
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


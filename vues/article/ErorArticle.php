
				<!--Message d'erreur -->
				<?php 
				if(isset($mesErreurArt))
				{?>
				<div class="alert">
				  <span class="closebtn">&times;</span>  
				  <strong>Erreur!</strong> <?php  echo $mesErreurArt ?>
				</div>
				<?php } ?>
				<?php 
				if(isset($erreurCat))
				{?>
				<div class="alert">
				  <span class="closebtn">&times;</span>  
				  <strong>Erreur!</strong> <?php  echo $erreurCat ?>
				</div>
				<?php } ?>
				<?php 
				if(isset($mesDoublonEl))
				{?>
				<div class="alert">
				  <span class="closebtn">&times;</span>  
				  <strong>Erreur!</strong> <?php  echo $mesDoublonEl ?>
				</div>
				<?php } ?>
				<?php 
				if(isset($erreurFichier))
				{?>
				<div class="alert">
				  <span class="closebtn">&times;</span>  
				  <strong>Erreur!</strong> <?php  echo $erreurFichier ?>
				</div>
				<?php } ?>	
				<?php 
				if(isset($erreurExt))
				{?>
				<div class="alert">
				  <span class="closebtn">&times;</span>  
				  <strong>Erreur!</strong> <?php  echo $erreurExt ?>
				</div>
				<?php } ?>		
				<?php 
				if(isset($erreurTaille))
				{?>
				<div class="alert">
				  <span class="closebtn">&times;</span>  
				  <strong>Erreur!</strong> <?php  echo $erreurTaille ?>
				</div>
				<?php } ?>
				<!--//Message d'erreur -->
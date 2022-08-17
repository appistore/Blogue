
				<!--Message d'erreur -->
				<?php  
				// Fonction controleInserMembre	
				if (isset($mesErreurMembre)) 
				{
					foreach($mesErreurMembre as $erreur)
					{?>
					<div class="alert">
					  <span class="closebtn">&times;</span>  
					  <strong>Erreur!</strong> <?php  echo $erreur ?>
					</div>
					<?php } ?>
				<?php } ?>
				
				<?php 
				if(isset($mesDoublonMembre))
				{?>
				<div class="alert">
				  <span class="closebtn">&times;</span>  
				  <strong>Erreur!</strong> <?php  echo $mesDoublonMembre ?>
				</div>
				<?php } ?>
				
				
				<?php 
				if(isset($mesDoublonMembreEmail))
				{?>
				<div class="alert">
				  <span class="closebtn">&times;</span>  
				  <strong>Erreur!</strong> <?php  echo $mesDoublonMembreEmail ?>
				</div>
				<?php } ?>
				
				<?php 
				if(isset($mesErreurModif))
				{?>
				<div class="alert">
				  <span class="closebtn">&times;</span>  
				  <strong>Erreur!</strong> <?php  echo $mesErreurModif ?>
				</div>
				<?php } ?>
				
				<?php 
				if(isset($mesMembreMdp))
				{?>
				<div class="alert">
				  <span class="closebtn">&times;</span>  
				  <strong>Erreur!</strong> <?php  echo $mesMembreMdp ?>
				</div>
				<?php } ?>		
				<?php 
				if(isset($mesErreurEnrg))
				{?>
				<div class="alert">
				  <span class="closebtn">&times;</span>  
				  <strong>Erreur!</strong> <?php  echo $mesErreurEnrg ?>
				</div>
				<?php } ?>		
				<?php 
				if(isset($ErreurPassword))
				{?>
				<div class="alert">
				  <span class="closebtn">&times;</span>  
				  <strong>Erreur!</strong> <?php  echo $ErreurPassword ?>
				</div>
				<?php } ?>	
				<?php 
				if(isset($mesEreurPassword))
				{?>
				<div class="alert">
				  <span class="closebtn">&times;</span>  
				  <strong>Erreur!</strong> <?php  echo $mesEreurPassword ?>
				</div>
				<?php } ?>	
				<!--//Message d'erreur -->
				
				
				
				<!--Message succes -->
				
				<?php 
				if(isset($mesEngMemb))
				{?>
				<div class="alert_success">
				  <span class="closebtn">&times;</span>  
				  <strong> </strong> <?php  echo $mesEngMemb ?>
				</div>
				<?php } ?>
				
				<!--//Message succes -->
				
				
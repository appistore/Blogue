
				<!--Message d'erreur -->
				<?php 
				if(isset($mesEchecLogin))
				{?>
				<div class="alert">
				  <span class="closebtn">&times;</span>  
				  <strong>Erreur!</strong> <?php  echo $mesEchecLogin ?>
				</div>
				<?php } ?>
				<!--//Message d'erreur -->
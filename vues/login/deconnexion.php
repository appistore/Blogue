<?php
session_start();
if(isset($_SESSION['emailMembre']))
{
	//Si on clique sur le bouton deconnexion, on detruit les variables de session de celui qui est connecté
	session_destroy();
	header('Location:../../index.php?controller=login&action=login');
	exit;
	
}

?>
<?php 
if(isset($_GET['action']))
{
	$action=$_GET['action'];
}
else
{
	$action='deconnexion';
}
switch ($action)
{
case "deconnexion":		
		// Si on clique sur le bouton deconnexion, on detruit les variables de session de celui qui est connecté
		session_destroy();
		include('authen/index.php');
		break;
}	


?>
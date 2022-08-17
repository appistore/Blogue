<?php 
if(isset($_GET['action']))
{
	$action=$_GET['action'];
}
else
{
	$action='login';
}
switch ($action)
{
case "login":
	include('vues/login/login.php');
	break;	
	

case "RegisterLogin":
	if(isset($_POST['emailMembre'])  && isset($_POST['pwdMembre']))
	{
		$emailMembre=(htmlspecialchars(trim($_POST['emailMembre'])));
		$pwdMembre=(htmlspecialchars(trim($_POST['pwdMembre'])));
		
		//Codage en md cinq
		$pwdMembre=md5($pwdMembre);
							
		//Recupère 
		$listeLogin = $pdo->VerifLoginMembre($emailMembre,$pwdMembre);
		$nbLogin=count((is_countable($listeLogin)?$listeLogin:[]));
		if(isset($nbLogin) AND $nbLogin>1)
		{
			$_SESSION['idMembre']=$listeLogin['idMembre'];
			$_SESSION['pwdMembre']=$listeLogin['pwdMembre'];
			$_SESSION['emailMembre']=$listeLogin['emailMembre'];
			$_SESSION['nomMembre']=$listeLogin['nomMembre'];
			$_SESSION['telMembre']=$listeLogin['telMembre'];
			$_SESSION['statutMembre']=$listeLogin['statutMembre'];
			$_SESSION['dateDuJour']=$listeLogin['dateDuJour'];
			
			$_SESSION['nomGroupe']=$listeLogin['nomGroupe'];
			$_SESSION['statutGroupe']=$listeLogin['statutGroupe'];
			
				
			if(isset($_SESSION['nomGroupe']) && $_SESSION['nomGroupe']=='admin')
			{
				echo '<script language="javascript">document.location="index.php"</script>';
				break;				
			}		
				
			if(isset($_SESSION['nomGroupe']) && $_SESSION['nomGroupe']=='membre')
			{
				echo '<script language="javascript">document.location="index.php"</script>';
				break;				
			}		
	
		}
		else
		{			
			$mesEchecLogin="Login ou mot de passe incorrect";
			include('vues/login/login.php');
			break;		
		}
	 }		






	   
	   
	   
	   
	   
	   		
}
?>
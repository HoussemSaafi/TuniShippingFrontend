<?php
	require_once('session.php');
require_once("../cruds/crudClient.php");
	$client_logout = new crudClient();
	$client_id = $_SESSION['user_session'];
	
	if($client_logout->is_loggedin()!="")
	{
		$client_logout->redirect('profile.php');
	}
	if(isset($_GET['logout']) && $_GET['logout']=="true")
	{   $client_logout->Client_deconnecte($client_id);
		$client_logout->doLogout();
		$client_logout->redirect('index.php');
	}
	elseif ($_GET['desactiver']) 
	{  
		$client_logout->desactivercompte($client_id);
        $client_logout->Client_deconnecte($client_id);
		$client_logout->doLogout();
		$client_logout->redirect('index.php?desactiversucces');
	}

?>
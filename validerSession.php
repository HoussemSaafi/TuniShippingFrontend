<?php
session_start();
    include 'commande.php';
	$c=new Commande();
	
	$username=$_POST['username'];
	$mdp=$_POST['mdp'];
  //  $_SESSION['uname']=$username;
   // $_SESSION['mdp']=mdp;
	if($c->ValiderSession($username,$mdp))
	{//$_SESSION['khorma']=$c->idClient;
        var_dump($_SESSION['user_session']);
	    //var_dump($c->idClient);
	    $_SESSION['user_id']=$c->idClient;
	    //var_dump( $_SESSION['user_id']);
		header('Location:remplirAdresse.php');
        }
		
	else{echo "erreur client<br>";}
	


?>
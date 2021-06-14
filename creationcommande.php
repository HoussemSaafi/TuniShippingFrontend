<?php

include 'livraison.php';
include 'commande.php';
if(!isset($_SESSION)) session_start();
	$c=new Commande();
	$prix=$c->CalculerPrixTotale();
	$c->ajouterCommande();
	$l=new Livraison();

	$l->detailleLivraison("",$_SESSION['adresse'],$_SESSION['user_session']);
	$l->creerLivraison();
?>
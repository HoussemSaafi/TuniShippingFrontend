<?php
 


include 'livraison.php';
include 'commande.php';
//if (isset($_POST['submit'])||isset($_SESSION['payement'])) {
	# code...
if(!isset($_SESSION)) session_start();
	$c=new Commande();
//	if (($_SESSION['payement']==0) || (!isset($_SESSION['payement']))) {
//		$c->etatPaiment="false";
//
//	}
//	elseif ($_SESSION['payement']==1) {
//		$c->etatPaiment="true";
//
//	}
	$prix=$c->CalculerPrixTotale();
	$c->ajouterCommande();
  //  ($_SESSION['panier']['idProduit']);
	$l=new Livraison();

	$l->detailleLivraison("",$_SESSION['adresse'],$_SESSION['user_session']);
	$l->creerLivraison();
?>
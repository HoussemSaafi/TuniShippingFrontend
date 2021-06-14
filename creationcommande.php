<?php
include_once 'ConnexionBD.php';
$conn=ConnexionBD::getInstance();
//include 'livraison.php';
include 'commande.php';
if(!isset($_SESSION)) session_start();
	$c=new Commande();
	$prix=$c->CalculerPrixTotale();
	$c->ajouterCommande();
	//$l=new Livraison();
    //$l->dateLivraison="";
    //$l->adresse=$_SESSION['adresse'];
    //$l->idClient=$_SESSION['user_session'];
	//$l->detailleLivraison("",$_SESSION['adresse'],$_SESSION['user_session']);
	//$l->creerLivraison();
    $sql="INSERT into livraison (DateLivraison,etatLivraison,IDCommande,adresse,IDClient)	values(CURDATE(),'Approuvée',".$_SESSION['idCommande'][0].",'".$_SESSION['adresse']."',".$_SESSION['user_session'].")";
			var_dump($sql);
			$res=$conn->query($sql);
			var_dump($res);
			if($res)
            {
                echo "<br>Votre Commande et livraison ont été ajoutés avec Succes!<br>";
                $_SESSION['panier']['prixProduit']= array();
                $_SESSION['panier']['idProduit']=array();
                $_SESSION['panier']['qte']=array();
                echo"<a href='index.php'> Rentrez au Shop </a>";
                //header('');
            }
            else{
                $_SESSION['panier']['prixProduit']= array();
                $_SESSION['panier']['idProduit']=array();
                $_SESSION['panier']['qte']=array();
                echo "<br>livraison non ajoutée<br>";
                echo"<a href='index.php'> Rentrez au Shop </a>";
                ;}
?>
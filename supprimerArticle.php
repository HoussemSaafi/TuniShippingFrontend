<?php
session_start();


$_SESSION['idProduit']=$_GET['idProduit'];
$possupprimer= array_search($_SESSION['idProduit'],$_SESSION['panier']['idProduit']);
if($possupprimer!==false)
{
unset($_SESSION['panier']['idProduit'][$possupprimer]);
unset($_SESSION['panier']['qte'][$possupprimer]);
unset($_SESSION['panier']['prixProduit'][$possupprimer]);
}
 header('Location: '.$_SESSION['thispage']);
?>




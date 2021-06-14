<?php
session_start();
include_once ('class.user.php');
require_once('ConnexionBD.php');
$conn=ConnexionBD::getInstance();
if (isset($_SESSION['user_session'])) {
	$user_id = $_SESSION['user_session'];
	$auth_user = new USER();
	$stmt = $auth_user->runQuery("SELECT * FROM client WHERE IDclient=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$auth_user->User_connecte($user_id);
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
}
$_SESSION['idProduit']=$_POST['idProduit'];

$posmodif= array_search($_SESSION['idProduit'],$_SESSION['panier']['idProduit']);
if($posmodif!==false)
{
	if($_POST['quantite']>0){
		$requette="SELECT Quantite from produit where Designation='".$_SESSION['idProduit']."'";
					$resultat=$conn->query($requette);
					$qtedispo=$resultat->fetchAll();
						foreach ($qtedispo as $v) {
							# code...
						
						if ($v['Quantite']>$_POST['quantite']) {
							$_SESSION['panier']['qte'][$posmodif]=$_POST['quantite'];
						}	
						else
							echo "kdjf";
						}

}
else
{

}
}
 header('Location: consulterPanier.php');
?>




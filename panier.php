<?php

 session_start();
try
				{
				/*	$db = new PDO('mysql:host=localhost;dbname=site-e-commerce', 'root','');
					$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);//les noms de champs seront en caractères miniscules
					$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);//les erreurs lanceront des exceptions
				*/}
	
	catch(Exception $e){
		
		die('Une erreur est survenue');
		
	}
//require_once('includes/header.php');

// require_once('includes/header.php');
// require_once('includes/sidebar.php');
//require_once('includes/paypal.php');



?>
<head>
<meta charset="UTF-8">
	<title>Panier - DecArt</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>

	<div id="page">
		<div id="header">
		<script type="text/javascript" src="http://counter5.freecounter.ovh/private/countertab.js?c=c83a7f0b98c7812ee0dd62755d24ce5d"></script>
<noscript><a href="http://www.compteurdevisite.com" title="compteur"><img src="http://counter5.freecounter.ovh/private/compteurdevisite.php?c=c83a7f0b98c7812ee0dd62755d24ce5d" border="0" title="compteur" alt="compteur"></a>
</noscript>
			<div id="logo">
			
				<a href="index.php"><img src="images/logo.png" alt="LOGO"></a>
			</div>
			
			<div id="navigation">
				<a href="panier.php" class="cart"></a>
				<ul>
					<li>
						<a href="index.php">Acceuil</a>
					</li>
					<li>
						<a href="sidebar.php">Les nouveautés</a>
					</li>
					<li>
						<a href="boutique.php">Boutique</a>
					</li>
					<li class="selected">
						<a href="panier.php">Panier</a>
					</li>
					<li>
						<a href="conditions_generales_de_vente.php">Conditions Générales de Vente</a>
					</li>
					<li>
					<?php if(!isset($_SESSION['user_id'])){?>
						<a href="register.php">S'inscrire</a>
					</li>
					<li><a href="connect.php">Sign In</a></li>
			<?php }else{ ?>
					<li>
						<a href="my_account.php">Mon compte</a>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>















<div id="contents">
			<div id="adbox">
				<img src="images/perfume-adNew.jpg" style="margin-top:2px" height="157" alt="Img">
			</div>
			<div id="shop" class="body">
				<h2>Shop</h2>
				<a href="boutique.php" class="btn"></a>
				<p class="message">
					Phasellus nec elementum quam. Vivamus at lectus purus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. <a href="index.php" class="more">&gt;&gt;&gt; Learn More</a>
				</p>
				

<?php

$erreur = false;

$action=(isset($_POST['action'])?$_POST['action']:(isset($_GET['action'])?$_GET['action']:null));

if($action!==null){
	if(!in_array($action, array('ajout','suppression','refresh')))
		$erreur = true;
		
		$l=(isset($_POST['l'])?$_POST['l']:(isset($_GET['l'])?$_GET['l']:null));
		$q=(isset($_POST['q'])?$_POST['q']:(isset($_GET['q'])?$_GET['q']:null));
		$p=(isset($_POST['p'])?$_POST['p']:(isset($_GET['p'])?$_GET['p']:null));
		
		$l = preg_replace('#\v#', '', $l);
		
		$p = floatval($p);
		
		if(is_array($q)){
			$QteArticle = array();
			
			$i=0;
			
			foreach($q as $contenu){
				$QteArticle[$i++] = intval($contenu);
			}
		}else{
			$q=intval($q);
		
	}
	
}

if (!$erreur){
	switch($action){
		Case "ajout":
		ajouterArticle($l,$q,$p);
		break;
		Case "suppression":
		supprimerArticle($l);
		break;
		Case "refresh" :
		for($i = 0 ; $i < count($QteArticle) ; $i++){
			if (isset($_SESSION['panier']['libelleProduit'][$i], $QteArticle[$i]))
			modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i], round($QteArticle[$i]));
			
		}
		break;
		Default:
		break;
		
		
	}
	
}
?>



<form method="post" action ="">
	<table width="400">
		<tr>
			<td colspan="4"><font color='#eabe60'>Votre panier</font></td>
		</tr>
		<tr>
			<td><font color='#eabe60'>Libellé produit</font></td>
			<td><font color='#eabe60'>Prix unitaire</font></td>
			<td><font color='#eabe60'>Quantité</font></td>
			<td><font color='#eabe60'>TVA</font></td>
			<td><font color='#eabe60'>Action</font></td>
		</tr>
		<?php
		
		if(isset($GET['deletepanier']) && $_GET['deletepanier'] == true){
			
			supprimerPanier();
		}
		
		if(creationPanier()){
		
		$nbProduits = count($_SESSION['panier']['libelleProduit']);
		
		if($nbProduits <= 0){
			echo'<br/><p style="font-size:20px; color:Red;">Panier vide !</p>' ;
			
		}else{
			$total = MontantGlobal();
			$totaltva = MontantGlobalTVA();
			
			if(isset($_SESSION['user_id'])){
$user_id = $_SESSION['user_id'];
$select = $db->query("SELECT pt_fid_user FROM users WHERE id = '$user_id'");
$s = $select->fetch(PDO::FETCH_OBJ);
$pt_fid_user = $s->pt_fid_user;
if($pt_fid_user >= 100)
{
	$remise=$pt_fid_user/100;
	$remise_final = floor ($remise);
			$shipping_initial = CalculFraisPorts();
			$porcentage_reduction = (CalculFraisPorts()*20)*$remise_final/100;
			$shipping = CalculFraisPorts() - $porcentage_reduction;
			

			$pt_fid_user = $pt_fid_user-(100*$remise_final);
			// $update = $db->query("UPDATE users SET pt_fid_user='$pt_fid_user' WHERE id='$user_id'");
}
else
{
			$shipping = CalculFraisPorts();
}
}
			$paypal = new Paypal();
			
			$params = array(
			'RETURNURL' => 'http://localhost/Site e-commerce/process.php',
			'CANCELURL' => 'http://localhost/Site e-commerce/cancel.php',
			
			'PAYMENTREQUEST_0_AMT' => $totaltva + $shipping,
			'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR',
			'PAYMENTREQUEST_0_SHIPPINGAMT' => $shipping,
			'PAYMENTREQUEST_0_ITEMAMT' => $totaltva
			);
			
			$response = $paypal->request('SetExpressCheckout', $params);
			
			if($response){
				$paypal = 'https://sandbox.paypal.com/webscr?cmd=_express-checkout&useraction=commit&token='.$response['TOKEN'].'';
				
			}
			else{
				var_dump($paypal->errors);
				die('Erreur');
				
				
			}
			
			
			for($i = 0; $i<$nbProduits; $i++) {
				?>
				
				<tr>
				<td><br/><font color='#eabe60'><?php echo $_SESSION['panier']['libelleProduit'][$i]; ?></font></td>
				<td><br/><font color='#eabe60'><?php echo $_SESSION['panier']['prixProduit'][$i];?></font></td>
				<td><br/><input name="q[]" value="<?php echo $_SESSION['panier']['qteProduit'][$i]; ?>" size="5"/></td>
				<td><br/><font color='#eabe60'><?php echo $_SESSION['panier']['tva']." %"; ?></font></td>
			<td><br/><a href="panier.php?action=suppression&amp;l=<?php echo rawurlencode($_SESSION['panier']['libelleProduit'][$i]); ?>"><font color='#eabe60'>X</font></a></td>
			
				</tr>
				<?php
				}
				?>
				
				<tr>
			<?php	if(isset($_SESSION['user_id'])){
$user_id = $_SESSION['user_id'];
$select = $db->query("SELECT pt_fid_user FROM users WHERE id = '$user_id'");
$s = $select->fetch(PDO::FETCH_OBJ);
$pt_fid_user = $s->pt_fid_user; ?>
				<?php if($pt_fid_user >= 100){ ?>
					<td colspan="2"><br/>
					<p><font color='#eabe60'>Total : <?php echo $total." DT"; ?></font></p><br/>
					<p><font color='#eabe60'>Total avec TVA : <?php echo $totaltva." DT"; ?></font></p>
					<p><font color='#eabe60'>Calcul des frais de port initial: <?php echo $shipping_initial." DT"?></font></p>
					<p><font color='#eabe60'>Felicitation! Vouz avez recolté plus de 100 points de fidélité donc vous aurez une reduction de : <?php echo $porcentage_reduction." DT"?> pour le prix de port</font></p>
					<p><font color='#eabe60'>Calcul des frais de port avec remise : <?php echo $shipping." DT"?></font></p>
					
				<?php } else { ?>
					<td colspan="2"><br/>
					<p><font color='#eabe60'>Total : <?php echo $total." DT"; ?></font></p><br/>
					<p><font color='#eabe60'>Total avec TVA : <?php echo $totaltva." DT"; ?></font></p>
					<p><font color='#eabe60'>Vouz n'avez pas encore recolté plus de 100 points de fidélité pour avoir une reduction de 20% sur les frais de transport. </font></p>
					<p><font color='#eabe60'>Calcul des frais de port sans remise : <?php echo $shipping." DT"?></font></p>
					
			<?php } } ?>
		<?php if(isset($_SESSION['user_id'])){?><a href="<?php echo $paypal; ?>"><font color='#eabe60'>Payer la commande</font></a><?php }else{?> <h4 style="color:red;">Vous devez être connecter pour payer votre commande. <a href="connect.php">Sign In</a></h4><?php } ?>
					
					</td>
				
				</tr>
				<tr>
					<td colspan="4">
						<input type="submit" value="rafraichir"/>
						<input type="hidden" name="action" value="refresh"/>
						<a href="?deletepanier=true"><font color='#eabe60'>Supprimer le panier</font></a>
					</td>
				</tr>
				
				<?php
				
			
			
		}
		}
		
		?>
	</table>


</form>


				<ul>
					<li>
						<img src="images/perfume-bottles.jpg" alt="Img"> <span class="price">$1</span> <a href="panier.php" class="cart">Add to Cart</a>
						<p>
							Perfume 1 <span class="manufacturer">by The Margarita Fragrance</span> <span class="remarks">*New Arrival</span>
						</p>
					</li>
					<li>
						<img src="images/perfumes.jpg" alt="Img"> <span class="price">$1</span> <a href="panier.php" class="cart">Add to Cart</a>
						<p>
							Perfume 1 <span class="manufacturer">by The Margarita Fragrance</span> <span class="remarks">*New Arrival</span>
						</p>
					</li>
					<li>
						<img src="images/perfume-bottles.jpg" alt="Img"> <span class="price">$1</span> <a href="panier.php" class="cart">Add to Cart</a>
						<p>
							Perfume 1 <span class="manufacturer">by The Margarita Fragrance</span> <span class="remarks">*New Arrival</span>
						</p>
					</li>
					<li>
						<img src="images/perfume-purple.jpg" alt="Img"> <span class="price">$1</span> <a href="panier.php" class="cart">Add to Cart</a>
						<p>
							Perfume 1 <span class="manufacturer">by The Margarita Fragrance</span> <span class="remarks">*New Arrival</span>
						</p>
					</li>
					<li>
						<img src="images/perfume-colors.jpg" alt="Img"> <span class="price">$1</span> <a href="panier.php" class="cart">Add to Cart</a>
						<p>
							Perfume 1 <span class="manufacturer">by The Margarita Fragrance</span> <span class="remarks">*New Arrival</span>
						</p>
					</li>
					<li>
						<img src="images/perfume-green.jpg" alt="Img"> <span class="price">$1</span> <a href="panier.php" class="cart">Add to Cart</a>
						<p>
							Perfume 1 <span class="manufacturer">by The Margarita Fragrance</span> <span class="remarks">*New Arrival</span>
						</p>
					</li>
					<li>
						<img src="images/perfumes2.jpg" alt="Img"> <span class="price">$1</span> <a href="panier.php" class="cart">Add to Cart</a>
						<p>
							Perfume 1 <span class="manufacturer">by The Margarita Fragrance</span> <span class="remarks">*New Arrival</span>
						</p>
					</li>
					<li>
						<img src="images/perfume-blue.jpg" alt="Img"> <span class="price">$1</span> <a href="panier.php" class="cart">Add to Cart</a>
						<p>
							Perfume 1 <span class="manufacturer">by The Margarita Fragrance</span> <span class="remarks">*New Arrival</span>
						</p>
					</li>
					<li>
						<img src="images/perfume-pink.jpg" alt="Img"> <span class="price">$1</span> <a href="panier.php" class="cart">Add to Cart</a>
						<p>
							Perfume 1 <span class="manufacturer">by The Margarita Fragrance</span> <span class="remarks">*New Arrival</span>
						</p>
					</li>
				</ul>
			</div>
		</div>













<?php
// require_once('includes/footer.php');

?>

<div id="footer">
			<div>
				<ul class="navigation">
					<li>
						<a href="index.php">Acceuil</a>
					</li>
					<li>
						<a href="sidebar.php">Les nouveautés</a>
					</li>
					<li>
						<a href="boutique.php">Boutique</a>
					</li>
					<li class="selected">
						<a href="panier.php">Panier</a>
					</li>
					<li>
						<a href="conditions_generales_de_vente.php">Conditions Générales de Vente</a>
					</li>
					<li>
					<?php if(!isset($_SESSION['user_id'])){?>
						<a href="register.php">S'inscrire</a>
					</li>
					<li><a href="connect.php">Sign In</a></li>
			<?php }else{ ?>
					<li>
						<a href="my_account.php">Mon compte</a>
					</li>
					<?php } ?>
				</ul>
				<p>
					© DecArt 2016. All Rights Reserved.
				</p>
			</div>
		</div>
	</div>

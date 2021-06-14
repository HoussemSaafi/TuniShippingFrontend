<?php
include 'class.user.php';
if (!isset($_SESSION)) {
    session_start();
    //print_r($_SESSION);
}
if (isset($_SESSION['user_session'])) {
	$user_id = $_SESSION['user_session'];

	$auth_user = new USER();
	$stmt = $auth_user->runQuery("SELECT * FROM client WHERE IDclient=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
     $auth_user->User_connecte($user_id);
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
}
	
	include 'raccourciPanier.php';
	$_SESSION['thispage']="consulterPanier.php";

	?>
<!DOCTYPE HTML>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<title>Free Home Shoppe Website Template | Home :: w3layouts</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="web/css/slider.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="web/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="web/js/move-top.js"></script>
<script type="text/javascript" src="web/js/easing.js"></script>
<script type="text/javascript" src="web/js/startstop-slider.js"></script>
</head>
<body>
  <div class="wrap">
	<div class="header">
		<div class="headertop_desc">
			<div class="call">
				 <p><span>Need help?</span> call us <span class="number">+216 26 211 344</span></span></p>
			</div>
			<div class="account_desc">
				<ul>

                    <?php
                    if(isset($_SESSION['user_session']))
                    {
                        ?>
                        <label class="h5">welcome : <?php print($userRow['username']); ?></label>
                        <li><a href="/EspaceClient/services/profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Espace Client</a></li>

                        <li><a href="/EspaceClient/services/logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Se Déconnecter</a></li>


                        <?php
                    }

                    else
                    {
                        ?>
                        <li><a href="/EspaceClient/services/sign-up.php">Sign Up</a></li>
                        <li><a href="/EspaceClient/services/profile.php">Sign In</a></li>


                        <?php

                    }
                    ?>

                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div class="header_top">
            <div class="logo">

            </div>
            <?php
            afficherPanier();

            ?>
            <script type="text/javascript">
                function DropDown(el) {
                    this.dd = el;
                    this.initEvents();
                }
                DropDown.prototype = {
                    initEvents : function() {
                        var obj = this;

                        obj.dd.on('click', function(event){
                            $(this).toggleClass('active');
                            event.stopPropagation();
                        });
                    }
                }

			$(function() {

				var dd = new DropDown( $('#dd') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-2').removeClass('active');
				});

			});

		</script>
	 <div class="clear"></div>
  </div>
	<div class="header_bottom">
	     	<div class="menu">
	     		<ul>
			    	<li><a href="index.php">Acceuil</a></li>
			    	<li><a href="about.php">A propos</a></li>
			    	<li><a href="delivery.php">Livraison</a></li>
			    	<li><a href="news.php">Nouveauté</a></li>
			    	<li><a href="contact.php">Reclamation</a></li>
			    	<div class="clear"></div>
     			</ul>
	     	</div>
	     	<div class="search_box">
	     		<form>
	     			<input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}"><input type="submit" value="">
	     		</form>
	     	</div>
	     	<div class="clear"></div>
	     </div>	     	
   </div>

<br><br>
<br><br>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Modify</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody>
                  
 <?php
         if(isset($_SESSION['panier'])&&count($_SESSION['panier']['idProduit'])>0)
      {
foreach ($_SESSION['panier']['idProduit'] as $key => $value) {
      	?>
                    <tr>
                    <form action="modifierPanier.php" method = post>
                        <td class="col-sm-8 col-md-6">
                        <div class="media">
                            <a class="thumbnail pull-left" href="#"> <img class="media-object" src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-2/72/product-icon.png" style="width: 72px; height: 72px;"> </a>
                            <div class="media-body">
                                <h4 class="media-heading"><a href="#"><?php echo $value; ?></a></h4>
                               
                                <span>Status: </span><span class="text-success"><strong>In Stock</strong></span>
                            </div>
                        </div></td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        <input type="number" class="form-control" name="quantite" placeholder=<?php 
                            echo $_SESSION['panier']['qte'][$key];
                         ?>>
                        </td>
                        <td class="col-sm-1 col-md-1" style="text-align: center">
                        <input type="hidden" name ="idProduit" value=<?php 
                            echo $value;
                            ?></input>
                        <button type="submit" class="btn btn-primary"><i  class="glyphicon glyphicon-pencil"></i></button>

                        </td>
                        <td class="col-sm-1 col-md-1 text-center"><strong><?php 
                            echo $_SESSION['panier']['prixProduit'][$key];
                            ?> TND</strong></td>
                        <td class="col-sm-1 col-md-1 text-center"><strong><?php 
                            echo $_SESSION['panier']['prixProduit'][$key]*$_SESSION['panier']['qte'][$key];
                            ?> TND</strong></td>
                        <td class="col-sm-1 col-md-1">
                        <a href=<?php 
			  	   				echo '"supprimerArticle.php?idProduit='.$value.'"';
			  	   			 ?> class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span> Remove
                        </a></td>
                    </tr>
                    </form>
                    <?php }?>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5><strong>

                        <?php
                        $prix=0;
                        foreach ($_SESSION['panier']['idProduit'] as $key => $value) {
                            $prix+= $_SESSION['panier']['prixProduit'][$key]*$_SESSION['panier']['qte'][$key];

                        }
                            echo $prix;
                            //isset($_SESSION['price'])?$_SESSION['price']=$prix:$_SESSION['price']=$prix;
                        ?> TND</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Estimated shipping</h5></td>
                        <td class="text-right"><h5><strong>8 TND</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td>
                        <td class="text-right"><h3><strong><?php $_SESSION['price']=$prix+8; echo $prix+8; ?> TND</strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
                        <a href="index.php" class="btn btn-default">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                        </a></td>
                        <td>
                        <a href="validerPanier.php" class="btn btn-success">
                            Checkout <span class="glyphicon glyphicon-play"></span>
                        </a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
 <?php 
          }

           

           else
           {

            ?>
            <br><br>
            <br><br>
            <br><br>
            <div class="jumbotron">
            <h1>Panier Vide</h1>
             <p></p>
             <p><a class="btn btn-primary btn-lg" href="index.php" role="button">Continuer Les Achats</a></p>
             </div>
            <?php
           }


               ?>








         
           
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>


	 </div>
	    <script type="text/javascript">
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true   // 100% fit in a container
        });
    });
   </script>		
   <div class="content_bottom">
    		<div class="heading">
    		<h3>Related Products</h3>
    		</div>
    		<div class="see">
    			<p><a href="see all products.php">See all Products</a></p>
    		</div>
    		<div class="clear"></div>
    	</div>
   <div class="section group">
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="#"><img src="web/images/new-pic1.jpg" alt=""></a>
					<div class="price" style="border:none">
					       		<div class="add-cart" style="float:none">								
									<h4><a href="#">Add to Cart</a></h4>
							     </div>
							 <div class="clear"></div>
					</div>
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="#"><img src="web/images/new-pic2.jpg" alt=""></a>
					 <div class="price" style="border:none">
					       		<div class="add-cart" style="float:none">								
									<h4><a href="#">Add to Cart</a></h4>
							     </div>
							 <div class="clear"></div>
					</div>
				</div>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="#"><img src="web/images/new-pic4.jpg" alt=""></a>
					<div class="price" style="border:none">
					       		<div class="add-cart" style="float:none">								
									<h4><a href="#">Add to Cart</a></h4>
							     </div>
							 <div class="clear"></div>
					</div>
				</div>
				<div class="grid_1_of_4 images_1_of_4">
				 <img src="web/images/new-pic3.jpg" alt="">
					 <div class="price" style="border:none">
					       		<div class="add-cart" style="float:none">								
									<h4><a href="#">Add to Cart</a></h4>
							     </div>
							 <div class="clear"></div>
					</div>
				</div>
			</div>
        </div>
				
   <div class="footer">
   	  <div class="wrap">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>Information</h4>
						<ul>
                              <li><a href="about.php">About Us</a></li>
						<li><a href="contact.php">Customer Service</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="contact.php">Site Map</a></li>
						<li><a href="#">Search Terms</a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Why buy from us</h4>
						<ul>
						<li><a href="about.php">About Us</a></li>
						<li><a href="contact.php">Customer Service</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="contact.php">Site Map</a></li>
						<li><a href="#">Search Terms</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>My account</h4>
						<ul>
							<li><a href="contact.php">Sign In</a></li>
							<li><a href="consulterPanier.php">View Cart</a></li>
							<li><a href="#">My Wishlist</a></li>
							<li><a href="#">Track My Order</a></li>
							<li><a href="contact.php">Help</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Contact</h4>
						<ul>
							<li><span>+216 26 211 344</span></li>
							<li><span>			<li><span></span></li></span></li>
						</ul>
						<div class="social-icons">
							<h4>Follow Us</h4>
					   		  <ul>
							      <li><a href="https://www.facebook.com/Shipping-from-across-the-World-111456524500065" target="_blank"><img src="web/images/facebook.png" alt="" /></a></li>
							      <li><a href="#" target="_blank"><img src="web/images/twitter.png" alt="" /></a></li>
							      <li><a href="#" target="_blank"><img src="web/images/skype.png" alt="" /> </a></li>
							      <li><a href="#" target="_blank"> <img src="web/images/dribbble.png" alt="" /></a></li>
							      <li><a href="#" target="_blank"> <img src="web/images/linkedin.png" alt="" /></a></li>
							      <div class="clear"></div>
						     </ul>
   	 					</div>
				</div>
			</div>			
        </div>
        <div class="copy_right">
				<p>Gl2-2020/2021</a> </p>
		   </div>
    </div>
   <script type="text/javascript">
		$(document).ready(function() {			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>
</html>


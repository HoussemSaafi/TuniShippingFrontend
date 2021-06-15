
<?php
include 'class.user.php';






//session_start();



	if (isset($_SESSION['user_session'])) {
	$user_id = $_SESSION['user_session'];
	$auth_user = new USER();
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE IDclient=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
     $auth_user->User_connecte($user_id);
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);




}

$_SESSION['thispage']="index.php";
include 'raccourciPanier.php';
		$conn=ConnexionBD::getInstance();
?>

<!DOCTYPE HTML>
<head>

<link rel="stylesheet" type="text/css" href="Client/bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="Client/bootstrap/css/bootstrap.min.css">
<title>Free Home Shoppe Website Template | About :: w3layouts</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="web/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="web/js/move-top.js"></script>
<script type="text/javascript" src="web/js/easing.js"></script>
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
                    		    <li><a href="EspaceClient/services/profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Espace Client</a></li>

                				<li><a href="EspaceClient/services/logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>


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
<!--				<a href="index.php
							<li><span>			<li><span></span></li></span></li>"><img src="web/images/logo.png" alt="" width="100px" height="100px"/></a>-->
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
			    	<li  class="active"><a href="about.php">A propos</a></li>
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
 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="col_1_of_3 span_1_of_3">
					<h3>Who We Are</h3>
					<img src="web/images/Houssem1.jpg" height=370px width="370px" alt="">
					<p>Houssem Saafi - CO FOUNDER.</p>
					<p>Our goal is to see our clients needs through the chat service that we implemented or the facebook page that we have. We want them to pick and choose whatever item they want. If one item gets a lot of requests we would ship it from wherever place in the world it is for our customers in Tunisia. All this at low costs and delivery low prices. WE MAKE THE WORLD LOOK SMALL</p>
				</div>
				<div class="col_1_of_3 span_1_of_3">
					<h3>Meet our team</h3>
                    <img src="web/images/Safa.jpg" alt="">
				 <div class="history-desc">
					<p class="history">Safa Kedidi - CO FOUNDER.</p>
					<p class="history">With the raise of technology, the world has become smaller and smaller! We want our customers to feel that even when it comes to shopping. Nowadays, tunisians visit shops from all over the world yet sometimes they can't buy stuff simply because we don't have it in our country. That is why we want to provide them with everything they need</p>
				 <div class="clear"></div>
				</div>
				 <div class="history-desc">
					<div class="year"><p></p></div>
					<p class="history"></p>
				 <div class="clear"></div>
				</div>
				 <div class="history-desc">
					<div class="year"><p></p></div>
					<p class="history"></p>
				 <div class="clear"></div>
				</div>
				 <div class="history-desc">
					<div class="year"><p></p></div>
					<p class="history"></p>
				 <div class="clear"></div>
				</div>
				<div class="history-desc">
					<div class="year"><p></p></div>
					<p class="history"></p>
				 <div class="clear"></div>
				</div>
			</div>
				<div class="col_1_of_3 span_1_of_3">
					<h3>Shipping For Tunisia</h3>
                    <img src="web/images/emna.jpg" alt="">
					<p>Emna Boukhris - CO FOUNDER.</p>
				    <div class="list">
					     <ul>
					     	<li><a href="#">Not gonna lie, we started this project for the money. We just want to be rich and that's it.</a></li>
					     	<li><a href="#">Never believe what Safa said.</a></li>
					     	<li><a href="#">I agree with whatever Houssem said.</a></li>
					     	
					     	<li><a href="#">That's it fellas</a></li>
					     </ul>
					 </div>
					 <p></p>
				</div>
			</div>			
    </div>
 </div>
</div>
  <?php   require("footerLayout.php");  ?>

   <script type="text/javascript">
		$(document).ready(function() {			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
</body>
</html>


<?php
include 'class.user.php';






//session_start();



	if (isset($_SESSION['user_session'])) {
	$user_id = $_SESSION['user_session'];

	$auth_user = new USER();
	$stmt = $auth_user->runQuery("SELECT * FROM Client WHERE IDclient=:user_id");
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
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<title>Free Home Shoppe Website Template | Delivery :: w3layouts</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="web/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="web/js/move-top.js"></script>
<script type="text/javascript" src="web/js/easing.js"></script>
<script type="text/javascript" src="web/js/jquery.accordion.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#posts").accordion({
			header: "div.tab",
			alwaysOpen: false,
			autoheight: false
		});
	});
</script>
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
                        <li><a href="../TuniShipping-Frontend/EspaceClient/services/profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Espace Client</a></li>

                        <li><a href="../TuniShipping-Frontend/EspaceClient/services/logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Se Déconnecter</a></li>


                        <?php
                    }

                    else
                    {
                        ?>
                        <li><a href="../TuniShipping-Frontend/EspaceClient/services/sign-up.php">Sign Up</a></li>
                        <li><a href="../TuniShipping-Frontend/EspaceClient/services/profile.php">Sign In</a></li>


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
			    	<li class="active"><a href="delivery.php">Livraison</a></li>
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
				<div class="grid_1_of_3 images_1_of_3">
					  <img src="web/images/delivery-img1.jpg" alt="" />
					  <h3>YO YO YO, YOU ASKED FOR THE PRODUCT AND WE DELIVERED </h3>
					  <p>We deliver products from all over the world, We ship them and then deliver them to your house.</p>
				</div>
				<div class="grid_1_of_3 images_1_of_3">
					  <img src="web/images/delivery-img2.jpg" alt="" />
					  <h3>Wassup my guy! Here came your product! Have you paid with Paypal or you will be paying upon reception?  </h3>
					  <p>Don't forget to visit our website and tell your friends to sign up we have the coolest items with the best reductions and promos</p>
				</div>
				<div class="grid_1_of_3 images_1_of_3">
					  <img src="web/images/delivery-img3.jpg" alt="" />
					  <h3>Now have a great day!</h3>
					  <p>Don't forget to subscribe to our newsletter! We would provide you with the latest of our added items!</p>
				</div>
			</div>	
		<div class="faqs">
    	  <h2>Frequently Asked Questions</h2>	          	
            <div id="posts">
			    <div class="tab bar">
                    <h4 class="post-title">1.What is Lorem Ipsum?</h4>
                </div>
			    <div class="panel margin-lr-7">
            		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
			    </div>		   
                <div class="tab bar">
                     <h4 class="post-title"> 2.What is Lorem Ipsum Lorem Ipsum has been the industry's standard dummy text?</h4>
                </div>
				<div class="panel margin-lr-7">
	        		 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
                <div class="tab bar">
                     <h4 class="post-title"> 3.What is Lorem Ipsum Lorem Ipsum has been the industry's?</h4>
                </div>
				<div class="panel margin-lr-7">
	        		 <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
				<div class="tab bar">
                    <h4 class="post-title"> 4.What is Lorem Ipsum dummy text of the printing?</h4>
            	</div>
			 	<div class="panel margin-lr-7">
	        		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
             	</div>
                <div class="tab bar">
                    <h4 class="post-title"> 5.What is Lorem Ipsum printing and typesetting industry?</h4>
                </div>
			    <div class="panel margin-lr-7">
	        	     <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
                <div class="tab bar">
                    <h4 class="post-title"> 6.What is Lorem Ipsum text of the printing?</h4>
            	</div>
				<div class="panel margin-lr-7">
                      <p>Pellentesque ornare sem lacinia quam venenatis vestibulum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec id elit non mi porta gravida at eget metus.</p>
                </div>
                <div class="tab bar">
                    <h4 class="post-title"> 7.What is Lorem Ipsum?</h4>
            	</div>
				<div class="panel margin-lr-7">
	        	     <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
                <div class="tab bar">
                    <h4 class="post-title"> 8.What is Lorem Ipsum dummy text ever since the 1500s?</h4>
            	</div>
				<div class="panel margin-lr-7">
	        	     <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
                <div class="tab bar">
                    <h4 class="post-title"> 9.What is Lorem Ipsum  Lorem Ipsum has been the industry's standard dummy text?</h4>
            	</div>
				<div class="panel margin-lr-7">
                      <p>Pellentesque ornare sem lacinia quam venenatis vestibulum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Donec id elit non mi porta gravida at eget metus.</p>
                </div>
                <div class="tab bar">
                    <h4 class="post-title"> 10.What is Lorem Ipsum typesetting industry?</h4>
            	</div>
				<div class="panel margin-lr-7">
	        	     <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>
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


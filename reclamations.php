<!DOCTYPE HTML>
<head>
<title>Shop Project</title>

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
<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
       <!--CUSTOM BASIC STYLES-->
    <link href="assets/css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
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
					<li><a href="#">Register</a></li>
					<li><a href="C:/Users/Khalil/Desktop/template/Advance%20Admin%20Free%20Website%20Template%20-%20Free-CSS.com/bs-advance-admin/advance-admin/login.html">Login</a></li>
					<li><a href="#">Delivery</a></li>
					<li><a href="#">Checkout</a></li>
					<li><a href="#">My Account</a></li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
		<div class="header_top">
			<div class="logo">
				<a href="index.php
							<li><span>			<li><span></span></li></span></li>"><img src="web/images/logo.png" alt="" /></a>
			</div>
			  <div class="cart">
			  	   <p>Welcome to our Online Store! <span>Cart:</span><div id="dd" class="wrapper-dropdown-2"> 0 item(s) - $0.00
			  	   	<ul class="dropdown">
							<li>you have no items in your Shopping cart</li>
					</ul></div></p>
			  </div>
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
			    	<li><a href="index.php">Home</a></li>
			    	<li><a href="about.php
							<li><span>			<li><span></span></li></span></li>">About</a></li>
			    	<li class="active"><a href="reclamations.php">Reclamation</a></li>
			    	<li><a href="news.html">News</a></li>
			    	<li><a href="contact.php
							<li><span>			<li><span></span></li></span></li>">Contact</a></li>
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
    	<form action="ajoutReclamation.php" method="POST">
		
         <table border="0">
		 
		<tr>
<td>Description</td>
<td><input type="text" name="Description"></td>
</tr>
<tr>
<td>Sujet</td>
<td><input type="text" name="Sujet"></td>
</tr>
<tr>


<tr>
<td>IDClient</td>
<td><input type="text" name="IDClient"></td>

</tr>
<tr>
<td></td>
<td><input type="submit" value="ajouter"></td>
</tr>
		</table>
		</form>	
		
		
         </div> 
    </div>
 </div>
   <div class="footer">
   	  <div class="wrap">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>Information</h4>
						<ul>
						<li><a href="about.php
							<li><span>			<li><span></span></li></span></li>">About Us</a></li>
						<li><a href="contact.php
							<li><span>			<li><span></span></li></span></li>">Customer Service</a></li>
						<li><a href="#">Advanced Search</a></li>
						<li><a href="delivery.php
							<li><span>			<li><span></span></li></span></li>
							<li><span>			<li><span></span></li></span></li>">Orders and Returns</a></li>
						<li><a href="contact.php
							<li><span>			<li><span></span></li></span></li>">Contact Us</a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Why buy from us</h4>
						<ul>
						<li><a href="about.php
							<li><span>			<li><span></span></li></span></li>">About Us</a></li>
						<li><a href="contact.php
							<li><span>			<li><span></span></li></span></li>">Customer Service</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="contact.php
							<li><span>			<li><span></span></li></span></li>">Site Map</a></li>
						<li><a href="#">Search Terms</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>My account</h4>
						<ul>
							<li><a href="contact.php
							<li><span>			<li><span></span></li></span></li>">Sign In</a></li>
							<li><a href="index.php
							<li><span>			<li><span></span></li></span></li>">View Cart</a></li>
							<li><a href="#">My Wishlist</a></li>
							<li><a href="#">Track My Order</a></li>
							<li><a href="contact.php
							<li><span>			<li><span></span></li></span></li>">Help</a></li>
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
				<p>GL2 2020/2021  © All rights Reseverd |</p>
		   </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>
	<!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
	<script src="assets/js/application.js"></script>
</body>
</html>


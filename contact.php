<?php
include 'class.user.php';


	session_start();
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

<script type="text/javascript">
function success()
{
	var success=<?php echo $_GET["success"]; ?>;
	console.log(success);
	if(success==1)
	{
		alert("Reclamation envoyé avec succée");
	}
	else
	{
		alert("Erreur lors de l'envoie")
	}
}

</script>


<head>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<title>Free Home Shoppe Website Template | Contact :: w3layouts</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<script type="text/javascript" src="web/js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="web/js/move-top.js"></script>
<script type="text/javascript" src="web/js/easing.js"></script>
</head>
<body >
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
                        <li><a href="/EspaceClient/services/profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Profile</a></li>

                        <li><a href="/EspaceClient/services/logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Log Out</a></li>


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
			    	<li><a href="index.php">Home</a></li>
			    	<li><a href="about.php">About us</a></li>
			    	<li><a href="delivery.php">Delivery</a></li>
			    	<li><a href="news.php">News</a></li>
			    	<li  class="active"><a href="contact.php">Reclamation</a></li>
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
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	
					 
					 <?php
					 		if (isset($_SESSION['user_session'])) {
					 		
					 ?>

		
					



					   <form action="ajoutReclamation.php" method="POST">
					    	<div>
						    	<span><label>Sujet</label></span>
						    	<span><input name="Sujet" type="text" class="textbox" ></span>
						    </div>
						    <input type="text" value="<?php echo $user_id;?>" name="IDClient"  style="display: none" ></input>
						    <div>
						    	<span><label>Message</label></span>
						    	<span><textarea name="Description"> </textarea></span>
						    </div>
						   <div>
						   		<span onclick="success()"><input type="submit" value="Submit"  class="myButton"></span>
						  </div>
					    </form>
						<?php
					 		}
					 		else
					 		{

					 			?>

					 				<h2>Vous Devez Etre Connctez</h2>

					 			<?php
					 		}
					 		
					 ?>

				  </div>
  				</div>
				<div class="col span_1_of_3">
					<div class="contact_info">
                        <h3>Find Us Here</h3>
                        <div class="map">
                            <iframe width="100%" height="175" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=INSAT+Point,+Tunis,+Tunisia&amp;aq=4&amp;oq=light&amp;sll=36.84341369396452, 10.196041207172955&amp;sspn=36.84341369396452, 10.196041207172955&amp;ie=UTF8&amp;hq=&amp;hnear=INSAT+Point,+Insat,+Tunis,+Tunisia&amp;t=m&amp;z=14&amp;ll=36.84341369396452, 10.196041207172955&amp;output=embed"></iframe><br><small><a href="https://maps.google.co.in/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Insat+Point,+Tunis,+Tunisia&amp;aq=4&amp;oq=light&amp;sll=36.84341369396452, 10.196041207172955&amp;sspn=36.84341369396452, 10.196041207172955&amp;ie=UTF8&amp;hq=&amp;hnear=Insat+Point,+Insat,+Tunis,+Tunisia&amp;t=m&amp;z=14&amp;ll=36.84341369396452, 10.196041207172955" style="color:#666;text-align:left;font-size:12px">View Larger Map</a></small>
                        </div>
                    </div>
                    <div class="company_address">
                        <h3>Company Information :</h3>
                        <p>DELIVERING FROM ALL OVER THE WORLD</p>
                        <p>22-56-2-9 Sit Amet, Lorem,</p>
                        <p>Tunis, Tunisia</p>
                        <p>Phone:+216 26 211 344</p>
                        <p>Fax: (000) 000 00 00 0</p>
                        <p>Email: <span>gl2@gmail.com</span></p>
                        <p>Follow on: <span href="https://www.facebook.com/Shipping-from-across-the-World-111456524500065">Facebook</span>, <span>Twitter</span></p>
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


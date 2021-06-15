<?php
	include 'class.user.php';
  //  session_start();
	if (isset($_SESSION['user_session'])) {
        $user_id = $_SESSION['user_session'];

        $auth_user = new USER();
        $stmt = $auth_user->runQuery("SELECT * FROM client WHERE IDclient=:user_id");
        $stmt->execute(array(":user_id" => $user_id));
        $auth_user->User_connecte($user_id);
        $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
	include 'raccourciPanier.php';
  $_SESSION['thispage']="validerPanier";
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
 




<div class="alert alert-info" role="alert">
Remplissez l'adresse de livraison
</div>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <form class="form-horizontal" action="choisirmodePaiement.php" method="POST">
        <fieldset>

          <!-- Form Name -->
          

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Rue</label>
            <div class="col-sm-10">
              <input name="rue" type="text" placeholder="Rue" class="form-control" required="true">
            </div>
          </div>

          <!-- Text input-->
         

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Ville</label>
            <div class="col-sm-10">
              <input name="ville" type="text" placeholder="Ville" class="form-control" required="true">
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Région</label>
            <div class="col-sm-4">
              <select  name="gouvernerat" class="form-control">
              	
              <option>Ariana</option>
              <option>Béja</option>
              <option>Ben Arous</option>
              <option>Bizerte</option>
              <option>Gabès</option>
              <option>Gafsa</option>
              <option>Jendouba</option>
              <option>Kairouan</option>
              <option>Kasserine</option>
              <option>Kébili</option>
              <option>Le Kef</option>
              <option>Mahdia</option>
              <option>La Manouba</option>
              <option>Médenine</option>
              <option>Monastir</option>
              <option>Nabeul</option>
              <option>Sfax</option>
              <option>Sidi Bouzid</option>
              <option>Siliana</option>
              <option>Sousse</option>
              <option>Tataouine</option>
              <option>Tozeur</option>
              <option>Tunis</option>
              <option>Zaghouan</option>


              </select>
            </div></div>
  <div class="form-group">
            <label class="col-sm-2 control-label" for="textinput">Postcode</label>
            <div class="col-sm-4">
              <input name="zip" type="text" placeholder="Post Code" class="form-control" required="true">
            </div>
          </div>



        
        

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="pull-right">
                
                <button type="submit" class="btn btn-primary">Enregistrer et Générer la Commande</button>
              </div>
            </div>
          </div>

        </fieldset>
      </form>
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->








	    <script type="text/javascript">
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion           
            width: 'auto', //auto or any width like 600px
            fit: true   // 100% fit in a container
        });
    });
   </script>		
   
   <div class="section group">
				
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



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
$i=$_GET["IDProduit"];
	$_SESSION['thispage']="preview.php?IDProduit=".$i;

	$_SESSION["idProduit"] =$_GET["IDProduit"];
$conn= ConnexionBD::getInstance();

$result=$conn->query("SELECT * FROM produit WHERE Ref=".$_GET['IDProduit']);
$res=$result->fetchAll();
//($res);

//($_SESSION["idProduit"]);
	?>



<!DOCTYPE HTML>
<head>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<title>Free Home Shoppe Website Template | Preview :: w3layouts</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="web/css/example.css" rel="stylesheet" type="text/css" media="all"/>
<link type="text/css" rel="stylesheet" href="css/example.css">
<script type="text/javascript" src="web/js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="web/js/move-top.js"></script>
<script type="text/javascript" src="web/js/easing.js"></script>
<script src="web/js/easyResponsiveTabs.js" type="text/javascript"></script>
<link href="web/css/easy-responsive-tabs.css" rel="stylesheet" type="text/css" media="all"/>
<link rel="stylesheet" href="web/css/global.css">
<script src="web/js/slides.min.jquery.js"></script>
<script>
		$(function(){
			$('#products').slides({
				preload: true,
				preloadImage: 'img/loading.gif',
				effect: 'slide, fade',
				crossfade: true,
				slideSpeed: 350,
				fadeSpeed: 500,
				generateNextPrev: true,
				generatePagination: false
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
 <div class="main">
    <div class="content">
    	<div class="content_top">

    		<div class="clear"></div>
    	</div>
    	<div class="section group">
    	<form action="GestionPanier.php">
				<div class="cont-desc span_1_of_2">
				  <div class="product-details">				
					<div class="grid images_3_of_2">
						<div id="container">
						   <div id="products_example">
							   <div id="products">
								<div class="slides_container" style="width=250 px">
									<?php
                                    $conn= ConnexionBD::getInstance();

									$result=$conn->query("SELECT * FROM produit WHERE Ref=".$_GET['IDProduit']);
							        $res=$result->fetchAll();
							   //   ($res);

							        foreach($res as $r)
							        {
									echo '<img src="data:image;base64,'.$r['ImgProduit'].'"style=max-width:300px;width:100% />';
									}

									?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="desc span_3_of_2">
					<?php
								foreach($res as $r)
							    {

										echo "<h2>".$r["Designation"]."</h2>";

								}

					?>
					<?php
								foreach($res as $r)
							    {
							    	if($r['Quantite']==0)
							    	{
										echo "<p>Ce produit n'est pas valable en stock </p>";
									}
									else
									{
										echo "<p>Ce produit est valable en stock </p>";
									}
								}

					?>					
					<div class="price">
						<p>Price: 
						<span>

						<?php 	
								foreach($res as $r)
							    {
									echo $r['PrixHT'].' DT';
								}
						?>

					</span>
					</p>
					</div>
					<div class="available">
						
					<ul>
						
						<li>Quantité  :  <input type="number" value="1" name="qte"> 


						</li>
					</ul>
					</div>
				<div class="share-desc">
					<div class="share">
						<p>Share Product :</p>
						<ul>
					    	<div class="fb-share-button" data-href="http://localhost/FrontBack/home_shoppe-pack/preview.php?IDProduit=1246" data-layout="button_count" data-mobile-iframe="true"></div>
					    					    
			    		</ul>
					</div>
				</div>
					<div class="button">
					<?php

					foreach($res as $r)
							    {
							    	if($r['Quantite']==0)
							    	{
										echo '<input type="submit" class="btn btn-primary" value="Add to Cart" disabled ></span></div>';
									}
									else
									{
										echo '<input type="submit" class="btn btn-primary" value="Add to Cart" herf="GestionPanier.php" ></span></div>';
									}
								}

					?>
												
					</form>


					</div>					
					<div class="clear"></div>
				</div>

			</div>
			<div class="clear"></div>
		  </div>
		<div class="product_desc">	
			<div id="horizontalTab">
				<ul class="resp-tabs-list">
					<li>Product Details</li>
					<li>product Tags</li>
					<li>Product Reviews</li>
					<div class="clear"></div>
				</ul>
				<div class="resp-tabs-container">
					<div class="product-desc">
						<p>
							
						<?php 	
								foreach($res as $r)
							    {
									echo $r['Description'];
								}
						?>

						</p>				
					</div>

				 <div class="product-tags">

					<div class="input-box">
						<p>

						 Ce produit appartient a la categorie 
						 <?php 	
						 		$result_Cat=$conn->query("SELECT DesignationCat,Description FROM categorie WHERE DesignationCat=(select ID_Categorie from produit where Ref=".$_GET['IDProduit'].")");
							    $result_Cat=$result_Cat->fetchAll();

								foreach($result_Cat as $r)
							    {
									echo $r[0];
									echo ' : '.$r[1];
								}
						?>

						 </p>
					</div>
			    </div>	

				<div class="review">

				<?php 

// Connect to the database
include('config_commentaire.php');
$id_post = $_GET["IDProduit"]; //the post or the page id
?>
<div class="cmt-container" >
    <?php 
    $sql="SELECT * FROM comments WHERE id_post = '$id_post'";
	$qr=mysqli_query($connection,$sql);
    while($affcom = mysqli_fetch_assoc($qr)){ 
        $name = $affcom['name'];
        $email = $affcom['email'];
        $comment = $affcom['comment'];
        $date = $affcom['date'];

        // Get gravatar Image 
        // https://fr.gravatar.com/site/implement/images/php/
       
    ?>
    <div class="cmt-cnt">
        
        <div class="thecom">
            <h5><?php echo $name; ?></h5><span data-utime="1371248446" class="com-dt"><?php echo $date; ?></span>
            <br/>
            <p>
                <?php echo $comment; ?>
            </p>
        </div>
    </div><!-- end "cmt-cnt" -->
    <?php } ?>


    <div class="new-com-bt">
        <span>écrivez un commentaire ...</span>
    </div>
    <div class="new-com-cnt">
    
				<ul>
					
                    <?php 
                    	if(isset($_SESSION['user_session']))
                    	{
                    		?>
                                <form action="insererCommentaire.php" method="POST">
        <input type="hidden" id="post_id" name="post_id" value="<?php echo $id_post; ?>" hidden/>
         <input type="text" id="name-com" name="name" value="<?php echo $userRow['username']; ?>" hidden />
        <input type="text" id="mail-com" name="mail" value="<?php echo $userRow['email']; ?>" hidden />
        <textarea class="the-new-com" name="commentaire"></textarea>
        <input  type="submit" value="Post comment" name="ajouter" id="ajouter" class="bt-add-com" >;
        <div class="bt-cancel-com">Cancel</div>
                                </form>
                		<?php		
                    	}

                      else
                      {
                    ?>
				<p>Vous devez  vous connectez pour ajouter un commentaire</p>
					

               <?php

           }
           ?>
              
				</ul>
			
        
    </div>
    <div class="clear"></div>
</div><!-- end of comments container "cmt-container" -->


<script type="text/javascript">
   $(function(){ 
        //alert(event.timeStamp);
        $('.new-com-bt').click(function(event){    
            $(this).hide();
            $('.new-com-cnt').show();
            $('#name-com').focus();
        });

        /* when start writing the comment activate the "add" button */
        $('.the-new-com').bind('input propertychange', function() {
           $(".bt-add-com").css({opacity:0.6});
           var checklength = $(this).val().length;
           if(checklength){ $(".bt-add-com").css({opacity:1}); }
        });

        /* on clic  on the cancel button */
        $('.bt-cancel-com').click(function(){
            $('.the-new-com').val('');
            $('.new-com-cnt').fadeOut('fast', function(){
                $('.new-com-bt').fadeIn('fast');
            });
        });

        // on post comment click 
        $('.bt-add-com').click(function(){
            var theCom = $('.the-new-com');
            var theName = $('#name-com');
            var theMail = $('#mail-com');

            if( !theCom.val()){ 
                alert('Veuillez écrire un commentaire!'); 
            }else{ 
                $.ajax({
                    type: "POST",
                    url: "ajax/add-comment.php",
                  //  data: 'act=add-com&id_post='+<?php echo $id_post; ?>+'&name='+theName.val()+'&email='+theMail.val()+'&comment='+theCom.val(),
                    success: function(html){
                        theCom.val('');
                        theMail.val('');
                        theName.val('');
                        $('.new-com-cnt').hide('fast', function(){
                            $('.new-com-bt').show('fast');
                            $('.new-com-bt').before(html);  
                        })
                    }  
                });
            }
        });

    });
</script>

				</div>
			</div>
		 </div>
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
    			<p><a href="see%20all%20products.php">See all Products</a></p>
    		</div>
    		<div class="clear"></div>
    	</div>
   <div class="section group">
	      <?php

                  $promotion=$conn->query("SELECT IDProduit FROM promotion");
                  $promotion=$promotion->fetchAll();
				  $result=$conn->query("SELECT * FROM produit WHERE ID_Categorie=(select ID_Categorie from produit where Ref=".$_GET['IDProduit'].") ORDER BY Ref DESC LIMIT 4");
		          $res=$result->fetchAll();
		          
		          foreach($res as $r)
		          {
		          	$exist=0;
		            echo '<div class="grid_1_of_4 images_1_of_4">';
		            echo '<a href="preview.php?IDProduit='.$r['Ref'].'"><div style="width: 250px; height: 250px;;overflow:hidden"><img src="data:image;base64,'.$r['ImgProduit'].'"style=max-width:300px;width:100% /></div></a>';
		            echo ' <h2>'.$r['Designation'].' </h2>';
		            echo '<div class="price-details">';
		            echo '<div class="price-number">';
		            foreach ($promotion as $prom) {
                        if($prom['IDProduit']==$r['Ref']){
                        $exist=1;
                        
                        }     
                    }
    				
                    if($exist==1){echo '<p style="text-decoration: line-through"><span class="rupees">'.$r['PrixHT'].' DT</span></p>';
                     $tauxprom=$conn->query("SELECT TauxDeProm FROM promotion where IDProduit=".$r['Ref']);
                     $tauxprom=$tauxprom->fetch();
                    $newPrice=$r['PrixHT'] - ($r['PrixHT']*$tauxprom[0]/100);
                    echo '<p><span class="rupees">'.$newPrice.' DT</span></p>';
                    }
                    else{
                    echo '<p><span class="rupees">'.$r['PrixHT'].' DT</span></p>';
                    }

		            echo '</div>';
		            echo '<div class="add-cart">';
		            echo '<h4><a href="preview.php?IDProduit='.$r['Ref'].'">Inspect</a></h4>';
		            echo '</div>';
		            echo '<div class="clear"></div>';
		            echo '</div>';
		            echo '</div>';

		          }  ?>  

				
			</div>
  
				<div style="float:Right">

				<form class="form-horizontal" method="POST" action="insererNewsletter.php">
				<fieldset>

				<!-- Form Name -->
				<legend></legend>

				<!-- Appended Input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="appendedtext">Inscription Newsletter</label>
				  <div class="col-md-4">
				    <div class="input-group">
				      <input   class="form-control" type="text" value = "Mettez votre E-mail ici ..." id="newsletter" name="newsletter" style="margin-top : 5px;margin-right : 15px" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Mettez votre E-mail ici ...';}">
				      <span class="input-group-addon"><input type="submit" value="Sign Up"   class="btn btn-sm btn-default" style="float:Right;padding-right : 20px" ></span>
<!--                        onclick="add_newsletter_list()"-->
				    </div>
				  </div>
				</div>
				</fieldset>
				</form>

      			</div>
      			<br>
      			<br>
      			<br>
      			</div>
 		</div>
 	</div>
    </div>
 </div>

  
   <script type="text/javascript">
		$(document).ready(function() {			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
	
	<script type="text/javascript">

			function validateEmail(email) 
			{
			    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			    return re.test(email);
			}
	</script>

	<script type="text/javascript">

			function add_newsletter_list()
			{

				email=document.getElementById("newsletter").value;
				console.log(email);
				if(validateEmail(email)==false)
				{
					window.alert("Veuillez inserer une adress e-mail valid");
				}
				else
				{
					// Create our XMLHttpRequest object
	                var hr = new XMLHttpRequest();
	                // var url = "checkID.php";Create some variables we need to send to our PHP file
	                var email=document.getElementById("newsletter").value;
	                console.log(email);
	                var url = "ajout mail newsletter.php?email="+email;

	                hr.open("POST", url, true);
	                // Set content type header information for sending url encoded variables in the request
	                hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	                // Access the onreadystatechange event for the XMLHttpRequest object
	                hr.onreadystatechange = function() {
	                    if(hr.readyState == 4 && hr.status == 200) {
	                        var return_data = hr.responseText;
	                        window.alert("Votre adress a été ajouter a la newsletter");

	                    }
	                }
	                // Send the data to PHP now... and wait for response to update the status div
	                hr.send(); // Actually execute the request
					
				}
			}
	</script>
  <?php   require("footerLayout.php");  ?>
    <a href="#" id="toTop"><span id="toTopHover"> </span></a>

    <div id="fb-root"></div>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</body>
</html>


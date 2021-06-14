
<?php
require("HeaderLayout.php");
include 'commande.php';


  $_SESSION['adresse']=$_POST['rue'].','.$_POST['ville'].','.$_POST['gouvernerat'].','.$_POST['zip'];

  $c=new commande();
              $p= $c->CalculerPrixTotale();
              $p=round($p,2);
              $_SESSION['prixtot']=$p;
             // ($_SESSION['panier']['idProduit']);
              // ($_SESSION['panier']['idProduit']);
ob_start();

	?>

 

<style type="text/css">
	
	body { margin-top:20px; }
.panel-title {display: inline;font-weight: bold;}
.checkbox.pull-right { margin: 0; }
.pl-ziro { padding-left: 0px; }
</style>


<div class="alert alert-info" role="alert">
Choisissez le mode de paiement
</div>


<div class="container" style="margin-left: 38%">
    <div class="row">
        <div class="col-xs-12 col-md-4">
                 <?php
                        $prix=0;
                        foreach ($_SESSION['panier']['idProduit'] as $key => $value) {
                            $prix+= $_SESSION['panier']['prixProduit'][$key]*$_SESSION['panier']['qte'][$key];

                        }
                        ?>
<a class="btn btn-block btn-lg btn-info"></span>Prix Totale: <?php echo $prix+8 ; ?> TND</a>
<br><br>
						<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
							<input name="amount" type="hidden" value="<?php echo $p; ?>" />
							<input name="currency_code" type="hidden" value="EUR" />
							<input name="shipping" type="hidden" value="8" />
							<input name="tax" type="hidden" value="0.00" />
							<input name="return" type="hidden" value="http://localhost:8080/home_shoppe-pack/ipn.php" />
							<input name="cancel_return" type="hidden" value="http://localhost:8080/home_shoppe-pack/choisirmodePaiement.php" />
							<input name="notify_url" type="hidden" value="http://localhost:8080/home_shoppe-pack/ipn.php" />
							<input name="cmd" type="hidden" value="_xclick" />
							<input name="item_name" type="hidden" value="Prix total" />
							<input name="no_note" type="hidden" value="1" />
							<input name="lc" type="hidden" value="FR" />
							<input name="bn" type="hidden" value="PP-BuyNowBF" />
							<input name="custom" type="hidden" value="var1=1" />
							<input type="submit" value="Payer Avec Paypal" class="btn btn-primary btn-lg btn-block"> 
						</form>







            <br/>
            <form action ="creationcommande.php" method="POST">

            <input name="submit" class="btn btn-success btn-lg btn-block" type="submit" value="Payer lors de la livraison "></form>
            </form>	
        </div>
    </div>
</div>

<br><br>





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


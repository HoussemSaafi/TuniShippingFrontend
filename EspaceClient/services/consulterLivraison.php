<?php 
//error_reporting(0);
 require_once("session.php");
  require_once("../cruds/crudClient.php");
include '../classes/livraison.php';
 $auth_client = new crudClient();
  
  
  $client_id = $_SESSION['user_session'];
  
  $stmt = $auth_client->runQuery("SELECT * FROM client WHERE IDclient=:client_id");
  $stmt->execute(array(":client_id"=>$client_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_GET['idlivraison']))
{
$l=new livraison();

$listelivraison=$l->afficherdetaillelivraison($_GET['idlivraison']);
//($listelivraison);
$c= new Commande();
$comm=$c->afficherdetaillecommande($listelivraison[0]['IDCommande']);
$liste=$c->afficherlignepourClient($listelivraison[0]['IDCommande']);
//($liste);

}



?>




<script src="//www.kirupa.com/js/prefixfree.min.js">
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../otstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="../assets/js/jquery-1.11.3-jquery.min.js"></script>
<link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <!--CUSTOM BASIC STYLES-->
    <link href="../assets/css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="../assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />


<link rel="stylesheet" href="../../../../projet/Client/services/style.css" type="text/css"  />
<title>welcome - <?php print($userRow['username']); ?></title>
</head>

<body >


<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="">GL2 ON DEMAND SHOP</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown-toggle"><a href="../../index.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Retour au site</a></li>
            <li class="dropdown-toggle"> <a href="profile.php"><span class="glyphicon glyphicon-user"></span> profile</a>&nbsp;</li>
           
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-user"></span>&nbsp;Hello Dear,  <?php echo $userRow['username']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Consulter Profile</a></li>
                <li><a href="../../../../projet/Client/services/ModifierProfile.php"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifier Profile</a></li>
                <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Se Déconnecter</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>












    <div class="clearfix"></div>
      
    
<div class="container-fluid" style="margin-top:80px;">
  
    
       <div class="container">
       








                               
                                
<?php

       if (isset($listelivraison)) {?>
                               <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            
                                            <th>ID Livraison</th>
                                            <th>Date Livraison</th>
                                            <th>Etat Livraison</th>
                                            <th>ID Commande   </th>
                                      
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                   


                                    <tbody>
                             
         
       
<?php
            
                foreach ($listelivraison as  $l) {

                    ?>

                                            <tr>
                                            <th><?php echo $l[0]; ?></th>
                                            <th><?php echo $l[3]; ?></th>
                                            <th><?php echo $l[4]; ?></th>
                                            <th><?php echo $l[2]; ?></th>
                                            
                                            
                                            
                                            <input hidden="true"  value="<?php echo  $l[4] ;?>" id="etat"></input>
                                           
                                           
                                            </tr>
                    <?php
                }
        }

                  ?>
                        </tbody>
                                </table>








<?php 
if (isset($liste)) {

 ?>
             <h4 style="margin-left: 10%" >   Detaille de la Commande:</h4>

            <ul class="list-group">
                <li class="list-group-item">
                    <span class="prefix">Date Creation:</span>
                    <span class="label label-success"><?php  echo $comm[0]['DateCreation']; ?></span>
                </li>
                <li class="list-group-item">
                    <span class="prefix">Prix Total:</span>
                    <span class="label label-success">TND <?php  echo $comm[0]['prixtotale']; ?></span>
                </li>
                <li class="list-group-item">
                    <span class="prefix">Etat Paiement:</span>
                    <span class="label label-success"><?php  echo $comm[0]['EtatPaiment']; ?></span>
                </li>
                
            </ul>

                                 
<table class="table table-hover">
                                    <thead>
                                        <tr>
                                            
                                            <th>ID Produit</th>
                                            <th>Designation</th>
                                            <th>Qte</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                   


                                    <tbody>
                             <?php

       

    # code...

            
                foreach ($liste as  $l) {
                    ?>

                                            <tr>
                                            <th><?php echo $l[1]; ?></th>
                                            <th><?php echo $l[5]; ?></th>
                                            <th><?php echo $l[0]; ?></th>

                                            </tr>
               
                        
            <?php } ?>
          </tbody>
                                </table>
<div class="row shop-tracking-status" >
    
    <div class="col-md-12">
        
    
        
            <div class="order-status">

                <div class="order-status-timeline">
                    <!-- class names: c0 c1 c2 c3 and c4 -->

                    <div id="timeline" ></div>
                </div>

                <div class="image-order-status image-order-status-new active img-circle">
                    <span class="status">Approuvée</span>
                    <div class="icon"></div>
                </div>
                <div class="image-order-status image-order-status-active active img-circle">
                    <span class="status">En Progression</span>
                    <div class="icon"></div>
                </div>
                <div class="image-order-status image-order-status-intransit active img-circle">
                    <span class="status">Embarquée</span>
                    <div class="icon"></div>
                </div>
                <div class="image-order-status image-order-status-delivered active img-circle">
                    <span class="status">Livrée</span>
                    <div class="icon"></div>
                </div>
                <div class="image-order-status image-order-status-completed active img-circle">
                    <span class="status">Terminée</span>
                    <div class="icon"></div>
                </div>

            
        </div>
    </div>

</div>

     <?php
                
                }
        

                  ?>








       </div>

<script src="../bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">
    if (document.getElementById('etat').value.toUpperCase()=="Approuvée".toUpperCase()) {

        document.getElementById('timeline').className="order-status-timeline-completion c0";
    }
    if (document.getElementById('etat').value.toUpperCase()=="En Progression".toUpperCase()) {

        document.getElementById('timeline').className="order-status-timeline-completion c1";
    } 
    if (document.getElementById('etat').value.toUpperCase()=="Embarquée".toUpperCase()) {

        document.getElementById('timeline').className="order-status-timeline-completion c2";
    } 
    if (document.getElementById('etat').value.toUpperCase()=="Livrée".toUpperCase()) {

        document.getElementById('timeline').className="order-status-timeline-completion c3";
    } 
    if (document.getElementById('etat').value.toUpperCase()=="Terminée".toUpperCase()) {
        document.getElementById('timeline').className="order-status-timeline-completion c4";
    } 


</script>


</body>
</html>
               













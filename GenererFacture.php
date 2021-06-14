<?php
require_once('commande.php');
if(!isset($_SESSION)) session_start();
$c =new Commande();
$c->ajouterCommande();
//($_SESSION['client']);
$Commande=$c->commandefacture($_SESSION['client']);
($Commande);
foreach ($Commande as $key => $value) {
    # code...
    $prod=$c->detaillefacture($value['IDCommande']);
    ($prod);
}


?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="web/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <link href="web/css/slider.css" rel="stylesheet" type="text/css" media="all"/>
    <script type="text/javascript" src="web/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="web/js/move-top.js"></script>
    <script type="text/javascript" src="web/js/easing.js"></script>
    <script type="text/javascript" src="web/js/startstop-slider.js"></script>
</head>
<title>Facture</title>

<style type="text/css">
    body {
        margin-top: 20px;
    }
</style>
</head>
<body>


<div class="container">
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <strong>GL2 ON DEMAND SHOP</strong>
                        <br>
                        6 Rue Sparte
                        <br>
                        Tunis - 1000
                        <br>
                        <abbr title="Phone">TEL:</abbr> (+216) 71 241 679
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date: <?php if($Commande[0]['DateCreation'])  echo $Commande[0]['DateCreation'];     ?></em>
                    </p>
                    <p>
                        <em>Receipt #: <?php if($Commande[0]['IDCommande']) echo $Commande[0]['IDCommande'];     ?></em>
                    </p>
                    <p>
                        <em>Etat Paiement: <?php if($Commande[0]['EtatPaiment']) echo $Commande[0]['EtatPaiment'];     ?></em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>Receipt</h1>
                </div>
                </span>
                <table class="table table-hover">
                    <thead>

                    <tr>
                        <th>Product</th>
                        <th>#</th>
                        <th class="text-center">Prix HT</th>
                        <th class="text-center">TVA</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($prod as $p) {


                        ?>
                        <tr>
                            <td class="col-md-9"><em></em></h4> <?php echo $p['Designation']; ?></td>
                            <td class="col-md-1" style="text-align: center"> <?php echo $p['Qte'];?> </td>
                            <td class="col-md-1 text-center"><?php echo $p['PrixHT'];?> </td>
                            <td class="col-md-1 text-center"><?php echo $p['TVA'];?></td>
                        </tr>
                        <?php
                    }
                    ?>

                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td class="text-right"><h4><strong>Total: </strong></h4></td>
                        <td class="text-center text-danger"><h4><strong> <?php echo $Commande[0]['prixtotale'];?> TND</strong></h4></td>
                    </tr>
                    </tbody>
                </table>
                <a title="Print Screen" class="btn btn-success btn-lg btn-block" alt="Print Screen" onclick="window.print();" target="_blank" style="cursor:pointer;" >Imprimer</a>
                <a  class="btn btn-primary btn-lg btn-block" href="index.php">
                    Boutique  <span class="glyphicon glyphicon-chevron-right"></span>
                </a></td>
            </div>
        </div>
    </div>

</body>

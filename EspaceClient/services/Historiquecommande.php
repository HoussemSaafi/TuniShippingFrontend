<?php

  require_once("session.php");
require_once("../cruds/crudClient.php");
  $auth_client = new crudClient();
  
  
  $client_id = $_SESSION['user_session'];
  
  $stmt = $auth_client->runQuery("SELECT * FROM client WHERE IDclient=:client_id");
  $stmt->execute(array(":client_id"=>$client_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

  $query=$auth_client->runQuery("SELECT IDCommande, DateCreation, EtatPaiment, prixtotale from commande  where IDclient=:client_id");
  $query->execute(array(":client_id"=>$client_id));
  $listeCommande=$query->fetchAll();
//  var_dump($listeCommande);



?>






<script src="//www.kirupa.com/js/prefixfree.min.js">
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="../assets/js/jquery-1.11.3-jquery.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css"  />
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
                <li><a href="logout?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Se Déconnecter</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div class="clearfix"></div>
      
    
<div class="container-fluid" style="margin-top:80px;">
  
    
       <div class="container">
       


<br><br>
<br><br>
  <div class="row">
       
                 <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title">Vos commandes </h3>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter" onclick="ShowFilter()"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
            </div>
            <table class="table" id="myDiv" hidden>
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="ID" id="myInput0" onkeyup="myFunction(0)" ></th>
                         <th><input type="text" class="form-control" placeholder="Date Création" id="myInput1" onkeyup="myFunction(1)"></th>
                        <th><input type="text" class="form-control" placeholder="Etat Paiment" id="myInput2" onkeyup="myFunction(2)"></th>
                        <th><input type="text" class="form-control" placeholder="Prix Total" id="myInput3" onkeyup="myFunction(3)"></th>
                    </tr>
                </thead>
                <tbody>
            </table>

                 </div>
  </div>
           <table class="table"  id="myTable">
               <thead>
               <th>ID Commande</th>
               <th>Date Création</th>
               <th>Etat Paiment</th>
               <th>Prix Total</th>

               </thead>
               <tbody>
                    <?php

                                                    
                    foreach($listeCommande as $liste) {
?>
                        <tr>
                            <td><b><?= $liste[0] ?></b></td>
                        <td><b><?= $liste[1] ?></b></td>
                        <td><b><?=$liste[2] ?></b></td>
                        <td><b><?= $liste[3] ?></b></td>
                            <td><a href ="consultercommande.php?IDCommande=<?php echo $liste[0];?>" class="btn btn-primary" >Consulter </a>   </td>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>










       </div>

<script src="../bootstrap/js/bootstrap.min.js"></script>

<script>
    function myFunction(K) {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput"+K);
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[K];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    function ShowFilter() {
        var x = document.getElementById("myDiv");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
</body>
</html>
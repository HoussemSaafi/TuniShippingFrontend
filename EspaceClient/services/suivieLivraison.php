<?php

  require_once("session.php");
require_once("../cruds/crudClient.php");
  include '../classes/livraison.php';

  $auth_client = new crudClient();
  
  
  $client_id = $_SESSION['user_session'];
  
  $stmt = $auth_client->runQuery("SELECT * FROM client WHERE IDclient=:client_id");
  $stmt->execute(array(":client_id"=>$client_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

  $query=$auth_client->runQuery("SELECT IDCommande, DateCreation, EtatPaiment, prixtotale from commande  where IDclient=:client_id");
  $query->execute(array(":client_id"=>$client_id));
  $listeCommande=$query->fetchall();


  $liv= new livraison();
  $liste=$liv->AfficherLivraisonClient($client_id);




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
       







        <?php

       if (isset($liste)) {?>
                               <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            
                                            <th>ID Livraison</th>
                                            <th>Date Livraison</th>
                                            <th>Etat Livraison</th>
                                            <th>ID Commande   </th>
                                            
                                           
                                        </tr>
                                    </thead>
                                   


                                    <tbody>
                             
         
       
<?php
            
                foreach ($liste as  $l) {
                    
                    ?>
                    <form>
                                            <tr>
                                            <th><?php echo $l[0]; ?></th>
                                            
                                            <th><?php echo date($l[3]); ?></th>
                                            <th><?php echo $l[4]; ?></th>
                                            <th><?php echo $l[2]; ?></th>
                                            <th><a href="consulterLivraison.php?idlivraison=<?php echo $l[0]; ?>" class="btn btn-primary">Consulter</a></th>
                                           
                                            </tr>
                                            </form>
                    <?php
                }
        }

                  ?>
                        </tbody>
                                </table>








       </div>

<script src="../bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            $('.filterable .btn-filter').click(function(){
                var $panel = $(this).parents('.filterable'),
                    $filters = $panel.find('.filters input'),
                    $tbody = $panel.find('.table tbody');
                if ($filters.prop('disabled') == true) {
                    $filters.prop('disabled', false);
                    $filters.first().focus();
                } else {
                    $filters.val('').prop('disabled', true);
                    $tbody.find('.no-result').remove();
                    $tbody.find('tr').show();
                }
            });

            $('.filterable .filters input').keyup(function(e){
                /* Ignore tab key */
                var code = e.keyCode || e.which;
                if (code == '9') return;
                /* Useful DOM data and selectors */
                var $input = $(this),
                    inputContent = $input.val().toLowerCase(),
                    $panel = $input.parents('.filterable'),
                    column = $panel.find('.filters th').index($input.parents('th')),
                    $table = $panel.find('.table'),
                    $rows = $table.find('tbody tr');
                /* Dirtiest filter function ever ;) */
                var $filteredRows = $rows.filter(function(){
                    var value = $(this).find('td').eq(column).text().toLowerCase();
                    return value.indexOf(inputContent) === -1;
                });
                /* Clean previous no-result if exist */
                $table.find('tbody .no-result').remove();
                /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
                $rows.show();
                $filteredRows.hide();
                /* Prepend no-result row if all rows are filtered */
                if ($filteredRows.length === $rows.length) {
                    $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
                }
            });
    </script>



</body>
</html>
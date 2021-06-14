<?php

  require_once("session.php");
require_once("../cruds/crudChat.php");
require_once("../cruds/crudClient.php");;
  $auth_client = new crudClient();
  $Chat= new crudChat();
  $client_id = $_SESSION['user_session'];
  
  $stmt = $auth_client->runQuery("SELECT * FROM client WHERE IDclient=:client_id");
  $stmt->execute(array(":client_id"=>$client_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);



  $nombre_en_ligne= $Chat->numberUser_connecte();

?>
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

<body>


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
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hello Dear, <?php echo $userRow['username']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Consulter Profile</a></li>
                <li><a href="ModifierProfile.php"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Modifier Profile</a></li>
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
    

    <div class="container">
      <div class="row">
      
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title" ><?php  echo $userRow['nom'],' ',$userRow['prenom']  ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://image.freepik.com/vecteurs-libre/icone-d&-39;utilisateur-de-sexe-masculin_17-810120247.jpg" class="img-circle img-responsive">

                </div>
                
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>username:</td>
                        <td><?php echo $userRow['username'] ?></td>
                      </tr>
                      <tr>
                        <td>Age:</td>
                        <td><?php echo $userRow['age'] ?></td>
                      </tr>
                      <tr>
                        <td>date d'inscription:</td>
                        <td><?php echo $userRow['date_inscription'] ?></td>
                      </tr>
                      <tr>
                        <td>CIN</td>
                        <td><?php echo $userRow['CIN'] ?></td>
                      </tr>
                   
  
                        <tr>
                        <td> Addresse</td>
                        <td><?php echo $userRow['adresse'] ?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><?php echo $userRow['email'] ?></td>
                      </tr>
                        <td>Numéro de Téléphone:</td>
                        <td><?php echo $userRow['telephone'] ?><br>
                        </td>    
                      </tr>
                     
                    </tbody>
                  </table>
                  
                  <a href="Historiquecommande.php" class="btn btn-primary">Historique d'achats</a>
                  <a href="suivieLivraison.php" class="btn btn-primary">Suivie des livraisons</a>
                  
                </div>
              </div>
            </div>

              <div class="panel-footer">
                        <a type="button"  class="btn btn-sm btn-primary"  data-toggle="collapse"  data-parent="#accordion" href="#collapseOne"  ><i class="glyphicon glyphicon-envelope"></i></a>
                        <span class="pull-right">
                            <a href="ModifierProfile.php" type="button" class="btn btn-sm btn-warning" title="Modifier vos informations"><i class="glyphicon glyphicon-edit"></i></a>
                             <a href="ModifierPassword.php" type="button" class="btn btn-sm btn-warning" title="Modifier Mot de passe"><i class="glyphicon glyphicon-lock"></i></a>
                             <!-- Button trigger modal -->
                           
                            <a  type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal" title="Desactiver Compte"><i class="glyphicon glyphicon-remove"></i></a>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Êtes-vous sûr de vouloir désactiver votre compte?</h4>
                                  </div>
                                  <div class="modal-body">
                                    En désactivant votre compte vous n'aurez plus le droit à l'accés à notre site en tant qu'utilisateurs .Si vous voulez réactiver votre compte faudra envoyer une rèclamation!! 
                                  </div>
                                  <div class="modal-footer " >
                                      <a href="logout.php?desactiver=$uid" type="button" class="btn btn-sm btn-danger" title="Desactiver Compte"><i class="glyphicon glyphicon-thumbs-down">&nbsp;Oui</i></a>
                                     <a href="profile.php" type="button" class="btn btn-sm btn-success"  ><i class="glyphicon glyphicon-thumbs-up">&nbsp;Non</i></a>
                                    
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                        </span>
                    </div>
            
          </div>
        </div>
      </div>
    </div> 
      
    
    </div>

</div>
<div class="container" style="position: absolute; bottom:0px">
    <div class="row" >

        <div class="col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading" id="accordion">
                    <span class="glyphicon glyphicon-comment "></span> Chat

                    <div class="btn-group pull-right">

                        <a href="profile.php" type="button" class="btn btn-default btn-xs" title="Rafraichir la discussion"><i class="  glyphicon glyphicon-refresh"></i>
                        </a>

                        <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" >
                            <span class="glyphicon glyphicon-chevron-down"></span>
                        </a>





                    </div>
                </div>
                <div class="panel-collapse collapse" id="collapseOne">
                    <div class="panel-bod" id="reload"  >


                    </div>

                    <div class="panel-footer">
                        <form action="savechat.php" method="post" id="reg-form" name="chatform">
                            <div class="input-group">
                                <input id="btn-input" type="text" type="text" name="message" id="message" class="form-control input-sm" placeholder="Type your message here..." required />
                                <span class="input-group-btn">
                           <input class="btn btn-warning btn-sm" id="btn-chat" type="submit" value="Envoyer"  />
                        </span>

                            </div>
                        </form>

                        <a
                                class="btn btn-info btn-xs" title="Nombre de personne connecté"><b>Nombre d'utilisateur connectés:&nbsp;<?php print($nombre_en_ligne); ?></b>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>





<script src="../bootstrap/js/bootstrap.min.js"></script>
<script>

    $(document).ready(function(){
        setInterval(function(){
            $("#reload").load('loadchat.php')
        }, 500);
    });
</script>

<script type="text/javascript">
    $(document).ready(function()
    {


        $(document).on('submit', '#reg-form', function()
        {



            var data = $(this).serialize();
            // a text string in standard URL-encoded notation

            $.ajax({

                type : 'POST',
                url  : 'savechat.php',
                data : data,
                success :  function(data)
                {
                    $("#reg-form")[0].reset();
                }
            });
            return false;
        });
    });


</script>

</body>
</html>
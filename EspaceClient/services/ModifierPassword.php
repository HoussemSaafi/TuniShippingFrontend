<?php

  
  require_once("session.php");
require_once("../cruds/crudClient.php");
  $auth_client = new crudClient();
  
  
  $client_id = $_SESSION['user_session'];
  
  $stmt = $auth_client->runQuery("SELECT * FROM client WHERE IDclient=:client_id");
  $stmt->execute(array(":client_id"=>$client_id));
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);






if(isset($_POST['btn-changerpass']))
{  
   
   $upass=strip_tags($_POST['txt_upass']);
   $unewpass = strip_tags($_POST['txt_unewpass']);
   $unewpassval  =  strip_tags($_POST['txt_unewpassval']);

   if( $upass=="")
   {
    $error[] = "Entrer votre mot de passe !";
   }

  else if(!($upass == $userRow['mdp']))
   {
    $error[] = "Votre mot de passe n'est pas valide !";
   }

  else if($unewpass=="")  
  {
    $error[] = "Entrer votre nouvelle Mot de passe !";
  }
  else if(strlen($unewpass) < 6)
  {
    $error[] = "Mot de passe doit ètre au moins de 6 charactères "; 
  }
else if($unewpass!=$unewpassval )
  {
     $error[] = "les deux mots de passe ne sont identiques "; 
  }
  else
  {
    try
    {
      
         if($auth_client->changermotdepasse($client_id,$unewpass))
        {
          $auth_client->redirect('ModifierPassword.php?changermdp');
        }
    }
    
    catch(PDOException $e)
    {
      echo $e->getMessage();
    }
     

  
  }
}





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="../assets/js/jquery-1.11.3-jquery.min.js"></script>
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css"  />
<title>welcome - <?php print($userRow['email']); ?></title>
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
        <span class="glyphicon glyphicon-user"></span>&nbsp;Hello Dear, <?php echo $userRow['username']; ?><span class="caret"></span></a>
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


<div class="clearfix">

 <div class="signin-form">

  <div class="container">
          <ul class="nav nav-tabs" style=" padding-left:321px">
            <li ><a href="ModifierProfile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Informations Personnels</a></li>
            <li class="active"><a href="ModifierPassword.php" ><span class="glyphicon glyphicon-lock"></span>&nbsp;Confidialité</a></li>
          </ul>
      
      <form method="post" class="form-signin">

           <h2 class="form-signin-heading">Changer votre mot de passe:</h2><hr />
             <?php
                if(isset($error))
                {
                  foreach($error as $error)
                  {
                     ?>         
                               <div class="alert alert-danger  " >
                                  <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                               </div>

                               
                               <?php
                  }
                }
                else if(isset($_GET['changermdp']))
                {
                   ?>
                           <div class="alert alert-info f">
                                <i class="glyphicon glyphicon-log-in"></i> &nbsp; Modification avec Succès  <a href='profile.php'> Retour vers votre Profile</a>
                           </div>
                           <?php
                }
                ?>
     

          <div class="form-group">
          <label> Mot de passe:</label>
              <input type="password" class="form-control" name="txt_upass"  placeholder="Entrer votre ancien Mot de Passe" />
          </div>       
          <div class="form-group">
          <label> Nouveau mot de passe:</label>
              <input type="password" class="form-control" name="txt_unewpass"  placeholder="Entrer votre Mot de Passe" />
          </div>
          <div class="form-group">
          <label> Nouveau mot de passe:</label>
              <input type="password" class="form-control" name="txt_unewpassval"  placeholder="Ré-entrer votre Mot de Passe"  />
          </div>
          <div class="form-group"> 
          <div class="form-group">
            
         


                 <a  type="submit" class="btn btn-sm btn-danger" name="btn-changerpass" data-toggle="modal" data-target="#myModal">
                  <i class="glyphicon glyphicon-edit"></i>&nbsp;Changer Mot de passe 
                 </a>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Êtes-vous sûr de vouloir  modifier votre mot de passe?</h4>
                                  </div>
                                  <div class="modal-body" >
                                  <p style="color: black">Pour modifier votre mot de passe appuez sur (Changer Mot de passe ).Sinon appuez sur (X) pour Annuler!!</p>
                                  </div>
                                  <div class="modal-footer " >

                                     <button type="submit" class="btn btn-sm btn-danger" name="btn-changerpass"  >
                                          <i class="glyphicon glyphicon-edit"></i>&nbsp;Changer Mot de passe 
                                     </button>
                                     </a>

                                  </div>
                                </div>
                              </div>
                            </div>
          </div>

      </form>
     
   
    
  </div>
 </div>
</div>
 


<script src="../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
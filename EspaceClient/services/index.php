<?php
session_start();
require_once("../cruds/crudClient.php");


$login = new crudClient();

if($login->is_loggedin()!="")
{
	$login->redirect('profile.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']);
	$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);


  if(!$login->excistencecompte($uname,$umail))
  {
    $login->redirect('index.php?nexistepas');
     
  }

  else
  {
	  if(!$login->statusducompte($uname,$umail))
    {
       $login->redirect('index.php?desactiver');
    }
    else
    {
       
      if($login->doLogin($uname,$umail,$upass))
      {
          $client_id = $_SESSION['user_session'];
        $login->Client_connecte($client_id);
        $login->redirect('profile.php');
      }
      else
      {
        $error = " Mauvais Détails  !";
      }
    }	
  }
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bienvenu a GL2 ON DEMAND SHOP</title>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="../assets/css/style.css" type="text/css"  />
</head>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<body style="background: url('logo.png')no-repeat center center fixed; background-size: cover; ">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.6";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>




<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Connectez-vous!!</h2>
      
        <hr />


        
        <div id="error">
        <?php

      if(isset($error))
      {
        
           ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
        
      }
      else if(isset($_GET['desactiver']))
      {
         ?>
                 <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; Compte désactiver 
                 </div>
                 <?php
      }
      else if(isset($_GET['desactiversucces']))
      {
         ?>
                 <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; Compte désactiver avec succés
                 </div>
                 <?php
      }else if(isset($_GET['nexistepas']))
      {
      ?>
                  <div class="alert alert-warning">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; Vous n'avez pas encore de compte  <a href='sign-up.php'> Cliquer ici pour créer un</a>
                 </div>
        <?php
      }
      else if(isset($_GET['mdpmodifier']))
      {
        ?>
           <div class="alert alert-info">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; Votre Mot de passe est modifier avec succés!!&nbsp;Vous pouvez vous connectez
                 </div>


       <?php
     }
     ?>
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" name="txt_uname_email" placeholder="Username or E mail ID" required autocomplete="off" />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" name="txt_password" placeholder="Mot De Passe" required />
        </div>
        <label><a href="Mdpoublie1.php">Mot de passe Oublié?</a></label>
     	  <hr />
        
        <div class="form-group">
            <button type="submit" name="btn-login" class="btn btn-primary">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; Sign In
            </button>
        </div>  
      	<br />
            <label>Vous n'avez pas encore de compte ! <a href="sign-up.php">S'inscrire</a></label>
             <hr />
            <a href="../../index.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Retour au site</a>
         


           
       
      </form>
       <div class="fb-share-button" data-href="http://localhost/TuniShipping-Frontend/EspaceClient/services/profile.php" data-layout="button_count" data-mobile-iframe="true"></div>

            <div style="padding-left:210px"class="fb-like" data-href="https://www.facebook.com/Shipping-from-across-the-World-111456524500065" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>


    </div>
    
</div>

</body>
</html>
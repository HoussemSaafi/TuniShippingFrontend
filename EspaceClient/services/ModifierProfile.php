<?php

  
  require_once("session.php");
require_once("../cruds/crudClient.php");
  $auth_client = new crudClient();
  
  
  $client_id = $_SESSION['user_session'];

  $stmt = $auth_client->runQuery("SELECT * FROM client WHERE IDclient=:client_id");
  $stmt->execute(array(":client_id"=>$client_id));
  
  $userRow=$stmt->fetch(PDO::FETCH_ASSOC);



if(isset($_POST['btn-modifier']))
{ 
  $uid = $userRow['IDclient'];
  $uname = strip_tags($_POST['txt_uname']);
  $umail = strip_tags($_POST['txt_umail']);
  $unom = strip_tags($_POST['txt_unom']);
  $uprenom = strip_tags($_POST['txt_uprenom']);
  $ucin =  strip_tags($_POST['txt_ucin']);
  $utelephone = strip_tags($_POST['txt_utelephone']);
  $uadresse = strip_tags($_POST['txt_uadresse']);
  $uage = strip_tags($_POST['txt_uage']);
  
  if($uname=="")  {
    $error[] = "Entrer votre username !"; 
  }
  else if($umail=="") {
    $error[] = "Entrer votre Email ID !"; 
  }
  else if(!filter_var($umail, FILTER_VALIDATE_EMAIL)) {
      $error[] = ' Entrer une email adresse valid !';
  }
  else if($unom=="")  {
    $error[] = "Entrer votre Nom !";
  }
  else if($uprenom=="") {
    $error[] = "Entrer votre Prenom !";
  }
  
  else if(strlen($ucin) != 8)
  {
    $error[] = "CIN doit ètre de taille 8 charactères"; 
  }
  else if(strlen($utelephone) < 9)
  {
    $error[] = "Numéro de Telephone  doit ètre au moins de 9 charactères";
  }
  else if($uadresse == "")
  {
    $error[] = "Entrer une adresse !";
  }
  else if($uage < 10)
  {
    $error[] = "Vous devez avoir plus de 10 ans !";
  }
  else
  {
   try
    {  $auth_client->validiter_username($uname);

      if (!$auth_client->validiter_username($uname))
       {
       $error[] = "Désole ce Username est déjà utilisé !";
      }
      elseif (!$auth_client->validiter_email($umail))
      {
        $error[] = "Désole ce Email est déjà utilisé !";
      }
      elseif (!$auth_client->validiter_cin($ucin))
      {
       $error[] = "Désole ce CIN est déjà utilisé !";
      }

      else
      {
      if ($auth_client->modifier_utilisateur($uid,$uname,$umail,$unom,$uprenom,$ucin,$utelephone,$uadresse,$uage))
        {
          $auth_client->redirect('Profile.php');
        }  
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
            <li class="dropdown-toggle"> <a href=profile.php"><span class="glyphicon glyphicon-user"></span> profile</a>&nbsp;</li>
           
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-user"></span>&nbsp;Hello Dear,  <?php echo $userRow['username']; ?>&nbsp;<span class="caret"></span></a>
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
      <li class="active"><a href="ModifierProfile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Informations Personnels</a></li>
      <li><a href="ModifierPassword.php" ><span class="glyphicon glyphicon-lock"></span>&nbsp;Confidialité</a></li>
    </ul>
                 
    

          

        <form method="post" class="form-signin">
            <h2 class="form-signin-heading">Modification des informations:</h2><hr />
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
                  else if(isset($_GET['modifier']))
                  {
                     ?>
                             <div class="alert alert-info ">
                                  <i class="glyphicon glyphicon-log-in"></i> &nbsp; Modification avec Succès  <a href='profile.php'> Retour vers votre Profile</a>
                             </div>
                             <?php
                  }
                  ?>
            <div class="form-group">
             <label> Nom d'utilisateur:</label>
            <input type="text" class="form-control" name="txt_uname" value="<?php  echo $userRow['username']  ?>" />
            </div>
            <div class="form-group">
            <label> Adresse Email:</label>
            <input type="text" class="form-control" name="txt_umail" value="<?php echo $userRow['email'] ?>"  />
            </div>
            <div class="form-group">
            <label> Nom :</label>
              <input type="text" class="form-control" name="txt_unom" value="<?php echo $userRow['nom'] ?>" />
            </div>
            <div class="form-group">
            <label> Prenom:</label>
              <input type="text" class="form-control" name="txt_uprenom" value="<?php echo $userRow['prenom'] ?>"   />
            </div>
            <div class="form-group">
            <label> Age:</label>
              <input type="text" class="form-control" name="txt_uage" value="<?php echo $userRow['age'] ?>"  />
            </div>
            <div class="form-group">
            <label> CIN:</label>
              <input type="text" class="form-control" name="txt_ucin" value="<?php echo $userRow['CIN'] ?>"/>
            </div>
            <div class="form-group">
            <label> Numero Telephone:</label>
              <input type="text" class="form-control" name="txt_utelephone" value="<?php echo $userRow['telephone'] ?>"/>
            </div>
             <div class="form-group">
             <label> Adresse:</label>
              <input type="text" class="form-control" name="txt_uadresse" value="<?php echo $userRow['adresse'] ?>"  />
            </div>
            <div class="form-group">
                <div class="form-group">




                    <a  type="submit" class="btn btn-sm btn-danger" name="btn-modifier" data-toggle="modal" data-target="#myModal">
                        <i class="glyphicon glyphicon-edit"></i>&nbsp;Modifier
                    </a>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Êtes-vous sûr de vouloir  modifier vos informations personnels?</h4>
                                </div>
                                <div class="modal-body" >
                                    <p style="color: black">Pour modifier vos informations appuez sur (Modifier).Sinon appuez sur (X) pour Annuler!!</p>
                                </div>
                                <div class="modal-footer " >

                                    <button type="submit" class="btn btn-sm btn-danger" name="btn-modifier"  >
                                        <i class="glyphicon glyphicon-edit"></i>&nbsp;&nbsp;Modifier
                                    </button>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>





            <label>Je ne veux pas changer <a href="../../../../projet/Client/services/index.php">Retour</a></label>
        </form>
     
  </div>
 </div>
</div>


 


<script src="../bootstrap/js/bootstrap.min.js"></script>
<script>
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
    // function Valider() {
    //     var x = document.getElementById("myModal");
    //     if (x.style.display === "none") {
    //         x.style.display = "block";
    //     } else {
    //         x.style.display = "none";
    //     }
    // }
</script>

</body>
</html>
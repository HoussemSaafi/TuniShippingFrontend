<?php

require_once("../cruds/crudClient.php");

$login = new crudClient();

$uid=base64_decode($_GET['IDclient'])  ;

$stmt = $login->runQuery("SELECT * FROM client WHERE IDclient=".$uid);
$stmt->execute();
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['btn-reset']))
{  $client_id = $userRow['IDclient'];
$unewpass = strip_tags($_POST['txt_unewpass']);
$unewpassval  =  strip_tags($_POST['txt_unewpassval']);

if ($unewpass == $userRow['mdp'])
{
$error[] = "Vous avez entré un ancien mot de passe !";
}

else if($unewpass=="")
{
$error[] = "Entrer votre nouvelle Mot de passe !";
}
else if($unewpass=="")
{
$error[] = "Mot de passe doit ètre au moins de 6 charactères ";
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
if($login->changermotdepasse($client_id,$unewpass))
{
$login->redirect('index.php?mdpmodifier');
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
    <title>Bienvenu a GL2 ON DEMAND SHOP</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css"  />
</head>
<body>




<div class="signin-form">

    <div class="container">

        <form class="form-signin" method="post" id="login-form">


            <h2 class="form-signin-heading">Récupération de Mot de Passe:</h2><hr />



            <label> Phase3: Changement de votre Mot de passe:</label>

            <div id="error">
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
                ?>
            </div>
            <hr />

            <div class="form-group">
                <div class="form-group">
                    <label> Nouveau mot de passe:</label>
                    <input type="password" class="form-control" name="txt_unewpass"  placeholder="Entrer votre Mot de Passe"  />
                </div>

                <div class="form-group">
                    <label> Nouveau mot de passe:</label>
                    <input type="password" class="form-control" name="txt_unewpassval"  placeholder="Ré-entrer votre Mot de Passe"  />
                </div>



                <div class="form-group">
                    <button type="submit" name="btn-reset" class="btn btn-danger">
                        <i class="glyphicon glyphicon-edit"></i> &nbsp; Changer Mot de passe
                    </button>
                </div>

                <br />
                <label>Vous n'avez pas encore de compte ! <a href="../../../../projet/Client/services/sign-up.php">S'inscrire</a></label>
            </div>
        </form>

    </div>

</div>

</body>
</html>
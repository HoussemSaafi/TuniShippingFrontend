<?php
session_start();
require_once("../cruds/crudClient.php");



$login = new crudClient();


if(isset($_POST['btn-reset']))
{
    $uname = strip_tags($_POST['txt_uname_email']);
    $umail = strip_tags($_POST['txt_uname_email']);

    if($uname=="")  {
        $error[] = "Entrer votre username !";
    }
    else if($umail=="") {
        $error[] = "Entrer votre Email ID !";
    }
    $conn=ConnexionBD::getInstance();
    $stmt ="SELECT username, email FROM client WHERE username=:uname OR email=:umail ";
    $req = $conn->prepare($stmt);
    $req->execute(array(':uname'=>$uname, ':umail'=>$umail ));
    $row=$req->fetch(PDO::FETCH_ASSOC);
    if( ($row['username'] == $uname)||($row['email'] == $umail) )
    {
        if(!$login->statusducompte($uname,$umail))
        {
            $login->redirect('index.php?desactiver');
        }
        else
        {

            $stmt ="SELECT IDclient FROM client WHERE username=:uname OR email=:umail ";
            $req =$conn->prepare($stmt);
            $req->execute(array(':uname'=>$uname, ':umail'=>$umail));
            $row=$req->fetch(PDO::FETCH_ASSOC);
            $encode=base64_encode ( $row['IDclient'] );

            $login->redirect('Mdpoublie2.php?IDclient='.$encode.'');

        }
    }
    else
    {
        $error = " Email ou Username ID inexistant  !";
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

                ?>
            </div>

            <label> Phase1: Entrez votre Email ou Username ID:</label>

            <div class="form-group">

                <div class="form-group">
                    <input type="text" class="form-control" name="txt_uname_email" placeholder="Entrez votre Username or E mail ID" required />
                    <span id="check-e"></span>
                </div>

                <hr />

                <div class="form-group">
                    <button type="submit" name="btn-reset" class="btn btn-primary">
                        <i class="glyphicon glyphicon-ok"></i> &nbsp; Valider
                    </button>
                </div>
                <br />
                <label>Vous n'avez pas encore de compte ! <a href="sign-up.php">S'inscrire</a></label>
        </form>

    </div>

</div>

</body>
</html>
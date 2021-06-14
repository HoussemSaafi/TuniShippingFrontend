<?php

require_once("../cruds/crudClient.php");

$login = new crudClient();

$uid=base64_decode($_GET['IDclient'])  ;

$stmt = $login->runQuery("SELECT * FROM client WHERE IDclient=".$uid);
$stmt->execute();
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);



if(isset($_POST['btn-reset']))
{
    $urepquestion = strip_tags($_POST['txt_urepquestion']);

    try
    {
        $stmt = $login->runQuery("SELECT Repquestion FROM client WHERE IDclient=".$userRow['IDclient']);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        if($row['Repquestion']!=$urepquestion) {
            $error = "Désolé,Mauvaise réponse";
        }

        else
        {
            $login->redirect('Mdpoublie3.php?IDclient='.$_GET['IDclient'].'');
        }
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
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

            <label> Phase2: Répondez à votre question secrète:</label>
            <hr />
            <label style="color: black">Bienvenu  : <?php  echo $userRow['nom'],' ',$userRow['prenom'];  ?> </label>


            <div class="form-group">
                <label ><?php print($userRow['question']); ?> </label>
                <div class="form-group">
                    <input type="text" class="form-control" name="txt_urepquestion" placeholder="Entrez votre réponse" required />
                    <span id="check-e"></span>
                </div>

                <hr />

                <div class="form-group">
                    <button type="submit" name="btn-reset" class="btn btn-primary">
                        <i class="glyphicon glyphicon-ok"></i> &nbsp; Valider
                    </button>
                </div>
                <br />
                <label>Vous n'avez pas encore de compte ! <a href="../../../../projet/Client/services/sign-up.php">S'inscrire</a></label>
        </form>

    </div>

</div>

</body>
</html>
<?php
session_start();
require_once("../cruds/crudClient.php");
$client = new crudClient();

if($client->is_loggedin()!="")
{
	$client->redirect('profile.php');
}
 
if(isset($_POST['btn-signup']))
{  



	    
	   
	$uname = strip_tags($_POST['txt_uname']);
	$umail = strip_tags($_POST['txt_umail']);
	$unom = strip_tags($_POST['txt_unom']);
	$uprenom = strip_tags($_POST['txt_uprenom']);
	$upass = strip_tags($_POST['txt_upass']);
	$ucin =  strip_tags($_POST['txt_ucin']);
	$utelephone = strip_tags($_POST['txt_utelephone']);
	$uadresse = strip_tags($_POST['txt_uadresse']);
	$uage = strip_tags($_POST['txt_uage']);
	$urepquestion = strip_tags($_POST['txt_urepquestion']);
	$uquestion = $_POST['question'];
	
	if($uname=="")	{
		$error[] = "Entrer votre username !";	
	}
	else if($umail=="")	{
		$error[] = "Entrer votre Email ID !";	
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = ' Entrer une email adresse valid !';
	}
	else if($unom=="")	{
		$error[] = "Entrer votre Nom !";
	}
	else if($uprenom=="")	{
		$error[] = "Entrer votre Prenom !";
	}
	else if($upass=="")	{
		$error[] = "Entrer votre Mot de passe !";
	}
	else if(strlen($upass) < 6){
		$error[] = "Mot de passe doit ètre au moins de 6 charactères ";	
	}
	else if(strlen($ucin) != 8)
	{
		$error[] = "CIN doit ètre de taille 8 charactères";	
	}
	else if(strlen($utelephone) < 8)
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
	else if($urepquestion =="")
	{
		$error[] = "Veuilliez insérer la réponse de votre question secrète !";
	}
	else
	{
		try
		{
			$stmt ="SELECT username, email, CIN FROM client WHERE username=:uname OR email=:umail OR CIN =:ucin ";
            $conn=ConnexionBD::getInstance();
			$req = $conn->prepare($stmt);
			$req->execute(array(':uname'=>$uname, ':umail'=>$umail, 'ucin'=>$ucin));
			$row=$req->fetch(PDO::FETCH_ASSOC);
				
			if($row['username']==$uname) {
				$error[] = "Désole ce Username est déjà utilisé !";
			}
			else if($row['email']==$umail) {
				$error[] = "Désole ce Email est déjà utilisé !";
			}
			else if ($row['CIN']==$ucin) {
				$error[] = "Désole ce CIN est déjà utilisé !";
			}
			else
			{
				if($client->register($uname,$umail,$unom,$uprenom,$upass,$ucin,$utelephone,$uadresse,$uage,$urepquestion,$uquestion)){
					$client->redirect('sign-up.php?enregistre');
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
<title>Coding Cage : INSCRIPTION</title>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css"  />
</head>
<body>

<div class="signin-form">

<div class="container">
    	
        <form method="post" class="form-signin">
            <h2 class="form-signin-heading">Inscription:</h2><hr />
            <?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
			else if(isset($_GET['enregistre']))
			{
				 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Enregistrement avec Succès  <a href='index.php'>Sign In</a> ici
                 </div>
                 <?php
			}
			?>

            <div class="form-group">
            <label> Nom d'utilisateur:</label>
            <input type="text" class="form-control" name="txt_uname" placeholder="Entrer votre Username" value="<?php if(isset($error)){echo $uname;}?>" autocomplete="off"/>
            </div>

            <div class="form-group">
            <label> Adresse Email:</label>
            <input type="text" class="form-control" name="txt_umail" placeholder="Entrer votre E-Mail ID" value="<?php if(isset($error)){echo $umail;}?>" autocomplete="off"/>
            </div>

            <div class="form-group">
            <label> Nom :</label>
            	<input type="text" class="form-control" name="txt_unom" placeholder="Entrer Votre nom" value="<?php if(isset($error)){echo $unom;}?>" autocomplete="off"/>
            </div>

            <div class="form-group">
            <label> Prenom:</label>
            	<input type="text" class="form-control" name="txt_uprenom" placeholder="Entrer Votre prenom" value="<?php if(isset($error)){echo $uprenom;}?>"  autocomplete="off"/>
            </div>

            <div class="form-group">
            <label> Age:</label>
            	<input type="text" class="form-control" name="txt_uage" placeholder="Entrer votre Age" value="<?php if(isset($error)
            	){echo $uage;}?>" autocomplete="off"/>
            </div>

            <div class="form-group">
            <label> Mot de passe:</label>
            	<input type="password" class="form-control" name="txt_upass" placeholder="Entrer votre Mot de Passe" />
            </div>

            <div class="form-group">
            	<label> Question secrète:</label>
            	<select class="form-control" name="question" >
            		<option disabled selected>Choisir une Question:</option>
	                <option  value="Quel est le nom de votre premier animal de compagnie ?"> Quel est le nom de votre premier animal de compagnie ?</option>
	                <option  value="Quel était le métier de votre grand-père ?">Quel était le métier de votre grand-père ?</option>
	                <option  value="Quel est votre Meilleur ami d'enfance ?" >Quel est votre Meilleur ami d'enfance ?</option>
	                <option  value="Quel est votre sportive préféré ?<">Quel est votre sportive préféré ?</option>
            	</select>
            	<input type="text" class="form-control" name="txt_urepquestion" placeholder="Entrer votre réponse" />	
            </div>


            <div class="form-group">
            <label> CIN:</label>
            	<input type="text" class="form-control" name="txt_ucin" placeholder="Entrer votre CIN" value="<?php if(isset($error))
            	{echo $ucin;}?>" />
            </div>

            <div class="form-group">
            <label> Numéro Téléphone::</label>
            	<input type="text" class="form-control" name="txt_utelephone" placeholder="Entrer votre  Telephone "value="<?php if(isset($error)){echo $utelephone;}?>"  />
            </div>


            <div class="form-group">
             <label> Adresse:</label>
            	<input type="text" class="form-control" name="txt_uadresse" placeholder="Entrer votre Adresse"  value="<?php if(isset($error)){echo $uadresse;}?>" />
            </div>
             


             
            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;S'INSCRIRE
                </button>
            </div>
            <br />
            <label>J'ai un compte <a href="index.php">Sign In</a></label>
        </form>
       </div>
</div>

</div>

</body>
</html>
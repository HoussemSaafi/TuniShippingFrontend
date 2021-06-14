
<?php
require_once ('crudReclamation.php');

require_once('ConnexionBD.php');
require_once ('Reclamation.php');
//session_start();
$crr=new crudReclamation(); 

echo $_POST['Description'];
$conn=ConnexionBD::getInstance();

if (isset($_POST['Description']) and isset($_POST['Sujet']) and isset($_POST['IDClient']) )
{
$rep=new Reclamation($_POST['Description'],$_POST['Sujet'],$_POST['IDClient']);

$crr->insertReclamation($rep);




header('location:contact.php?success=1');
}
else{
	header('location:contact.php?success=0');
}



?>
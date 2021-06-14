<?php
// filename: myAjaxFile.php
// some PHP
require_once('ConnexionBD.php');
		$conn=ConnexionBD::getInstance();

		$req1="INSERT INTO newsletter (email) VALUES ('".$_GET['email']."')";
		if($conn->query($req1))
		{
			echo "success";
		}
		else
		{
			echo "error";
		}

        

?>
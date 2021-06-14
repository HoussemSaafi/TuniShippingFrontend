<?php
    include('../classes/ConnexionBD.php');
    require_once("session.php");
require_once("../cruds/crudClient.php");
	require_once("../cruds/crudChat.php");


	$auth_client = new crudClient();
	$chat = new crudChat();





	$client_id = $_SESSION['user_session'];
    $stmt = $auth_client->runQuery("SELECT * FROM client WHERE IDclient=:client_id");
	$stmt->execute(array(":client_id"=>$client_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

    $umessage = $_POST['message'];
    $upseudo = $userRow['username'];


    $chat->savechat($upseudo,$umessage);

 
 


?>
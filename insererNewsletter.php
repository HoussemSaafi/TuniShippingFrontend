<?php
include_once ('ConnexionBD.php');
$conn=ConnexionBD::getInstance();
//($_POST['newsletter']);
//($_POST['name']);
//($_POST['mail']);
//($_POST['commentaire']);
$sql='INSERT into newsletter (email) values("'.$_POST['newsletter'].'")';
($sql);
$res=$conn->query($sql);
//($res);
//$_POST['commentaire']=null;
//$id=$_POST['post_id'];
header('Location: ' . $_SERVER['HTTP_REFERER']);
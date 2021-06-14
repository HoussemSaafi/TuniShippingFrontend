<?php
include_once ('ConnexionBD.php');
$conn=ConnexionBD::getInstance();
//var_dump($_POST['post_id']);
//var_dump($_POST['name']);
//var_dump($_POST['mail']);
//var_dump($_POST['commentaire']);
$sql="INSERT into comments (id_post,name,email,comment,date) values(".$_POST['post_id'].',"'.$_POST['name'].'","'.$_POST['mail'].'","'.$_POST['commentaire'].'"'.",CURDATE())";
var_dump($sql);
$res=$conn->query($sql);
var_dump($res);
$_POST['commentaire']=null;
$id=$_POST['post_id'];
header('Location: ' . $_SERVER['HTTP_REFERER']);
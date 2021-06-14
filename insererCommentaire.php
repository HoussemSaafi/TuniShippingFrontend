<?php
include_once ('ConnexionBD.php');
$conn=ConnexionBD::getInstance();
//($_POST['post_id']);
//($_POST['name']);
//($_POST['mail']);
//($_POST['commentaire']);
$sql="INSERT into comments (id_post,name,email,comment,date) values(".$_POST['post_id'].',"'.$_POST['name'].'","'.$_POST['mail'].'","'.$_POST['commentaire'].'"'.",CURDATE())";
//($sql);
$res=$conn->query($sql);
//($res);
$_POST['commentaire']=null;
$id=$_POST['post_id'];
header('Location: ' . $_SERVER['HTTP_REFERER']);
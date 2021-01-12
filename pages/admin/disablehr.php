<?php 
	require '../../includes/db_connect.php';
require ('LOGIN_CHECK.php');

	$id=$_GET['id'];
	$stmt=$pdo->prepare('update user set active=:zero where id=:id');
	$stmt->execute(['zero'=>'0', 'id'=>$id]);

	header("location: hrman.php");

?>

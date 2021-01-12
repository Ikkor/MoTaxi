<?php 
	require '../../includes/db_connect.php';
require ('LOGIN_CHECK.php');

	$id=$_GET['id'];
	$stmt=$pdo->prepare('update user set active=:one where id=:id');
	$stmt->execute(['one'=>'1', 'id'=>$id]);

	header("location: hrman.php");

?>

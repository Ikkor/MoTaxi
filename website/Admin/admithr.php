<?php 
	require '../../../includes/db-connect.php';
	require '../../../modules/login_check.php';

	$id=$_GET['id'];
	$stmt=$pdo->prepare('update user set active=:one where id=:id');
	$stmt->execute(['one'=>'1', 'id'=>$id]);

	header("location: hrman.php");

?>

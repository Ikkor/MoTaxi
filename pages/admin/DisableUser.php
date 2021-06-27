<?php 
	require '../../includes/db_connect.php';
// require ('LOGIN_CHECK.php');
	
	$UserID=$_GET['id'];
	$stmt=$pdo->prepare('update user set active=:stat where id=:UserID');
	$stmt->execute([ 'stat'=>'0','UserID'=>$UserID]);

	header("location: manage_users.php?message=SuccesfullDisabling");

?>
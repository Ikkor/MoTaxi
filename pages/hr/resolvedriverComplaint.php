<?php 
	require '../../includes/db_connect.php';
	require 'LOGIN_CHECK.php';

	$complaint_id=$_GET['id'];
	$stmt=$pdo->prepare('update driver_complaints set status=:resolved where complaint_id=:complaint_id');
	$stmt->execute(['resolved'=>'resolved', 'complaint_id'=>$complaint_id]);


	//header("location: drivers_complaints.php?message=SuccesfullResolve");

?>



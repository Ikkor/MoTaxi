<?php 
	require '../../includes/db_connect.php';
	require 'LOGIN_CHECK.php';

	$complaint_id=$_POST['complaint_id'];
	$stmt=$pdo->prepare('update client_complaints set status=:resolved where complaint_id=:complaint_id');
	$stmt->execute(['resolved'=>'resolved', 'complaint_id'=>$complaint_id]);

	$output = "Resolved!";
	echo $output;
	//header("location: clients_complaints.php?message=SuccesfullResolve");

?>



<?php 
	require '../../includes/db_connect.php';
	require ('../../modules/login_check.php');
	require 'includes/utypecheck.php';

	$ride_id=$_POST['ride_id'];
	date_default_timezone_set('Asia/Dubai');      
	$dt = date('h:i:s');
	$stmt=$pdo->prepare('update ride set time_out=:dt where ride_id=:id');
	$stmt->execute(['id'=>$ride_id, 'dt'=>$dt]);

$output = "Dropped client!";
	echo $output;
	//header("location: drivers_complaints.php?message=SuccesfullResolve");

?>



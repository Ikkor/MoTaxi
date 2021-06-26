<?php 
	require '../../includes/db_connect.php';
	require ('../../modules/login_check.php');
	require 'includes/utypecheck.php';

	$ride_id=$_POST['ride_id'];
	date_default_timezone_set('Asia/Dubai');      
	$dt =Date('Y-m-d\TH:i',time());
	$stmt=$pdo->prepare('update rides set time_out=:dt,status=:status where ride_id=:id');
	$stmt->execute(['id'=>$ride_id, 'dt'=>$dt, 'status'=>'off']);

$output = "Dropped client!";
	echo $output;
	//header("location: drivers_complaints.php?message=SuccesfullResolve");

?>



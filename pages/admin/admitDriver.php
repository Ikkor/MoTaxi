<?php 
	require '../../includes/db_connect.php';
require ('LOGIN_CHECK.php');

	$driverId=$_GET['id'];
	$stmt=$pdo->prepare('update driver_details set accepted=:yes where driverId=:driverId');
	$stmt->execute(['yes'=>'yes', 'driverId'=>$driverId]);


	header("location: manage_drivers.php?message=SuccesfullAdmission");

?>



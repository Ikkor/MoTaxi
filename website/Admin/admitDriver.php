<?php 
	require '../../../includes/db-connect.php';
	require '../../../modules/login_check.php';

	$driverId=$_GET['id'];
	$stmt=$pdo->prepare('update driver_details set accepted=:yes where driverId=:driverId');
	$stmt->execute(['yes'=>'yes', 'driverId'=>$driverId]);


	header("location: driverman.php?message=SuccesfullAdmission");

?>



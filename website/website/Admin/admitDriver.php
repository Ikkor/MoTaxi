<?php 
	require '../config/dbconn.php';
	require '../config/loginCheck.php';

	$driverId=$_GET['id'];
	$stmt=$pdo->prepare('update driver_details set accepted=:yes where driverId=:driverId');
	$stmt->execute(['yes'=>'yes', 'driverId'=>$driverId]);
	$result = $stmt->fetch(PDO::FETCH_ASSOC);

	header("location: driverman.php?message=SuccesfullAdmission");

?>



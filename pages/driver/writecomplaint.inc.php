<?php 
	require '../../includes/db_connect.php';
	require '../../modules/inputsanitizer.php';
	require '../../modules/login_check.php';
	//var_dump($_POST);
	sanitizeInput();

	$descE=1;
	if(isset($_POST['txt_comment'])){
		$descE=0;
	}
	if(isset($_POST['submit']) && $descE==0 ){

		$driverId=$_SESSION['id'];//driver login=>driver id
		$userId=$_SESSION['userInQuestion'];
		$dateHappened=$_SESSION['dateInQuestion'];

		$stmt=$pdo->prepare("select driver_id from ride where user_id=:userId && driver_id=:driverId && date=:dateHappened");
		
		$stmt->execute(['userId'=>$userId, 'driverId'=>$driverId, 'dateHappened'=>$dateHappened]);

		$result=$stmt->fetch();

		$driverCheck=$result['driver_id'];

		if($driverCheck==""){//IF ATTEMPTED TO CHANGE DRIVERID FROM URL
			echo 'please do not toy with the system';
			exit();
		}

		$complaintId='NULL';
		$comment=$_POST['txt_comment'];
		$date=date("Y:m:d");
		$location=$_SESSION['locationInQuestion'];
		$status='notResolved';
		
		$stmt2=$pdo->prepare("insert into driver_complaints 
			VALUES (:complaintId, :driverId, :userId, :comment, :date , :location, :status)");

		$stmt2->execute(['complaintId'=>$complaintId, 'driverId'=>$driverId,'userId'=>$userId,'comment'=>$comment,'date'=>$date,'location'=>$location, 'status'=>$status]);
		header('location: driver_rides.php');


	}


 ?>
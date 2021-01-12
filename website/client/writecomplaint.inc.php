<?php 
	require '../config/dbconn.php';
	require '../functions/functions.php';
	require 'loginCheck.php';
	//var_dump($_POST);
	sanitizeInput();

	$descE=$typeE=1;
	if(isset($_POST['txt_desc'])){
		$descE=0;
	}
	if(isset($_POST['txt_type'])){
		$typeE=0;
	}
	if(isset($_POST['submit']) && $descE==0 && $typeE==0 ){
		$userId=$_SESSION['id'];//client login=>client id
		$driverId=$_SESSION['driverInQuestion'];
		$dateHappened=$_SESSION['dateInQuestion'];

		$stmt=$pdo->prepare("select user_id from ride where driver_id=:driverId && user_id=:userId && date=:dateHappened");
		
		$stmt->execute(['driverId'=>$driverId,'userId'=>$userId,'dateHappened'=>$dateHappened]);

		$result=$stmt->fetch();

		$userCheck=$result['user_id'];

		if($userCheck==""){//IF ATTEMPTED TO CHANGE DRIVERID 
			echo 'please do not toy with the system';
			exit();
		}

		$type=$_POST['txt_type'];
		$desc=$_POST['txt_desc'];
		$date=date("H:m:s");
		$status='notResolved';
		$complaintId='NULL';

		$stmt=$pdo->prepare("insert into client_complaints 
		VALUES (:complaintId, :userId, :driverId, :type, :desc, :date ,:status)");

		$stmt->execute(['complaintId'=>$complaintId, 'userId'=>$userId,'driverId'=>$driverId,'type'=>$type,'desc'=>$desc,'date'=>$date,'status'=>$status]);


	}
 ?>
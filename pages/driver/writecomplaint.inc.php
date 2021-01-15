<?php 
	require '../../includes/db_connect.php';
	require '../../modules/inputsanitizer.php';
	require '../../modules/login_check.php';
	require ('includes/utypecheck.php');
	//var_dump($_POST);
	sanitizeInput();

	$descE=1;
	if(isset($_POST['txt_comment']) && $_POST['txt_comment']!=""){
		$descE=0;
	}
	if(isset($_POST['submit']) && $descE==0 ){

		$driverId=$_SESSION['id'];//driver login=>driver id


		$stmt=$pdo->prepare("select * from ride where ride_id=:ride_id && driver_id=:driverId");
		
		$stmt->execute(['ride_id'=>$_SESSION['rideInQuestion'], 'driverId'=>$driverId]);

		$result=$stmt->fetch();

		$count = $stmt->rowCount();

		if($count==0){
			header('location: ../index.php?message=PleaseDoNotToyWithURL');
		}

		$userId=$result['user_id'];

		$complaintId='NULL';
		$comment=$_POST['txt_comment'];
		$date=date("Y:m:d");
		$location=$result['from_loc'];
		$status='notResolved';
		
		$stmt2=$pdo->prepare("insert into driver_complaints 
			VALUES (:complaintId, :driverId, :userId, :comment, :date , :location, :status)");

		$stmt2->execute(['complaintId'=>$complaintId, 'driverId'=>$driverId,'userId'=>$userId,'comment'=>$comment,'date'=>$date,'location'=>$location, 'status'=>$status]);
		header('location: driver_rides.php?message=SuccesfullReporting');


	}


 ?>
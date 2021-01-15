<?php 

	require '../../includes/db_connect.php';
	require '../../modules/inputsanitizer.php';
	require '../../modules/login_check.php';
	require 'includes/utypecheck.php';
	
	//var_dump($_POST);
	sanitizeInput();

	

	$descE=$typeE=1;
	if(isset($_POST['txt_desc']) && $_POST['txt_desc']!=''){
		$descE=0;
	}
	if(isset($_POST['txt_type']) && $_POST['txt_type']!=''){
		$typeE=0;
	}
	if(isset($_POST['submit']) && $descE==0 && $typeE==0 ){

		$userId=$_SESSION['id'];//client login=>user id
		$date=date("H:m:s");
		$status='notResolved';
		$complaintId='NULL';
		$type=$_POST['txt_type'];
		$desc=$_POST['txt_desc'];

		
		$stmt=$pdo->prepare("select * from ride where ride_id=:ride_id && user_id=:userId");
		
		$stmt->execute(['ride_id'=>$_SESSION['rideInQuestion'], 'userId'=>$userId]);

		$result=$stmt->fetch();

		$count = $stmt->rowCount();

		if($count==0){
			header('location: ../index.php?message=PleaseDoNotToyWithURL');
		}

		$driverId=$result['driver_id'];
		
		$stmt=$pdo->prepare("insert into client_complaints 
		VALUES (:complaintId,:rideId, :userId, :driverId, :type, :desc, :date ,:status)");

		$stmt->execute(['complaintId'=>$complaintId,'rideId'=>$result['ride_id'], 'userId'=>$userId,'driverId'=>$driverId,'type'=>$type,'desc'=>$desc,'date'=>$date,'status'=>$status]);


	}
 ?>
<?php 
session_start();
	require '../../includes/db_connect.php';
	require '../../modules/inputsanitizer.php';
	require '../../modules/login_check.php';
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
		$userId=$_SESSION['id'];
		$driverId=$_GET['driverId'];
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
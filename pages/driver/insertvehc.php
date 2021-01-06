<?php 
	session_start();
	require '../../modules/login_check.php';//incldue session start
	require '../../includes/db_connect.php';
	require '../../modules/inputsanitizer.php';

	sanitizeInput();
	//grap values
	$reg_no=$_POST['txt_regno'];//not<0
	$s_type=$_POST['txt_stype'];//in simple day package
	$seat=$_POST['txt_#seat'];//not<1
	$model=$_POST['txt_model'];//not empty
	$year=$_POST['txt_year'];//not <now
	$ac=$_POST['txt_ac'];//either yes or no
	$boot=$_POST['txt_bootcap'];//not<0
	
	$imgE=$regDup=$reg_noE=$s_typeE=$seatE=$modelE=$yearE=$acE=$bootE=1;

	if($reg_no>=0){
		$reg_noE=0;
	}
	$s_type=strtolower($s_type);
	if($s_type=='simple' || $s_type=='package'){
		$s_typeE=0;
	}
	if($seat>=1){
		$seatE=0;
	}
	if($model!=""){
		$modelE=0;
	}
	if($year<=date('Y:m:d')){
		$yearE=0;
	}
	$ac=strtolower($ac);
	if($ac=='yes' || $ac=='no'){
		$acE=0;
	}
	if($boot>0){
		$bootE=0;
	}

	$check=$pdo->prepare("select * from vehicules where reg_no=:id");
	$check->execute(['id'=>$reg_no]);
	$resultcheck=$check->fetch(PDO::FETCH_ASSOC);

	if($reg_no!=$resultcheck['reg_no']){
		$regDup=0;
	}//it works

	echo $reg_noE;
	echo $s_typeE;
	echo $seatE;
	echo $modelE;
	echo $yearE;
	echo $acE;
	echo $bootE;

	//----------------for image--------------------
	$allowed=array('jpg', 'jpeg', 'png');

	$imgName=$_FILES['vehcimg']['name'];
	$imgTempName=$_FILES['vehcimg']['tmp_name'];
	$imgSize=$_FILES['vehcimg']['size'];
	$imgError=$_FILES['vehcimg']['error'];

	$imgExt=explode('.',$imgName);
	$imgActualExt=strtolower(end($imgExt));

	if(in_array($imgActualExt,$allowed) && $imgError==0 /*&& $licenseSize<1000000*/){
		$imgE=0;

		//get a new name and assign location
		$imgNewName=uniqid('',true).".".$imgActualExt;
		$imgDestination='../../uploads/vehicule/'.$imgNewName;
		
		//file ready for upload
	}else{
		echo 'An error occured';
	}


	if(isset($_POST['submit']) && $reg_noE==0 && $s_typeE==0 && $seatE==0 && $modelE==0 && $yearE==0 && $acE==0 && $bootE==0 && $regDup==0){
		// $reg_no
		// $s_type
		$owned_by=$_SESSION['id'];
		// $seat
		// $model
		// $year
		// $ac
		// $boot
		// $imgDestination

		//reg_no s_type owned_by #seat model_name year a/c boot_capacity pic
		$stmt=$pdo->prepare("insert into vehicules 
			values(:reg_no, :s_type, :owned_by, :seat, :model, :year, :ac, :boot, :imgDestination)");
		$stmt->
		execute(['reg_no'=>$reg_no,'s_type'=>$s_type, 'owned_by'=>$owned_by,'seat'=>$seat,'model'=>$model,'year'=>$year,'ac'=>$ac,'boot'=>$boot, 'imgDestination'=>$imgDestination]);
		move_uploaded_file($imgTempName, $imgDestination);

		header("location: driver_vehicles.php?message=vehicule_added");
		exit();

		//inserting
	}
	else{
	header('location: addvehc.php?error=badinput');
	exit();
	}

	

 ?>
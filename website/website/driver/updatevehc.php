<?php 
	require '../config/loginCheck.php';//incldue session start
	require '../config/dbconn.php';
	require '../functions/functions.php';

	sanitizeInput();
	$oldreg=$_SESSION['old_reg_no'];
	//grap values
	$reg_no=$_POST['txt_regno'];//not<0
	$s_type=$_POST['txt_stype'];//in simple day package
	$seat=$_POST['txt_#seat'];//not<1
	$model=$_POST['txt_model'];//not empty
	$year=$_POST['txt_year'];//not <now
	$ac=$_POST['txt_ac'];//either yes or no
	$boot=$_POST['txt_bootcap'];//not<0

	$regDup=$reg_noE=$s_typeE=$seatE=$modelE=$yearE=$acE=$bootE=1;
	if($reg_no>=0){//valid
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
	if($reg_no!=$resultcheck['reg_no']){
		$regDup=0;
	}//it works


	// echo $reg_noE;
	// echo $s_typeE;
	// echo $seatE;
	// echo $modelE;
	// echo $yearE;
	// echo $acE;
	// echo $bootE;

	if(isset($_POST['submit']) && $reg_noE==0 && $s_typeE==0 && $seatE==0 && $modelE==0 && $yearE==0 && $acE==0 && $bootE==0 && $regDup==0){
		
		$stmt=$pdo->prepare("update vehicules set reg_no=:reg_no1,s_type=:s_type,seat=:seat, model_name=:model,year=:year ,ac=:ac, boot_capacity=:boot where reg_no=:reg_no2");

		$stmt->
		execute(['reg_no1'=>$reg_no,'s_type'=>$s_type,'seat'=>$seat,'model'=>$model,'year'=>$year,'ac'=>$ac,'boot'=>$boot,'reg_no2'=>$oldreg]);
		header("location: driverprofile.php?message=vehicule_updated");

		//updating
	}
	else if(isset($_POST['delete'])){
		$stmt=$pdo->prepare("delete from vehicules where reg_no=:reg_no");
		$stmt->execute(['reg_no'=>$oldreg]);
		header("location: driverprofile.php?message=vehicule_deleted");
		//deleting
	}
	else{
		header('location: editvehc.php?error=badinput');
	}

	

 ?>
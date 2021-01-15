<?php 
	require ('../../modules/login_check.php');
	require ('../../includes/db_connect.php');
	require ('../../modules/inputsanitizer.php');
	require ('includes/utypecheck.php');

	sanitizeInput();
	$oldreg=$_SESSION['old_reg_no'];
	//grap values
	$s_type=$_POST['txt_stype'];//in simple day package
	$seat=$_POST['txt_#seat'];//not<1
	$model=$_POST['txt_model'];//not empty
	$year=$_POST['txt_year'];//not <now
	$ac=$_POST['txt_ac'];//either yes or no
	$boot=$_POST['txt_bootcap'];//not<0


	$piclink=$_SESSION['piclink'];
	$imgDestination = $piclink; //if no image uploaded, keep old path

	$imgE=$s_typeE=$seatE=$modelE=$yearE=$acE=$bootE=1;
	
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

	


	echo $reg_noE;
	echo $s_typeE;
	echo $seatE;
	echo $modelE;
	echo $yearE;
	echo $acE;
	echo $bootE;
	//echo $regDup;


$stmt=$pdo->prepare("select * from vehicules where reg_no=:reg_no");
	$stmt->execute(['reg_no'=>$oldreg]);
	$img=$stmt->fetch(PDO::FETCH_ASSOC);

	$oldpicLink=$img['pic'];
	echo $oldpicLink;

	$allowed=array('jpg', 'jpeg', 'png');

    $PicName=$_FILES['vehcimg']['name'];
    $PicTempName=$_FILES['vehcimg']['tmp_name'];
    $PicSize=$_FILES['vehcimg']['size'];
    $PicError=$_FILES['vehcimg']['error'];//error 4 means no file uploaded

    $PicExt=explode('.',$PicName);
    $PicActualExt=strtolower(end($PicExt));

    if(in_array($PicActualExt, $allowed) && $PicError==0 /*&& $PicSize<1000000*/ ){
    //get a new name and assign location
   		$PicDestination=$oldpicLink;
   		echo $PicDestination;
    //file ready for upload
    }else{
        echo 'An error occured';
    }

	if(isset($_POST['submit']) && $reg_noE==0 && $s_typeE==0 && $seatE==0 && $modelE==0 && $yearE==0 && $acE==0 && $bootE==0){
		
		$stmt=$pdo->prepare("update vehicules set s_type=:s_type, seat=:seat, model_name=:model,year=:year ,ac=:ac, boot_capacity=:boot where reg_no=:reg_no");

		$stmt->
		execute(['s_type'=>$s_type,'seat'=>$seat,'model'=>$model,'year'=>$year,'ac'=>$ac,'boot'=>$boot,'reg_no'=>$oldreg]);

		if($PicError==4){
			//upload field left blank, do not upload new file
		}
		if($PicError==0){
			move_uploaded_file($PicTempName, $PicDestination);
		}


		header("location: driver_vehicles.php?message=vehicule_updated");

		//updating
	}
	else if(isset($_POST['delete'])){
		$stmt=$pdo->prepare("delete from vehicules where reg_no=:reg_no");
		$stmt->execute(['reg_no'=>$oldreg]);

		header("location: driver_vehicles.php?message=vehicule_deleted");
		//deleting
	}
	else{
		//header('location: editvehc.php?error=badinput');
	}

	

 ?>
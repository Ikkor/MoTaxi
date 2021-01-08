<?php 
	require 'config/dbconn.php';
	require 'functions/functions.php';
	
	sanitizeInput();
	//var_dump($_POST);

	$emailE=$nameE=$phoneE=$passE=$dobE=$addrE=1;
	//all 0 means all good
	//checking if any empty and validate, no check on id 
	if( isset($_POST['txt_email']) && (filter_var($_POST['txt_email'], FILTER_VALIDATE_EMAIL) ) ){
		$emailE=0;
	}

	$rexName="/[A-Z][a-z']+/";
	if( isset($_POST['txt_name']) && preg_match_all($rexName,$_POST['txt_name'])==str_word_count($_POST['txt_name'])){
		$nameE=0;
	}

	$rexPhone="/[5][0-9]{7}/";
	if( isset($_POST['txt_phone']) ){
		if( (strlen($_POST['txt_phone'])==8) && preg_match_all($rexPhone,$_POST['txt_phone']) ) 
			$phoneE=0;
		if(strlen($_POST['txt_phone'])==7)
			$phoneE=0;
	}
	//password: at least 1 uppercase, 1 lowercase, 1 symbol (@#-_$%^&+=§!?), 1 digit and length 8-20
	
	$rexPass='/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/';
	if( isset($_POST['txt_pass']) && preg_match($rexPass,$_POST['txt_pass']) && $_POST['txt_pass']==$_POST['txt_passR']){
		$passE=0;
	}

	if( isset($_POST['txt_dob']) && $_POST['txt_dob'] < date("Y-m-d")  ){
		$dobE=0;
	}

	if( isset($_POST['txt_address']) ){
		$addrE=0;
	}

	if(isset($_POST["submit"]) && $emailE==0 && $nameE==0 && $phoneE==0 && $passE==0 && $dobE==0 && $addrE==0 ){
		//do the insert, careful stripslashes

		/*
		1. hash password
		2. double entry for password

		if(password_verify($password, $hashed_password)) {
		    // If the password inputs matched the hashed password in the database
		    // Do something, you know... log them in.
		}

		*/

		
		$id='NULL';
		$email=$_POST['txt_email'];

		$password=$_POST['txt_pass'];
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$utype=$_GET['ref'];
		$name=$_POST['txt_name'];
		$phone=$_POST['txt_phone'];
		$addr=$_POST['txt_address'];
		$dob=$_POST['txt_dob'];

		//---------must be transaction--------------
		$sql="insert into user VALUES (:id, :email, :password, :utype, :name, :phone, :addr, :dob)";

		$stmt=$pdo->prepare($sql);

		$stmt->
		execute(['id'=>$id,'email'=>$email,'password'=>$hashed_password,'utype'=>$utype,'name'=>$name,'phone'=>$phone,'addr'=>$addr,'dob'=>$dob]);

		$slt=$pdo->query('select MAX(id) as id from user');
		$idtemp=$slt->fetchAll(PDO::FETCH_ASSOC);
		foreach($idtemp as $row){
			$id=$row['id'];
		}	
		//---------transaction END-------------------

		if($utype=='driver'){
			//3 new fields 
			$dateStartE=$licenseE=$pfpE=1;
			$allowed=array('jpg', 'jpeg', 'png');

			//license--------------------------------------
			$licenseName=$_FILES['filelicense']['name'];
			$licenseTempName=$_FILES['filelicense']['tmp_name'];
			$licenseSize=$_FILES['filelicense']['size'];
			$licenseError=$_FILES['filelicense']['error'];

			$licenseExt=explode('.',$licenseName);
			$licenseActualExt=strtolower(end($licenseExt));

			if(in_array($licenseActualExt,$allowed) && $licenseError==0 /*&& $licenseSize<1000000*/){
				$licenseE=0;
				//get a new name and assign location
				$licenseNewName=uniqid('',true).".".$licenseActualExt;
				$licenseDestination='uploads/license/'.$licenseNewName;
				
				//file ready for upload
			}else{
				echo 'An error occured';
			}


			//pfp------------------------------------------
			$fileNameP=$_FILES['filepfp']['name'];
			$fileTempNameP=$_FILES['filepfp']['tmp_name'];
			$fileSizeP=$_FILES['filepfp']['size'];
			$fileErrorP=$_FILES['filepfp']['error'];

			$fileExtP=explode('.',$fileNameP);
			$fileActualExtP=strtolower(end($fileExtP));

			if(in_array($fileActualExtP,$allowed) && $fileErrorP==0 /*&& $fileSizeP<1000000*/ ){
				$pfpE=0;
				$fileNewNameP=uniqid('',true).".".$fileActualExtP;
				$fileDestinationP='uploads/pfp/'.$fileNewNameP;
				//file ready for upload
			}else{
				echo 'An error occured';
			}

			if($_POST['txt_dateStart']<date("Y-m-d")){
				$dateStartE=0;
			}
			if($dateStartE==0 && $licenseE==0 && $pfpE==0){
				//do the insert and upload for driver
				move_uploaded_file($licenseTempName, $licenseDestination);

				move_uploaded_file($fileTempNameP, $fileDestinationP);
				//$utype=$_GET['ref']; already have
				$dateStart=$_POST['txt_dateStart'];
				$dateEnrolled=date("Y-m-d");
				//$licenseDestination;
				//$fileDestinationP;

				$newsql="insert into driver_details VALUES (:id, :dateStart, :dateEnrolled, :licenseDestination, :fileDestinationP)";

				$newstmt=$pdo->prepare($newsql);
				$newstmt->
				execute(['id'=>$id,'dateStart'=>$dateStart,'dateEnrolled'=>$dateEnrolled,'licenseDestination'=>$licenseDestination,'fileDestinationP'=>$fileDestinationP]);
			}
		}

	}

?>
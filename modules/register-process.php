<?php 
	session_start();


	require('../includes/db_connect.php');
	require 'inputsanitizer.php';
	
	sanitizeInput();
	//var_dump($_POST);

	$districtErr=$dateStartE=$licenseE=$pfpE=$emailE=$nameE=$phoneE=$passE=$dobE=$addrE=1;

	//used to fetch previous values
	$_SESSION['name']=$_SESSION['phone']=$_SESSION['address']=$_SESSION['email'] = $_SESSION['dateStart']=$_SESSION['dob']=

	//used to display errors

	
	$_SESSION['districtErr'] = $_SESSION['emailErr'] = $_SESSION['nameErr'] = $_SESSION['phoneErr'] = $_SESSION['passwordErr'] = $_SESSION['dobErr'] = $_SESSION['addressErr'] = $_SESSION['dateStartE']=$_SESSION['licenseE']=  $_SESSION['pfpE'] = $_SESSION['addressErr']='';

// -----------------------------------------------------

			//EMAIL

	if( isset($_POST['txt_email']) && (filter_var($_POST['txt_email'], FILTER_VALIDATE_EMAIL) ) ){
		$emailE=0;

		$_SESSION['email']=$_POST['txt_email'];
	}
	else
	{
		$_SESSION['emailErr']="Email format is invalid";
	}



		// NAME

	$rexName="/[A-Z][a-z']+/";
	if( !empty($_POST['txt_name']) && isset($_POST['txt_name'])){
		if(preg_match_all($rexName,$_POST['txt_name'])==str_word_count($_POST['txt_name'])){
			$nameE=0;

			$_SESSION['name']=$_POST['txt_name'];
		}
		else
		{
			$_SESSION['nameErr']="Please enter your name correctly.";
		}
	}
	else{
		$_SESSION['nameErr']='Your name is required.';
	}

	

		// PHONE
	
	$rexPhone="/[5][0-9]{7}/";
	if( isset($_POST['txt_phone']) ){
		if( (strlen($_POST['txt_phone'])==8) && preg_match_all($rexPhone,$_POST['txt_phone']) ) 
			$phoneE=0;
		if(strlen($_POST['txt_phone'])==7)
			$phoneE=0;

		$_SESSION['phone']=$_POST['txt_phone'];
	}
	if ($phoneE == 1)
	{
		$_SESSION['phoneErr'] = "Please enter a correct phone number.";
	}
	
	//password: at least 1 uppercase, 1 lowercase, 1 symbol (@#-_$%^&+=§!?), 1 digit and length 8-20
	
	// $rexPass='/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/';
	// if( isset($_POST['txt_pass']) && preg_match($rexPass,$_POST['txt_pass']) && $_POST['txt_pass']==$_POST['txt_passR']){
	// 	$passE=0;
	// }
	// else{
	// 	$_SESSION['passwordErr']="Please check if you've correctly written or confirmed your password";
	// }




			//PASSWORD

if(!empty($_POST["txt_pass"])) {
	 $password = $_POST["txt_pass"];

    if($_POST["txt_pass"] == $_POST["txt_passR"]){
	   

	    if (strlen($_POST["txt_pass"]) <= '8') {
	        $_SESSION['passwordErr']= "Your Password Must Contain At Least 8 Characters!";
	    }
	    elseif(!preg_match("#[0-9]+#",$password)) {
	        $_SESSION['passwordErr']= "Your Password Must Contain At Least 1 Number!";
	    }
	    elseif(!preg_match("#[A-Z]+#",$password)) {
	        $_SESSION['passwordErr']= "Your Password Must Contain At Least 1 Capital Letter!";
	    }
	    elseif(!preg_match("#[a-z]+#",$password)) {
	        $_SESSION['passwordErr']= "Your Password Must Contain At Least 1 Lowercase Letter!";
	    }
	     else $passE=0;
	}
	else{
		$_SESSION['passwordErr']= "Check if you've entered or confirmed your password!";
	}
}
else {
	$_SESSION['passwordErr']="A password is required.";
}


	// DATE OF BIRTH


	if( isset($_POST['txt_dob'])  && !empty($_POST['txt_dob'])&& $_POST['txt_dob'] < date("Y-m-d")  ){
		$dobE=0;

		$_SESSION['dob']=$_POST['txt_dob'];

	}
	else
	{
		$_SESSION['dobErr'] = "Please check if you have correctly specified your date of birth.";
	}

	// ADDRESS

	if( isset($_POST['txt_address']) && !empty($_POST['txt_address'])){
		$addrE=0;
		$_SESSION['address'] = $_POST['txt_address'];
	}
	else{
		$_SESSION['addressErr']="An address is required";
	}


	//DISTRICT 

	if( isset($_POST['txt_district']) && $_POST['txt_district']!=''){
		$districtErr=0;
		$_SESSION['txt_district'] = $_POST['txt_district'];
	}
	else{
		$_SESSION['districtErr']="You must specifify a district";
	}

// --------------------------------------------



//if any error occurred, redirect to same appropriate form
	if( $emailE==1 || $nameE==1 || $phoneE==1 || $passE==1 || $dobE==1 || $addrE==1 || $districtErr ==1 ){

		if($_GET['ref']=='client'){
			header("Location: ../pages/client_register.php?ref=Err");
			exit();
	}
		if($_GET['ref']=='driver'){
			header("Location: ../pages/driver_register.php?ref=Err");
			exit();

		}


	}


	if(isset($_POST["submit"]) && $emailE==0 && $nameE==0 && $phoneE==0 && $passE==0 && $dobE==0 && $addrE==0 && $districtErr==0){
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
		$district=$_POST['txt_district'];
		$acc='no';
		$active=1;

		//---------must be transaction--------------
		$sql="insert into user VALUES (:id, :email, :password, :utype, :name, :phone, :addr, :dob, :district, :active)";

		$stmt=$pdo->prepare($sql);

		$stmt->
		execute(['id'=>$id,'email'=>$email,'password'=>$hashed_password,'utype'=>$utype,'name'=>$name,'phone'=>$phone,'addr'=>$addr,'dob'=>$dob, 'district'=>$district, 'active'=>$active]);

		$slt=$pdo->query('select MAX(id) as id from user');
		$idtemp=$slt->fetchAll(PDO::FETCH_ASSOC);
		foreach($idtemp as $row){
			$id=$row['id'];
		}


		//---------transaction END-------------------

		if($utype=='driver'){
			
			//3 new fields 
			//$dateStartE=$licenseE=$pfpE=1; already declared
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
				$licenseDestination='../uploads/license/'.$licenseNewName;
				
				//file ready for upload
			} 
			else {

				$_SESSION['licenseE'] = "A picture of your license is required.";
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
				$fileDestinationP='../uploads/pfp/'.$fileNewNameP;
				//file ready for upload
			} else {
				$_SESSION['pfpE'] = "A profile picture is required.";
			}




			if(isset($_POST['txt_dateStart']) && $_POST['txt_dateStart']<date("Y-m-d")){

				$dateStartE=0;
				$_SESSION['dateStart'] = $_POST['txt_dateStart']; //to display value in form if another error occured
			}
			else 
			{
				$_SESSION['dateStartE']="Please provide us with a correct date.";
			}



			if($dateStartE==1 || $licenseE==1 || $pfpE==1){
				header("Location: ../pages/driver_register.php?ref=Err");
				exit();

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

				$newsql="insert into driver_details VALUES (:driverId, :dateStart, :dateEnrolled, :license, :pfp, :accepted)";

				$newstmt=$pdo->prepare($newsql);
				$newstmt->
				execute(['driverId'=>$id,'dateStart'=>$dateStart,'dateEnrolled'=>$dateEnrolled,'license'=>$licenseDestination,'pfp'=>$fileDestinationP,'accepted'=>$acc]);
			}
		}

		
		
		
		

	}

	session_destroy();
	header('Location: ../pages/index.php?ref=success');
	

?>
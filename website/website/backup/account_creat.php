<?php 
	function sanitizeInput(){
		foreach($_POST as $key=>$data){
			htmlentities($data);
			trim($data);
		}
		
	}

	
	sanitizeInput();
	//var_dump($_POST);

	//all 0 means all good
	$emailE=$nameE=$phoneE=$passE=$dobE=$addrE=1;

	//checking if any empty and validate, no check on id 
	if( isset($_POST['txt_email']) && (filter_var($_POST['txt_email'], FILTER_VALIDATE_EMAIL) ) ){
		$emailE=0;
	}

	$rexName="/[A-Z][a-z']+/";
	if( isset($_POST['txt_name']) && preg_match_all($rexName,$_POST['txt_name'])==str_word_count($_POST['txt_name'])){
		$nameE=0;
	}

	$rexPhone="/[5][1-9]{7}/";
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

		require 'config/dbconn.php';
		$id='NULL';
		$email=$_POST['txt_email'];

		$password=$_POST['txt_pass'];
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$utype=$_GET['ref'];
		$name=$_POST['txt_name'];
		$phone=$_POST['txt_phone'];
		$addr=$_POST['txt_address'];
		$dob=$_POST['txt_dob'];

		$sql="insert into user VALUES (:id, :email, :password, :utype, :name, :phone, :addr, :dob)";

		$stmt=$pdo->prepare($sql);

		$stmt->
		execute(['id'=>$id,'email'=>$email,'password'=>$hashed_password,'utype'=>$utype,'name'=>$name,'phone'=>$phone,'addr'=>$addr,'dob'=>$dob]);

	}

?>
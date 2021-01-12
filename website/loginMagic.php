<?php 
	require 'functions/functions.php';
	$emailE=1;
	sanitizeInput();// trimmed and remove specialchars

	if( isset($_POST['txt_email']) && filter_var($_POST['txt_email'], FILTER_VALIDATE_EMAIL)){
		$emailE=0;
	}

	if( isset($_POST['submit']) && $emailE==0){
		require 'config/dbconn.php';
		//get the data
		$email=$_POST['txt_email'];
		$pwd=$_POST['txt_pass'];

		$loginstmt=$pdo->prepare('select * from user where email=:email');
		$loginstmt->execute(['email'=>$email]);
		$login = $loginstmt->fetch(PDO::FETCH_ASSOC);

		$id=$login['id'];
		$name=$login['name'];
		$email=$login['email'];
		$utype=$login['utype'];

		$hashpwd=$login['password'];

		
		if(!$login || !password_verify($pwd, $hashpwd) || $login['active']=='0'){
			header('location: loginPage.php?error=wronglogin');
		}else{//create session variables
			session_start();
			$_SESSION['id']=$id;
			$_SESSION['name']=$name;
			$_SESSION['email']=$email;
			$_SESSION['utype']=$utype;

			if($utype=='client'){
				header('location: client/clientprofile.php');

			}
			if($utype=='driver'){
				header('location: driver/driverprofile.php');
			}
		}


	}


 ?>
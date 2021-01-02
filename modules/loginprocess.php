<?php 
session_start();
	require 'inputsanitizer.php';
	
	$emailE=1;
	sanitizeInput();// trimmed and remove specialchars

	if( isset($_POST['txt_email']) && filter_var($_POST['txt_email'], FILTER_VALIDATE_EMAIL)){
		$emailE=0;
	}
	if( isset($_POST['submit']) && $emailE==0){
		require '../includes/db_connect.php';
		//get the data
		$email=$_POST['txt_email'];
		$pwd=$_POST['txt_password'];

		$loginstmt=$pdo->prepare('select * from user where email=:email');
		$loginstmt->execute(['email'=>$email]);
		$login = $loginstmt->fetch(PDO::FETCH_ASSOC);

		$id=$login['id'];
		$name=$login['name'];
		$email=$login['email'];
		$utype=$login['utype'];

		$hashpwd=$login['password'];

		
		if(!$login || !password_verify($pwd, $hashpwd)){
			
			
			
			header('location: ../pages/index.php?ref=err');
			exit();

		}else{//create session variables
			
			
			$_SESSION['id']=$id;
			$_SESSION['username']=$name;
			$_SESSION['email']=$email;
			$_SESSION['utype']=$utype;



			if($utype=='client'){
				header('location: ../pages/myprofile.php');
				exit();

			}
			if($utype=='driver'){
				header('location: ../pages/myprofile.php');
				exit();

				

				//sucess
			}
		}


	}
$_SESSION['err'] = "Wrong login credentials.";
header('location: ../pages/index.php?ref=err');
//session_destroy();
 ?>

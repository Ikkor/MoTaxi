<?php 
	require '../functions/functions.php';
	$emailE=1;
	sanitizeInput();// trimmed and remove specialchars

	if( isset($_POST['txt_email']) && filter_var($_POST['txt_email'], FILTER_VALIDATE_EMAIL)){
		$emailE=0;
	}

	if( isset($_POST['submit']) && $emailE==0){
		require '../config/dbconn.php';
		//get the data
		$email=$_POST['txt_email'];
		$pwd=$_POST['txt_pwd'];

		$loginstmt=$pdo->prepare('select * from admin where email=:email');
		$loginstmt->execute(['email'=>$email]);
		$login = $loginstmt->fetch(PDO::FETCH_ASSOC);

		$email=$login['email'];
		$hashpwd=$login['password'];

		if(!$login || !password_verify($pwd, $hashpwd)){
			header('location: adminlogin.php?error=wronglogin');
		}else{//create session variables
			session_start();
			$_SESSION['adminName']=$login['name'];
			$_SESSION['id']='admin';
			header("location: admindashboard.php");
		}
	}

 ?>

<html>
	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

 		<label for="txt_email">Email</label>
 		<input type="email" name="txt_email" id="txt_email">


 		<label for="txt_pwd">password</label>
 		<input type="text" name="txt_pwd" id="txt_pwd">

		<input type="submit" name="submit" value="submit">

	</form>


</html>
<?php 
	require '../../includes/db_connect.php';
	require '../../modules/inputsanitizer.php';

	

	if(isset($_POST['submit'])){
		//verify data then insert no check on name just pregmatch on password
		sanitizeInput();
		$name=$_POST['txt_name'];
		$pwd=$_POST['txt_pwd'];
		$email=$_POST['txt_email'];

		$rexPass='/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/';
		if($pwd !="" && $email!="" && filter_var($_POST['txt_email'], FILTER_VALIDATE_EMAIL) && preg_match($rexPass,$pwd) ){
			$hash_pwd=password_hash($pwd, PASSWORD_DEFAULT);
			$sql="insert into admin values (:name, :email, :password)";
			$stmt=$pdo->prepare($sql);
			$stmt->execute(['name'=>$name,'email'=>$email, 'password'=>$hash_pwd]);

			header("location: adminlogin.php");

		}

	}


 ?>

 <html>
 	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
 		

 		<label for="txt_name">Name</label>
 		<input type="text" name="txt_name" id="txt_name">

 		<label for="txt_email">Email</label>
 		<input type="email" name="txt_email" id="txt_email">


 		<label for="txt_pwd">password</label>
 		<input type="text" name="txt_pwd" id="txt_pwd">

		<input type="submit" name="submit" value="submit">

 	</form>
 </html>
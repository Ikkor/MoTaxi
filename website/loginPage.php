<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<form action="loginMagic.php" method="post">

		<label for="txt_email">email</label>
		<input type="email" name="txt_email" placeholer="johndoe@gmail.com" id="txt_email">
		<br>	
		<br>

		<label for="txt_pass">password</label>
		<input type="text" name="txt_pass" placeholder="********" id="txt_pass">
		<br>
		<br>

		<input type="submit" name="submit" value="submit">
	</form>

	<?php 	

		if(isset($_GET['error']) && $_GET['error'] == 'wronglogin'){
			echo 'wrong login';
		}
		if(isset($_GET['action']) && $_GET['action'] == 'logout'){
			echo 'logout successful';
		}

	 ?>

	
</body>
</html>
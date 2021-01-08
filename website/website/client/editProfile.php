<?php 
	require '../config/loginCheck.php';//incldue session start
	require '../config/dbconn.php';
	require '../functions/functions.php';

	/*
	verify that regno belong to session[id]
	show pre filled form
	upon submit, update table
	*/

	$id=$_SESSION['id'];
	$stmt=$pdo->prepare("select * from user where id=:id");
	$stmt->execute(['id'=>$id]);
	$check=$stmt->fetch(PDO::FETCH_ASSOC);

	//id email password utype name phone address dob

	$hashpwd=$check['password'];
	$nameE=$opwdE=$npwdE=$addrE=$phoneE=1;
	sanitizeInput();
	//from form

	if(isset($_POST['submit']) || isset($_POST['delete']) ){
		$name=$_POST['txt_name'];
		$opwd=$_POST['txt_opwd'];
		$npwd=$_POST['txt_npwd'];
		$npwdr=$_POST['txt_npwdr'];
		$addr=$_POST['txt_address'];
		$phone=$_POST['txt_phone'];
	}

	if(isset($_POST['submit'])){
		

		if(isset($opwd) && password_verify($opwd, $hashpwd)){
			$opwdE=0;
			if($npwd=="" && $npwdr==""){
				$npwd=$opwd;
				$npwdE=0;
			}
		}

		$rexPass='/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/';
		if(isset($npwd) && isset($npwdr) && $npwd==$npwdr && preg_match($rexPass,$npwd)){//must comply to pregmatch and to npwdr
			$npwdE=0;
		}

		$rexPhone="/[5][0-9]{7}/";
		if( isset($phone) ){
			if( (strlen($phone)==8) && preg_match_all($rexPhone,$phone) ) 
				$phoneE=0;
			if(strlen($phone)==7)
				$phoneE=0;
		}

		$rexName="/[A-Z][a-z']+/";
		if( isset($name) && preg_match_all($rexName,$name)==str_word_count($name)){
			$nameE=0;
		}

		if( isset($addr) ){
			$addrE=0;
		}

		if($nameE==0 && $opwdE==0 && $npwdE==0 && $addrE==0 && $phoneE==0){
			//do the update
			$sql="update user set name=:name, password=:newhash, address=:addr, phone=:phone where id=:id";

			$newhash=password_hash($npwd, PASSWORD_DEFAULT);

			$stmt=$pdo->prepare($sql);

			$stmt->
			execute(['name'=>$name,'newhash'=>$newhash,'addr'=>$addr,'phone'=>$phone,'id'=>$id]);

			header("location: clientProfile.php?message=updateSuccess");

		}
	}

	if(isset($_POST['delete'])){
		if(isset($opwd) && password_verify($opwd, $hashpwd)){
			echo 'auth success';
			$opwdE=0;
		}
		if($opwdE==0){

			$sql="delete from user where id=:id";

			$stmt=$pdo->prepare($sql);

			$stmt->execute(['id'=>$id]);

			header("location: clientProfile.php?message=deleteSuccess");
		}
	}

 ?>

 <html>
<head>
	
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

		<label for="txt_name">name</label>
		<input type="text" name="txt_name" id="txt_name" value="<?php echo $check['name'];?>">
		<br>	
		<br>

		<label for="txt_opwd">old password</label> <!-- must input for authentification -->
		<input type="text" name="txt_opwd" id="txt_opwd" value="" >
		<br>
		<br>

		<label for="txt_npwd">new password</label> <!-- may be blank -->
		<input type="text" name="txt_npwd" id="txt_npwd" value="" >
		<br>
		<br>

		<label for="txt_npwdr">new password (repeat)</label>
		<input type="text" name="txt_npwdr" id="txt_npwdr" value="" >
		<br>
		<br>

		<label for="txt_address">address</label>
		<input type="text" name="txt_address" id="txt_address" value="<?php echo $check['address']?>" >
		<br>
		<br>

		<label for="txt_phone">phone</label>
		<input type="text" name="txt_phone" id="txt_phone" value="<?php echo $check['phone']?>" >
		<br>
		<br>

		<input type="submit" name="submit" value="update">
		<input type="submit" name="delete" value="delete">

	</form>
	<?php 	
		if(isset($_GET['error'])){
			echo $_GET['error'];
		}

	 ?>
	
</body>
</html>


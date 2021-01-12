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

	$stmt=$pdo->prepare("select * from driver_details where driverId=:id");
	$stmt->execute(['id'=>$id]);
	$img=$stmt->fetch(PDO::FETCH_ASSOC);

	/*
	for the images:
	get old names
	get new files prepare for upload and upload
	ensure overwrite of old
	*/
	$oldLicLink='../'.$img['license'];
	$oldPfpLink='../'.$img['pfp'];
	$allowed=array('jpg', 'jpeg', 'png');

	if(isset($_POST['submit']) || isset($_POST['delete']) ){
		$name=$_POST['txt_name'];
		$opwd=$_POST['txt_opwd'];
		$npwd=$_POST['txt_npwd'];
		$npwdr=$_POST['txt_npwdr'];
		$addr=$_POST['txt_address'];
		$phone=$_POST['txt_phone'];



		//----------License-----------------------------------------------------
   
	    $LicName=$_FILES['license']['name'];
	    $LicTempName=$_FILES['license']['tmp_name'];
	    $LicSize=$_FILES['license']['size'];
	    $LicError=$_FILES['license']['error']; //error 4 means no file uploaded

	    $LicExt=explode('.',$LicName);
	    $LicActualExt=strtolower(end($LicExt));


	    if(in_array($LicActualExt, $allowed) && $LicError==0 /*&& $pfpSize<1000000*/ ){
	        //get a new name and assign location
	        $LicDestination=$oldLicLink;
	        //file ready for upload
	    }else{
	        echo 'An error occured';
	    }


	//---------pfp-------------------------------------------------------------
	    $pfpName=$_FILES['pfp']['name'];
	    $pfpTempName=$_FILES['pfp']['tmp_name'];
	    $pfpSize=$_FILES['pfp']['size'];
	    $pfpError=$_FILES['pfp']['error']; //error 4 means no file uploaded

	    $pfpExt=explode('.',$pfpName);
	    $pfpActualExt=strtolower(end($pfpExt));


	    if(in_array($pfpActualExt, $allowed) && $pfpError==0 /*&& $pfpSize<1000000*/ ){
	        //get a new name and assign location
	        $pfpDestination=$oldPfpLink;
	        //file ready for upload
	    }else{
	        echo 'An error occured';
	    }

		//-----------------------------------------------------------------
	}

 	

	//name phone address password license pfp

	$hashpwd=$check['password'];
	$nameE=$opwdE=$npwdE=$addrE=$phoneE=1;
	sanitizeInput();
	//from form


	if(isset($_POST['submit'])){
		//this is the update, only difference are image uploads links do not get updated
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

			//this part goes to isset $post submit
			if($pfpError==4 || $LicError==4){
    			//upload field left blank, do not upload new file
    		}
   			if($pfpError==0){
				move_uploaded_file($pfpTempName, $pfpDestination);
    		}

		    if($LicError==0){
				move_uploaded_file($LicTempName, $LicDestination);
		    }


			header("location: driverProfile.php?message=updateSuccess");

		}
	}

	if(isset($_POST['delete'])){
		if(isset($opwd) && password_verify($opwd, $hashpwd)){
			echo 'auth success';
			$opwdE=0;
		}
		if($opwdE==0){
			//----------Updatedhere----------------------------
			$sql="update user set active=:value where id=:id";
			$value=0;
			$stmt=$pdo->prepare($sql);

			$stmt->execute(['value'=>$value, 'id'=>$id]);
			//-------------------------------------------------
			// $sql="delete from user where id=:id";

			// $stmt=$pdo->prepare($sql);

			// $stmt->execute(['id'=>$id]);

			header("location: ../logout.php");
		}
	}

 ?>

 <html>
<head>
	
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
	<!-- name phone address password license pfp -->
		<label for="txt_name">name</label>
		<input type="text" name="txt_name" id="txt_name" value="<?php echo $check['name'];?>">
		<br>
		<br>

		<label for="txt_phone">telno</label>
		<input type="text" name="txt_phone" id="txt_phone" value="<?php echo $check['phone'];?>">
		<br>
		<br>
				
		<label for="txt_address">address</label>
		<input type="text" name="txt_address" id="txt_address" value="<?php echo $check['address'];?>">
		<br>
		<br>

		<label for="txt_opwd">Oldpassword</label>
		<input type="text" name="txt_opwd" id="txt_opwd">
		<br>
		<label for="txt_npwd">New password</label>
		<input type="text" name="txt_npwd" id="txt_npwd">
		<br>
		<label for="txt_npwdr">New password repeat</label>
		<input type="text" name="txt_npwdr" id="txt_npwdr">
		<br>
		----------------------------------------------------------------------------------------
		<br>	

		<!-- must display old images -->

		<label for="license">license</label> 
		<input type="file" name="license" id="license">
		<br> <!-- link to license=>$oldLicLink -->
	
		<br>

		<label for="pfp">pfp</label>
		<input type="file" name="pfp" id="pfp">
		<br><!-- link to pfp=>$oldPfpLink -->
		<br>

		<input type="submit" name="submit" value="update">
		<input type="submit" name="delete" value="delete">

	</form>
	<?php 	
		if(isset($_GET['message'])){
			echo $_GET['message'];
		}

	 ?>
	
</body>
</html>


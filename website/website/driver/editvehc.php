<?php 
	require '../config/loginCheck.php';//incldue session start
	require '../config/dbconn.php';

	/*
	verify that regno belong to session[id]
	show pre filled form
	upon submit, update table
	*/

	$id=$_SESSION['id'];
	$stmt=$pdo->prepare("select * from vehicules where owned_by=:id && reg_no=:reg_no");
	$reg_no=$_SESSION['old_reg_no'];
	$stmt->execute(['id'=>$id, 'reg_no'=>$reg_no]);
	$check=$stmt->fetch(PDO::FETCH_ASSOC);

 ?>

<html>
<head>
	
</head>
<body>
	<form action="updatevehc.php" method="post">
	<!-- reg_no s_type owned_by #seat model_name year a/c boot_capacity pic -->
		<label for="txt_regno">Matriculation</label>
		<input type="text" name="txt_regno" id="txt_regno" value="<?php echo $check['reg_no']?>">
		<br>	
		<br>

		<label for="txt_stype">service type</label>
		<input type="text" name="txt_stype" id="txt_stype" value="<?php echo $check['s_type']?>" >
		<br>
		<br>

		<label for="txt_#seat">#seat</label>
		<input type="text" name="txt_#seat" id="txt_#seat" value="<?php echo $check['seat']?>" >
		<br>
		<br>

		<label for="txt_model">model</label>
		<input type="text" name="txt_model" id="txt_model" value="<?php echo $check['model_name']?>" >
		<br>
		<br>

		<label for="txt_year">year</label>
		<input type="text" name="txt_year" id="txt_year" value="<?php echo $check['year']?>" >
		<br>
		<br>

		<label for="txt_ac">a/c</label>
		<input type="text" name="txt_ac" id="txt_ac" value="<?php echo $check['ac']?>" >
		<br>
		<br>

		<label for="txt_bootcap">bootcap</label>
		<input type="text" name="txt_bootcap" id="txt_bootcap" value="<?php echo $check['boot_capacity']?>" >
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
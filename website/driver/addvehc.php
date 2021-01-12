<html>
<head>
	
</head>
<body>
	<form action="insertvehc.php" method="post" enctype="multipart/form-data">
	<!-- reg_no s_type owned_by #seat model_name year a/c boot_capacity pic -->
		<label for="txt_regno">Matriculation</label>
		<input type="text" name="txt_regno" id="txt_regno">
		<br>	
		<br>

		<label for="txt_stype" >service type</label>
		<input type="text" name="txt_stype" id="txt_stype">
		<br>
		<br>

		<label for="txt_#seat">#seat</label>
		<input type="text" name="txt_#seat" id="txt_#seat">
		<br>
		<br>

		<label for="txt_model">model</label>
		<input type="text" name="txt_model" id="txt_model">
		<br>
		<br>

		<label for="txt_year">year</label>
		<input type="text" name="txt_year" id="txt_year"  >
		<br>
		<br>

		<label for="txt_ac">a/c</label>
		<input type="text" name="txt_ac" id="txt_ac"  >
		<br>
		<br>

		<label for="txt_bootcap">bootcap</label>
		<input type="text" name="txt_bootcap" id="txt_bootcap" >
		<br>
		<br>

		<label for="vehcimg">Vehicle: </label>
		<input type="file" name="vehcimg" id="vehcimg">
		<br>
		<br>


		<input type="submit" name="submit" value="Create">
		

	</form>
	<?php 	
		if(isset($_GET['error'])){
			echo $_GET['error'];
		}

	 ?>
	
</body>
</html>
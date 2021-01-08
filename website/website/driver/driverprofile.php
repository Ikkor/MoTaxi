<?php
	require '../config/loginCheck.php';
?>
<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<ul>
		<li><a href="complaints.php">To complaints</a></li>
		<li><a href="editProfile.php">Edit Profile</a></li>
		<li><a href="vehc.php">Add Vehicule</a></li>
	</ul>
	<?php 	
		if(isset($_GET['message'])){
			echo $_GET['message'];
		}

	 ?>

	
</body>
</html>
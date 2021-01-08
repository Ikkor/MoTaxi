<?php
	require 'loginCheck.php';
?>
<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<ul>
		<li>To <a href="complaints.php">complaints</a></li>
		<li><a href="editProfile.php">Edit Profile</a></li>
	</ul>
	<?php 
		if(isset($_GET['message'])){
			echo $_GET['message'];
		}
	 ?>
	
</body>
</html>
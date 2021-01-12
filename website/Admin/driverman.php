<?php 

	require '../../../modules/login_check.php';

?>
<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<table>
		<tr>
			<th>Driver</th>
			<th>License</th>
			<th>name</th>
			<th>email</th>
			<th>phone</th>
			<th>address</th>
			<th>date of birth</th>
			<th>Date debuted as driver</th>
		</tr>




		<?php 
			//user-> name email phone address dob
			//driver details-> dateStart license pfp
			$id=$_SESSION['id'];
			// $name=$_SESSION['name'];
			// $email=$_SESSION['email'];
			// $utype=$_SESSION['utype'];

			//fetch all vehicules pertaining to that driver

			require '../config/dbconn.php';
			$stmt=$pdo->prepare('select * from user inner join driver_details on id=driverId');
			$stmt->execute();
			$details = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($details as $row){
				$pfplink='../'.$row['pfp'];
				$liclink='../'.$row['license']; 
				echo 
				"<tr><td><img src='".$pfplink."' border=3 height=100 width=100></img>"."</td>
				<td><img src='".$liclink."' border=3 height=100 width=100></img>"."</td>
				<td>".$row['name']."</td>
				<td>".$row['email']."</td>
				<td>".$row['phone']."</td>
				<td>".$row['address']."</td>
				<td>".$row['dob']."</td>
				<td>".$row['dateStart']."</td>
				<td>"."</td>
				<td>"."</td><td>"."<a href='admitDriver.php?id=".$row['driverId']."'>Admit</a></td>
				<td>"."</td><td>"."<a href='disableDriver.php?id=".$row['driverId']."'>Disable</a></td></tr>";


			}	

 		?>

	</table>
	<?php  
		if(isset($_GET['message'])){
			echo $_GET['message'];
		}

	?>

</body>
</html>
<?php
	/*
	show list of current vehicules
	edit button next to a vehc takes to a prefilled form and updates db
	add button at botton takes in: reg_no s_type owned_by #seat model_name year a/c boot_capacity pic
	*/
	require '../../../modules/login_check.php';

?>
<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<table>
		<tr>
			<th>id</th>
			<th>name</th>
			<th>email</th>
			<th>phone</th>
			<th>district</th>
			<th>address</th>
			<th>dob</th>
			<th>active</th>
		</tr>




		<?php 
			
			$id=$_SESSION['id'];
			// $name=$_SESSION['name'];
			// $email=$_SESSION['email'];
			// $utype=$_SESSION['utype'];

			//fetch all vehicules pertaining to that driver

			require '../config/dbconn.php';
			$stmt=$pdo->prepare('select * from user where utype=:driver order by name');
			$utype='hr';
			$stmt->execute(['driver'=>$utype]);
			$listhr = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach($listhr as $row){

				echo 
				"<tr><td>".$row['id']."</td>
				<td>".$row['name']."</td>
				<td>".$row['email']."</td>
				<td>".$row['phone']."</td>
				<td>".$row['address']."</td>
				<td>".$row['address']."</td>
				<td>".$row['dob']."</td>
				<td>".$row['active']."</td>
				<td>"."</td>
				<td>"."</td><td>"."<a href='admithr.php?id=".$row['id']."'>Admit</a></td>
				<td>"."</td><td>"."<a href='disablehr.php?id=".$row['id']."'>Disable</a></td></tr>";
			}	

 		?>

	</table>
	
</body>
</html>
<?php
	/*
	show list of current vehicules
	edit button next to a vehc takes to a prefilled form and updates db
	add button at botton takes in: reg_no s_type owned_by #seat model_name year a/c boot_capacity pic
	*/
	require '../config/loginCheck.php';

?>
<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<table>
		<tr>
			<th>Vehicule</th>
			<th>Matriculation</th>
			<th>Service(s)</th>
			<th>#Seats</th>
			<th>Model</th>
			<th>Year</th>
			<th>a/c</th>
			<th>Boot Capacity</th>
		</tr>




		<?php 
			
			$id=$_SESSION['id'];
			// $name=$_SESSION['name'];
			// $email=$_SESSION['email'];
			// $utype=$_SESSION['utype'];

			//fetch all vehicules pertaining to that driver

			require '../config/dbconn.php';
			$stmt=$pdo->prepare('select * from vehicules where owned_by=:id');
			$stmt->execute(['id'=>$id]);
			$listvehc = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach($listvehc as $row){
				$piclink=$row['pic'];
				$reg_no=$row['reg_no'];
				$_SESSION['old_reg_no']=$row['reg_no'];

				echo 
				"<tr><td><img src='".$piclink."' border=3 height=100 width=100></img>".
				"</td><td>".$row['reg_no'].
				"</td><td>".$row['s_type'].
				"</td><td>".$row['seat'].
				"</td><td>".$row['model_name'].
				"</td><td>".$row['year'].
				"</td><td>".$row['ac'].
				"</td><td>".$row['boot_capacity'].
				"</td><td>"."</td><td>"."</td><td>"."<a href='editvehc.php'>Edit Vehicule</a> </td></tr>";

			}	

 		?>

	</table>

	<a href="addvehc.php">Add New</a>
	<!-- add the vehc <a href=""></a> -->
</body>
</html>
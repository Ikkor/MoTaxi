<?php
	require '../config/loginCheck.php';

?>
<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<table>
		<tr>
			<th>Date</th>
			<th>Time</th>
			<th>Name</th>
			<th>From</th>
			<th>To</th>
		</tr>




		<?php 

			$id=$_SESSION['id'];
			$name=$_SESSION['name'];
			$email=$_SESSION['email'];
			$utype=$_SESSION['utype'];
			//fetch all rides pertaining to that client

			require '../config/dbconn.php';
			$stmt=$pdo->prepare('select * from ride where driver_id=:id order by date desc');
			$stmt->execute(['id'=>$id]);
			$history = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach($history as $row){
				//get the name of the client in question
					$user_id=$row['user_id'];
					$name=$pdo->prepare('select name from user where id=:id');
					$name->execute([ 'id'=>$user_id ]);
					$result=$name->fetch();
				
				// echo "<tr><td><img src='".$pfplink."' border=3 height=100 width=100></img>"."</td><td>".$row['date']."</td><td>".$row['time_in'].$result['name']."</td><td>".$row['from_loc']."</td><td>".$row['to_loc']."</td><td>"."<a href='writecomplaint.php?driverId=".$driver_id."'>Write complaint</a> </td></tr>";

				echo "<tr><td>".$row['date']."</td><td>".$row['time_in']."</td><td>".$result['name']."</td><td>".$row['from_loc']."</td><td>".$row['to_loc']."</td><td>"."<a href='writecomplaint.php'>Write complaint</a> </td></tr>";

				$_SESSION['locationInQuestion']=$row['from_loc'];
				$_SESSION['dateInQuestion']=$row['date'];
				$_SESSION['userInQuestion']=$user_id;
			}	
 		?>

	</table>
</body>
</html>
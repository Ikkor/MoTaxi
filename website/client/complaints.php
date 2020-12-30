<?php
	require 'loginCheck.php';

?>
<!DOCTYPE html>
<html>
<head>
	
</head>
<body>
	<table>
		<tr>
			<th>Driver</th>
			<th>Date</th>
			<th>Time</th>
			<th>Name</th>
			<th>From</th>
			<th>To</th>
		</tr>




		<?php 
			/*
			get session variables
			show ride history for client sort by date
			allow search for specific reg id
			select from table
			build list with <a></a> and driver id as ?
			go to write complaint area
			submit
			*/

			$id=$_SESSION['id'];
			$name=$_SESSION['name'];
			$email=$_SESSION['email'];
			$utype=$_SESSION['utype'];
			//fetch all rides pertaining to that client

			require '../config/dbconn.php';
			$stmt=$pdo->prepare('select * from ride where user_id=:id order by date desc');
			$stmt->execute(['id'=>$id]);
			$history = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach($history as $row){
				//get the name of the driver
				$driver_id=$row['driver_id'];
				$name=$pdo->prepare('select name from user where id=:id');
				$name->execute([ 'id'=>$row['driver_id'] ]);
				$result=$name->fetch();
				

				//get his photo
				$photo=$pdo->prepare('select pfp from driver_details where driverId=:driver_id');
				$photo->execute([ 'driver_id'=>$driver_id ]);
				$pfp=$photo->fetch();
				$pfplink='../'.$pfp['pfp'];
				//echo $pfplink;

				echo "<tr><td><img src='".$pfplink."' border=3 height=100 width=100></img>"."</td><td>".$row['date']."</td><td>".$row['time_in'].$result['name']."</td><td>".$row['from_loc']."</td><td>".$row['to_loc']."</td><td>"."<a href='writecomplaint.php?driverId=".$driver_id."'>Write complaint</a> </td></tr>";

			}	
 		?>

	</table>
</body>
</html>
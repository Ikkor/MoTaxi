
<style>
	td{
		border-left: 2px solid #D3D3D3;

	}

</style>

	<?php

//fetch_client_complaints.php

//require ('../../includes/db_connect.php');
include('../../modules/chat_connection.php');

session_start();

$query = 'select * from client_complaints inner join user on id=user_id where status="notResolved" order by date';

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table class="table">
<thead>
    <tr>

      <th scope="col">Complaint ID</th>
      <th scope="col">client ID</th>
      <th scope="col">client email</th>
      <th scope="col">Driver</th>
      <th scope="col">driver ID</th>
      <th scope="col">Type</th>
      <th scope="col">Description</th>
      <th scope="col">Date</th>
      <th scope="col">Status</th>
      <th scope="col">action</th>
      <th scope="col"></th>
      

      
    </tr>
  </thead>
  <tbody>
';

foreach($result as $row)
{
	//get driver name
	$driver_namestmt=$connect->prepare('select name from user where Id=:driver_id');
	$driver_namestmt->execute(['driver_id'=>$row['driver_id']]);
	$driver_name=$driver_namestmt->fetch();


 	//get driver photo
	$photo=$connect->prepare('select pfp from driver_details where driverId=:driver_id');
	$photo->execute([ 'driver_id'=>$row['driver_id'] ]);
	$pfp=$photo->fetch();
	$pfplink="../".$pfp['pfp'];


  $output.='
		<tr>
		
		<td>'.$row['complaint_id'].'</td>
		<td><strong>'.$row['user_id'].'</strong><button type="button"  class="btn btn-info btn-sm start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$row['name'].'">Chat</button></td>
		<td>'.$row['email'].'</td>

		<td>
			<img src="'.$pfplink.'" border=3 height=65 width=65></img>
			</td>
		<td><strong>'.$row['driver_id'].'</strong><button type="button" class="btn btn-warning btn-sm start_chat" data-touserid="'.$row['driver_id'].'" data-tousername="'.$driver_name['name'].'">Chat</button></td>
		<td>'.$row['type'].'</td>
		<td>'.$row['description'].'</td>
		<td>'.$row['date'].'</td>
		<td>'.$row['status'].'</td>
		<td><button type="button" data="'.$row['complaint_id'].'"class="btn btn-warning btn-sm resolvebtn">Change to Resolved</button></td>
			
		</tr>
		';
}

$output .= '</tbody></table>';
// <a style = "color:green;" href="resolveclientComplaint.php?id='.$row['complaint_id'].'">Change to resolved</a></td>
echo $output;

?>

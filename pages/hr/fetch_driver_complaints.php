
<style>
	td{
		border-left: 2px solid #D3D3D3;

	}

</style>

	<?php

//fetch_client_complaints.php

//require ('../../includes/db_connect.php');
include('chat_modules/chat_connection.php');

session_start();

$query = 'select * from driver_complaints inner join user on id=user_id where status="notResolved" order by date';

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table class="table">
<thead>
    <tr>

      <th scope="col">Complaint ID</th>
      <th scope="col">Driver ID</th>
      <th scope="col">Driver email</th>

      <th scope="col">Client ID</th>
     
      <th scope="col">Comments</th>
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
	//get client name
	$client_namestmt=$connect->prepare('select name from user where Id=:user_id');
	$client_namestmt->execute(['user_id'=>$row['user_id']]);
	$client_name=$client_namestmt->fetch();


 	


  $output.='
		<tr>
		
		<td>'.$row['complaint_id'].'</td>
		<td><strong>'.$row['driver_id'].'</strong><button type="button"  class="btn btn-info btn-sm start_chat" data-touserid="'.$row['driver_id'].'" data-tousername="'.$row['name'].'">Chat</button></td>
		<td>'.$row['email'].'</td>

		
		<td><strong>'.$row['user_id'].'</strong><button type="button" class="btn btn-warning btn-sm start_chat" data-touserid="'.$row['user_id'].'" data-tousername="'.$client_name['name'].'">Chat</button></td>
		
		<td>'.$row['comments'].'</td>
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


<style>
	td{
		border-left: 2px solid #D3D3D3;

	}

</style>

	<?php


require ('../../includes/db_connect.php');

session_start();

$query = 'select * from ride where driver_id ='.$_SESSION['id'].' AND time_out=:time order by date';

$statement = $pdo->prepare($query);

$statement->execute(['time'=>'00:00:00']);

$result = $statement->fetchAll();

$output = '
<table class="table">
<thead>
    <tr>

      <th scope="col">ride ID</th>
      <th scope="col">From</th>
      <th scope="col">To</th>
      <th scope="col">Pickup</th>
     
      <th scope="col">Client ID</th>
      <th scope="col">Name</th>
      <th scope="col">Service type</th>
      <th scope="col">Distance</th>
     
      <th scope="col">action</th>
      <th scope="col"></th>
      

      
    </tr>
  </thead>
  <tbody>
';

foreach($result as $row)
{
	//get driver name
	$user_namestmt=$pdo->prepare('select name from user where Id=:user_id');
	$user_namestmt->execute(['user_id'=>$row['user_id']]);
	$user_name=$user_namestmt->fetch();


  $output.='
		<tr>
		
		<td>'.$row['ride_id'].'</td>
		<td>'.$row['from_loc'].'</td>
		<td>'.$row['to_loc'].'</td>
		<td>'.$row['time_in'].'</td>
		
		<td>'.$row['user_id'].'</td>
		<td>'.$user_name['name'].'</td>
		<td>'.$row['service_type'].'</td>
		<td>'.$row['distance'].'</td>
		<td>

		<button type="button" data="'.$row['ride_id'].'"class="btn btn-info btn-m droppedbtn">Dropped</button>

		<button type="button" data="'.$row['ride_id'].'"class="btn btn-warning btn-sm cancelbtn">Cancel</button></td>

			
		</tr>
		';
}

$output .= '</tbody></table>';
// <a style = "color:green;" href="resolveclientComplaint.php?id='.$row['complaint_id'].'">Change to resolved</a></td>
echo $output;

?>

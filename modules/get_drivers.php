
	<?php

//fetch_client_complaints.php
require('../includes/db_connect.php');

session_start();

$query = 'select driverid, pfp from driver_details where accepted="yes"';

$statement = $pdo->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table class="table">
<thead>
    <tr>

      <th scope="col">Name</th>
      <th scope="col">ID</th>
      <th scope="col"></th>
      <th scope="col">action</th>
      <th scope="col"></th>
      

      
    </tr>
  </thead>
  <tbody>
';

$i = 0;

foreach($result as $row)
{

	//get driver name
	$driver_namestmt=$pdo->prepare('select name from user where Id=:driver_id');
	$driver_namestmt->execute(['driver_id'=>$row['driverid']]);
	$driver_name=$driver_namestmt->fetch();


 	//get driver photo
	$photo=$pdo->prepare('select pfp from driver_details where driverId=:driver_id');
	$photo->execute([ 'driver_id'=>$row['driverid'] ]);
	$pfp=$photo->fetch();
	$pfplink="../".$pfp['pfp'];


  $output.='
		<tr>
		
		<td>'.$driver_name['name'].'</td>
		<td>'.$row['driverid'].'</td>

		<td>
			<img src="'.$pfplink.'" border=3 height=60width=60></img>
			</td>
		<td><input type="radio" id="driver" checked id = "driver_id" name="driver_id" value='.$row['driverid'].'></td>
		
		
			
		</tr>
		';
}
$i += 1;

$output .= '</tbody></table>';

echo $output;

?>

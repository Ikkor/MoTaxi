

	<?php

$service = $_POST['service'];
$driverid = $_POST['driverid'];

//fetch_client_complaints.php
require('../includes/db_connect.php');

session_start();

$query = 'select reg_no, model_name, seat, ac, pic, year, boot_capacity, s_type from vehicules where s_type=:service and owned_by=:driverid';

$statement = $pdo->prepare($query);

$statement->execute(['service'=>$service, 'driverid'=>$driverid]);

$result = $statement->fetchAll();

$output = '
<table class="table">
<thead>
    <tr>

      <th scope="col">model_name</th>
      <th scope="col">seat</th>
      <th scope="col">ac</th>
      <th scope="col">year</th>
      <th scope="col">boot</th>
      <th scope="col">service</th>
      <th scope="col">choose</th>

      <th scope="col"></th>

      

      
    </tr>
  </thead>
  <tbody>
';


foreach($result as $row)
{

	
 	
	$pfplink="../".$row['pic'];


  $output.='
		<tr>
		
		<td>'.$row['model_name'].'</td>
		<td>'.$row['seat'].'</td>
		<td>'.$row['ac'].'</td>
		<td>'.$row['year'].'</td>
		<td>'.$row['boot_capacity'].'</td>
		<td>'.$row['s_type'].'</td>
	
		
		<td><input type="radio" id="vehicle" checked name="reg_no" value='.$row['reg_no'].'></td>
		
		
			
		</tr>
		';
}


$output .= '</tbody></table>';

echo $output;

?>

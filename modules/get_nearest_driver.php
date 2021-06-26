<?php
function distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
      return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
  } else {
      return $miles;
  }
}

require ('../includes/db_connect.php');
$lon = $_POST['lon'];
$lat = $_POST['lat'];
$nearestdriver;
$pfp;
$shortestdistance=9999999999999999;


$query = 'select pfp, driverid, lon, lat from driver_details';

$statement = $pdo->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

foreach($result as $row)
{
  $distance = distance($row['lat'],$row['lon'],$lat,$lon,'K');
  // echo $distance.' XX '.$row['driverid'].'<br>';

  if($distance<=$shortestdistance){
    $shortestdistance = $distance;
    $nearestdriver = $row['driverid'];
    $pfp = $row['pfp'];
  }
}

$driver_namestmt=$pdo->prepare('select name from user where Id=:driver_id');

$driver_namestmt->execute(['driver_id'=>$nearestdriver]);
$driver_name=$driver_namestmt->fetch();
$pfplink = "../".$pfp;


$output = '
<p>Approx '.$shortestdistance.' Km away from you</p>
<input id ="driver_id" name = "driver_id" class = "hidden" type = "text" value = "'.$nearestdriver.'"/>
<table class="table">
<thead>
    <tr>

      <th scope="col">Name</th>
      <th scope="col">ID</th>
      <th scope="col"></th>
      
    </tr>
  </thead>
  <tbody>

<tr>
    
    <td>'.$driver_name['name'].'</td>
    <td>'.$nearestdriver.'</td>

    <td>
      <img src="'.$pfplink.'" border=3 height=60width=60></img>
      </td>

    
      
    </tr>

';


echo $output;

//my loc is lon: -20.2833 lat: 57.55


?>


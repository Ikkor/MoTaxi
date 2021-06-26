<?php
session_start();
require('../includes/db_connect.php');
$query = "
 SELECT * FROM rides 
 WHERE driver_id = ".$_SESSION['id']." 
 AND status = 'ongoing'
 ";
 $statement = $pdo->prepare($query);
 $statement->execute();
 $count = $statement->rowCount();
 $output = '';
 // if($count > 0)
 // {
 //  $output = $count;
 // }

echo $count;


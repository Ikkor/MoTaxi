<?php 
//this is driver page
	$utype='driver';

	require '../../includes/db_connect.php';
	
	if($utype!=$_SESSION['utype']){
		header("location: ../index.php");
	}
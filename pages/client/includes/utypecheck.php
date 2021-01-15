<?php 
//this is client page
	$utype='client';

	require '../../includes/db_connect.php';
	
	if($utype!=$_SESSION['utype']){
		header("location: ../index.php");
	}
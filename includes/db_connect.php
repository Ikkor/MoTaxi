<?php 
	$host='localhost';
	$user='root';
	$password='';
	$dbname='motaxi';

	$dsn='mysql:host='.$host.';dbname='.$dbname;

	$pdo=new PDO($dsn,$user,$password);

	if(!$pdo){
		echo 'connection failed';
	}

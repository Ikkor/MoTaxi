<?php
	session_start();
	if(!isset($_SESSION['id'])){
		header("location: ../loginPage.php?error=NOT LOGGED IN");
	}
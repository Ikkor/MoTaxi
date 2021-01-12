<?php
	 session_start();
	if(!isset($_SESSION['id'])){
		header("location: hr_login.php?error=notlog");
	}
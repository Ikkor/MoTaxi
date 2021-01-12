<?php
	 session_start();
	if(!isset($_SESSION['id'])){
		header("location: admin_login.php?error=notlog");
	}
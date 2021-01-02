<?php  
	function sanitizeInput(){
		foreach($_POST as $key=>$data){
			htmlentities($data);
			trim($data);
		}	
	}

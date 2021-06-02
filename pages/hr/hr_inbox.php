<?php

require ('LOGIN_CHECK.php');

$_SESSION['user_id'] = $_SESSION['hrnEmail'];
  

//remove when hr has id
?>

<!DOCTYPE html>
<html>
  <head>
    <title>HR INBOX</title>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<!-- Google Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
	<!-- Bootstrap core CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
	<!-- Material Design Bootstrap -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
 	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.2.2/web-animations.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

	<script type ="text/javascript" src="../../javascript/main.js"></script>

	<!-- this adds emoji box -->
	 <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
	 <script type = "text/javascript" src="chat_system.js"></script>
    

<style>
	td{
		border-left: 2px solid #D3D3D3;

	}

</style>

<script>
	$(document).ready(function(){

    
    		fetch_inbox_latest();

    		

    		setInterval(function(){
    			fetch_inbox_latest();
    		}, 4000);
//fetch new complaints every 15 secs

    		function fetch_inbox_latest(){
    			$.ajax({
    				url:"fetch_inbox_latest.php",
    				method:"POST",
    				success:function(data){
    					$('#messages').html(data);
    				}
    			})
    		}
    	});

    	</script>


	</head>

<body>
	<div id = "chatbox"></div>
<!-- Main navigation -->
<div id = "INBOX"></div>
  <!-- top Navbar-->
 <?php 


 $activemenu = "clients";
 include('includes/hr_navbar.php'); ?>




<!-- SIDE NAV -->
<div class="row" id="body-row" >
    <?php 
    $activeside = 'inbox';
    include('includes/hr_side_navbar.php');
    ?>


	<div class="col py-3" style = "background-color: white;" > 
	        <h1>
	        </h1>
	        <hr>
	        <hr>


	 
	        <h1>My Messages</h1>


<!-- INBOX WRAPPER BELOW -->



		<!-- generate messages inside -->
		<div id = "messages" class = "wrapper" style = " display: flex;">
		<!-- table is generated here -->


		</div>


	</div>
 </div>



    </body>
</html>
    
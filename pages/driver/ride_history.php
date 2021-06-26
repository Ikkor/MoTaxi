<?php

require ('../../modules/login_check.php');
require 'includes/utypecheck.php';

//remove when hr has id
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Driver see his rides requests</title>
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
    <link rel="stylesheet" type="text/css" href="../../css/style.css">

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


    <script>

        $(document).ready(function(){

    
            fetch_ride_requests();

            setInterval(function(){
                fetch_ride_requests();
            }, 15000);


        $(document).on('click','.droppedbtn',function(){
                        var id = $(this).attr('data');
                        $.ajax({
                            url:"driver_dropped_client.php",
                            method:"POST",
                            data:{
                                ride_id:id
                            },
                            success:function(data)
                            {
                                $(this).html(data)

                                fetch_ride_requests();
                                

                            }
                        })
                    });


        $(document).on('click','.cancelbtn',function(){
                        var id = $(this).attr('data');
                        $.ajax({
                            url:"driver_cancel_client.php",
                            method:"POST",
                            data:{
                                ride_id:id
                            },
                            success:function(data)
                            {
                                $(this).html(data)

                                fetch_ride_requests();
                                

                            }
                        })
                    });





        function fetch_ride_requests(){
                $.ajax({
                    url:"fetch_ride_requests.php",
                    method:"POST",
                    success:function(data){
                        $('#rides').html(data);
                    }
                })
            }

       


        
 });


        </script>

</style>
   
	</head>

<body>
<!-- Main navigation -->  <!-- top Navbar-->
 <?php 


 $activemenu = "rides";
 include('includes/driver_navbar.php'); ?>




<!-- SIDE NAV -->
<div class="row" id="body-row" >
    <?php 
    $activeside = 'requests';
    include('includes/driver_side_navbar.php');
    ?>


<div class="col py-3" style = "background-color: white;" > 
        <h1>
        </h1>
        <hr>
        <hr>


 
        <h1>Ride Requests</h1>


<!-- RIDE REQUESTS WRAPPER BELOW -->



<!-- generate complaints inside -->
<div id = "rides" class = "wrapper" style = " display: flex;">




 </div>


</div>



 

    </body>
</html>
    
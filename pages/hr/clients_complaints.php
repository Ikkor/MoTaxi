<?php

require ('LOGIN_CHECK.php');

$_SESSION['user_id'] = $_SESSION['hrnEmail'];
  

//remove when hr has id
?>

<!DOCTYPE html>
<html>
  <head>
    <title>HR manage clients complaints</title>
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

    <script type = "text/javascript" src ="chat_system.js">
    </script>

    <script>

        $(document).ready(function(){

    
            fetch_client_complaints();

            setInterval(function(){
                fetch_client_complaints();
            }, 15000);


        $(document).on('click','.resolvebtn',function(){
                        var comp_id = $(this).attr('data');
                        $.ajax({
                            url:"resolveclientComplaint.php",
                            method:"POST",
                            data:{
                                complaint_id:comp_id
                            },
                            success:function(data)
                            {
                                $(this).html(data) //need a way to prevent accidental resolve
                                fetch_client_complaints();
                                

                            }
                        })
                    });




        function fetch_client_complaints(){
                $.ajax({
                    url:"fetch_client_complaints.php",
                    method:"POST",
                    success:function(data){
                        $('#complaints').html(data);
                    }
                })
            }

       


        
 });


        </script>

</style>
   
	</head>

<body>
<!-- Main navigation -->
<div id = "chatbox"></div>
  <!-- top Navbar-->
 <?php 


 $activemenu = "clients";
 include('includes/hr_navbar.php'); ?>




<!-- SIDE NAV -->
<div class="row" id="body-row" >
    <?php 
    $activeside = 'unresolved';
    include('includes/hr_side_navbar.php');
    ?>


<div class="col py-3" style = "background-color: white;" > 
        <h1>
        </h1>
        <hr>
        <hr>


 
        <h1>New complaints: Client v/s Driver</h1>


<!-- CLIENT COMPLAINTS WRAPPER BELOW -->



<!-- generate complaints inside -->
<div id = "complaints" class = "wrapper" style = " display: flex;">




 </div>


</div>



 

    </body>
</html>
    
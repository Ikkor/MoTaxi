<?php

require ('../../modules/login_check.php');
require 'includes/utypecheck.php';

$_SESSION['user_id'] = $_SESSION['id'];

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Driver Inbox</title>
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

  <!-- this adds emoji box -->
   <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
   <script type = "text/javascript" src="../../modules/chat_modules/chat_system.js"></script>
    


<script>
  $(document).ready(function(){

    
        fetch_inbox_latest();

        

        setInterval(function(){
          fetch_inbox_latest();
        }, 4000);
//fetch new complaints every 15 secs

        function fetch_inbox_latest(){
          $.ajax({
            url:"../../modules/chat_modules/fetch_inbox_latest.php",
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

<div id = "INBOX"></div>
  <!-- top Navbar-->
 <?php 


 $activemenu = "profile";
 include('includes/driver_navbar.php'); ?>




<!-- SIDE NAV -->
<div class="row" id="body-row" >
    <?php 
    $activeside = 'inbox';
    include('includes/driver_side_navbar.php');
    ?>


<div class="col py-3" style = "background-color: white;" > 
        <h1>
        </h1>
        <hr>
        <hr>


 
        <h1>My Messages</h1>


<!-- CLIENT RIDES WRAPPER BELOW -->




<div class = "wrapper" id = "messages" style = "display: flex;">
   


</div>
</div>



    

    </body>
</html>
    
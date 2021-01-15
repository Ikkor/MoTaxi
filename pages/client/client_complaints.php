<?php
require ('../../modules/login_check.php');
require ('../../includes/db_connect.php');
require 'includes/utypecheck.php';
$_SESSION['rideInQuestion']=$_GET['rideInQuestion'];

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Client View Rides</title>
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

   <link rel="stylesheet" type="text/css" href="../../css/style.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.2.2/web-animations.min.js"></script>


   
	</head>

<body>
<!-- Main navigation -->

  <!-- top Navbar-->
 <?php 


 $activemenu = "profile";
 include('includes/client_navbar.php'); ?>




<!-- SIDE NAV -->
<div class="row" id="body-row" >
    <?php 
    $activeside = 'rides';
    include('includes/client_side_navbar.php');
    ?>


<div class="col py-3" style = "background-color: white;" > 
        <h1>
        </h1>
        <hr>
        <hr>


 
        <h1>Writing a complaint</h1>
       
        <a href = "client_rides.php"><< Back</a>

        <hr>
       


         <div class = "container">

<form class="text-center border border-light p-5" action="writecomplaint.inc.php" method = "post">

    <div class="form-col mb-4">

      <div class="row">
            <label for = "txt_type">What would you like to complaint about?</label>
            <select required="required" class = "browser-default custom-select" name ="txt_type" id="txt_type">
              <option value="hygiene">hygiene</option>
              <option value="treatment">treatment</option>
              <option value="other" selected>other</option>
            </select>
      </div>        

      <div class="col">
            <div class="md-form">
              <textarea required="required"style= id="form10" class="md-textarea form-control" rows="6" name = "txt_desc" ></textarea>
              <label for="txt_desc">Give us more details: </label>
            </div>
          </div>

          <!-- submit button -->
    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" name = "submit" value = "submit" style = "width:320px;" type="submit">Submit </button>
  </div>
      
        


<!--             <span class="error">echo the errors</span><br/>
 -->        
       
    
  
    
    
    
<hr style="border-top: 8px solid #bbb;
  border-radius: 5px;"> 

    

</div>

   
    
    
    

   
  
</form>
</div>


<!-- CLIENT RIDES WRAPPER BELOW -->




<div class = "wrapper" style = "display: flex;">



 
    <!-- Mask & flexbox options-->

</div>
</div>



    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

	<script type ="text/javascript" src="../../javascript/main.js"></script>

    </body>
</html>
    
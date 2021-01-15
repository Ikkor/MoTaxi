<?php

require ('../../modules/login_check.php');
  require ('includes/utypecheck.php');


?>

<!DOCTYPE html>
<html>
  <head>
    <title>Driver View Rides</title>
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
 include('includes/driver_navbar.php'); ?>




<!-- SIDE NAV -->
<div class="row" id="body-row" >
    <?php 
    $activeside = 'rides';
    include('includes/driver_side_navbar.php');
    ?>


<div class="col py-3" style = "background-color: white;" > 
        <h1>
        </h1>
        <hr>
        <hr>


 
        <h1>My Rides</h1>


<!-- CLIENT RIDES WRAPPER BELOW -->




<div class = "wrapper" style = "display: flex;">

<table class="table">
  <thead>
    <tr>
      
      <th scope="col">Date</th>
      <th scope="col">Time</th>
      <th scope="col">Name</th>
      <th scope="col">From</th>
      <th scope="col">To</th>
      <th scope="col"></th>

      
    </tr>
  </thead>
  <tbody>
<?php 

      $id=$_SESSION['id'];
      $name=$_SESSION['name'];
      $email=$_SESSION['email'];
      $utype=$_SESSION['utype'];
      //fetch all rides pertaining to that client

      require '../../includes/db_connect.php';
      $stmt=$pdo->prepare('select * from ride where driver_id=:id order by date desc');
      $stmt->execute(['id'=>$id]);
      $history = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach($history as $row){
        //get the name of the client in question
          $user_id=$row['user_id'];
          $ride_id=$row['ride_id'];

          $name=$pdo->prepare('select name from user where id=:id');
          $name->execute([ 'id'=>$user_id ]);
          $result=$name->fetch();
        
        // echo "<tr><td><img src='".$pfplink."' border=3 height=100 width=100></img>"."</td><td>".$row['date']."</td><td>".$row['time_in'].$result['name']."</td><td>".$row['from_loc']."</td><td>".$row['to_loc']."</td><td>"."<a href='writecomplaint.php?driverId=".$driver_id."'>Write complaint</a> </td></tr>";

        echo "<tr><td>".$row['date']."</td><td>".$row['time_in']."</td><td>".$result['name']."</td><td>".$row['from_loc']."</td><td>".$row['to_loc']."</td><td>"."<a style = 'color: blue;' href='driver_writecomplaint.php?rideInQuestion=$ride_id'>Write complaint</a> </td></tr>";

      } 
    ?>

  </tbody>
</table>

 
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
    
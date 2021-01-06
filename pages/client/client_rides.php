<?php

require ('../../modules/login_check.php');


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


 
        <h1>My Rides</h1>


<!-- CLIENT RIDES WRAPPER BELOW -->




<div class = "wrapper" style = "display: flex;">

<table class="table">
  <thead>
    <tr>
      <th scope="col">Driver</th>
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
      /*
      get session variables
      show ride history for client sort by date
      allow search for specific reg id
      select from table
      build list with <a></a> and driver id as ?
      go to write complaint area
      submit
      */

      $id=$_SESSION['id'];
      $name=$_SESSION['name'];
      $email=$_SESSION['email'];
      $utype=$_SESSION['utype'];
      //fetch all rides pertaining to that client

      require '../../includes/db_connect.php';
      $stmt=$pdo->prepare('select * from ride where user_id=:id order by date desc');
      $stmt->execute(['id'=>$id]);
      $history = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach($history as $row){
        //get the name of the driver
        $driver_id=$row['driver_id'];
        $name=$pdo->prepare('select name from user where id=:id');
        $name->execute([ 'id'=>$row['driver_id'] ]);
        $result=$name->fetch();
        

        //get his photo
        $photo=$pdo->prepare('select pfp from driver_details where driverId=:driver_id');
        $photo->execute([ 'driver_id'=>$driver_id ]);
        $pfp=$photo->fetch();
        $pfplink='../'.$pfp['pfp'];
        //echo $pfplink;

        echo "<tr><td><img src='".$pfplink."' border=3 height=100 width=100></img>"."</td><td>".$row['date']."</td><td>".$row['time_in']."</td><td>".$result['name']."</td><td>".$row['from_loc']."</td><td>".$row['to_loc']."</td><td>"."<a style = 'color:blue;'href='client_complaints.php?driverId=".$driver_id."'>Write complaint</a> </td></tr>";

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
    
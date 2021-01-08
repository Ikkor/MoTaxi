<?php

require ('../../modules/login_check.php');


?>

<!DOCTYPE html>
<html>
  <head>
    <title>Driver view vehicles</title>
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
    $activeside = 'vehicles';
    include('includes/driver_side_navbar.php');
    ?>


<div class="col py-3" style = "background-color: white;" > 
        <h1>
        </h1>
        <hr>
        <hr>


 
        <h1>My Vehicles</h1>


<!-- CLIENT RIDES WRAPPER BELOW -->




<div class = "wrapper" style = "display: flex;">

<table class="table">
  <thead>
    <tr>
      <th scope="col">Vehicle</th>
      <th scope="col">License plate</th>
      <th scope="col">Service(s)</th>
      <th scope="col">#Seats</th>
      <th scope="col">Model</th>
      <th scope="col">Year</th>
      <th scope="col">a/c</th>
      <th scope="col">Boot Capacity</th>

    </tr>
  </thead>
  <tbody>
<?php 
			
			$id=$_SESSION['id'];
			// $name=$_SESSION['name'];
			// $email=$_SESSION['email'];
			// $utype=$_SESSION['utype'];

			//fetch all vehicules pertaining to that driver

			require '../../includes/db_connect.php';
			$stmt=$pdo->prepare('select * from vehicules where owned_by=:id');
			$stmt->execute(['id'=>$id]);
			$listvehc = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach($listvehc as $row){
				$piclink=$row['pic'];
				$reg_no=$row['reg_no'];
				$_SESSION['old_reg_no']=$row['reg_no'];

				echo "<tr><td><img src='".$piclink."' border=3 height=100 width=100></img>"."</td><td>".$row['reg_no']."</td><td>".$row['s_type']."</td><td>".$row['seat']."</td><td>".$row['model_name']."</td><td>".$row['year']."</td><td>".$row['ac']."</td><td>".$row['boot_capacity']."</td><td>"."</td><td>"."</td><td>"."<a style = 'color:blue;' href='editvehc.php'>Edit Vehicule</a> </td></tr>";

			}	

 		?>

  </tbody>
</table>

 
    <!-- Mask & flexbox options-->

</div>
	<a href="addvehc.php">Add New</a>

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
    
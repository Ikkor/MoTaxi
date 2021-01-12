<?php

require ('LOGIN_CHECK.php');


?>

<!DOCTYPE html>
<html>
  <head>
    <title>HR view solved complaints</title>
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

    <link rel="stylesheet" type="text/css" href="css/style.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.2.2/web-animations.min.js"></script>

</style>
   
	</head>

<body>
<!-- Main navigation -->

  <!-- top Navbar-->
 <?php 


 $activemenu = "clients";
 include('includes/hr_navbar.php'); ?>




<!-- SIDE NAV -->
<div class="row" id="body-row" >
    <?php 
    $activeside = 'resolved';
    include('includes/hr_side_navbar.php');
    ?>


<div class="col py-3" style = "background-color: white;" > 
        <h1>
        </h1>
        <hr>
        <hr>


 
        <h1>Resolved complaints: Client v/s Driver</h1>


<!-- CLIENT RIDES WRAPPER BELOW -->




<div class = "wrapper" style = "display: flex;">

<table class="table">
  <thead>
    <tr>

      <th scope="col">Complaint ID</th>
      <th scope="col">client ID</th>
      <th scope='col>'>client email</th>
      <th scope="col">driver ID</th>
      <th scope="col">Type</th>
      <th scope="col">Description</th>
      <th scope="col">Date</th>
      <th scope="col">Status</th>
      <th scope="col"></th>
      

      
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
			$stmt=$pdo->prepare('select * from client_complaints inner join user on id=user_id where status="Resolved" order by date');
			$stmt->execute();
			$details = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($details as $row){
				
				echo 
				"<tr
				<td></td>
				<td>".$row['complaint_id']."</td>
				<td>".$row['user_id']."</td>
				<td>".$row['email']."</td>
				<td>".$row['driver_id']."</td>
				<td>".$row['type']."</td>
				<td>".$row['description']."</td>
				<td>".$row['date']."</td>
				<td>".$row['status']."</td>
				</tr>";

			


			}	

 		?>

  </tbody>
</table>
<?php  
		// if(isset($_GET['message'])){
		// 	echo $_GET['message'];
		// }

	?>

 




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
    
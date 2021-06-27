<?php

//require ('LOGIN_CHECK.php');


?>

<!DOCTYPE html>
<html>
  <head>
    <title>Admin manage Users</title>
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


 $activemenu = "manage";
 include('includes/admin_navbar.php'); ?>




<!-- SIDE NAV -->
<div class="row" id="body-row" >
    <?php 
    $activeside = 'users';
    include('includes/admin_side_navbar.php');
    ?>


<div class="col py-3" style = "background-color: white;" > 
        <h1>
        </h1>
        <hr>
        <hr>


 
        <h1>Manage users</h1>


<!-- CLIENT RIDES WRAPPER BELOW -->




<div class = "wrapper" style = "display: flex;">

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Email</th>
      <th scope="col">Utype</th>
      <th scope="col">Name</th>
      <th scope="col">Phone #</th>
      <th scope="col">Address</th>
      <th scope="col">Date of birth</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
<?php 
			
			// $name=$_SESSION['name'];
			// $email=$_SESSION['email'];
			// $utype=$_SESSION['utype'];

			//fetch all vehicules pertaining to that driver

			require '../../includes/db_connect.php';
			$stmt=$pdo->prepare('select name, id, email, utype, phone,address, dob, active from user');
			$stmt->execute();
			$details = $stmt->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($details as $row){
			
				echo "<tr>
				<td>".$row['id']."</td>
				<td>".$row['email']."</td>
				<td>".$row['utype']."</td>
				<td>".$row['name']."</td>
				<td>".$row['phone']."</td>
				<td>".$row['address']."</td>
				<td>".$row['dob']."</td>
				<td>".$row['active']."</td>
				";
				

				if($row['active']=='0'){
					echo "<td>"."</td><td>"."<a style = 'color:green;' href='EnableUser.php?id=".$row['id']."'>Activate</a></td>";
				}
				else{
					echo "<td>"."</td><td>"."<a style = 'color:red;'href='DisableUser.php?id=".$row['id']."'>Disable</a></td>";
				}

				echo "</tr>";


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
    
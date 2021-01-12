<?php

require ('LOGIN_CHECK.php');
require ('../../includes/db_connect.php');

$oldresult['rate']="";
	$oldrate='select * from rate order by date desc limit 1';
	$stmt=$pdo->prepare($oldrate);
	$stmt->execute();
	$oldresult = $stmt->fetch(PDO::FETCH_ASSOC);

	if(isset($_POST['submit'])){
		if(is_numeric($_POST['newrate']) && $_POST['newrate']!=""){
			$email=$_SESSION['adminEmail'];
			$null=NULL;
			$sql='insert into rate values(:NULL, :rate, :who)';
			$stmt=$pdo->prepare($sql);
			$stmt->execute(['NULL'=>$null,'rate'=>$_POST['newrate'], 'who'=>$email]);
		}
	}
?>


?>

<!DOCTYPE html>
<html>
  <head>
    <title>Admin manage rates</title>
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


 $activemenu = "rates";
 include('includes/admin_navbar.php'); ?>




<!-- SIDE NAV -->
<div class="row" id="body-row" >
    <?php 
    $activeside = 'rates';
    include('includes/admin_side_navbar.php');
    ?>


<div class="col py-3" style = "background-color: white;" > 
        <h1>
        </h1>
        <hr>
        <hr>


 
        <h1>Manage rates</h1>


<!-- CLIENT RIDES WRAPPER BELOW -->




<div class = "wrapper" style = "display: flex;">
	<form class="text-center border border-light p-5" action="writecomplaint.inc.php" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

		<div class="form-col mb-4">


<div class = "row edit">
	<h5> Old Rates </h5>
	<input type="text" class="form-control" name="oldrate" id="oldrate" value="<?php echo $oldresult['rate'] ?>" readonly>
</div>


<div class = "row edit">
	<h5>New Rate</h5>
	<input type="number" class="form-control" name="newrate" id="newrate">
</div>

	
	<div class = "form group">
	<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="submit" value="update">Update</button>
</div>

</div>

</form>
</div>


<?php  
		if(isset($_GET['message'])){
			echo $_GET['message'];
		}

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
    
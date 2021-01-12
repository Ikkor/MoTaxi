<?php 
 require '../../modules/inputsanitizer.php';
  $emailE=1;
  $logerror = '';

  if(isset($_GET['error'])){
  	if($_GET['error']=='wronglogin'){
    $logerror='Authentication failed, please try again';
	}
	if($_GET['error']=='notlog'){
		$logerror='Please login first.';
	}

  }
  
  sanitizeInput();// trimmed and remove specialchars

  if( isset($_POST['txt_email']) && filter_var($_POST['txt_email'], FILTER_VALIDATE_EMAIL)){
    $emailE=0;
  }

  if( isset($_POST['submit']) && $emailE==0){
    require '../../includes/db_connect.php';
    //get the data
    $email=$_POST['txt_email'];
    $pwd=$_POST['txt_pwd'];

    $loginstmt=$pdo->prepare('select * from hr_man where email=:email');
    $loginstmt->execute(['email'=>$email]);
    $login = $loginstmt->fetch(PDO::FETCH_ASSOC);

    $email=$login['email'];
    $hashpwd=$login['password'];

    if(!$login || !password_verify($pwd, $hashpwd)){
      header('location: hr_login.php?error=wronglogin');
    }else{//create session variables
      session_start();
      $_SESSION['hrName']=$login['name'];
      $_SESSION['hrnEmail']=$login['email'];
      $_SESSION['id']='hr';
      header("location: drivers_complaints.php");
    }
  }

 ?>


<!DOCTYPE html>
<html>
  <head>
    <title>HR Login</title>
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


   
	</head>

<body>
<!-- Main navigation -->
<header>
  <!--Navbar-->
 <?php 

 $activemenu = "login";
 
 include('includes/hr_navbar.php'); ?>

  <!-- Full Page Intro -->
  <div class="view" style="background-image: url('../../images/bg-admin.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    
    <!-- Mask & flexbox options-->
    <div class="mask rgba-gradient blur d-flex justify-content-center align-items-center">

      <!-- Content -->
      <div class="container" >
        <!--Grid row-->
        <div class="row">
<div class = "reguser" style = "width: 40% !important;">
    <div class="card-header" style = " width: auto;">
      <strong style = "color:black; ">HR </strong>
      <strong style = "color: white;">Login</strong>
    </div>

<form class="text-center border border-light p-5" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" >
      <h5> Authentication required. </h5>
      <hr>


    <span class = "error"><?php echo $logerror?></span>


    

    <div class="col" >
       
      
  
        <div class="form group" style = "margin-bottom: 50px;" >
            <!-- email -->
              <label for="txt_email">Email: </label>
            <input pattern = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type="email" name = "txt_email" id="defaultRegisterFormName" class="form-control" value = "">

        </div>
      
    


    
        <div class="form group" style = "margin-bottom: 50px;" >
            <!-- password -->
              <label for="txt_pwd">Password: </label>
            <input type="password" name = "txt_pwd" id="defaultRegisterFormPassword" class="form-control"  value = "" required pattern = '^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$'>
        </div>

      </div>
      
    <hr>
 


        <span class="navbar-toggler-icon"></span>
      </button>
    <!-- Sign up button -->
    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" value = "submit" name = "submit">Login</button>

    <!-- facebook register -->
   <!--  <p>or sign up with:</p>

    <a href="#" class="mx-2" role="button"><i class="fab fa-facebook-f light-blue-text"></i></a> -->
    <hr>

    
  </form>
</div>


</div>



          <!--Grid column-->
        </div>

        <!--Grid row-->
      </div>
      <!-- Content -->
    </div>
    <!-- Mask & flexbox options-->
  </div>
  <!-- Full Page Intro -->
</header>
<!-- Main navigation -->

<footer>
<p>Copyright © 2020 MoTaxi Ltd. All Rights Reserved.</p>
</footer>

<!--Main Layout-->




	<!-- JQuery -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Bootstrap tooltips -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
	<!-- Bootstrap core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<!-- MDB core JavaScript -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

	<script type ="text/javascript" src="../javascript/main.js"></script>

    </body>
</html>
    


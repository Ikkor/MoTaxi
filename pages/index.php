<!DOCTYPE html>
<html>
  <head>
    <title> MoTaxi Homepage</title>
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

    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.2.2/web-animations.min.js"></script>


   
	</head>

<body>
<!-- Main navigation -->
<header>
  <!--Navbar-->
 <?php 
 $activemenu = "home";
 include('../includes/navbar.php'); ?>

  <!-- Full Page Intro -->
  <div class="view" style="background-image: url('../images/bg.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    <!-- Mask & flexbox options-->
    <div class="mask rgba-gradient d-flex justify-content-center align-items-center">
      <!-- Content -->
      <div class="container">
        <!--Grid row-->
        <div class="row">


          <!--Grid column-->
          <div class="col-md-6 white-text text-center text-md-left mt-xl-5 mb-5 wow fadeInLeft" data-wow-delay="0.3s">
            <h1 class="h1-responsive font-weight-bold mt-sm-5">Life has never been easier than a ride with MoTaxi! </h1>
            <hr class="hr-light">
            <h6 class="mb-4">Whether you want to book a taxi or arrange your airport transfers, MoTaxi is just what you need!</h6>
            <a class="btn request">Request Ride</a>
  	        <a class="btn btn-outline-white">Learn more</a>


          </div>
          <!--Grid column-->
          <!--Grid column-->

          <!-- Material form login -->
<div class="card">


  <h5 class="card-header text-center" >
    <strong>Sign in</strong>
  </h5>

  <!--Card content-->
  <div class="card-body px-lg-5 pt-0">

    <!-- Form -->
    <form class="text-center" style="color: black;" action="#!">

      <!-- Email -->
      <div class="md-form">
        <input type="email" id="materialLoginFormEmail" class="form-control">
        <label for="materialLoginFormEmail">E-mail</label>
      </div>

      <!-- Password -->
      <div class="md-form">
        <input type="password" id="materialLoginFormPassword" class="form-control">
        <label for="materialLoginFormPassword">Password</label>
      </div>

      <div class="d-flex justify-content-around">
        <div>
          <!-- Remember me -->
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
            <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
          </div>
        </div>
        <div>
          <!-- Forgot password -->
          <a href="">Forgot password?</a>
        </div>
      </div>

      <!-- Sign in button -->
      <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>

      <!-- Register -->
      <p>Not a member?
        <a href="#" data-toggle=modal data-target="#centralModalSm">Register</a>
      </p>

      <!-- Social login -->
      <p>or sign in with:</p>
      <a type="button" class="btn-floating btn-fb btn-sm">
        <i class="fab fa-facebook-f"></i>
      </a>

    </form>
    <!-- Form -->

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



<!-- Button trigger modal -->


<!-- Central Modal Small -->
<div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Change class .modal-sm to change the size of the modal -->
  <div class="modal-dialog modal-lg" role="document">


    <div class="modal-content">
      	<div class="modal-header">
	        <h4 class="modal-title w-100" id="myModalLabel">Register as a ..</h4>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
    	</div>
    <div class="modal-body">
      	<div class = "reg-opt">
      		<div class = "img1">
	      		<img src = "../images/steering.png"/>
	      		<br/>
		        <button type="button" class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0">Driver</button>
		    </div>

			<div class ="img2">
				<img src = "../images/user.png"/>
	      		<br/>
		        <a href = "../pages/user_register.php"><button type="button" class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0">User</button></a>
		    </div>

	    </div>

    </div>
    <div class="modal-footer">
      
    </div>
    </div>
  </div>
</div>

<!-- Central Modal Small -->


<!--Main Layout-->

<!-- 
<main> 
  <div class="container">
   
    <div class="row py-5">
      
      <div class="col-md-12 text-center">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
      
    </div>
    
  </div>
</main>
-->
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
    


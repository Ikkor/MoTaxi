<?php 
  require '../../includes/db_connect.php';
  require '../../modules/inputsanitizer.php';

  

  if(isset($_POST['submit'])){
    //verify data then insert no check on name just pregmatch on password
    sanitizeInput();
    $name=$_POST['txt_name'];
    $pwd=$_POST['txt_pwd'];
    $email=$_POST['txt_email'];

    $rexPass='/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/';
    if($pwd !="" && $email!="" && filter_var($_POST['txt_email'], FILTER_VALIDATE_EMAIL) && preg_match($rexPass,$pwd) ){
      $hash_pwd=password_hash($pwd, PASSWORD_DEFAULT);
      $sql="insert into admin values (:name, :email, :password)";
      $stmt=$pdo->prepare($sql);
      $stmt->execute(['name'=>$name,'email'=>$email, 'password'=>$hash_pwd]);

      header("location: admin_login.php");

    }

  }


 ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Admin create</title>
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

 $activemenu = "home";
 
 include('includes/admin_navbar.php'); ?>

  <!-- Full Page Intro -->
  <div class="view" style="background-image: url('../../images/bg-admin.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    
    <!-- Mask & flexbox options-->
    <div class="mask rgba-gradient blur d-flex justify-content-center align-items-center">

      <!-- Content -->
      <div class="container" >
        <!--Grid row-->
        <div class="row">
<div class = "reguser">
    <div class="card-header" style = " width: auto;">
      <strong style = "color:white; ">Register as a </strong>
      <strong style = "color: black;">Admin</strong>
    </div>
<form class="text-center border border-light p-5" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" >
  <h4 style = "text-align: center!important;"> Please fill in the required details below.. </h4>

    

    <div class="col" style = "width:60%">
        <div class="row edit">
            <!-- Username -->
              <label for="txt_name">Full Name: </label>
            <input required="required" type="text" name = "txt_name" id="defaultRegisterFormName" class="form-control" placeholder="e.g John Doe" value = "">
        </div>
      
   

    
        <div class="row edit">
            <!-- email -->
              <label for="txt_email">Email: </label>
            <input pattern = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type="email" name = "txt_email" id="defaultRegisterFormName" class="form-control" placeholder="johndoe@motaxi.mu" value = "">

        </div>
      
    


    
        <div class="row edit">
            <!-- password -->
              <label for="txt_pwd">Password: </label>
            <input type="password"pattern='^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$'  name = "txt_pwd" id="defaultRegisterFormName" class="form-control"  value = "">
        </div>

      </div>
      
    
 

    <!-- Sign up button -->
    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" value = "submit" name = "submit">Register</button>

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



<!-- Button trigger modal -->


<!-- Central Modal Small-->

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
    


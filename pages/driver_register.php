<?php session_start(); 

$nameErr = $addressErr= $dobErr = $districtErr = $passwordErr  = $emailErr = $phoneErr = $districtErr=$dateStartE=$licenseE=$pfpE="";

$name = $email =$district = $phone = $dob = $address= $dateStart ='';


//get the error descriptions stored in sessions
if(isset($_GET['ref'])){
  if(($_GET['ref'])=='Err'){

    

    //common errors
      $nameErr = $_SESSION['nameErr'];
      $phoneErr = $_SESSION['phoneErr'];
      $addressErr = $_SESSION['addressErr'];
      $emailErr = $_SESSION['emailErr'];
      $passwordErr = $_SESSION['passwordErr'];
      $dobErr = $_SESSION['dobErr'];
      $districtErr = $_SESSION['districtErr'];

    //driver only errors
      
      $pfpE = $_SESSION['pfpE'];
      $licenseE = $_SESSION['licenseE'];
      $dateStartE = $_SESSION['dateStartE'];


    //common previous values
      $name = $_SESSION['name'];
      $email = $_SESSION['email'];
      $phone =  $_SESSION['phone'];
      $dob = $_SESSION['dob'];
      $address = $_SESSION['address'];


    //driver only previous values
     $dateStart = $_SESSION['dateStart'];


    }
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Driver SignUp</title>
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
    
   <style>
    .text-center{
      text-align: left !important;
    }
  </style>

	</head>

<body>
<!-- Main navigation -->
<header>
   <?php 
 $activemenu = "signup";
 include('../includes/navbar.php'); ?>


    <!-- Mask & flexbox options-->
    <div class="mask rgba-gradient d-flex justify-content-center align-items-center">
      
<div class="container">
        <!--Grid row-->
        <div class="row">

  <!-- Default form register -->
  <div class = "reguser">
    <div class="card-header" style = " width: auto;">
      <strong style = "color:white; ">Register as a </strong>
      <strong style = "color: black;">Driver </strong>
    </div>
<form class="text-center border border-light p-5" action="../modules/register-process.php?ref=driver" method = "post" enctype="multipart/form-data">
  <h4 style = "text-align: center!important;"> Please fill in the required details below.. </h4>

    <hr>


    <div class="form-row mb-4">
        <div class="col">
            <!-- Username -->
            <label for="txt_name">Full Name: </label>
            <input type="text" name = "txt_name" id="defaultRegisterFormName" class="form-control" pattern = "\b[A-Z][a-z]*( [A-Z][a-z]*)*\b" title = "Your name(s) should start with a capital letter" placeholder="e.g John Doe" value = "<?php echo $name ?>">

            <span class="error">*<?php echo $nameErr;?></span><br/>
        </div>
      
    </div>

    <!-- E-mail -->
    <label for="txt_email">Email Address: </label>
    <span class="error">* <?php echo $emailErr;?></span><br/>
    <input type="email" id="defaultRegisterFormEmail" name = "txt_email" class="form-control mb-4" pattern = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title = "someone@email.com" placeholder="johndoe@limem.com" value = "<?php echo $email ?>">

    <!-- Phone number -->
    <label for="txt_phone">Phone Number: </label>
    <span class="error">*<?php echo $phoneErr;?></span><br/>
    <input type="text" id="defaultRegisterFormPhone" name = "txt_phone" class="form-control mb-4" placeholder="5XXXXXXX" pattern = "[5][0-9]{7}" title = "Should start with 5 and not exceed a length of 8 digits" value = "<?php echo $phone ?>">

    <!-- DOB -->
    <label for="txt_dob">Date of Birth: </label>
    <span class="error">*<?php echo $dobErr;?></span><br/>
    <input required = "required" type="date" id="defaultRegisterFormDate" name = "txt_dob" class="form-control mb-4" value = "<?php echo $dob ?>">
    

    <!-- Password -->
    <label for="txt_phone">Password: </label>
    <span class="error">*<?php echo $passwordErr?></span><br/>
    <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Enter password" aria-describedby="defaultRegisterFormPasswordHelpBlock" name = "txt_pass" title=" A combination of atleast 1 symbol, digit, lowercase, uppercase and of length 8." pattern='^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$'>
   

    <!-- confirm password -->
    <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Confirm Password" aria-describedby="defaultRegisterFormPasswordHelpBlock" name = "txt_passR">
     <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
        A combination of atleast 1 symbol, digit, lowercase, uppercase and of length 8.
    </small>

    <!-- Date started taxi -->
    <label for="txt_dateStart">You are a registered taxi driver since: </label>
    <span class="error">* <?php echo $dateStartE?></span><br/>
    <input required = "required" type="date" id="defaultRegisterFormDate" name = "txt_dateStart" class="form-control mb-4" value = "<?php echo $dateStart ?>">

    <!-- license  -->
  <div class="form-row mb-4">
    <div class = "col">
    <label for = "filelicense">Upload a picture of your license:  </label>
    <span class="error">* <?php echo $licenseE ?></span>
    <input required = "required" type="file" accept = ".png, .jpeg, .jpg" id="filelicense" name = "filelicense" class=".form-control-file">
  </div>

    <div class = "col">
    <!-- profile picture -->
    <label for = "filepfp">Please select a profile picture (can edit later) :</label>
    <span class="error">* <?php echo $pfpE ?></span>
    <input required = "required" type="file" accept = ".png, .jpeg, .jpg" id="filepfp" name = "filepfp" class=".form-control-file">
  </div>
</div>
  
    
  <div class="form-group">
    <span class="error">* <?php echo $districtErr ?></span>    
    <select required="required" class = "browser-default custom-select" name="txt_district" id="txt_district">
    <option value =''>Select a district</option>
    <option value ="port louis">Port-Louis</option>
    <option value ="grand port">Grand-Port</option>
    <option value ="flacq">Flacq</option>
    <option value = "pamplemousses">Pamplemousses</option>
    <option value = "plaine wilhems">Plaine Wilhems</option>
    <option value = "riviere du rempart">Riviere du Rempart</option>
    <option value = "moka">Moka</option>
    <option value = "savanne">Savanne</option>
    </select> 
  </div>

    <label  for="txt_address">Your address: </label>
    <span class="error">* <?php echo $addressErr ?></span>
    <input required="required" pattern="[A-Za-z0-9]+" type="text" 
         class="form-control mb-4" 
         id="txt_address" 
         placeholder="e.g  queen elizabeth II avenue, place d'armes"
         name = "txt_address"
         value = "<?php echo $address?>"
         >

    <!-- Sign up button -->
    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" value = "submit" name = "submit">Sign Up</button>

   
    <hr>

    <!-- Terms of service -->
    <p>By clicking
        <em>Sign up</em> you agree to our
        <a href="" target="_blank">terms of service</a>
    </p>
  </form>
</div>

</div>
</div>
</div>
</div>
<!-- Default form register -->
<!-- Central Modal Small -->
</header>
<?php include("../modules/registerpopup.php"); ?>


<script type ="text/javascript" src="../javascript/rideform.js"></script>
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

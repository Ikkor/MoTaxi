<!DOCTYPE html>
<html>
  <head>
    <title>SignUp</title>
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
    
   
	</head>

<body>
<!-- Main navigation -->
<header>
   <?php 
 $activemenu = "signup";
 include('../includes/navbar.php'); ?>





<?php  

// define variables and set to empty values
$fnameErr = $lnameErr = $passwordErr  = $emailErr = $phoneErr = $districtErr="";
$fname = $lname = $password = $cpassword = $email = $phone =  "";
$err = 0;



function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") { //check if the page is being invoked after form data has been submitted
  if (empty($_POST["txt_fname"])) {//check if the field is empty
    $fnameErr = "First name is required";
    $err =1;
  } else {
    $fname = test_input($_POST["txt_fname"]);//call the test_input function on $_POST["txt_name"]
    if (!preg_match("/^[a-zA-Z ]*$/",$fname)) { //Use a regular expression to validate the name field
       $fnameErr = "Only letters and white space allowed"; 
       $err =1;
       $fname = "";
    }//end if

  }//end else
  



  if (empty($_POST["txt_lname"])) {//check if the field is empty
    $lnameErr = "Last name is required";
    $err =1;
  } else {
    $lname = test_input($_POST["txt_lname"]);//call the test_input function on $_POST["txt_name"]
    if (!preg_match("/^[a-zA-Z ]*$/",$lname)) { //Use a regular expression to validate the name field
       $lnameErr = "Only letters and white space allowed"; 
       $err =1;
       $lname = "";
    }//end if

  }//end else
  
  
if (empty($_POST["txt_email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["txt_email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  

  


  if(!empty($_POST["txt_password"]) && ($_POST["txt_password"] == $_POST["txt_cpassword"])) {
    $password = test_input($_POST["txt_password"]);
    $cpassword = test_input($_POST["txt_cpassword"]);
    if (strlen($_POST["txt_password"]) <= '8') {
        $passwordErr = "Your Password Must Contain At Least 8 Characters!";
    }
    elseif(!preg_match("#[0-9]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Number!";
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
        $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
    }
}
elseif(!empty($_POST["txt_password"])) {
    $passwordErr = "Please Check You've Entered Or Confirmed Your Password!";
} else {
     $passwordErr = "Please enter password   ";
}


// IMPORTANT: ONLY INSERTING EMAIL AND PW FOR NOW

if($err != 1){ //if no errors


   $hashed_password = password_hash($password,PASSWORD_DEFAULT);
    require_once "../includes/db_connect.php";
    $sInsert = "INSERT INTO registered_user  (email, password, username) VALUES( '$email' , '$hashed_password' , '$fname') ";
    #echo $sQuery;
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $Result = $conn->exec($sInsert) ;
   
    if($Result )
    { 
      $Msg = "!Success";
      echo $Msg;
      header("Location: index.php");
    }else{
       $Msg = "ERROR: Your credentials could not be saved!";
       echo $Msg;
      
    }
    




  }
}
?>
 



    <!-- Mask & flexbox options-->
    <div class="mask rgba-gradient d-flex justify-content-center align-items-center">
      
<div class="container">
        <!--Grid row-->
        <div class="row">

  <!-- Default form register -->
  <div class = "reguser">
    <div class="card-header" style = " width: auto;">
      <strong style = "color:white; ">Register as a </strong>
      <strong style = "color: black;">User</strong>
    </div>
<form class="text-center border border-light p-5" action="<?php echo $_SERVER["PHP_SELF"];?>" method = "post">
  <p> Please fill in the required details below.. </p><br>

    

    <div class="form-row mb-4">
        <div class="col">
            <!-- First name -->
            <input type="text" name = "txt_fname" id="defaultRegisterFormFirstName" class="form-control" placeholder="First name" value = "<?php echo $fname ?>">

            <span class="error">* <?php echo $fnameErr;?></span><br/>
        </div>
        <div class="col">
            <!-- Last name -->
            <input type="text" id="defaultRegisterFormLastName" name = "txt_lname" class="form-control" placeholder="Last name" value = "<?php echo $lname ?>">
            <span class="error">* <?php echo $lnameErr;?></span><br/>


        </div>
    </div>

    <!-- E-mail -->
    <span class="error">* <?php echo $emailErr;?></span><br/>
    <input type="email" id="defaultRegisterFormEmail" name = "txt_email" class="form-control mb-4" placeholder="E-mail" value = "<?php echo $email ?>">
    

    <!-- Password -->
    <span class="error">* <?php echo $passwordErr?></span><br/>
    <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Password" aria-describedby="defaultRegisterFormPasswordHelpBlock" name = "txt_password">
   

    <!-- confirm password -->
    <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Confirm Password" aria-describedby="defaultRegisterFormPasswordHelpBlock" name = "txt_cpassword">
     <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
        At least 8 characters and 1 digit
    </small>


   
    <!-- Phone number -->
    <!-- <input type="text" id="defaultRegisterPhonePassword" class="form-control" placeholder="Phone number" aria-describedby="defaultRegisterFormPhoneHelpBlock">
    <small id="defaultRegisterFormPhoneHelpBlock" class="form-text text-muted mb-4">
        Optional - for two step authentication
    </small> -->

    <select class = "browser-default custom-select" name="fruit">
    <option value ="none">Select a district</option>
    <option value ="port louis">Port-Louis</option>
    <option value ="grand port">Grand-Port</option>
    <option value ="flacq">Flacq</option>
    <option value = "pamplemousses">Pamplemousses</option>
    <option value = "plaine wilhems">Plaine Wilhems</option>
    <option value = "riviere du rempart">Riviere du Rempart</option>
    <option value = "moka">Moka</option>
    <option value = "savanne">Savanne</option>
 

    </select> 

    <input type="street" 
         class="form-control mb-4" 
         id="autocomplete" 
         placeholder="Street"
         >

  
  <input type="city" 
         class="form-control mb-4" 
         id="inputCity" 
         placeholder="City">

    <!-- Sign up button -->
    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign Up</button>

    <!-- facebook register -->
   <!--  <p>or sign up with:</p>

    <a href="#" class="mx-2" role="button"><i class="fab fa-facebook-f light-blue-text"></i></a> -->
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

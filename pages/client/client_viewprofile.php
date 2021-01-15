<?php
require('../../modules/login_check.php');
require('../../includes/db_connect.php');
require 'includes/utypecheck.php';



// errors
$txt_nameErr=$txt_passErr=$txt_passErr=$txt_districtErr=$txt_addressErr=$txt_phoneErr=$txt_npwdErr='';

/*
    verify that regno belong to session[id]
    show pre filled form
    upon submit, update table
    */

    $id=$_SESSION['id'];
    $stmt=$pdo->prepare("select * from user where id=:id");
    $stmt->execute(['id'=>$id]);
    $check=$stmt->fetch(PDO::FETCH_ASSOC);
        //id email password utype name phone address dob
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Client view profile</title>
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.2.2/web-animations.min.js"></script>

   
	</head>

<body>
<!-- Main navigation -->

  <!-- top Navbar-->
 <?php 


 $activemenu = "profile";
 include('includes/client_navbar.php'); ?>

  <!-- Full Page Intro -->

<!-- SIDE NAV -->


<div class="row" id="body-row" >
    <?php 
    $activeside = 'vprofile';

    include('includes/client_side_navbar.php');
    ?>
    

<div class="col py-3" style = "background-color: white;" > 
        <h1>
        </h1>
        <hr>
        <hr>


 
        <h1>View My Profile</h1>


<!-- EDIT PROFILE WRAPPER BELOW -->

<div>

<form  action="#" method = "post"  enctype="#" >
<div class = "wrapper" style = "display: flex;">


    <div class = "text-center border border-light p-5 left form" style="width: 60%;">

<fieldset disabled = "disabled">
    <div class="form-col mb-4">
        <div class="row edit">
            <!-- First name -->
            <h4>Name: </h4>
            <input type="text" name = "txt_name" id="txt_name" class="form-control" value ="<?php echo $check['name'];?>">

            
        </div>
       
    
    <!-- E-mail -->
  <!--   <div class="row edit">
    <h4>Email: </h4>
    
    <input type="email" id="defaultRegisterFormEmail" name = "txt_email" class="form-control" placeholder="E-mail" value = "email.com">
    <span class="error">ok</span>
    
    </div>
 -->    

 <div class = "row edit">
    <h4>Phone Number: </h4>
     <input type="text" name = "txt_phone" id="txt_phone" class="form-control" value ="<?php echo $check['phone'];?>">
            

 </div>

 <div class = "row edit">
    <h4>Address: </h4>
     <input type="text" name = "txt_address" id="txt_address" class="form-control" value ="<?php echo $check['address'];?>">
           

</div>

<div class="row edit">


    <h4> District: </h4>
  
    <select class = "browser-default custom-select" name="txt_district" id="txt_district">
    <option value ='<?php echo $check['district']?>'><?php echo $check['district']?></option>

    </select> 
  </div>

<!-- <hr style="border-top: 8px solid #bbb;
  border-radius: 5px;">  -->

  


   
    
    <!-- save changes button -->
</fieldset>
<div class = "row">

    <div class ="col">

    <a href = "client_editprofile.php" class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name = "submit" value = "#">Edit </a>
</div>

 
  </div>

  

</div>

</div>



    

</div>
</form>
 </div>
    <!-- Mask & flexbox options-->

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
    
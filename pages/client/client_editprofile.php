<?php
require('../../modules/login_check.php');
require('../../includes/db_connect.php');
require('../../modules/inputsanitizer.php');
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



    $hashpwd=$check['password'];
    $nameE=$opwdE=$npwdE=$addrE=$phoneE=$districtErr=1;
    sanitizeInput();

   
    if(isset($_POST['submit']) || isset($_POST['delete']) ){
        $name=$_POST['txt_name'];
        $opwd=$_POST['txt_opwd'];
        $npwd=$_POST['txt_npwd'];
        $npwdr=$_POST['txt_npwdr'];
        $addr=$_POST['txt_address'];
        $phone=$_POST['txt_phone'];
        $district=$_POST['txt_district'];



        
    }

    

    

    


    if(isset($_POST['submit'])){
        //this is the update, only difference are image uploads links do not get updated
        if(isset($opwd) && password_verify($opwd, $hashpwd)){
            $opwdE=0;
            if($npwd=="" && $npwdr==""){
                $npwd=$opwd;
                $npwdE=0;
            }
        } else  $txt_passErr = "Password is wrong, try again";

        $rexPass='/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/';
        if(isset($npwd) && isset($npwdr) && $npwd==$npwdr && preg_match($rexPass,$npwd)){//must comply to pregmatch and to npwdr
            $npwdE=0;
        }
        if($npwdE==1 && !empty($npwd) && !empty($npwdr)) $txt_npwdErr = "Please enter a strong password";
      
        $rexPhone="/[5][0-9]{7}/";
        if( isset($phone) ){
            if( (strlen($phone)==8) && preg_match_all($rexPhone,$phone) ) 
                $phoneE=0;
            if(strlen($phone)==7)
                $phoneE=0;
           
        }
        if($phoneE==1) $txt_phoneErr="Please enter a correct phone number";

        $rexName="/[A-Z][a-z']+/";
        if( isset($name) && preg_match_all($rexName,$name)==str_word_count($name)){
            $nameE=0;
        }
        if($nameE==1)
            $txt_nameErr = "Names are case sensitive";

        if( isset($addr) && !empty($addr) ){
            $addrE=0;
        }

        if($addrE==1) $txt_addressErr = "An address is required";

        if( isset($district) ){
            $districtErr=0;
        }
        else
            $txt_districtErr="District is required";

        if($nameE==0 && $opwdE==0 && $npwdE==0 && $addrE==0 && $phoneE==0 && $districtErr ==0){
            //do the update
            $sql="update user set name=:name, password=:newhash, address=:addr, phone=:phone, district=:district where id=:id";

            $newhash=password_hash($npwd, PASSWORD_DEFAULT);

            $stmt=$pdo->prepare($sql);

            $stmt->
            execute(['name'=>$name,'newhash'=>$newhash,'addr'=>$addr,'phone'=>$phone,'district'=>$district,'id'=>$id]);

            

            header("location: client_editprofile.php?message=success");

        }
    }

    if(isset($_POST['delete'])){
        if(isset($opwd) && password_verify($opwd, $hashpwd)){
            echo 'auth success';
            $opwdE=0;
        }
        if($opwdE==0){

			$sql="update user set active=:value where id=:id";
			$value=0;
			$stmt=$pdo->prepare($sql);

			$stmt->execute(['value'=>$value, 'id'=>$id]);

            header("location: ../logout.php");
        }
    }
    


?>

<!DOCTYPE html>
<html>
  <head>
    <title>Client edit profile</title>
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

<style>
    #txt_district:focus option:first-of-type {
    display: none;
}
</style>
   
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
    $activeside = 'eprofile';
    include('includes/client_side_navbar.php');
    ?>
    

<div class="col py-3" style = "background-color: white;" > 
        <h1>
        </h1>
        <hr>
        <hr>


 
        <h1>Edit my profile</h1>


<!-- EDIT PROFILE WRAPPER BELOW -->



<form  action="<?php echo $_SERVER["PHP_SELF"];?>" method = "post"  enctype="multipart/form-data" >
<div class = "wrapper" style = "display: flex;">


    <div class = "text-center border border-light p-5 left form" style="width: 60%;">



    <div class="form-col mb-4">
        <div class="row edit">
            <!-- First name -->
            <h4>Name: </h4>
            <input type="text" name = "txt_name" id="txt_name" class="form-control" value ="<?php echo $check['name'];?>">

            <span class="error"><?php echo $txt_nameErr ?></span><br/>
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
            <span class="error"><?php echo $txt_phoneErr ?></span><br/>

 </div>

 <div class = "row edit">
    <h4>Address: </h4>
     <input type="text" name = "txt_address" id="txt_address" class="form-control" value ="<?php echo $check['address'];?>">
            <span class="error"><?php echo $txt_addressErr ?></span><br/>

</div>

<div class="row edit">


    <h4> District: </h4>
    <span class="error"> <?php echo $txt_districtErr ?></span>    
    <select class = "browser-default custom-select" name="txt_district" id="txt_district">
    <option value ='<?php echo $check['district']?>'><?php echo $check['district']?></option>
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

<!-- <hr style="border-top: 8px solid #bbb;
  border-radius: 5px;">  -->

  
<!-- new pass -->
<div class ="row edit">
            

    <h4>Update your password: </h4>
    <span class="error"><?php echo $txt_npwdErr ?></span>

    <input type="password" id="txt_npwd" class="form-control" placeholder="New Password" aria-describedby="defaultRegisterFormPasswordHelpBlock" name = "txt_npwd">

    <input type="password" id="txt_npwdr" class="form-control" placeholder="Confirm New Password" aria-describedby="defaultRegisterFormPasswordHelpBlock" name = "txt_npwdr">
</div>
<small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
         A combination of atleast 1 symbol, digit, lowercase, uppercase and of length 8.
    </small>

  <!-- old Password -->
    <div class="row edit">
    <h4>Please enter your current password to confirm any changes: </h4>
    <input type="password" id="txt_opwd" class="form-control" aria-describedby="defaultRegisterFormPasswordHelpBlock" name = "txt_opwd">
<span class="error"><?php echo $txt_passErr ?></span>
</div>

     



   
    
    <!-- save changes button -->
<div class = "row">

    <div class ="col">

    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name = "submit" value = "update">Update </button>
</div>

  <div class = "col">
    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" style = "color: black !important; background-color: grey !important;" id="delete" name = "delete" value = "delete">Delete </button>
  </div>
  </div>

  

</div>
</div>



    

</div>
</form>
 
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
    
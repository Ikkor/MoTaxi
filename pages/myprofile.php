<?php
session_start();


?>

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

  <!-- top Navbar-->
 <?php 


 $activemenu = "home";
 include('../includes/navbar.php'); ?>

  <!-- Full Page Intro -->

<!-- SIDE NAV -->

<!-- Bootstrap row -->
<div class="row" id="body-row" >
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block col-2">

        <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group sticky-top sticky-offset">
            
            <li style="height:56px;" class = "list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
            </li>
            <!-- /END Separator -->
            <!-- Menu with submenu -->
             <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-calendar fa-fw mr-3"></span>
                    <span class="menu-collapsed">wa</span>
                </div>
            </a>
         
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-calendar fa-fw mr-3"></span>
                    <span class="menu-collapsed">sasa</span>
                </div>
            </a>
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-tasks fa-fw mr-3"></span>
                    <span class="menu-collapsed">Tasks</span>
                </div>
            </a>
            
            <!-- /END Separator -->
            <a href="#" class="bg-dark list-group-item list-group-item-action active">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-calendar fa-fw mr-3"></span>
                    <span class="menu-collapsed">Driver panel</span>
                </div>
            </a>
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-envelope-o fa-fw mr-3"></span>
                    <span class="menu-collapsed">Messages <span class="badge badge-pill badge-primary ml-2">5</span></span>
                </div>
            </a>
            <!-- Separator without title -->
            <li class="list-group-item sidebar-separator menu-collapsed"></li>
            <!-- /END Separator -->
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-question fa-fw mr-3"></span>
                    <span class="menu-collapsed">Help</span>
                </div>
            </a>
            <a href="#" data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span id="collapse-icon" class="fa fa-2x mr-3"></span>
                    <span id="collapse-text" class="menu-collapsed">kaver</span>
                </div>
            </a>
            <!-- Logo -->
            <li class="list-group-item logo-separator d-flex justify-content-center">
                
            </li>
        </ul>
        <!-- List Group END-->
    </div>


<div class="col py-3" style = "background-color: white;" > 
        <h1>
        </h1>
        <hr>
        <hr>


 
        <h1>Edit my profile</h1>


<!-- EDIT PROFILE WRAPPER BELOW -->




<div class = "wrapper" style = "display: flex;">

    <div class = "left form" style="width: 50%;">

<form class="text-center border border-light p-5" action="<?php echo $_SERVER["PHP_SELF"];?>" method = "post">

    <div class="form-row mb-4">
        <div class="row edit">
            <!-- First name -->
            <h4>Name: </h4>
            <input type="text" name = "txt_fname" id="defaultRegisterFormFirstName" class="form-control" placeholder="First name" value = "kolombo">

            <span class="error">echo the errors</span><br/>
        </div>
       
    
    <!-- DOB -->
    <div class="row edit">
    <h4>Date of Birth: </h4>
    
    <input type="date" id="defaultRegisterFormDate" name = "txt_email" class="form-control" placeholder="E-mail" value = "">
    
    
    </div>
    
    <!-- E-mail -->
    <div class="row edit">
    <h4>Email: </h4>
    
    <input type="email" id="defaultRegisterFormEmail" name = "txt_email" class="form-control" placeholder="E-mail" value = "email.com">
    <span class="error">ok</span>
    
    </div>
    
<hr style="border-top: 8px solid #bbb;
  border-radius: 5px;"> 

    <!-- Password -->
    <div class="row edit">
    <h4>Enter new password: </h4>
    <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="New Password" aria-describedby="defaultRegisterFormPasswordHelpBlock" name = "txt_password">

    <input type="password" id="defaultRegisterFormPassword" class="form-control" placeholder="Confirm New Password" aria-describedby="defaultRegisterFormPasswordHelpBlock" name = "txt_cpassword">

     <small id="defaultRegisterFormPasswordHelpBlock" class="form-text text-muted mb-4">
        At least 8 characters and 1 digit
    </small>
</div>

</div>

   
    
    <!-- save changes button -->
    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Save changes </button>
    

   
  
</form>
</div>

<div class = "right form">

<div class="text-center border border-light p-5">

    <div class="form-row mb-4">


    <div class="row edit" style = "margin-bottom: 70px;">
        <h4 style>Profile picture </h4>
    </div>

        <div class="row edit" style = "margin-top: 70px;">
            <img src="https://www.getdigital.eu/web/getdigital/gfx/products/__generated__resized/1100x1100/12943doge_mask_single.jpg" alt="Girl in a jacket" width="300" height="300">
    </div>
        <div class="row edit">
            <p> Upload new profile picture: </p>
            <input type="file" accept="image/*" name = "txt_image" id="defaultRegisterFormFile" class="form-control">

            <span class="error">some errors here></span><br/>
        </div>
           
        </div>

</div>
    </div>

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

	<script type ="text/javascript" src="../javascript/main.js"></script>

    </body>
</html>
    
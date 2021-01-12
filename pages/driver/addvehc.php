<?php

require ('../../modules/login_check.php');
require ('../../includes/db_connect.php');

?>

<!DOCTYPE html>
<html>
  <head>
    <title>addvehc</title>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.2.2/web-animations.min.js"></script>


   
	</head>

<body>
<!-- Main navigation -->

  <!-- top Navbar-->
 <?php 


 $activemenu = "profile";
 include('includes/driver_navbar.php'); ?>




<!-- SIDE NAV -->
<div class="row" id="body-row" >
    <?php 
    $activeside = 'vehicles';
    include('includes/driver_side_navbar.php');
    ?>


<div class="col py-3" style = "background-color: white;" > 
        <h1>
        </h1>
        <hr>
        <hr>


 
        <h1>Add a new vehicle</h1>
       
        <a href = "driver_vehicles.php"><< Back</a>

        <hr>
        <?php if (isset($_GET['error']) && $_GET['error']=='badinput'){
      echo '<span class="error">An error occured, please try again.</span>';
    } ?>


         <div class = "wrapper" style = "display: flex;">
<div class = "left form" style="width: 70%;">
<form class="text-center border border-light p-5" action="insertvehc.php" method="post" enctype="multipart/form-data">

    <div class="form-col mb-4">

      <div class="row edit">
            <h5>Vehicle registration plate</h5>
            <input required="required"  type="text" name = "txt_regno" id="txt_regno" class="form-control" placeholder="e.g ABC123">
      </div>        

   

  <div class="row edit">
        <h5 style = "padding-right:30px;">Service Type:   </h5>
        <div class="form-check form-check-inline">
          
          
          
          <input class="form-check-input" type="radio" name="txt_stype" id="txt_stype" value="simple" checked>
          <label class="form-check-label" for="txt_stype">
            Simple
          </label>
        </div>
        
        <div class="form-check form-check-inline">

          <input class="form-check-input" type="radio" name="txt_stype" id="txt_stype" value="package" checked>
          <label class="form-check-label" for="txt_stype">
            Package
          </label>
        </div>
        
      </div>





      <div class="row edit">
              <h5>Number of seats </h5>
                <input required="required"type="number" name = "txt_#seat" id="txt_#seat" class="form-control" Min=1 Max=30 placeholder="e.g 4">

        </div>

        <div class="row edit">
          <h5>Model</h5>
            <input required="required"  type="text" name = "txt_model" id="txt_model" class="form-control" placeholder="e.g Honda Accord">
        </div>


        <div class="row edit">
          <h5>Year</h5>
            <input type="number" input required="required" type="number" Min = 2000 Max = '<?php echo date("Y"); ?>' name = "txt_year" id="txt_year" class="form-control" placeholder="e.g 2009">
        </div>


      <div class="row edit">
        <h5 style = "padding-right:30px;">Air conditioning:   </h5>
        <div class="form-check form-check-inline">
          
          
          
          <input class="form-check-input" type="radio" name="txt_ac" id="txt_ac" value="no" checked>
          <label class="form-check-label" for="txt_ac">
            No
          </label>
        </div>
        
        <div class="form-check form-check-inline">

          <input class="form-check-input" type="radio" name="txt_ac" id="txt_ac" value="yes" checked>
          <label class="form-check-label" for="txt_ac">
            Yes
          </label>
        </div>
        
      </div>


      <div class="row edit">
        <h5>Boot Capacity(Litres)</h5>
        <input Min=100 required="required" type="text" name = "txt_bootcap" id="txt_bootcap" class="form-control" >
      </div>


      <div class="form group">
        <h4 style>Upload a picture of your vehicle: </h4>
    </div>

        <div class="form group">
            <img id = "output" src="http://www.wihcon.com/wp-content/plugins/Builder_UX-development/admin/assets/img/noImageSelected.jpg" alt="image of car" width="300" height="300">
    </div>
        <div class="form group">
            <p> Please ensure the image is properly lit. </p>
            <input required="required" type="file" accept=".png, .jpeg, .jpg" name = "vehcimg" id="vehcimg" class="form-control" onchange="loadFile(event)" >


            <script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>

            
        </div>



          <!-- submit button -->
    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" name = "submit" value = "Create" style = "width:320px;" type="submit">Submit </button>
  </div>
      
        


<!--             <span class="error">echo the errors</span><br/>
 -->        
      

   

  
</form>
</div>









</div>
    </div>









</div>



 
    <!-- Mask & flexbox options-->

</div>
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
    
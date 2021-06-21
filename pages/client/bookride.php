<?php 
    require('../../modules/login_check.php');
    require 'includes/utypecheck.php';
 ?>

<!-- T H I S   P A G E   I S    A   P R T O  Y P E   -->
<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Request ride</title>
         <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
		
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
        
        <link href = '../../css/style.css' rel = 'stylesheet' type = 'text/css'> 
        <link href = '../../css/bookride.css' rel = 'stylesheet' type = 'text/css'> 

        <link rel="stylesheet" href="../../javascript/timepicker/timepicker.css" />

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        

        <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.2.2/web-animations.min.js"></script>
       <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!-- Bootstrap tooltips -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
      <!-- Bootstrap core JavaScript -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
      <!-- MDB core JavaScript -->
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>


       
    </head>
    <script src="../../javascript/timepicker/timepicker.js"></script>
    <body oncontextmenu='return false' class='snippet-body'>
    <script>
        $(function() {
  $(document).ready(function () {
    
   var todaysDate = new Date(); // Gets today's date
    
    // Max date attribute is in "YYYY-MM-DD".  Need to format today's date accordingly
    
    var year = todaysDate.getFullYear();                        // YYYY
    var month = ("0" + (todaysDate.getMonth() + 1)).slice(-2);  // MM
    var day = ("0" + (todaysDate.getDate()+1)).slice(-2);           // DD

    var minDate = (year +"-"+ month +"-"+ day); // Results in "YYYY-MM-DD" for today's date 
    
    // Now to set the max date value for the calendar to be today's date
    $('.pickdate').attr('min',minDate);
 
  });
});
</script>


 <?php 
    // if(!isset($_SESSION['username']))
    //     {
    //      header("Location: index.php?referer=badlogin");
    //     }

	$activemenu = 'bookride';
	include('includes/client_navbar.php');
	?>
	



                            <!-- MultiStep Form -->
<div class="view1" style="background-image: url('../../images/bluemap.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    

<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div style = "top: 23px !important;"class="card ride px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Book a Ride</strong></h2>
                <p>Fill in the required details</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="when"><strong>When</strong></li>
                                <li id="where"><strong>Where</strong></li>
                                <li id="who"><strong>Who</strong></li>
                                <li id="confirm"><strong>Finish</strong></li>
                            </ul> <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">When do you need this ride?</h2>   
                                    <h3>Date</h3>                    
                                        <input type="date" class ="pickdate"name="pickdate">
                                  <h3>Time</h3>
                                   <input class = "form-control picktime" type = "text"/> 
                                     <script type="text/javascript">
                                      $( document ).ready(function(){
                                        $(".picktime").timepicker();
                                        });
                                    </script>
                                     

                                     <h2 class = "fs-title">Type of service? </h2> 
                                     <select required = "required" class = "browser-default custom-select" name="txt_package" id="txt_package">
                                        <option value='package'>Package</option>
                                        <option value='ride'>Ride</option>
                                    </select>



                                </div> <input type="button" name="next" class="next action-button" value="Next Step" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Where do you need to go?</h2> <






                                </div> <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="next" class="next action-button" value="Next Step" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Payment Information</h2>
                                    <div class="radio-group">
                                        <div class='radio' data-value="credit"><img src="https://i.imgur.com/XzOzVHZ.jpg" width="200px" height="100px"></div>
                                        <div class='radio' data-value="paypal"><img src="https://i.imgur.com/jXjwZlj.jpg" width="200px" height="100px"></div> <br>
                                    </div> <label class="pay">Card Holder Name*</label> <input type="text" name="holdername" placeholder="" />
                                    <div class="row">
                                        <div class="col-9"> <label class="pay">Card Number*</label> <input type="text" name="cardno" placeholder="" /> </div>
                                        <div class="col-3"> <label class="pay">CVC*</label> <input type="password" name="cvcpwd" placeholder="***" /> </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3"> <label class="pay">Expiry Date*</label> </div>
                                        
                                    </div>
                                </div> <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="make_payment" class="next action-button" value="Confirm" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title text-center">Success !</h2> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3"> <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image"> </div>
                                    </div> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5>You Have Successfully Signed Up</h5>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



 <script type = 'text/javascript' src ='../../javascript/rideform.js'></script>

 <script type = 'text/javascript' src='../../javascript/main.js'></script>
 

                            </body>
                        </html>
<?php require('../../modules/login_check.php'); ?>

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
    <body oncontextmenu='return false' class='snippet-body'>


 <?php 
    // if(!isset($_SESSION['username']))
    //     {
    //      header("Location: index.php?referer=badlogin");
    //     }

	$activemenu = 'bookride';
	include('includes/client_navbar.php');
	?>
	

                            <!-- MultiStep Form -->
<div class="view1" style="background-image: url('../images/bluemap.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
    

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
                                <li class="active" id="account"><strong>Account</strong></li>
                                <li id="personal"><strong>Personal</strong></li>
                                <li id="payment"><strong>Payment</strong></li>
                                <li id="confirm"><strong>Finish</strong></li>
                            </ul> <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Account Information</h2> <input type="email" name="email" placeholder="Email Id" /> <input type="text" name="uname" placeholder="UserName" /> <input type="password" name="pwd" placeholder="Password" /> <input type="password" name="cpwd" placeholder="Confirm Password" />
                                </div> <input type="button" name="next" class="next action-button" value="Next Step" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Personal Information</h2> <input type="text" name="fname" placeholder="First Name" /> <input type="text" name="lname" placeholder="Last Name" /> <input type="text" name="phno" placeholder="Contact No." /> <input type="text" name="phno_2" placeholder="Alternate Contact No." />
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
                                        <div class="col-9"> <select class="list-dt" id="month" name="expmonth">
                                                <option selected>Month</option>
                                                <option>January</option>
                                                <option>February</option>
                                                <option>March</option>
                                                <option>April</option>
                                                <option>May</option>
                                                <option>June</option>
                                                <option>July</option>
                                                <option>August</option>
                                                <option>September</option>
                                                <option>October</option>
                                                <option>November</option>
                                                <option>December</option>
                                            </select> <select class="list-dt" id="year" name="expyear">
                                                <option selected>Year</option>
                                            </select> </div>
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
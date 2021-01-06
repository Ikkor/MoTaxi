
<nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
    <div class="container">
      <a class= "navbar-brand"  href="index.php">
      	<i class="fas fa-taxi"></i>
        <strong class = "mo">Mo</strong>
        <strong class = "taxi">Taxi</strong>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent-7">


        <?php 

            if(isset($_SESSION['utype']) && $_SESSION['utype']=='driver'){

            ?>

            <ul class="navbar-nav mr-auto">
          <li 

            <?php
          if ($activemenu=="home")  
            echo "class=\"nav-item active\"";
          else 
            echo "class = \"nav-item\"";
               
               ?>>
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li 
          <?php 
          if ($activemenu=="riderequest")  
        echo "class=\"nav-item active\"";
      else 
        echo "class = \"nav-item\"";
               ?>>
            <a class="nav-link" href="driver/riderequests.php">Ride Requests</a>
          </li>
          <li 
          <?php 
          if ($activemenu=="aboutus")  
          echo "class=\"nav-item active\"";
         else 
          echo "class = \"nav-item\"";
               ?>>
            <a class="nav-link" href="#">About us</a>
          </li>

          
          

          
          <!-- here display my profile li -->
          <li
          <?php 
          if ($activemenu=="profile")  
            echo "class=\"nav-item active\"";
          else 
            echo "class = \"nav-item\"";  
                ?>>

                <!-- display my profile since driver must be logged in to view this  -->
            <a class="nav-link" href="driver/driver_vehicles.php" ><?php 
                  echo "My Profile"; ?>
                </a>
           </li>

         
        </ul>
<?php } else { ?>

        <!-- user and guest below -->

        <ul class="navbar-nav mr-auto">
          <li 

            <?php
	      	if ($activemenu=="home")  
	          echo "class=\"nav-item active\"";
	      	else 
	      		echo "class = \"nav-item\"";
               
               ?>>
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li 
          <?php 
          if ($activemenu=="bookride")  
        echo "class=\"nav-item active\"";
      else 
        echo "class = \"nav-item\"";
               ?>>
            <a class="nav-link" href="client/bookride.php">Book a ride</a>
          </li>
          <li 
          <?php 
         	if ($activemenu=="aboutus")  
				  echo "class=\"nav-item active\"";
			   else 
				  echo "class = \"nav-item\"";
               ?>>
            <a class="nav-link" href="#">About us</a>
          </li>

          
          <!-- check if user is logged in -->

          <?php if(isset($_SESSION['utype']) && $_SESSION['utype']=='client') {

          ?>
          <!-- here display my profile li -->
          <li
          <?php 
          if ($activemenu=="profile")  
            echo "class=\"nav-item active\"";
          else 
            echo "class = \"nav-item\"";  
                ?>>

                <!-- Display sign up if user not logged in! -->
            <a class="nav-link" href="client/client_rides.php" ><?php 
                  echo "My Profile"; ?>
                </a>
           </li>

          <!-- else.. -->

        <?php } else { ?>

          <li 
          <?php 
         	if ($activemenu=="signup")  
         		echo "class=\"nav-item active\"";
         	else 
         		echo "class = \"nav-item\"";  
         		    ?>>

                <!-- Display sign up if user not logged in! -->
            <a class="nav-link" href="#" data-toggle=modal data-target = "#centralModalSm"><?php 
                  echo "Sign up";
                
              ?>
        
            </a>
          </li>
          <?php } ?>
          
        </ul>
      <?php }?>



       
      </div>
    </div>
  </nav>

<!-- For register as a ... popup -->

  <?php 
  if(!isset($_SESSION['id'])){
  include("../modules/registerpopup.php");
  }
   ?>

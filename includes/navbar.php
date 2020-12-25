

<nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.php">
      	<i class="fas fa-taxi"></i>
        <strong class = "mo">Mo</strong>
        <strong class = "taxi">Taxi</strong>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7" aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
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
            <a class="nav-link" href="bookride.php">Book a ride</a>
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
          <li 
          <?php 
         	if ($activemenu=="signup")  
         		echo "class=\"nav-item active\"";
         	else 
         		echo "class = \"nav-item\"";  
         		    ?>>
            <a class="nav-link" href="#" data-toggle=modal data-target = "#centralModalSm">Sign up</a>
          </li>
        </ul>
       
      </div>
    </div>
  </nav>
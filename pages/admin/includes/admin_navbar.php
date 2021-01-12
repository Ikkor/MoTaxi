<nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
    <div class="container">
      <a class= "navbar-brand"  href="manage_drivers.php">
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
          if ($activemenu=="manage")  
        echo "class=\"nav-item active\"";
      else 
        echo "class = \"nav-item\"";
               ?>>
            <a class="nav-link" href="manage_drivers.php">Manage</a>
          </li>
          <li 
          <?php 
            if ($activemenu=="rates")  
                  echo "class=\"nav-item active\"";
               else 
                  echo "class = \"nav-item\"";
               ?>>
            <a class="nav-link" href="manage_rates.php">Rates</a>
          </li>


          <?php if(isset($_SESSION['id'])){ ?>
          <li class = "nav-item">
            <a class="nav-link" href="logout.php">Logout </a>
          </li> 
        <?php } else { ?>

          <li 
          <?php 
          if ($activemenu=="login")  
        echo "class=\"nav-item active\"";
      else 
        echo "class = \"nav-item\"";
               ?>>
            <a class="nav-link" href="admin_login.php">Login</a>
          </li>
        <?php } ?>


         
       

          <!-- else.. -->

          </li>
        </ul>
       
      </div>
    </div>
  </nav>




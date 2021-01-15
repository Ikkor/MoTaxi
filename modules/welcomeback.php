
<style>
	.hr{
		margin: 10px 0 !important;
	}
	.a:hover{
		color: grey !important;
	}
</style>

<div class = "card border border-warning shadow-0 mb-3" style="display: flex; ">
  <div class="card-header" style = "font-size: 20px; text-align: center;"><strong><?php echo "Welcome back, ".$_SESSION['name']. "!"; ?></strong></div>
<div class="card-body">


  <h5 class="card-title" >
    <strong style = "font-size: 50px; color: orange;" class = "card-text"> What's next? </strong>

    <ul style = " color: orange;">
      <?php if($_SESSION['utype']=='driver'){ ?>

    	<hr>
      <li><a href = '../pages/driver/driver_viewprofile.php'> View/Edit my profile </a></li>
      <hr>
      <li><a href = '../pages/driver/driver_vehicles.php'> View my vehicles </a></li>
      <hr>
      <li><a href = '../pages/driver/addvehc.php'> Add a new vehicle </a></li>
      <hr>
      <li><a href = '../pages/logout.php'> Logout </a></li>
    <?php } else { ?>

      <hr>
      <li><a href = '../pages/client/client_viewprofile.php'> View/Edit my profile </a></li>
      <hr>
      <li><a href = '../pages/client/bookride.php'> Book a ride </a></li>
      <hr>
      <li><a href = '../pages/client/client_rides.php'> View my previous rides</a></li>
      <hr>
      <li><a href = '../pages/logout.php'> Logout </a></li>
  <?php } ?>




  </h5>


</div>
</div>


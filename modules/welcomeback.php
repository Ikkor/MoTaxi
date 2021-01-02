
<style>
	.hr{
		margin: 10px 0 !important;
	}
	.a:hover{
		color: grey !important;
	}
</style>

<div class = "card border border-warning shadow-0 mb-3" style="display: flex; ">
  <div class="card-header" style = "font-size: 20px; text-align: center;"><strong><?php echo "Welcome back, ".$_SESSION['username']. "!"; ?></strong></div>
<div class="card-body">


  <h5 class="card-title" >
    <strong style = "font-size: 50px; color: orange;" class = "card-text"> What's next? </strong>

    <ul style = " color: orange;">
    	<hr>
      <li><a href = '../pages/myprofile.php'> View/Edit my profile </a></li>
      <hr>
      <li><a href = '../pages/logout.php'> Logout </a></li>

  </h5>


</div>
</div>


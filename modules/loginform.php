<?php
//flush();
// Start the session
//The session_start() function must be the very first thing in your document. Before any HTML tags.
//session_start();

// define variables and set to empty string values

$EmailErr = $passwordErr = "";
$email = $password = $Msg =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["txt_email"])) {
    $EmailErr = "Email is required";
  } else {
    $email = $_POST["txt_email"];
  }//end else
  if (empty($_POST["txt_password"])) {
    $passwordErr = "Password is required";
  } else {
    $password= $_POST["txt_password"];
   
  }//end else
  
  if($EmailErr == "" && $passwordErr == "" )
  {
    require_once "../includes/db_connect.php";
    $sQuery = "SELECT * FROM registered_user WHERE email = '$email'  ";
    
    #echo $sQuery;
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $Result = $conn->query($sQuery) ;
    $userResults = $Result->fetch(PDO::FETCH_ASSOC);

   
    if($userResults['email'])//the user exists
    { 

      $hashed_password = $userResults['password'];
      echo $hashed_password;

      if(password_verify($password,$hashed_password))
      {
        $username = $userResults['username'];
        $_SESSION['username'] = $username;
       // echo $_SESSION['username'];
        header("Location: index.php?referer=login");
      }
      else
      {
        $Msg = "Incorrect password";
          //echo $Msg;
      }
      
    }else{
       $Msg = "Incorrect email";
      // echo $Msg;
      
    }
  }//end if
  
 }//end else 
  

?>


<div class="card">


  <h5 class="card-header text-center" >
    <strong>Sign in</strong>
  </h5>

  <!--Card content-->
  <div class="card-body px-lg-5 pt-0">

    <!-- Form -->
    <form method = "POST" class="text-center" style="color: black;" action="<?php echo $_SERVER["PHP_SELF"];?>">

      <!-- Email -->
      <div class="md-form">
        <input name = "txt_email" type="email" id="materialLoginFormEmail" class="form-control">
        <label for="materialLoginFormEmail">E-mail</label>
        <span class="error"><?php echo $Msg;?></span><br/>
      </div>

      <!-- Password -->
      <div class="md-form">
        <input name = "txt_password" type="password" id="materialLoginFormPassword" class="form-control">
        <label for="materialLoginFormPassword">Password</label>
      </div>

      <div class="d-flex justify-content-around">
        <div>
          <!-- Remember me -->
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
            <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
          </div>
        </div>
        <div>
          <!-- Forgot password -->
          <a href="">Forgot password?</a>
        </div>
      </div>

      <!-- Sign in button -->
      <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>

      <!-- Register -->
      <p>Not a member?
        <a href="#" data-toggle=modal data-target="#centralModalSm">Register</a>
      </p>

      <!-- Social login -->
      <!-- <p>or sign in with:</p>
      <a type="button" class="btn-floating btn-fb btn-sm">
        <i class="fab fa-facebook-f"></i>
      </a> -->

    </form>
    <!-- Form -->

  </div>

</div>
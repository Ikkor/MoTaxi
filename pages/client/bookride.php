<?php 
    require('../../modules/login_check.php');
    require ('../../includes/db_connect.php');
    require 'includes/utypecheck.php';
    require '../../modules/fetch_latest_rate.php';
    
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

      


          <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script type="text/javascript" src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>



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
    <body oncontextmenu='return false' class='snippet-body'>


<style>
    .table-wrapper
{
    
    width: 100%;
    height: 300px;
    overflow: auto;
}

table
{
    border: 1px solid black;
    
}

td
{
   
    background-color: #ccc;
}


.hidden{
    display:none;
}

#map {

  width: 500px;
  height: 300px;
  background-color: gray;
}

#routingInputContainer {
  width: 300px;
  height: 210px;
  position: relative;
  
  
  color: black;
}

.routingInput {
  width: 95%;
}

</style>






    <script>
        
  $(document).ready(function () {

var lon;
var lat;

    $.ajax({
          url: "https://geolocation-db.com/jsonp",
          jsonpCallback: "callback",
          dataType: "jsonp",
          success: function(location) {
            lon=location.longitude;
            lat=location.latitude;
            $('#loc').html('lon: '+location.latitude+' lat: '+location.longitude);

          }
        })




    var when; //when does client need ride;


$('#driver_id').change(function(){
            selected_value = $("input[name='driver_id']:checked").val();
            alert("AAA");
        });
//if user selects now..
$('select').change(function() {
  if ($(this).val() == 'now') {
    when = 'now';
  


    function timestampToDatetimeInputString(timestamp) {
    const date = new Date((timestamp + _getTimeZoneOffsetInMs()));
    // slice(0, 19) includes seconds
    return date.toISOString().slice(0, 19);
  }
  
  function _getTimeZoneOffsetInMs() {
    return new Date().getTimezoneOffset() * -60 * 1000;
  }

  document.getElementById('picktime').value = timestampToDatetimeInputString(Date.now());

   
    $( "#picktime" ).prop( "readonly", true );




  } else {
    when='NULL';
    $( "#picktime" ).prop( "readonly", false );





  }
}).trigger("change");



//when client clicks next (after 1st slide)
$( ".next.action-button.2" ).click(function() {




    $('#drivers').empty();
        if(when=='now'){
        get_nearest_drivers();
        }

        else {
        get_drivers();
        $("#target").val($("#target option:first").val());

        }

});


function get_driver_vehicle(A){
$('#vehicles').empty();

var service = document.getElementById('txt_service').selectedOptions[0].value;

var driverid = A;

     $.ajax({
            url:"../../modules/get_driver_vehicle.php",
            method:"POST",
            data:{
                driverid:driverid,
                service:service
            },
            success:function(data){
              $('#vehicles').html(data);

            }
          })

}



function get_nearest_drivers(){
 
      $.ajax({
            url:"../../modules/get_nearest_driver.php",
            method:"POST",
            data:{
                lon:lon,
                lat:lat
            },
            success:function(data){
              $('#drivers').html(data);

        get_driver_vehicle($('#driver_id').val());
            }
          })


      get_driver_vehicle();
}

function get_drivers(){ 
   
    $.ajax({
            url:"../../modules/get_drivers.php",
            method:"POST",
            success:function(data){
              $('#drivers').html(data);

                get_driver_vehicle($('input[name="driver_id"]:checked').val());
            

                $('input[type=radio][name="driver_id"]').change(function() {
        get_driver_vehicle($(this).val()); // or, use `this.value`
    });

            }
          })

        }




        
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
                        <form id="msform" target="print_popup"  class="text-center border border-light p-5" action="http://127.0.0.1:8000/rides/create" method = "GET" onsubmit="window.open('about:blank','print_popup','width=1000,height=800')";>
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="where"><strong>When</strong></li>
                                <li id="when"><strong>Where</strong></li>
                                <li id="who"><strong>Who</strong></li>
                                <li id="confirm"><strong>Finish</strong></li>
                            </ul> <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Where do you need to go?</h2>


                                       <div id="map"></div>
                                        <div id="routingInputContainer">
                                          Starting point:
                                            
                                          <input required id="inputStart" name="from_loc" class="routingInput" readonly = "readonly"/>
                                          Destination point:
                                          <input required id="inputDest" name="to_loc" class="routingInput" readonly = "readonly"/>
                                          <br/><br/>
                                          <span id="info"></span>
                                     </div>

                                    <!-- hidden fields here -->
                                     <input class = "hidden" id = "distance" name = "txt_distance" type="number">

                                     <input class = "hidden" name = "txt_name" type="text" value=<?php echo $_SESSION['name'];?>>

                                     <input class = "hidden" name = "txt_id" type="text" value=<?php echo $_SESSION['id'];?>>

                                     <input class = "hidden" name = "txt_rate" type="number" value=<?php echo $rate ?>>



                                
                                <!-- end hidden fields -->
                                   
                                </div>


                                <input type="button" name="next" class="next action-button 1" value="Next Step" />
                            </fieldset>


                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">When do you need this ride?</h2> 

                                  <select id = "when" required = "required" class = "browser-default custom-select" name="txt_when" id="txt_when">
                                    <option value='later'>Later</option>
                                        <option value='now'>Now</option>
                                        
                                    </select>
                                    
                               
                                  
                                    <br><br>
                                    <h3>Date & Time </h3>
                                   <input id="picktime" required="required" name = "time_in" class = "form-control picktime" type = "datetime-local"/> 
                                     

                                    

                                     <h2 class = "fs-title">Type of service? </h2> 
                                     <select required = "required" class = "browser-default custom-select" name="service" id="txt_service">
                                        <option value='package'>Package</option>
                                        <option value='ride'>Ride</option>
                                    </select>
                                    <!-- <p id="loc"></p> -->
                                    



                                </div> <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="next" class="next action-button 2" value="Next Step" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Your driver</h2>
                                  
                                  
                                    <div id="drivers" class="table-wrapper"> </div>

                                     <div id ="vehicles" class ="table-wrapper"></div>
                               
                        

                                </div> <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="submit" class="next action-button" value="submit" />
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title text-center">Success !</h2> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3"> <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image"> </div>
                                    </div> <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5>Perfect! You are just one step away..</h5>

                                             <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" value = "submit" name = "submit">Confirm my details</button>
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
<script type="text/javascript" src="routing.js"></script>
 <script type = 'text/javascript' src='../../javascript/main.js'></script>

 

                            </body>
                        </html>
<?php

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Admin checks chat</title>
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

    <link rel="stylesheet" type="text/css" href="css/style.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.2.2/web-animations.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</style>
   
	</head>

<body>
<script>
	 $(document).ready(function () {





function fill_table(A){
	$("#json_chat tbody").empty();
	var from=A;

     $.ajax({
        url: 'json_chatlog.php',
        data:{
        	from:from
        },
        type: 'get',
        dataType: 'JSON',
        success: function(response){
        	var len = response.length;
            for(var i=0; i<len; i++){
                var id = response[i].chat_message_id;
                var to = response[i].to_user_id;
                var from = response[i].from_user_id;
                var message = response[i].chat_message;
                var time = response[i].timestamp;
                var status = response[i].status;


                var tr_str = "<tr>" +
                    
                    "<td align='center'>" + id + "</td>" +
                    "<td align='center'>" + to + "</td>" +
                    "<td align='center'>" + from + "</td>" +
                    "<td align='center'>" + message + "</td>" +
                    "<td align='center'>" + time + "</td>" +
                    "<td align='center'>" + status + "</td>" +
                    "</tr>";

                $("#json_chat tbody").append(tr_str);
            }
        }

    })
}


   function fill_select(){
     $.ajax({
        url: 'json_chatlog.php',
        type: 'get',
        dataType: 'JSON',
        success: function(response){
        	var arr=[''];
					var j=0;
					for (var i = 0; i < response.length; i++) {
					  if($.inArray(response[i].from_user_id,arr)<0){
					      arr[j]=response[i].from_user_id;
					      j++;
					  }
					}

			len = arr.length;
            for(var i=0; i<len; i++){

                var from = arr[i];
  
                var tr_str = 
                    
                    "<option value="+from+">"+from+"</option>";
                    
                
                    
                $("#from_msg").append(tr_str);
            }

        }

    })

}

fill_select();
fill_table();

$('#from_msg').on('change',function(){
	fill_table(this.value);
   // code
});

});
    </script>
<!-- Main navigation -->

  <!-- top Navbar-->
 <?php 


 $activemenu = "manage";
 include('includes/admin_navbar.php'); ?>




<!-- SIDE NAV -->
<div class="row" id="body-row" >
    <?php 
    $activeside = 'drivers';
    include('includes/admin_side_navbar.php');
    ?>


<div class="col py-3" style = "background-color: white;" > 
        <h1>
        </h1>
        <hr>
        <hr>


 <div class = "row">
        <h1>View Chatlog</h1>

<select name="from_msg" id="from_msg">
<option value="">All</option>

</select>



</div><!-- chat wrapper-->




<div class = "wrapper" style = "display: flex;">

<table id="json_chat" class="table">
  <thead>
    <tr>
      <th scope="col">msg_id</th>
      <th scope="col">to_user</th>
      <th scope="col">from_user</th>
      <th scope="col">message</th>
      <th scope="col">timestamp</th>
      <th scope="col">status</th>

    </tr>
  </thead>
  <tbody></tbody></table>

 


</div></div></div>

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
    
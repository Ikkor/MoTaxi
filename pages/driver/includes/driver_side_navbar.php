<!-- Sidebar -->
<?php

require('../../includes/db_connect.php');
$_SESSION['user_id'] = $_SESSION['id'];

?>
<script>
    //code below will update the msg fav-icon 
        $(document).ready(function(){
            count_unread_message();
            count_new_rides();

            setInterval(function(){
                count_unread_message(); count_new_rides();
            }, 5000);
            

            /* function get_new_rides(){
                 $.ajax({
                        url: "../../modules/driver_get_rides.php"


            })
             }
             */
            function count_unread_message(){
                $.ajax({
                    url: "../../modules/chat_modules/count_unseen_message.php",
                    method: "POST",
                    success:function(data){
                        $('#msgcnt').html(data);
                        // alert(data);
                    }
                })
            }


             function count_new_rides(){
                $.ajax({
                    url: "../../modules/count_new_rides.php",
                    method: "POST",
                    success:function(data){
                        $('#ridescnt').html(data);
                        // alert(data);
                    }
                })
            }
        });







    </script>

    <style>

        #ridescnt {
            background-color: red !important;
        }

    </style>


    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block col-2">

        <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group sticky-top sticky-offset">
            
            <li style="height:56px;" class = "list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
            </li>
            <!-- /END Separator -->
                  <!-- Menu with submenu -->
              <a data-toggle="collapse" aria-expanded = "false" href="#submenu1" <?php if($activeside=='vprofile' || $activeside=="eprofile"){ echo 'class="bg-dark list-group-item list-group-item-action active"';} else { echo'class="bg-dark list-group-item list-group-item-action"';}?>>
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-user fa-fw mr-3"></span>
                    <span class="menu-collapsed">My Profile</span>
                </div>
            </a>


        <!-- Submenu content -->
            <div id="submenu1" class="collapse sidebar-submenu">
                <a href="driver_viewprofile.php" <?php if($activeside=='vprofile'){ echo 'class="bg-dark list-group-item list-group-item-action bg-dark sub text-white active"';} else { echo'class="bg-dark list-group-item list-group-item-action bg-dark sub text-white"';}?>>
                    <span class="menu-collapsed">View Profile</span>
                </a>
                <a href="driver_editprofile.php" <?php if($activeside=='eprofile'){ echo 'class="bg-dark list-group-item list-group-item-action bg-dark sub text-white active"';} else { echo'class="bg-dark list-group-item list-group-item-action bg-dark sub text-white"';}?>>
                    <span class="menu-collapsed">Edit Profile</span>
                </a>
               
            </div>
         




         
            <a href="driver_vehicles.php" <?php if($activeside=='vehicles'){ echo 'class="bg-dark list-group-item list-group-item-action active"';} else { echo'class="bg-dark list-group-item list-group-item-action"';}?>>
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-car-side fa-fw mr-3"></span>
                    <span class="menu-collapsed">My Vehicles</span>
                </div>
            </a>


            <a href="driver_rides.php" <?php if($activeside=='rides'){ echo 'class="bg-dark list-group-item list-group-item-action active"';} else { echo'class="bg-dark list-group-item list-group-item-action"';}?>>
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-tasks fa-fw mr-3"></span>
                    <span class="menu-collapsed">Ride history</span>
                </div>
            </a>
           
            
            <!-- /END Separator -->
            <a href="ride_requests.php"<?php if($activeside=='requests'){ echo 'class="bg-dark list-group-item list-group-item-action active"';} else { echo'class="bg-dark list-group-item list-group-item-action"';}?>>
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-exclamation fa-fw mr-3"></span>
                    <span class="menu-collapsed">Ride Requests<span  id = "ridescnt" class="badge badge-pill badge-primary ml-2">0</span></span>

                </div>
            </a>



           <a href="driver_inbox.php" <?php if($activeside=='inbox'){ echo 'class="bg-dark list-group-item list-group-item-action active"';} else { echo'class="bg-dark list-group-item list-group-item-action"';}?>>
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-envelope fa-fw mr-3"></span>
                    <span class="menu-collapsed">Messages 
                    <span  id = "msgcnt" class="badge badge-pill badge-primary ml-2">0</span></span>
                </div>
            </a>
            <!-- Separator without title -->
            <li class="list-group-item sidebar-separator menu-collapsed"></li>
            <!-- /END Separator -->
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-question fa-fw mr-3"></span>
                    <span class="menu-collapsed">Help</span>
                </div>
            </a>
          
           <a href="../logout.php" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-power-off fa-fw mr-3"></span>
                    <span class="menu-collapsed">Log Out</span>
                </div>
            </a>




            <!-- Logo -->
            <li class="list-group-item logo-separator d-flex justify-content-center">
                
            </li>
        </ul>
        <!-- List Group END-->
    </div>
<!-- Sidebar -->
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
                <a href="client_viewprofile.php" <?php if($activeside=='vprofile'){ echo 'class="bg-dark list-group-item list-group-item-action bg-dark sub text-white active"';} else { echo'class="bg-dark list-group-item list-group-item-action bg-dark sub text-white"';}?>>
                    <span class="menu-collapsed">View Profile</span>
                </a>
                <a href="client_editprofile.php" <?php if($activeside=='eprofile'){ echo 'class="bg-dark list-group-item list-group-item-action bg-dark sub text-white active"';} else { echo'class="bg-dark list-group-item list-group-item-action bg-dark sub text-white"';}?>>
                    <span class="menu-collapsed">Edit Profile</span>
                </a>
               
            </div>
         
            <a href="client_rides.php" <?php if($activeside=='rides'){ echo 'class="bg-dark list-group-item list-group-item-action active"';} else { echo'class="bg-dark list-group-item list-group-item-action"';}?>>
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-tasks fa-fw mr-3"></span>
                    <span class="menu-collapsed">My Rides</span>
                </div>
            </a>
            
            
            <!-- /END Separator -->
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-calendar fa-fw mr-3"></span>
                    <span class="menu-collapsed">coming soon</span>
                </div>
            </a>
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-envelope fa-fw mr-3"></span>
                    <span class="menu-collapsed">Messages <span class="badge badge-pill badge-primary ml-2">5</span></span>
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


            <a href="../../pages/logout.php" class="bg-dark list-group-item list-group-item-action">
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
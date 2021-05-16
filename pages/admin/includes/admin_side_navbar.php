<!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block col-2">

        <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group sticky-top sticky-offset">
            
            <li style="height:56px;" class = "list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
            </li>
            <!-- /END Separator -->
            <!-- Menu with submenu -->
                     

             <div class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-tools fa-fw mr-3"></span>
                   <span><strong style="font-size: 19px;" class="menu-collapsed">ADMIN PANEL</strong></span>
                </div>
            </div>
        
            <a href="manage_drivers.php" <?php if($activeside=='drivers'){ echo 'class="bg-dark list-group-item list-group-item-action active"';} else { echo'class="bg-dark list-group-item list-group-item-action"';}?>>
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-car-side fa-fw mr-3"></span>
                    <span class="menu-collapsed">Drivers</span>
                </div>
            </a>


            <a href="manage_hrman.php" <?php if($activeside=='managers'){ echo 'class="bg-dark list-group-item list-group-item-action active"';} else { echo'class="bg-dark list-group-item list-group-item-action"';}?>>
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-users fa-fw mr-3"></span>
                    <span class="menu-collapsed">HR Managers</span>
                </div>
            </a>
           
            

 

            <!-- /END Separator -->
            <a href="manage_rates.php" <?php if($activeside=='rates'){ echo 'class="bg-dark list-group-item list-group-item-action active"';} else { echo'class="bg-dark list-group-item list-group-item-action"';}?>>
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-dollar-sign fa-fw mr-3"></span>
                    <span class="menu-collapsed">Rates</span>
                </div>
            </a>
            
    

          
           <a href="logout.php" class="bg-dark list-group-item list-group-item-action">
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
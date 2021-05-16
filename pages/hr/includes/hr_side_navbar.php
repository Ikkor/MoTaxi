<!-- Sidebar -->


<script>
    //code below will update the msg fav-icon 
        $(document).ready(function(){
            count_unread_message();

            setInterval(function(){
                count_unread_message();
            }, 5000);
            
            function count_unread_message(){
                $.ajax({
                    url: "../../modules/count_unseen_message.php",
                    method: "POST",
                    success:function(data){
                        $('#msgcnt').html(data);
                        // alert(data);
                    }
                })
            }
        });

    </script>

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
                   <span><strong style="font-size: 19px;" class="menu-collapsed">HR PANEL</strong></span>
                </div>
            </div>
        
             <a data-toggle="collapse" aria-expanded = "false" href="#submenu1" <?php if($activeside=='unresolved'){ echo 'class="bg-dark list-group-item list-group-item-action active"';} else { echo'class="bg-dark list-group-item list-group-item-action"';}?>>
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-user fa-fw mr-3"></span>
                    <span class="menu-collapsed">New Complaints</span>
                </div>
            </a>


        <!-- Submenu content -->
            <div id="submenu1" class="collapse sidebar-submenu">
                <a href="drivers_complaints.php" class="list-group-item list-group-item-action bg-dark sub text-white">
                    <span class="menu-collapsed">Driver v/s Client</span>
                </a>
                <a href="clients_complaints.php" class="list-group-item list-group-item-action bg-dark sub text-white">
                    <span class="menu-collapsed">Client v/s Driver</span>
                </a>
               
            </div>
         


             <a data-toggle="collapse" aria-expanded = "false" href="#submenu2" <?php if($activeside=='resolved'){ echo 'class="bg-dark list-group-item list-group-item-action active"';} else { echo'class="bg-dark list-group-item list-group-item-action"';}?>>
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-user fa-fw mr-3"></span>
                    <span class="menu-collapsed">Resolved complaints</span>
                </div>
            </a>


        <!-- Submenu content -->
            <div id="submenu2" class="collapse sidebar-submenu">
                <a href="drivers_solved_complaints.php" class="list-group-item list-group-item-action bg-dark sub text-white">
                    <span class="menu-collapsed">Driver v/s Client</span>
                </a>
                <a href="clients_solved_complaints.php" class="list-group-item list-group-item-action bg-dark sub text-white">
                    <span class="menu-collapsed">Client v/s Driver</span>
                </a>
               
            </div>
         
           
            <a href="hr_inbox.php" <?php if($activeside=='inbox'){ echo 'class="bg-dark list-group-item list-group-item-action active"';} else { echo'class="bg-dark list-group-item list-group-item-action"';}?>>
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-envelope fa-fw mr-3"></span>
                    <span class="menu-collapsed">Messages 
                    <span  id = "msgcnt" class="badge badge-pill badge-primary ml-2">0</span></span>
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
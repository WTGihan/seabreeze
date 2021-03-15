<?php 
   // Header
   $title = "Edit-Reservation";
   include(VIEWS.'dashboard/inc/header.php');
?> 


<div class="wrapper">

    <?php 
            $navbar_title = "Edit Reservation Page";
            $search = 0;
            $search_by = '#';
            include(VIEWS.'dashboard/inc/sidebar.php'); //Sidebar
            include(VIEWS.'dashboard/inc/navbar.php'); //Navbar
    ?>
    
    <!-- Table design -->
    <div class="content">
        <div class="tablecard">
            <div class="card">

                <div class="cardheader">
                    <div class="options">
                        <h4>Edit Reservation 
                        <span>
                            <a href="<?php url("reservation/details"); ?>" class="addnew"><i class="material-icons">reply_all</i></a>  
                        </span>
                        </h4>  
                    </div>

                    <p class="textfortabel">Reservation has Following Details</p>
                </div>

                <div class="cardbody">  
                    
                </div>  <!--End Card Body -->
            </div>  <!--End Card -->

            
        </div>
    </div>   <!-- End Table design -->
    
</div>
    
<?php include(VIEWS.'dashboard/inc/footer.php'); ?>




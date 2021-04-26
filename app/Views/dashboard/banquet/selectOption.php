<style>

</style>
<?php 

// Header
   $title = "Banquet Hall page";
   include(VIEWS.'dashboard/inc/header.php'); 
?>

<div class="wrapper">
      
   <?php 
   
       $navbar_title = "Select Option Page";
       $search = 0;
       $search_by = 'name';
       $url = "employee/index";
       
       include(VIEWS.'dashboard/inc/sidebar.php'); //Sidebar
       include(VIEWS.'dashboard/inc/navbar.php'); //Navbar
   ?>

<div class="content">
       <div class="tablecard">
           <div class="card">
               <div class="cardheader">
                   <div class="options">
                       <h4>Banquet Hall Select Option Page
                       </h4>
                   </div>
                   <p class="textfortabel">Select Banquet Hall Choice</p>
               </div>
               
                    <div class="badgeSec">
                        <div class="horBadge">
                        
                            <div class="icon1">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="text">
                                Banquet Search
                            </div>
                            <a href="<?php url('newBanquet/search');?>"></a>
                        </div>

                        <div class="horBadge">
                        
                            <div class="icon1">
                                <i class="fas fa-user-tag"></i>
                            </div>
                            <div class="text">
                                Banquet Reservations
                            </div>
                            <a href="<?php url('newBanquet/generateCustomeBill');?>"></a>
                        </div>

                    </div>
           </div> 
       </div>
   </div>

</div>   

<?php include(VIEWS.'dashboard/inc/footer.php'); ?>

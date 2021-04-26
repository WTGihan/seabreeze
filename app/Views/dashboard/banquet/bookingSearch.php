<?php 
   // Header
   $title = "Search Banquet page";
   include(VIEWS.'dashboard/inc/header.php');
?> 


<div class="wrapper">

    <?php 
            $navbar_title = "Search Banquet Page";
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
                        <h4>Banquet Hall Search 
                        <span>
                            <a href="<?php url("newBanquet/selectOption"); ?>" class="addnew"><i class="material-icons">reply_all</i></a>  
                       </span>
                       <?php 
                        if(isset($errors)) { ?>
                        <!-- //     echo '<script>alert("'.$errors['date'].'!!")</script>'; -->
                        <div class="notifyclass">
                            <span class="notifyError">
                                <h3 class="error-style">
                                    <?php echo "No Banquet Hall Available For Days"; ?>
                                </h3>
                            </span>
                        </div> 
                            
                        <?php } ?>
                        </h4>  
                    </div>

                    <p class="textfortabel">Complete Following Details</p>
                </div>

                <div class="cardbody">  
                    <?php 
                        if(!isset($customer['id'])) { 
                            $customer['id'] = 0;
                        }
                    ?>
                    <form action="<?php url("newBanquet/banquetCheck"); ?>" method="post" class="addnewform">

                    <div class="section1">

                        <input type="text" name="owner_user_id" value ="<?php echo $_SESSION['user_id']; ?>" hidden  >
                        

                        <div class="row">
                            <label for="#"><i class="material-icons">store</i>Banquet Type:</label>
                                <div class="animate-form">
                                    <select name="session_hall" class="inputField" required>
                                         <option value="">-Select Banquet Type-</option>
                                         <?php if(isset($details['session_hall'])) {?>
                                            <option value="<?php echo $details['session_hall']; ?>" selected><?php echo $details['session_hall']; ?></option>
                                         <?php } ?>
                                         <option value="White Horse Banquet">White Horse Banquet</option>
                                         <option value="White Elephant Banquet Hall">White Elephant Banquet Hall</option>
                                         <option value="White Lion Banquet Hall">White Lion Banquet Hall</option>
                                    </select>    
                                </div>     
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">pending_actions</i>Session Type:</label>
                                <div class="animate-form">
                                    <select name="session_time" class="inputField" required>
                                         <option value="">-Select Session Type-</option>
                                         <?php if(isset($details['session_time'])) {?>
                                            <option value="<?php echo $details['session_time']; ?>" selected><?php 
                                                if($details['session_time'] == "morning") {
                                                    echo "Morning Session (9.00AM-3.00PM)";
                                                }
                                                elseif($details['session_time'] == "night") {
                                                    echo "Night Session (7.00PM-1.00AM)";
                                                }
                                                elseif($details['session_time'] == "both") {
                                                    echo "Both";
                                                }
                                                ?>
                                            </option>
                                         <?php } ?>
                                         <option value="morning">Morning Session (9.00AM-3.00PM)</option>
                                         <option value="night">Night Session (7.00PM-1.00AM)</option>
                                         <option value="both">Both</option>  
                                    </select>    
                                </div>     
                        </div>

                        <div class="rowdate">
                            <label for="#"><i class="material-icons">today</i>Session Date:</label>
                                <!-- <div class="animate-formdate"> -->
                                    <input type="date"  autocomplete="off" name="session_date" class="inputFieldDate"
                                    <?php 

                                        date_default_timezone_set("Asia/Colombo");
                                        $current_date = date('Y-m-d');
                                        $next_date = date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $current_date) ) ));
                                        if(isset($details['check_in_date'])){
                                            echo 'value="' . $details['check_in_date'] . '"';
                                        }
                                        else {
                                            echo 'value="'.$current_date .'"';
                                        } 
                                    
                                    ?>

                                    <?php 
                                        echo 'min="'.$current_date .'"';
                                    ?>
                                    
                                    required
                                    >
                                        
                                <!-- </div> -->
                        </div>
                        

                        
                        <div class="row">
                            <div class="button">
                                <button class="save" name="submit">Search</button>
                            </div>
                        </div>

                    </div>

                    <div class="section2"> 

                    </div>

                    </form>
                </div>  <!--End Card Body -->
            </div>  <!--End Card -->

            
        </div>
    </div>   <!-- End Table design -->
    
</div>
    
<?php include(VIEWS.'dashboard/inc/footer.php'); ?>





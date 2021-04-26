<?php 
   // Header
   $title = "Hall Reservation Payment page";
   include(VIEWS.'dashboard/inc/header.php');
?> 


<div class="wrapper">

    <?php 
            $navbar_title = "Hall Payment Page";
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
                        <h4>New Hall Reservation Payment 
                        <span>
                        
                       
                        </span>
                        </h4>  
                    </div>

                    <p class="textfortabel">Complete Following Details</p>
                </div>

                <div class="cardbody">  
                
                    <form action="<?php url("newBanquet/payBanquest"); ?>" method="post" class="addnewform">
    
                    <div class="section1">

                        <!-- Customer Part -->
                        
                        <input type="hidden" name="customer_id" value="<?php echo $reservation['customer_id']; ?>">
                        <input type="hidden" name="reservation_id" value="<?php echo $reservation['reservation_id']; ?>">
                        
                        <div class="row">
                            <label for="#"><i class="material-icons">account_box</i>First Name:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="first_name" class="inputField" maxlength="20" minlength="4" id="first_name" oninput="validationFirstName()"
                                    <?php 
                                        if(isset($reservation['first_name'])){
                                            echo 'value="' . $reservation['first_name'] . '"';
                                        }
                                        if(isset($customer['first_name'])) {
                                            echo 'value="' . $customer['first_name'] . '"';
                                        }
                                        else {
                                            echo 'placeholder="Must Start with Capital letter Min length 4 and Max length 20"';
                                        } 
                                    
                                    ?>
                                    
                                    readonly
                                    >
                                    
                                     
                                </div>     
                        </div>

                
                        <div class="row">
                            <label for="#"><i class="material-icons">account_box</i>Last Name:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="last_name" class="inputField" maxlength="20" minlength="4" id="last_name" oninput="validationLastName()"
                                    <?php 
                                        if(isset($reservation['last_name'])){
                                            echo 'value="' . $reservation['last_name'] . '"';
                                        }
                                        if(isset($customer['last_name'])) {
                                            echo 'value="' . $customer['last_name'] . '"';
                                        }
                                        else {
                                            echo 'placeholder="Must Start with Capital letter Min length 4 and Max length 20"';
                                        } 
                                    
                                    ?>
                                    
                                    readonly
                                    >
                                    
                                  
                                </div>     
                        </div>


                        <div class="row">
                            <label for="#"><i class="material-icons">perm_contact_calendar</i>Age:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="age" class="inputField" maxlength="3" minlength="2" id="age" oninput="validationAge()"
                                    <?php 
                                        if(isset($reservation['age'])){
                                            echo 'value="' . $reservation['age'] . '"';
                                        }
                                        if(isset($customer['age'])) {
                                            echo 'value="' . $customer['age'] . '"';
                                        }
                                        else {
                                            echo 'placeholder="Must less than 20 Years old"';
                                        } 
                                    
                                    ?>
                                    
                                    readonly
                                    >
                                    
                                  
                                </div>     
                        </div>
                        
                        <?php 
                            // echo $reservation['location'];
                            // die();
                        ?>
                        <div class="row">
                            <label for="#"><i class="material-icons">public</i>Country:</label>
                                <div class="animate-form">
                                    <select name="location" class="inputField" readonly>
                                    <?php if(isset($reservation['location'])){ ?>
                                        <option value="<?php echo $reservation['location']; ?>" selected><?php echo $reservation['location']; ?></option>
                                    <?php }?>
                                        
                                    </select>    
                                </div>     
                        </div>

                        
                        <div class="row">
                            <label for="#"><i class="material-icons">contacts</i>Contact Number:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="contact_number" class="inputField" maxlength="10" minlength="10" id="contact_number" oninput="validationContactNumber()"
                                    <?php 
                                        if(isset($reservation['contact_number'])){
                                            echo 'value="' . $reservation['contact_number'] . '"';
                                        }
                                        if(isset($customer['contact_number'])) {
                                            echo 'value="' . $customer['contact_number'] . '"';
                                        }
                                        else {
                                            echo 'placeholder="Must Min length and Max length 10"';
                                        } 
                                    
                                    ?>
                                    
                                    readonly
                                    >
                                    
                                     
                                </div>     
                        </div>

                        

                        

                        <div class="row">
                            <label for="#"><i class="material-icons">mail</i>Email Address:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="email" class="inputField" maxlength="30" minlength="10" id="email" oninput="validationEmail()"
                                    <?php 
                                        if(isset($reservation['email'])){
                                            echo 'value="' . $reservation['email'] . '"';
                                        }
                                        if(isset($customer['email'])) {
                                            echo 'value="' . $customer['email'] . '"';
                                        }
                                        else {
                                            echo 'placeholder="Must GMAIL Min length 12 and Max length 30"';
                                        } 
                                    
                                    ?>
                                    readonly
                                    
                                    >
                                    
                                    
                                </div>     
                        </div>

                        <!-- End of Customer Details Part  -->

                        <!-- Hall Reservation Details -->

                       
                        

                        <div class="row">
                            <label for="#"><i class="material-icons">store</i>Hall Type:</label>
                                <div class="animate-form">
                                    <select name="session_hall" class="inputField"  readonly>
                                         <?php if(isset($reservation['session_hall'])) {?>
                                            <option value="<?php echo $reservation['session_hall']; ?>" selected><?php echo $reservation['session_hall']; ?></option>
                                         <?php } ?>
                                                
                                    </select>    
                                </div>     
                        </div>
                        <div class="row">
                            <label for="#"><i class="material-icons">pending_actions</i>Session Type:</label>
                                <div class="animate-form">
                                    <select name="session_time" class="inputField" readonly>
                                         <?php if(isset($reservation['session_time'])) {?>
                                            <option value="<?php echo $reservation['session_time']; ?>" selected><?php 
                                                if($reservation['session_time'] == "morning") {
                                                    echo "Morning Session (9.00AM-3.00PM)";
                                                }
                                                elseif($reservation['session_time'] == "night") {
                                                    echo "Night Session (7.00PM-1.00AM)";
                                                }
                                                elseif($reservation['session_time'] == "both") {
                                                    echo "Both";
                                                }
                                                ?>
                                            </option>
                                         <?php } ?>
                                              
                                    </select>    
                                </div>     
                        </div>
                       

                       


                        <div class="rowdate">
                            <label for="#"><i class="material-icons">today</i>Session Date:</label>
                                <!-- <div class="animate-form"> -->
                                    <input type="date"  autocomplete="off" name="session_date" class="inputFieldDate" readonly
                                    <?php 

                                        date_default_timezone_set("Asia/Colombo");
                                        $current_date = date('Y-m-d');
                                        $next_date = date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $current_date) ) ));
                                        if(isset($reservation['session_date'])){
                                            echo 'value="' . $reservation['session_date'] . '"';
                                        }
                                        else {
                                            echo 'value="'.$current_date .'"';
                                        } 
                                    
                                    ?>

                                    <?php 
                                        echo 'min="'.$current_date .'"';
                                    ?>
                                    
                                    
                                    >
                                    
                                        
                                <!-- </div>      -->
                        </div>

                        <!-- End of Reservation Details -->
                          
                        <!-- Payment Details -->


                        <div class="row">
                            <label for="#"><i class="material-icons">request_quote</i>Payment Method:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="payment_method" class="inputField"
                                    <?php 
                                        if(isset($reservation['payment_method'])){
                                            echo 'value="' . $reservation['payment_method'] . '"';
                                        }
                                        else {
                                            echo 'value="CASH"';
                                        } 
                                    
                                    ?>
                                    
                                    readonly="readonly"
                                    >
                                    
                                      
                                </div>     
                        </div>
                        <div class="row">
                            <label for="#"><i class="material-icons">sell</i>Hall Price:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="price" class="inputField"
                                    <?php 
                                        $multply = 1;
                                        if($reservation['session_time'] == "both") {
                                            $multply = 2;
                                            $new_reservation_price = $reservation['price']*$multply;
                                        }
                                        else {
                                            $new_reservation_price = $reservation['price'];
                                        }

                                        if(isset($reservation['price'])){
                                            echo 'value="' . $reservation['price']*$multply . '"';
                                        }
                                        else {
                                            echo 'value="00000"';
                                        } 
                                    
                                    ?>
                                    
                                    readonly
                                    >
                                    
                                      
                                </div>     
                        </div>
                        <div class="row">
                            <label for="#"><i class="material-icons">sell</i>Service Charge:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="service_charge" class="inputField"
                                    <?php 
                                        $service_charge = $new_reservation_price*(10/100);
                                        
                                        echo 'value="' . $service_charge  . '"';
                                        
                                    ?>
                                    
                                    readonly
                                    >
                                    
                                      
                                </div>     
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">price_check</i>Total:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="total" class="inputField"
                                    <?php 
                                        $total = $service_charge + $new_reservation_price;
                                        echo 'value="' . $total . '"';
                                        
                                    
                                    ?>
                                    
                                    readonly
                                    >
                                    
                                      
                                </div>     
                        </div>

                        
                        <!-- End of Payment Details -->

                        <div class="row">
                            <div class="button">
                                <button class="save" name="submit">Pay Now</button>
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
<script src="<?php echo BURL.'assets/js/main.js'; ?>"></script>   
<?php include(VIEWS.'dashboard/inc/footer.php'); ?>




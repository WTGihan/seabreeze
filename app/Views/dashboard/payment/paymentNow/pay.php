<?php 
   // Header
   $title = "Edit-Reservation";
   include(VIEWS.'dashboard/inc/header.php');
?> 

<style>
.invoice-box {
  max-width: 800px;
  margin: auto;
  padding: 30px;
  border: 1px solid #eee;
  box-shadow: 0 0 10px rgba(0, 0, 0, .15);
  font-size: 16px;
  line-height: 24px;
  font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
  color: #555;
}

.invoice-box table {
  width: 100%;
  line-height: inherit;
  text-align: left;
}

.invoice-box table td {
  padding: 5px;
  vertical-align: top;
}

.invoice-box table tr td:nth-child(n+2) {
  text-align: right;
}

.invoice-box table tr.top table td {
  padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
  font-size: 45px;
  line-height: 45px;
  color: #333;
}

.invoice-box table tr.information table td {
  padding-bottom: 40px;
}

.invoice-box table tr.heading td {
  background: #eee;
  border-bottom: 1px solid #ddd;
  font-weight: bold;
}

.invoice-box table tr.details td {
  padding-bottom: 20px;
}

.invoice-box table tr.item td{
  border-bottom: 1px solid #eee;
}

.invoice-box table tr.item.last td {
  border-bottom: none;
}

.invoice-box table tr.item input {
  padding-left: 5px;
}

.invoice-box table tr.item td:first-child input {
  margin-left: -5px;
  width: 100%;
}

.invoice-box table tr.total td:nth-child(2) {
  border-top: 2px solid #eee;
  font-weight: bold;
}

.invoice-box input[type=number] {
  width: 60px;
}

@media only screen and (max-width: 600px) {
  .invoice-box table tr.top table td {
      width: 100%;
      display: block;
      text-align: center;
  }
  
  .invoice-box table tr.information table td {
      width: 100%;
      display: block;
      text-align: center;
  }
}

/** RTL **/
.rtl {
  direction: rtl;
  font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
}

.rtl table {
  text-align: right;
}

.rtl table tr td:nth-child(2) {
  text-align: left;
}
</style>
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
                    <div class="window">

                        <div class="linkBar">
                            <a href="<?php url('pay/checkout/0/'.$room['room_number'].'/'.$reservation['check_in_date'].'/'.$reservation['check_out_date']);?>">Guest Details</a>
                            <a href="<?php url('pay/checkout/1/'.$room['room_number'].'/'.$reservation['check_in_date'].'/'.$reservation['check_out_date']);?>">Room Details</a>
                            <a href="<?php url('pay/checkout/2/'.$room['room_number'].'/'.$reservation['check_in_date'].'/'.$reservation['check_out_date']);?>">Payment Details</a>
                        </div>

                        <div class="formSet">
                        <form action="<?php url("reservation/update/".$reservation['check_in_date']); ?>" method="post" class="addnewform">

                    <div class="section1">

                   

                        <input type="text" name="customer_id" value ="<?php echo $reservation['customer_id']; ?>" hidden  >
                        <input type="text" name="reception_user_id" value ="<?php echo $reservation['reception_user_id']; ?>" hidden  >
                        <input type="text" name="room_id" value ="<?php echo $reservation['room_id']; ?>" hidden  >

                        <?php if ($sectionId == 0): ?>
                        

                        <div class="row">
                            <label for="#"><i class="material-icons">book</i>Reservation ID:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="reservation_id" class="inputField"
                                    <?php 
                                        if(isset($reservation['reservation_id'])){
                                            echo 'value="' . $reservation['reservation_id'] . '"';
                                        }

                                    
                                    ?>
                                    
                                    readonly
                                    >
                                    
                                        <label for="name" class="label-name">
                                            <?php if($reservation['reservation_id'] == ""){ ?>
                                                <span class="content-success"><i class="material-icons">privacy_tip</i></span>
                                            <?php } else {?>
                                                <span class="content-success"><i class="material-icons">verified_user</i></span>
                                            <?php } ?>
                                        </label>    
                                </div>     
                        </div>


                        <div class="row">
                            <label for="#"><i class="material-icons">account_box</i>Customer First Name:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="first_name" class="inputField"
                                    <?php 
                                        if(isset($customer['first_name'])){
                                            echo 'value="' . $customer['first_name'] . '"';
                                        }
                                        
                                    
                                    ?>
                                    
                                    readonly
                                    >
                                    
                                        <label for="name" class="label-name">
                                            <?php if($customer['first_name'] == ""){ ?>
                                                <span class="content-success"><i class="material-icons">privacy_tip</i></span>
                                            <?php } else {?>
                                                <span class="content-success"><i class="material-icons">verified_user</i></span>
                                            <?php } ?>
                                        </label>    
                                </div>     
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">account_box</i>Customer Last Name:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="last_name" class="inputField"
                                    <?php 
                                        if(isset($customer['last_name'])){
                                            echo 'value="' . $customer['last_name'] . '"';
                                        }
                                         
                                    
                                    ?>
                                    
                                    readonly
                                    >
                                    
                                        <label for="name" class="label-name">
                                            <?php if($customer['last_name'] == ""){ ?>
                                                <span class="content-success"><i class="material-icons">privacy_tip</i></span>
                                            <?php } else {?>
                                                <span class="content-success"><i class="material-icons">verified_user</i></span>
                                            <?php } ?>
                                        </label>    
                                </div>     
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">contacts</i>Contact Number:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="contact_number" class="inputField"
                                    <?php 
                                        if(isset($customer['contact_number'])){
                                            echo 'value="' . $customer['contact_number'] . '"';
                                        }
                                    
                                    ?>
                                    
                                    readonly
                                    >
                                    
                                        <label for="name" class="label-name">
                                            <?php if($customer['contact_number'] == ""){ ?>
                                                <span class="content-success"><i class="material-icons">privacy_tip</i></span>
                                            <?php } else {?>
                                                <span class="content-success"><i class="material-icons">verified_user</i></span>
                                            <?php } ?>
                                        </label>    
                                </div>     
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">mail</i>Email:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="email" class="inputField"
                                    <?php 
                                        if(isset($customer['email'])){
                                            echo 'value="' . $customer['email'] . '"';
                                        }
                                    
                                    ?>
                                    
                                    readonly
                                    >
                                    
                                        <label for="name" class="label-name">
                                            <?php if($customer['email'] == ""){ ?>
                                                <span class="content-success"><i class="material-icons">privacy_tip</i></span>
                                            <?php } else {?>
                                                <span class="content-success"><i class="material-icons">verified_user</i></span>
                                            <?php } ?>
                                        </label>    
                                </div>     
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">public</i>Country:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="location" class="inputField"
                                    <?php 
                                        if(isset($customer['location'])){
                                            echo 'value="' . $customer['location'] . '"';
                                        }
                                    
                                    ?>
                                    
                                    readonly
                                    >
                                    
                                        <label for="name" class="label-name">
                                            <?php if($customer['location'] == ""){ ?>
                                                <<span class="content-success"><i class="material-icons">privacy_tip</i></span>
                                            <?php } else {?>
                                                <span class="content-success"><i class="material-icons">verified_user</i></span>
                                            <?php } ?>
                                        </label>    
                                </div>     
                        </div>

                        <?php elseif ($sectionId == 1): ?>

                        <div class="row">
                            <label for="#"><i class="material-icons">admin_panel_settings</i>Room Number:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="room_number" class="inputField"
                                    <?php 
                                        if(isset($room['room_number'])){
                                            echo 'value="' . $room['room_number'] . '"';
                                        }
                                        
                                    
                                    ?>
                                    
                                    readonly
                                    >
                                    
                                        <label for="name" class="label-name">
                                            <?php if($room['room_number'] == ""){ ?>
                                                <<span class="content-success"><i class="material-icons">privacy_tip</i></span>
                                            <?php } else {?>
                                                <span class="content-success"><i class="material-icons">verified_user</i></span>
                                            <?php } ?>
                                        </label>    
                                </div>     
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">hotel</i>Room Name:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="room_name" class="inputField"
                                    <?php 
                                        if(isset($room['room_name'])){
                                            echo 'value="' . $room['room_name'] . '"';
                                        }
                                        
                                    
                                    ?>
                                    
                                    readonly
                                    >
                                    
                                        <label for="name" class="label-name">
                                            <?php if($room['room_name'] == ""){ ?>
                                                <<span class="content-success"><i class="material-icons">privacy_tip</i></span>
                                            <?php } else {?>
                                                <span class="content-success"><i class="material-icons">verified_user</i></span>
                                            <?php } ?>
                                        </label>    
                                </div>     
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">hotel</i>Room Type:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="type_name" class="inputField"
                                    <?php 
                                        if(isset($room_type['type_name'])){
                                            echo 'value="' . $room_type['type_name'] . '"';
                                        }
                                        
                                    
                                    ?>
                                    
                                    readonly
                                    >
                                    
                                        <label for="name" class="label-name">
                                            <?php if($room_type['type_name'] == ""){ ?>
                                                <<span class="content-success"><i class="material-icons">privacy_tip</i></span>
                                            <?php } else {?>
                                                <span class="content-success"><i class="material-icons">verified_user</i></span>
                                            <?php } ?>
                                        </label>    
                                </div>     
                        </div>
                        

                        <div class="row">
                            <label for="#"><i class="material-icons">local_offer</i>Room Price:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="price" class="inputField"
                                    <?php 
                                        if(isset($room['price'])){
                                            echo 'value="' . $room['price'] . '$"';
                                        }
                                        
                                    
                                    ?>
                                    
                                    readonly
                                    >
                                    
                                        <label for="name" class="label-name">
                                            <?php if($room['price'] == ""){ ?>
                                                <span class="content-success"><i class="material-icons">privacy_tip</i></span>
                                            <?php } else {?>
                                                <span class="content-success"><i class="material-icons">verified_user</i></span>
                                            <?php } ?>
                                        </label>    
                                </div>     
                        </div>

                        <?php elseif ($sectionId == 2): ?>

                        <div class="row">
                            <label for="#"><i class="material-icons">recent_actors</i>Reception Name:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="username" class="inputField"
                                    <?php 
                                        if(isset($reception['username'])){
                                            echo 'value="' . $reception['username'] . '"';
                                        }
                                        
                                    ?>
                                    readonly
                                    >
                                    
                                        <label for="name" class="label-name">
                                            <?php if($reception['username'] == ""){ ?>
                                                <span class="content-success"><i class="material-icons">privacy_tip</i></span>
                                            <?php } else {?>
                                                <span class="content-success"><i class="material-icons">verified_user</i></span>
                                            <?php } ?>
                                        </label>    
                                </div>     
                        </div>


                        <div class="row">
                            <label for="#"><i class="material-icons">today</i>Check In Date:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="check_in_date" class="inputField"
                                    <?php 
                                        if(isset($reservation['check_in_date'])){
                                            echo 'value="' . $reservation['check_in_date'] . '"';
                                        }
                                        
                                    
                                    ?>
                                    
                                    required
                                    >
                                    
                                        <label for="name" class="label-name">
                                            <?php if((isset($errors['check_in_date'])) && (isset($reservation['check_in_date']))): ?>
                                                <span class="content-name"><i class="material-icons">info</i><?php echo $errors['check_in_date']; ?></span>
                                            <?php endif; ?>
                                            <?php if(isset($success)): ?>
                                                <span class="content-success"><i class="material-icons">verified_user</i>Updated Success</span>
                                            <?php endif; ?>
                                        </label>    
                                </div>     
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">today</i>Check Out Date:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="check_out_date" class="inputField"
                                    <?php 
                                        if(isset($reservation['check_out_date'])){
                                            echo 'value="' . $reservation['check_out_date'] . '"';
                                        }
                                        
                                    
                                    ?>
                                    
                                    required
                                    >
                                    
                                        <label for="name" class="label-name">
                                            <?php if((isset($errors['check_out_date'])) && (isset($reservation['check_out_date']))): ?>
                                                <span class="content-name"><i class="material-icons">info</i><?php echo $errors['check_out_date']; ?></span>
                                            <?php endif; ?>
                                            <?php if(isset($success)): ?>
                                                <span class="content-success"><i class="material-icons">verified_user</i>Updated Success</span>
                                            <?php endif; ?>
                                        </label>    
                                </div>     
                        </div>

                        <div class="row">
                            <label for="#"><i class="material-icons">request_quote</i>Total Nights:</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="payment_method" class="inputField"
                                    <?php 
                                        
                                        $date1=date_create($reservation['check_in_date']);
                                        $date2=date_create($reservation['check_out_date']);
                                        $diff=date_diff($date1,$date2);
                                        // echo $diff->format("%R%a days");
                                        // exit;
                                    if(isset($diff)){
                                            echo 'value="' .$diff->format("%a nights"). '"';
                                        }
                                        
                                    
                                    ?>
                                    
                                    required
                                    >
                                    
                                        <label for="name" class="label-name">
                                            <?php if((isset($errors['payment_method'])) && (isset($reservation['payment_method']))): ?>
                                                <span class="content-name"><i class="material-icons">info</i><?php echo $errors['payment_method']; ?></span>
                                            <?php endif; ?>
                                            <?php if(isset($success)): ?>
                                                <span class="content-success"><i class="material-icons">verified_user</i>Updated Success</span>
                                            <?php endif; ?>
                                        </label>    
                                </div>     
                        </div>
                        <div class="row">
                            <label for="#"><i class="material-icons">request_quote</i>Total Amount (LKR):</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="payment_method" class="inputField"
                                    
                                    <?php 
                                        
                                        $date1=date_create($reservation['check_in_date']);
                                        $date2=date_create($reservation['check_out_date']);
                                        $diff=date_diff($date1,$date2);
                                        // echo $diff;
                                        // exit;
                                    if(isset($diff)){
                                            echo 'value="' .$diff->format("%a")*$room['price']. ' $"';
                                        }
                                        
                                    
                                    ?>
                                    
                                    required
                                    >
                                    
                                        <label for="name" class="label-name">
                                            <?php if((isset($errors['payment_method'])) && (isset($reservation['payment_method']))): ?>
                                                <span class="content-name"><i class="material-icons">info</i><?php echo $errors['payment_method']; ?></span>
                                            <?php endif; ?>
                                            <?php if(isset($success)): ?>
                                                <span class="content-success"><i class="material-icons">verified_user</i>Updated Success</span>
                                            <?php endif; ?>
                                        </label>    
                                </div>     
                        </div>  
                        <div class="row">
                            <label for="#"><i class="material-icons">request_quote</i>Payed Amount (LKR):</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="payment_method" class="inputField"
                                    <?php
                                    if(isset($onlinePay)){
                                        echo 'value="' .$onlinePay. ' $"';
                                    }
                                    
                                    ?>
                                    
                                    required
                                    >
                                    
                                        <label for="name" class="label-name">
                                            <?php if((isset($errors['payment_method'])) && (isset($reservation['payment_method']))): ?>
                                                <span class="content-name"><i class="material-icons">info</i><?php echo $errors['payment_method']; ?></span>
                                            <?php endif; ?>
                                            <?php if(isset($success)): ?>
                                                <span class="content-success"><i class="material-icons">verified_user</i>Updated Success</span>
                                            <?php endif; ?>
                                        </label>    
                                </div>     
                        </div>  
                        <div class="row">
                            <label for="#"><i class="material-icons">request_quote</i>Amount to be Payed(LKR):</label>
                                <div class="animate-form">
                                    <input type="text"  autocomplete="off" name="payment_method" class="inputField"
                                    
                                    <?php
                                    $date1=date_create($reservation['check_in_date']);
                                    $date2=date_create($reservation['check_out_date']);
                                    $diff=date_diff($date1,$date2);
                                    // echo $diff;
                                    // exit;
                                    if(isset($onlinePay) ){
                                        $tot =($diff->format("%a")*$room['price'] ) -    $onlinePay;
                                        
                                    
                                        echo 'value="' .$tot. ' $"';
                                        
                                        
                                    }else{
                                        echo 'value="' .$diff->format("%a")*$room['price'] .' $"';

                                    }
                                    
                                    ?>
                                    required
                                    >
                                    
                                        <label for="name" class="label-name">
                                            <?php if((isset($errors['payment_method'])) && (isset($reservation['payment_method']))): ?>
                                                <span class="content-name"><i class="material-icons">info</i><?php echo $errors['payment_method']; ?></span>
                                            <?php endif; ?>
                                            <?php if(isset($success)): ?>
                                                <span class="content-success"><i class="material-icons">verified_user</i>Updated Success</span>
                                            <?php endif; ?>
                                        </label>    
                                </div>     
                        </div>   
                        <div class="invoice-box">
                                <table cellpadding="0" cellspacing="0">
                                    <tr class="top">
                                    <td colspan="4">
                                        <table>
                                        <tr>
                                            <td class="logo" style="justify-content: left;">
                                            
                                            <img src="<?php echo BURL.'assets/img/basic/logo.png'; ?>" style="width:250px"> 
                                            <!-- <p>Sea Breeze Hotel</p> -->
                                            </td>

                                            <td>
                                            Invoice #:<?php echo(rand(10000,900000)); ?> <br>
                                            <?php
                                                echo "Created: ".$reservation['check_in_date'];
                                            ?>
                                            <br> 
                                            <?php
                                                date_default_timezone_set("Asia/Kolkata"); 
                                                $Due = date("Y-m-d");
                                                echo "Due: ".$Due;

                                            ?>
                                            </td>
                                        </tr>
                                        </table>
                                    </td>
                                    </tr>
                                    
                                    <tr class="information">
                                    <td colspan="4">
                                        <table>
                                        <tr>
                                            <td>

                                            155, Galle Road,<br> Urawaththa, Ambalangoda <br> Sri Lanka
                                            </td>

                                            <td>
                                            <?php  echo  $customer['first_name'] ." ".$customer['last_name'];?>
                                            <br>
                                            <?php  echo  $customer['location'];?>
                                             <br>
                                             <?php  echo  $customer['email'];?>
                                             <br>
                                             <?php  echo  $customer['contact_number'];?>
                                            </td>
                                        </tr>
                                        </table>
                                    </td>
                                    </tr>

                                    <tr class="heading">
                                    <td>
                                        #Title   
                                    </td>

                                    <td>
                                       Room Rate(LKR)
                                    </td>

                                    <td>
                                       Nights
                                    </td>

                                    <td>
                                        Price(LKR)
                                    </td>
                                    </tr>
                                    <tr>
                                    <td></td></tr>
                                    <tr class="item">
                                    <td>
                                    <?php echo $room['room_number']; ?>
                                    </td>

                                    <td>
                                        <?php echo $room['price']; ?>
                                    </td>

                                    <td>
                                       <?php 
                                        $date1=date_create($reservation['check_in_date']);
                                        $date2=date_create($reservation['check_out_date']);
                                        $diff=date_diff($date1,$date2);
                                        // echo $diff->format("%R%a days");
                                        // exit;
                                    if(isset($diff)){
                                            echo $diff->format("%a nights");
                                        }
                                       ?>
                                    </td>

                                    <td>
                                    <?php 
                                        
                                        $date1=date_create($reservation['check_in_date']);
                                        $date2=date_create($reservation['check_out_date']);
                                        $diff=date_diff($date1,$date2);
                                        // echo $diff;
                                        // exit;
                                    if(isset($diff)){
                                            echo $diff->format("%a")*$room['price'];
                                        } 
                                        
                                    
                                    ?>
                                    
                                    </td>
                                    </tr>
                                    <tr>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total:</strong></td>
                                    <td>
                                    <?php 
                                        
                                        $date1=date_create($reservation['check_in_date']);
                                        $date2=date_create($reservation['check_out_date']);
                                        $diff=date_diff($date1,$date2);
                                        // echo $diff;
                                        // exit;
                                    if(isset($diff)){
                                            echo $diff->format("%a")*$room['price'];
                                        }
                                        
                                    
                                    ?>
                                    </td>
                                    </tr>
                                    
                                    </tr>
                                    <tr>
                            <td></td>
                            </tr>
                            </tr>
                            <tr class="total">
                            <td ></td>
                            <td ></td>
                            <td >Signature</td>
                            <td>
                               ........................
                            </td>
                            </tr>
                                </table>
                        </div>
                        <div class="row">
                                <a href="<?php url('report/printBills/'.$room['room_number'].'/'.$reservation['check_in_date'].'/'.$reservation['check_out_date']); ?>" class="save" name="">Pay Bill</a>
                        </div>
                    </div>

                    <?php endif; ?>

                    <div class="section2"> 

                    </div>


                    </form>
                        </div>

                    </div>
                </div>  <!--End Card Body -->
            </div>  <!--End Card -->

            
        </div>
    </div>   <!-- End Table design -->
    
</div>
    
<?php include(VIEWS.'dashboard/inc/footer.php'); ?>




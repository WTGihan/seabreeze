
<?php 

// Header
   $title = "Reservations page";
   include(VIEWS.'dashboard/inc/header.php'); 
?>

<div class="wrapper">
      
   <?php 
   
       $navbar_title = "Rooms Reservations ";
       $search = 1;
       $search_by = 'Hall Name';
       $url = "banquet/hallReservationIndex";
       
       include(VIEWS.'dashboard/inc/sidebar.php'); //Sidebar
       include(VIEWS.'dashboard/inc/navbar.php'); //Navbar
   ?>
       
    <!-- Table design -->
   <div class="content">
       <div class="tablecard">
           <div class="card">
               <div class="cardheader">
                   <div class="options">
                       <h4>All Room Reservations Page  
                       <span>
                            <a href="<?php url("banquet/selectOption"); ?>" class="addnew"><i class="material-icons">reply_all</i></a>
                            <a href="<?php url("banquet/hallReservationIndex"); ?>" class="refresh"><i class="material-icons">loop</i></a> 
                       </span> 
                        
                       </h4>
                   </div>
                   <p class="textfortabel">Hall Reservations View Following Table</p>
               </div>
               <div class="cardbody">
               <div class="tablebody">
                                <table>
                                    <thead>
                                        <th>Hall Name</th>
                                        <th>Customer</th>
                                        <th>Email</th>
                                        <th>Hall Price</th>
                                        <th>Session Date</th>
                                        <th>Session Type</th>
                                        <!-- <?php if($_SESSION['user_level'] == "Owner" ): ?>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        <?php endif; ?>                                             -->
                                    </thead>

                                    <?php foreach($rooms as $row): ?>
                                    <tbody>
                                        
                                        <td><?php echo $row['name'];?></td>
                                        <td><?php echo $row['first_name'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <td><?php echo $row['price'];?></td>
                                        <td>
                                            <div class="outofdate">
                                                <?php echo $row['session_date'];?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="in">
                                                <?php echo ucfirst($row['session_type']);?>
                                            </div>
                                        </td>
                                        <?php 
                                            date_default_timezone_set("Asia/Colombo");
                                            $current_date = date("Y-m-d");
                                        ?>

                                        <!-- <?php if($_SESSION['user_level'] == "Owner"): ?>
                                            <?php if($current_date > $row['check_out_date']) { ?>
                                                <td><a href="#" onclick="return confirm('Can not Edit Sorry!!');" class="edit"><i class="material-icons">edit</i></a></td>
                                            <?php } else { ?>   
                                                <td><a href="<?php url('reservation/edit/'.$row['room_number'].'/'.$row['check_in_date'].'/'.$row['check_out_date']);?>" class="edit"><i class="material-icons">edit</i></a></td>
                                            <?php }; ?>    
                                            <td><a href="<?php url('reservation/delete/'.$row['room_number'].'/'.$row['check_in_date'].'/'.$row['check_out_date']);?>" onclick="return confirm('Are you sure?');" class="delete"><i class="material-icons">delete</i></a></td>
                                        <?php endif; ?> -->
                                    </tbody>
                                <?php endforeach ?> 
                                </table>
                           
                           </div>
                </div>  <!--End Card Body -->
           </div> 
       </div>
   </div>

</div>   
   

<?php include(VIEWS.'dashboard/inc/footer.php'); ?>

<?php 

// Header
   $title = "Reservations Notification Page";
   include(VIEWS.'dashboard/inc/header.php'); 
?>

<div class="wrapper">
      
   <?php 
   
       $navbar_title = "Hall Reservations ";
       $search = 0;
       $search_by = 'Hall Name';
       $url = "banquet/notificationIndex"; //must change
       
       include(VIEWS.'dashboard/inc/sidebar.php'); //Sidebar
       include(VIEWS.'dashboard/inc/navbar.php'); //Navbar
   ?>
       
    <!-- Table design -->
   <div class="content">
       <div class="tablecard">
           <div class="card">
               <div class="cardheader">
                   <div class="options">
                       <h4>All Hall Reservations Notification Page
                       <span>
                            <a href="<?php url("banquet/selectOption"); ?>" class="addnew"><i class="material-icons">reply_all</i></a>
                            <a href="<?php url("banquet/notificationIndex"); ?>" class="refresh"><i class="material-icons">loop</i></a>  
                       </span> 
                       </h4>
                   </div>
                   <p class="textfortabel">Hall Reservations Notifications View Following Table</p>
                   <p class="textfortabel">Morning Session (9.00AM-3.00PM) && Night Session (7.00PM-1.00AM)</p>
               </div>
               <div class="cardbody">
               <div class="tablebody">
                                <?php 
                                    if(isset($errors)) {
                                        echo '<script>alert("Can not Accept Already reserved Sorry!!")</script>';
                                    }
                                
                                
                                ?>
                                <table>
                                    <thead>
                                        <th>Hall Name</th>
                                        <th>Hall Price</th>
                                        <th>Session Date</th>
                                        <th>Session Type</th>
                                        <th>Accept</th>
                                        <th>Decline</th>
                                                                                 
                                    </thead>

                                    <?php foreach($rooms as $row): ?>
                                    <tbody>
                                        
                                        <td><?php echo ucwords($row['name']);?></td>
                                        <td><?php echo $row['price'];?></td>
                                        <td>  
                                            <div class="in">
                                                <?php  echo $row['session_date'];?>
                                            </div>
                                        </td>

                                        <td>   
                                            <div class="out">
                                                <?php  echo ucfirst($row['session_type']);?>
                                            </div>        
                                        </td>
                                        
                                        <td>
                                            <div class="outofdate">
                                                <a href="<?php url('banquet/notificationAccept/'.$row['id'].'/'.$row['hall_id'].'/'.$row['session_date'].'/'.$row['session_type']);?>" class="edit" style="color:#ffff;">accept</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="outofdate">
                                                <a href="<?php url('banquet/notificationDecline/'.$row['id']);?>" class="edit" style="color:#ffff;">decline</a>
                                            </div>
                                        </td>
                                        
                                        
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
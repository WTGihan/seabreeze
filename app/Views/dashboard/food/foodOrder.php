
<?php 

// Header
   $title = "Reception page";
   include(VIEWS.'dashboard/inc/header.php'); 
?>

<div class="wrapper">
      
   <?php 
   
       $navbar_title = "Reception Page";
       $search = 1;
       $search_by = 'username';
       $url = "Reception/index";
       
       include(VIEWS.'dashboard/inc/sidebar.php'); //Sidebar
       include(VIEWS.'dashboard/inc/navbar.php'); //Navbar
   ?>
       
    <!-- Table design -->
   <div class="content">
       <div class="tablecard">
           <div class="card">
               <div class="cardheader">
                   <div class="options">
                       <h4>Reception Page   
                       <span>
                       <a href="<?php url("employee/option"); ?>" class="addnew"><i class="material-icons">reply_all</i></a>  
                            <a href="<?php url("reception/index"); ?>" class="refresh"><i class="material-icons">loop</i></a> 
                            
                        
                       </span> 
                       </h4>
                   </div>
                   <p class="textfortabel">Reception View Following Table</p>
               </div>
               <div class="cardbody">
                    <div class="tablebody">
                        <table>
                            <thead>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Sub Total</th>                           
                                <?php if($_SESSION['user_level'] == "Owner"): ?>
                                    <th>Delete</th>
                                    <!-- <th>View</th> -->
                                <?php endif; ?>
                                <?php if($_SESSION['user_level'] != "Owner"): ?>
                                    <!-- <th>View</th> -->
                                <?php endif; ?>

                            </thead>
                            <?php foreach($food1 as $row): ?>
                            <tbody>
                                <td><?php echo $row['food_order_id'];?></td>
                                <td><?php echo $row['date'];?></td>
                                <td><?php echo $row['sub_total'];?></td>
                                 <td><a href="<?php url('food/deleteFood/'.$row['food_order_id']);?>" class="delete"><i class="material-icons">delete</i>Delete</a></td>
                                 <!-- <td><a href="<?php url('reception/edit/'.$row['reception_user_id']);?>" class="edit"><i class="material-icons">visibility</i></a>View</td> -->
                               
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

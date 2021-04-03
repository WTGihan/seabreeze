<?php 
session_start();

class FoodController {

    private $table = "food_item";
    private $connection;

    public function __construct() {
        
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'seabreeze';

        $this->connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    }
    public function index() {
       
        //Checking if a user is logged in
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();   
        }
        else {
            
            $db = new Food;
            $data['food'] = $db->getAllFood();
            // $data['room'] = array("room_number"=>"", "room_name"=>"", "type_id"=>"", "room_desc"=>"", "price"=>"", "room_view"=>"", "floor_type"=>"", "room_size"=>"", "air_condition"=>"", "free_canseleration"=>"", "hot_water"=>"", "breakfast_included"=>"");
            view::load('dashboard/food/food', $data);

        }
    }

    public function placeOrder()
    {
        $str = $_POST['subTotal'];
        $newStr = str_replace(',', '', $str); // If you want it to be "185345321"
        $num = intval($newStr); // If you want it to be a number 185345321
               
        date_default_timezone_set("Asia/Kolkata"); 
                $Due = date("Y-m-d");
                $query = "INSERT INTO food_order (food_order_id, date, sub_total) 
                    VALUES (NULL,'{$Due}', '{$num}')";
                    // echo $query;
                    // exit;
                $result = mysqli_query($this->connection, $query);
                
               $count = 0; 
               $sql = "SELECT * FROM food_order ORDER BY food_order_id DESC LIMIT 1";
               $result = mysqli_query($this->connection, $sql);
               $row = mysqli_fetch_assoc($result);
               $order_id = $row['food_order_id'];
                
                foreach ($_POST as $key => $value) {
                   // echo '<pre>' , var_dump($_POST) , '</pre>'; exit;
              
                    $count++;
                    if ($count == 1) {
                        $product_id = $value;
                    }
                    
                    if ($count==2) {
                        if ($value != "") {
                            $sql = "SELECT * FROM food_item WHERE food_id= '{$product_id}' LIMIT 1";
                            $result = mysqli_query($this->connection, $sql);
                            $row = mysqli_fetch_assoc($result);
            
                            // $profit = ($row['sell_unit_price'] - $row['bill_unit_price']) * $value;
            
                            $query = "INSERT INTO food_order_item (id,food_order_id, food_id, qty) 
                            VALUES ( NULL, '{$order_id}', '{$product_id}', '{$value}')";
                            // echo $query;
                            // exit;
                            $result = mysqli_query($this->connection, $query);
            
                            $count=0;
                        }else{
                            $count =0;
                        }
                    }
                }
                $data['food_order'] = $order_id;
                view::load('dashboard/food/foodOrder', $data); 
            
            }
            
            public function viewFood() {
       
                //Checking if a user is logged in
                if(!isset($_SESSION['user_id'])) {
                    $dashboard = new DashboardController();
                    $dashboard->index();   
                }
                else {
                    
                    $db = new Food;
                    $data['food1'] = $db->viewFoodOrder();
                    // var_dump($data); exit;
                    // $data['room'] = array("room_number"=>"", "room_name"=>"", "type_id"=>"", "room_desc"=>"", "price"=>"", "room_view"=>"", "floor_type"=>"", "room_size"=>"", "air_condition"=>"", "free_canseleration"=>"", "hot_water"=>"", "breakfast_included"=>"");
                    view::load('dashboard/food/foodOrder', $data);
        
                }
            }    

            public function deleteFood($orderId) {
       
                //Checking if a user is logged in
                if(!isset($_SESSION['user_id'])) {
                    $dashboard = new DashboardController();
                    $dashboard->index();   
                }
                else {
                    
                    $db = new Food;
                    $db->deleteFoodOrder($orderId);
                    // var_dump($data); exit;
                    // $data['room'] = array("room_number"=>"", "room_name"=>"", "type_id"=>"", "room_desc"=>"", "price"=>"", "room_view"=>"", "floor_type"=>"", "room_size"=>"", "air_condition"=>"", "free_canseleration"=>"", "hot_water"=>"", "breakfast_included"=>"");
                    $db = new Food;
                    $data['food1'] = $db->viewFoodOrder();
                    view::load('dashboard/food/foodOrder', $data);
        
                }
            }    
    }

    
  

?>
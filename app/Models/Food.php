

<?php 

class Food {

    private $table = "food_item";
    private $table1 = "food_order";
    private $connection;

    public function __construct() {
        
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'seabreeze';

        $this->connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    }
    

    //Done
    public function getAllFood() {

        $query = "SELECT * FROM  $this->table";
        // echo $query;
        // exit;
        $users = mysqli_query($this->connection, $query);
        if($users) {
            $food =mysqli_fetch_all($users,MYSQLI_ASSOC);
        }
        else {
            echo "Database Query Failed";
        }    
// var_dump($food);
// exit;
        return $food; 

    }

    public function viewFoodOrder() {
     
        $query = "SELECT * FROM  $this->table1";
                // echo $query;
                // exit;
                $users = mysqli_query($this->connection, $query);
                if($users) {
                    $food1 =mysqli_fetch_all($users,MYSQLI_ASSOC);
                }
                else {
                    echo "Database Query Failed";
                }    
        
                return $food1; 
    }

    public function deleteFoodOrder($orderId) {
     
        $query = "DELETE FROM  $this->table1 WHERE food_order_id  = {$orderId} ";
                // echo $query;
                // exit;
                $users = mysqli_query($this->connection, $query);
                  
    }
}
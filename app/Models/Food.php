

<?php 

class Food {

    private $table = "food_item";
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

   
}
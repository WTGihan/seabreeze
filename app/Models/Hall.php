<?php 


class Hall extends Connection {

    public $hall_id;
    // private $customer_id;
    // private $reservation_reception_user_id;
    // private $hall_id; Foreign Key
    private $hall_name;
    private $hall_price;
    public $hall_table = "hall";

    public function __construct() {        
        Connection::__construct();
    }

    public function getHallDetails($hall_id) {
        $this->hall_id = mysqli_real_escape_string($this->connection, $hall_id);

        $query = "SELECT * FROM $this->hall_table 
            WHERE id = '{$this->hall_id}'
            LIMIT 1";

        $result = mysqli_query($this->connection, $query);

        if($result ){
            if(mysqli_num_rows($result ) == 1) {
                $hall = mysqli_fetch_assoc($result);
            }
        }
        else {
            echo "Query Error";
        }

        return $hall;  
    }
}
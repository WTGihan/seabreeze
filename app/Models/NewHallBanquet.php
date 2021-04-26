<?php 

class NewHallBanquet extends Connection {

    public $banquet_id;
    // private $customer_id;
    // private $reservation_reception_user_id;
    // private $hall_id; Foreign Key
    public $banquet_hall_id;
    private $banquet_session_date;
    private $banquet_session_type;
    private $banquet_is_valid;
    private $banquet_request;
    private $banquet_payment_method;
    public $banquet_table = "bonquet_reservation";

    public function __construct() {        
        Connection::__construct();
    }

    public function searchBanquet($hall_id, $session_date, $session_type) {
        $this->banquet_hall_id = mysqli_real_escape_string($this->connection, $hall_id);
        $this->banquet_session_date = mysqli_real_escape_string($this->connection, $session_date);
        
        // echo "tharindu Gihan";
        // die();
        $request_value = 0;
        $valid = 1;
        if($session_type === "both" ) {
            $session_type1 = "morning";
            $session_type2 = "evening";
            $session_type3 = "both";
            $query = "SELECT * FROM $this->banquet_table
                WHERE hall_id = '{$this->banquet_hall_id}' and 
                session_date = '{$this->banquet_session_date}' and request = '{$request_value}' and is_valid = '{$valid}' and
                (session_type = '{$session_type1}' OR  session_type = '{$session_type2}' OR session_type = '{$session_type3}')
                LIMIT 1";
        }
        else {
            $session_type3 = "both";
            $this->banquet_session_type = mysqli_real_escape_string($this->connection, $session_type);
            $query = "SELECT * FROM $this->banquet_table
                WHERE hall_id = '{$this->banquet_hall_id}' and 
                session_date = '{$this->banquet_session_date}' and  is_valid = '{$valid}' and request = '{$request_value}' and
                (session_type = '{$this->banquet_session_type}'  OR session_type = '{$session_type3}')
                LIMIT 1";
        }

        $result = 0;
        $result_set = mysqli_query($this->connection, $query);
        // var_dump($query);
        // die();
        if($result_set){
            if(mysqli_num_rows($result_set) == 1) {
                $result = 1;
            }
        }
        else {
            echo "Query Error";
        }
        return $result;
    }

    public function getCreateReservation($data) {
        $value = 0;
        $customer = new Customer();
        $reception = new Reception();
        $room = new RoomDetails();

        $customer->customer_id = mysqli_real_escape_string($this->connection, $data[0]);
        $reception->reception_user_id = mysqli_real_escape_string($this->connection, $data[1]);
        $this->banquet_hall_id = mysqli_real_escape_string($this->connection, $data[2]);
        $this->banquet_session_date = mysqli_real_escape_string($this->connection, $data[3]);
        $this->banquet_session_type = mysqli_real_escape_string($this->connection, $data[4]);
        $this->banquet_request = mysqli_real_escape_string($this->connection, $data[5]);
        $this->banquet_payment_method = mysqli_real_escape_string($this->connection, $data[6]);
        $this->banquet_request = (int)$this->banquet_request;
        // echo $customer->customer_id;
        // die();
        
        // var_dump($data);exit;
        $query = "INSERT INTO $this->banquet_table (
                 customer_id, reception_user_id, hall_id, session_date, session_type, request, payment_method, is_valid) 
                 VALUES (
                 '{$customer->customer_id}', '{$reception->reception_user_id}', '{$this->banquet_hall_id}', '{$this->banquet_session_date}', '{$this->banquet_session_type}', '{$this->banquet_request}', '{$this->banquet_payment_method}', 1
                 )";
        // print_r($query);
        // die();
        $result = mysqli_query($this->connection, $query);
        // echo "Query Level2";
        if($result) {
            // query successful..
            // echo "Query Successfull";
            $value = 1;
            return $value;
        }
        else {
            echo "Query failed";
        }
    }

    

    public function getOneHalleView($id) {

        $this->banquet_hall_id = mysqli_real_escape_string($this->connection, $id);
        $hall[] = array();
        $hall = "hall";
         $query = "SELECT * FROM $hall
                   WHERE $hall.id='$this->banquet_hall_id' LIMIT 1 ";
        // echo $query;  
        // exit();  
        $result= mysqli_query($this->connection, $query);
        // var_dump($result);
        // exit();
        if($result) {
            $hall = mysqli_fetch_all($result,MYSQLI_ASSOC);
        
            // var_dump($hall);
            // echo $hall[0]['name'];
            // exit();
            return $hall;
        }
        else {
            echo "Database Query Failed";
        } 
    }

    public function getReservationDetails($customer_id, $session_date, $session_time) {

        $customer_id = mysqli_real_escape_string($this->connection, $customer_id);
        $this->banquet_session_date = mysqli_real_escape_string($this->connection, $session_date);
        $this->banquet_session_time = mysqli_real_escape_string($this->connection, $session_time);

        $query = "SELECT * FROM $this->banquet_table
                  WHERE customer_id = '{$customer_id}' AND session_date = '{$this->banquet_session_date}' AND  session_type = '{$this->banquet_session_time}' AND $this->banquet_table.is_valid = 1
                  LIMIT 1";
        // var_dump($query);
        // die();
        $reservations = mysqli_query($this->connection, $query);
        if($reservations){
            if(mysqli_num_rows($reservations) == 1) {
                $reservation = mysqli_fetch_assoc($reservations);
            }
        }
        else {
            echo "Query Error";
        }

        return $reservation;

    }

    public function getBanquetReservations($reservation_id) {
        // echo "success";
        $this->banquet_id = mysqli_real_escape_string($this->connection, $reservation_id);
        // $hall[] = array();
        // $hall = "hall";
         $query = "SELECT * FROM $this->banquet_table
                   WHERE id ='$this->banquet_id' LIMIT 1 ";

        // echo $query;  
        // exit();  
        $reservations= mysqli_query($this->connection, $query);
        // var_dump($result);
        // exit();
        if($reservations) {
            if(mysqli_num_rows($reservations) == 1) {
                $reservation = mysqli_fetch_assoc($reservations);
            }
        
            // var_dump($hall);
            // echo $hall[0]['name'];
            // exit();
            return $reservation;
        }
        else {
            echo "Database Query Failed";
        } 
    }



    

    
}
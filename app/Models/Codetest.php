<?php 

class Codetest{

    private $table1 = "room_details";
    private $table2 = "room_type";

    public function __CONSTRUCT(){
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'bayfront_hotel';
    
        $this->connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    }

    public function roomAllDetails()
    {
        // exit;
        $sql = "SELECT $this->table1.room_number, $this->table1.room_name, $this->table2.type_name, $this->table1.room_view, $this->table1.price, $this->table1.room_number 
        FROM $this->table2 
        INNER JOIN $this->table1 
        ON  $this->table1.type_id = $this->table2.room_type_id 
        WHERE  $this->table1.price > 20000 ORDER BY  $this->table1.price DESC ";

        // echo $sql;
        // exit;

        $room = mysqli_query($this->connection , $sql);
        if($room){
            $room = mysqli_fetch_all($room, MYSQLI_ASSOC);
            // var_dump($room);exit;
            return $room;
        }else{
            echo "Error";
        }
    }
}

?>
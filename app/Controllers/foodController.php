<?php 
session_start();

class FoodController {

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

}    

?>
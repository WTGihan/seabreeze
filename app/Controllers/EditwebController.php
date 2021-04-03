<?php 
session_start();
class EditwebController{

    public function index() {
        

        //Checking if a user is logged in
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();      
        }
        else {
            $data = array();
            // $db = new Employee;
            $db = new RoomEdit();

            if(isset($_POST['search'])) {
                $search = $_POST['search'];
                $data['rooms'] = $db->getSearchRoom($search);
                //echo 'Error1';
                view::load('dashboard/editweb/index', $data);
            }
            else {
                $data['rooms'] = $db->getAllRoom();
        
                view::load('dashboard/editweb/index', $data);
            }
        }
    }

    public function discount() {
        date_default_timezone_set("Asia/Colombo");
        $current_date = date('Y-m-d');
        
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();   
        }
        
        else {
            $db = new RoomType();
            $typename = $db->getRoomTypes();
            $data['typename'] = $typename;

            $db = new RoomType();
            $type = $db->getTypes();
            $data['type'] = $type;
            
            $db = new RoomEdit();
            $data['discount_details'] = $db->getAllDiscount();
            // var_dump($data['type']); exit;
                    
            view::load('dashboard/editweb/discount', $data);

        }
           
    }

    public function updateDiscount(){
        $errors =array();
        if(isset($_POST['submit'])){
            //echo '<pre>', print_r($_POST) ,'</pre>';
            //exit();

            $type_name =$_POST['type_name'];
            $dis =$_POST['discount'];
            $start =$_POST['start_date'];
            $end =$_POST['end_date'];
            
            if(empty($dis)){
                if($dis != 0 || $dis == ""){
                $errors['discount'] = 'Discount Field required';
                }
            }else{
                if(!preg_match("/^[0-9]\d*(((,\d{3}){1})?(\.\d{0,2})?)$/" , $dis)){
                    $errors['discount'] = 'Entered Discount is Invalid';
                }

                if($dis > 100.00){
                    $errors['discount'] = 'Discount is Too Large';
                }
                
            }

            if($start > $end){
                $errors['date'] = 'Invalid Date Input';
            }
            if(count( $errors ) == 0) {
                $db = new RoomType();
                $type = $db->getTypeID($type_name);
                $type_id = $type['room_type_id'];
                
                $db = new RoomType();
                if($db->updateTypeDiscount($type_id, $dis, $start, $end)){

                    $db = new RoomType();
                    $typename = $db->getRoomTypes();
                    $data['typename'] = $typename;

                    $db = new RoomType();
                    $type = $db->getTypes();
                    $data['type'] = $type;
                    
                    $db = new RoomEdit();
                    $data['discount_details'] = $db->getAllDiscount();
                    // var_dump($data['type']); exit;
                        view::load('dashboard/editweb/discount', $data);
                }
            }else{
                $db = new RoomType();
                $typename = $db->getRoomTypes();
                $data['typename'] = $typename;

                $db = new RoomType();
                $type = $db->getTypes();
                $data['type'] = $type;
                
                $db = new RoomEdit();
                $data['discount_details'] = $db->getAllDiscount();
                // var_dump($data['type']); exit;
                $data['errors'] = $errors;
                view::load('dashboard/editweb/discount', $data);
            }
            
        }
           
    }
    public function selectDetails() {
        

        //Checking if a user is logged in
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();      
        }
        else {
            $data = array();
            // $db = new Employee;
            $db = new RoomEdit();

            if(isset($_POST['search'])) {
                $search = $_POST['search'];
                $data['rooms'] = $db->getSearchRoom($search);
                //echo 'Error1';
                view::load('dashboard/editweb/select', $data);
            }
            else {
                $data['rooms'] = $db->getAllRoom();
        
                view::load('dashboard/editweb/select', $data);
            }
        }
    }
    public function selectChange($room_number) {
    
        
        $data['room_number']= $room_number;
        // exit();
        view::load('dashboard/editweb/selectChange', $data);
    }




    public function changeDetails($room_number) {
    
        $db = new RoomDetails();
        $result = $db->getOneRoomView($room_number);
        // var_dump($result);
        $data['room_details'] = $result; 
        view::load('dashboard/editweb/changeDetails', $data);
    }

    public function createNew() {
       
        if(!isset($_SESSION['user_id'])) {
            view::load('dashboard/dashboard');    
        }

        else {
             $data['room'] = array("room_number"=>"", "room_name"=>"", "type_id"=>"", "room_desc"=>"", "price"=>"", "room_view"=>"", "floor_type"=>"10", "room_size"=>"", "air_condition"=>"", "free_canseleration"=>"", "hot_water"=>"", "breakfast_included"=>"");
            view::load('dashboard/editweb/newRoom', $data);
        }
    }

    public function create() {
        $errorsNew =array();
        if(!isset($_SESSION['user_id'])) {
            view::load('dashboard/dashboard');    
        }
        else {

            if(isset($_POST['submit'])){
                // echo '<pre>', print_r($_POST) ,'</pre>';
                // exit();
                $room_number= $_POST['room_number'];
                $room_name = $_POST['room_name'];
                $type_name = $_POST['type_id'];
                $room_desc = $_POST['room-desc'];
                $room_view = $_POST['room_view'];
                $floor_type = $_POST['floor_type'];


                $room_size = $_POST['room_size'];
                $room_size = floatval($room_size);

                $price = $_POST['price'];
                $price = floatval($price);

                $air_condition = $_POST['air_condition'];
                $free_canseleration = $_POST['free_canseleration'];
                $hot_water = $_POST['hot_water'];
                $breakfast_included = $_POST['breakfast_included'];

                //validate room number
                if (preg_match( "/[0-9]{3}/", $room_number)) {
                    
                    if(empty($room_number)){
                        $errorsNew['room_number'] = 'Room number field required';
                    }else{
                        if($floor_type == 0){
                            if($room_number > 0 && $room_number < 100){
                                $room_number = "A".$room_number;
                                $db = new RoomEdit;
                                if ($db->serchRoom($room_number) == 1) {
                                    $errorsNew['room_number'] = 'Room number already exist';
                                }
                            }else{
                                $errorsNew['room_number'] = 'Ground Floor Contains 001 - 099';
                            }
                        }
                        if($floor_type == 1){
                            
                            if($room_number > 99 && $room_number < 200){
                                $room_number = "B".$room_number;
                                $db = new RoomEdit;
                                if ($db->serchRoom($room_number) == 1) {
                                    $errorsNew['room_number'] = 'Room number already exist';
                                }
                            }else{
                                $errorsNew['room_number'] = 'First Floor Contains 100 - 199';
                            }
                        }
                        if($floor_type == 2){
                            
                            if($room_number > 199 && $room_number < 300){
                                $room_number = "C".$room_number;
                                $db = new RoomEdit;
                                if ($db->serchRoom($room_number) == 1) {
                                    $errorsNew['room_number'] = 'Room number already exist';
                                }
                            }else{
                                $errorsNew['room_number'] = 'Second Floor Contains 200 - 299';
                            }
                        }
                        if($floor_type == 3){
                           
                            if($room_number > 299 && $room_number < 400){
                                $room_number = "D".$room_number;
                                $db = new RoomEdit;
                                if ($db->serchRoom($room_number) == 1) {
                                    $errorsNew['room_number'] = 'Room number already exist';
                                }
                            }else{
                                $errorsNew['room_number'] = 'Third Floor Contains 300 - 399';
                            }
                        }
                        if($floor_type == 4){
                           
                            if($room_number > 399 && $room_number < 400){
                                $room_number = "E".$room_number;
                                $db = new RoomEdit;
                                if ($db->serchRoom($room_number) == 1) {
                                    $errorsNew['room_number'] = 'Room number already exist';
                                }
                            }else{
                                $errorsNew['room_number'] = 'Forth Floor Contains 400 - 499';
                            }
                        }
                    }
                }else{
                    $errorsNew['room_number'] = 'Your Input Must Be 3 Digits';
                }

                if(empty($room_name)){
                    $errorsNew['room_name'] = 'Room name field required';
                }else{
                    if (!preg_match( "/^[A-Za-z.\s_-]+$/", $room_name)) {
                        $errorsNew['room_name'] = 'Invalid room name';  
                    }
                }

                if(empty($room_desc)){
                    $errorsNew['room_desc'] = 'Room description field required';
                }
                
                if(empty($price)){
                    $errorsNew['price'] = 'price Field required';
                }else{
                    if(!preg_match("/^[0-9]\d*(((,\d{3}){1})?(\.\d{0,2})?)$/" , $price)){
                        $errorsNew['price'] = 'Entered Price is Invalid';
                    }
                }
                
                if(empty($room_size)){
                    $errorsNew['room_size'] = 'room size Field required';
                }else{
                    if(!preg_match("/^[0-9]\d*(((,\d{3}){1})?(\.\d{0,2})?)$/" , $room_size)){
                        $errorsNew['room_size'] = 'Entered Room Size is Invalid';
                    }
                }

                // print_r($errorsNew);
                //     exit(); 
            
                if(count( $errorsNew ) == 0) {

                    $file = $_FILES['imgfile'];
                    // print_r($file);
                    // exit();
                
                    $filename = $_FILES['imgfile']['name'];
                    $filetmp_name = $_FILES['imgfile']['tmp_name'];
                    // echo  $filetmp_name;
                    // exit();
                    $filesize = $_FILES['imgfile']['size'];
                    $fileerror = $_FILES['imgfile']['error'];
                    $filetype = $_FILES['imgfile']['type'];
                
                    $fileExt = explode('.', $filename);
                    $fileActualExt = strtolower(end($fileExt));
                    // echo $fileActualExt;
                    $allowed = array('jpg', 'jpeg', 'png' );
                
                    if (in_array($fileActualExt, $allowed)) {
                        if ($fileerror === 0) {
                            if ($filesize < 1000000) {
                                $fileNewName = "image_01".".".$fileActualExt;
                                if (!file_exists(__DIR__.'/../../public/uploads/'.$room_number)) {
                                    mkdir(__DIR__.'/../../public/uploads/'.$room_number, 0777, true);
                                    // rmdir(__DIR__.'/../../public/uploads/A006');
                                }
                                $path =   __DIR__.'/../../public/uploads/'.$room_number.'/'.$fileNewName;
                                // echo $path;
                                // exit();
                                $db = new RoomEdit;
                                
                                if($floor_type == 0){
                                    $room_number = "A".$room_number;
                                }
                                if($floor_type == 1){
                                    $room_number = "B".$room_number;
                                }
                                if($floor_type == 2){
                                    $room_number = "C".$room_number;
                                }
                                if($floor_type == 3){
                                    $room_number = "D".$room_number;
                                }
                                if($floor_type == 4){
                                    $room_number = "E".$room_number;
                                }

                                $updateDetails = $db->createRoom( $room_number, $type_name, $room_name, $room_desc, $floor_type, $room_size, $price, $room_view,  $air_condition, $free_canseleration, $hot_water ,$breakfast_included );
                   
                                $db = new Image();
                                if ($db->upload($room_number, "image_01" ,  $path)){
                                    move_uploaded_file($filetmp_name, $path);
                                    $data['errors'] = $errorsNew;
                                    $db = new RoomEdit;
                                    $data['rooms'] = $db->getAllRoom();
                                    view::load('dashboard/editweb/index', $data);
        
                                }else{
                                    $errorsNew['img'] = 'Image Not Uploaded';
                                    $data['errors'] = $errorsNew;
                                    $data['room'] = array("room_number"=>$room_number, "room_name"=>$room_name, "type_id"=>$type_name, "room_desc"=>$room_desc, "price"=>$price, "room_view"=>$room_view, "floor_type"=>$floor_type, "room_size"=>$room_size, "air_condition"=>$air_condition, "free_canseleration"=>$free_canseleration, "hot_water"=>$hot_water, "breakfast_included"=>$breakfast_included);
                                    unset($_POST);
                                    view::load('dashboard/editweb/newRoom', $data);
                                }
                            }else{
                                $errorsNew['img'] = 'Image File Is Too Small';
                                $data['errors'] = $errorsNew;
                                $data['room'] = array("room_number"=>$room_number, "room_name"=>$room_name, "type_id"=>$type_name, "room_desc"=>$room_desc, "price"=>$price, "room_view"=>$room_view, "floor_type"=>$floor_type, "room_size"=>$room_size, "air_condition"=>$air_condition, "free_canseleration"=>$free_canseleration, "hot_water"=>$hot_water, "breakfast_included"=>$breakfast_included);
                                unset($_POST);
                                view::load('dashboard/editweb/newRoom', $data);
                            }
                        }else{
                            $errorsNew['img'] = 'There Is Some Error In Image';
                            $data['errors'] = $errorsNew;
                            $data['room'] = array("room_number"=>$room_number, "room_name"=>$room_name, "type_id"=>$type_name, "room_desc"=>$room_desc, "price"=>$price, "room_view"=>$room_view, "floor_type"=>$floor_type, "room_size"=>$room_size, "air_condition"=>$air_condition, "free_canseleration"=>$free_canseleration, "hot_water"=>$hot_water, "breakfast_included"=>$breakfast_included);
                            unset($_POST);
                            view::load('dashboard/editweb/newRoom', $data);
                        }
                    }else{
                        $errorsNew['img'] = 'Invalid Image Format';
                        $data['errors'] = $errorsNew;
                        $data['room'] = array("room_number"=>$room_number, "room_name"=>$room_name, "type_id"=>$type_name, "room_desc"=>$room_desc, "price"=>$price, "room_view"=>$room_view, "floor_type"=>$floor_type, "room_size"=>$room_size, "air_condition"=>$air_condition, "free_canseleration"=>$free_canseleration, "hot_water"=>$hot_water, "breakfast_included"=>$breakfast_included);
                        unset($_POST);
                        view::load('dashboard/editweb/newRoom', $data);
                    }
                }
                else {
                    $data['errors'] = $errorsNew;
                    $data['room'] = array("room_number"=>$room_number, "room_name"=>$room_name, "type_id"=>$type_name, "room_desc"=>$room_desc, "price"=>$price, "room_view"=>$room_view, "floor_type"=>$floor_type, "room_size"=>$room_size, "air_condition"=>$air_condition, "free_canseleration"=>$free_canseleration, "hot_water"=>$hot_water, "breakfast_included"=>$breakfast_included);
                    unset($_POST);
                    view::load('dashboard/editweb/newRoom', $data);
                }
                
            }
        }

    }


    public function update() {
        // var_dump($_POST);
        // exit;
        if(isset($_POST['submit'])) {
                $errors = array();

                $room_id= $_POST['room_id'];
                $room_number= $_POST['room_number'];
                $room_name = $_POST['room_name'];
                $type_name = $_POST['type_name'];
                $room_desc = $_POST['room-desc'];
                $room_view = $_POST['room_view'];
                $floor_type = $_POST['floor_type'];

                $room_size = $_POST['room_size'];
                $room_size = floatval($room_size);

                $price = $_POST['price'];
                $price = floatval($price);

                $air_condition = $_POST['air_condition'];

                $free_canseleration = $_POST['free_canseleration'];

                $hot_water = $_POST['hot_water'];

                $breakfast_included = $_POST['breakfast_included'];

                if (preg_match( "/^[0-9]{3}$/", $room_number)) {
                    
                    if(empty($room_number)){
                        $errors['room_number'] = 'Room number field required';
                    }else{
                        if($floor_type == 0){
                            if($room_number > 0 && $room_number < 100){
                                $room_number = "A".$room_number;
                               
                            }else{
                                $errors['room_number'] = 'Ground Floor Contains 001 - 099';
                            }
                        }
                        if($floor_type == 1){
                            if($room_number > 99 && $room_number < 200){
                                $room_number = "B".$room_number;
                                
                            }else{
                                $errors['room_number'] = 'First Floor Contains 100 - 199';
                            }
                        }
                        if($floor_type == 2){
                            if($room_number > 199 && $room_number < 300){
                                $room_number = "C".$room_number;
                               
                            }else{
                                $errors['room_number'] = 'Second Floor Contains 200 - 299';
                            }
                        }
                        if($floor_type == 3){
                            if($room_number > 299 && $room_number < 400){
                                $room_number = "D".$room_number;
                                
                            }else{
                                $errors['room_number'] = 'Third Floor Contains 300 - 399';
                            }
                        }
                        if($floor_type == 4){
                            if($room_number > 399 && $room_number < 400){
                                $room_number = "E".$room_number;
                                
                            }else{
                                $errors['room_number'] = 'Forth Floor Contains 400 - 499';
                            }
                        }
                    }
                }else{
                    $errors['room_number'] = 'Your Input Must Be 3 Digits';
                }

                if(empty($room_name)){
                    $errors['room_name'] = 'Room name field required';
                }else{
                    if (!preg_match( "/^[A-Za-z.\s_-]+$/", $room_name)) {
                        $errors['room_name'] = 'Invalid room name';  
                    }
                }

                if(empty($room_desc)){
                    $errors['room_desc'] = 'Room description field required';
                }
                
                if(empty($price)){
                    $errors['price'] = 'price Field required';
                }else{
                    if(!preg_match("/^[0-9]\d*(((,\d{3}){1})?(\.\d{0,2})?)$/" , $price)){
                        $errors['price'] = 'Entered Price is Invalid';
                    }
                }
                
                if(empty($room_size)){
                    $errors['room_size'] = 'room size Field required';
                }else{
                    if(!preg_match("/^[0-9]\d*(((,\d{3}){1})?(\.\d{0,2})?)$/" , $room_size)){
                        $errors['room_size'] = 'Entered Room Size is Invalid';
                    }
                }

 
            
            if(count( $errors ) == 0) {
                
               $db = new RoomEdit;
            $updateDetails = $db->updateRoom($room_id, $room_number, $type_name, $room_name, $room_desc, $floor_type, $room_size, $price,  $air_condition, $free_canseleration, $hot_water);


                if($updateDetails == 1){

                    $data['room_details'][0] = array("room_id"=>$room_id, "room_number"=>$room_number, "room_name"=>$room_name, "type_id"=>$type_name, "room_desc"=>$room_desc, "price"=>$price, "room_view"=>$room_view, "floor_type"=>$floor_type, "room_size"=>$room_size, "air_condition"=>$air_condition, "free_canselaration"=>$free_canseleration, "hot_water"=>$hot_water, "breakfast_included"=>$breakfast_included);
                    $data['success'] = array("success"=> "Update Success"); 
                    unset($_POST);
                    view::load("dashboard/editweb/changeDetails", $data);
                }
                else {
                    // Query failed
                }
            }
            else {
               
                $data['errors'] = $errors;
                    $data['room_details'][0] = array("room_id"=>$room_id, "room_number"=>$room_number, "room_name"=>$room_name, "type_id"=>$type_name, "room_desc"=>$room_desc, "price"=>$price, "room_view"=>$room_view, "floor_type"=>$floor_type, "room_size"=>$room_size, "air_condition"=>$air_condition, "free_canselaration"=>$free_canseleration, "hot_water"=>$hot_water, "breakfast_included"=>$breakfast_included);
                    unset($_POST);
                    view::load("dashboard/editweb/changeDetails", $data);
            }

            
            }
        }    

    

    public function delete($room_id , $room_number)
    {
        
        $db = new RoomEdit;
        if($db->deleteRoom($room_id)){
            $db = new RoomEdit;
            $data['rooms'] = $db->getAllRoom();
            if (file_exists(__DIR__.'/../../public/uploads/'.$room_number)) {
                // mkdir(__DIR__.'/../../public/uploads/'.$room_number, 0777, true);
                array_map('unlink', glob(__DIR__.'/../../public/uploads/'.$room_number.'/*.*'));
                rmdir(__DIR__.'/../../public/uploads/'.$room_number);
            }
            // $_POST = array();
            view::load('dashboard/editweb/index', $data);
        }

    }

    private function check_req_fields($req_fields) {
        
        $errors = array();

        foreach($req_fields as $field) {
            if(empty(trim($_POST[$field]))) {
                $errors[$field] = ' is required';
            }
        }

        return $errors;
    }

    private function check_max_len($max_len_fields) {
        // Check max lengths
        $errors = array();
    
        foreach($max_len_fields as $field => $max_len) {
            if(strlen(trim($_POST[$field])) > $max_len ) {
                $errors[$field] = ' must be less than ' . $max_len . ' characters';
            }
        }
    
        return $errors;
    }
    
    private function is_email($email) {
        return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i" ,$email));
    }

    private function is_valid($text) {
        return(preg_match("/^([a-zA-Z' ]+)$/", $text));
    }

    private function is_num($num) {
        return(preg_match('/^[0-9]+$/', $num));

    }
    
}

?>
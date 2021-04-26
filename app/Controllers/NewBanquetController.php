<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'Libs/vendor/autoload.php';
require_once 'Libs/payment/vendor/autoload.php';
require_once 'Libs/TCPDF-main/tcpdf.php';
require_once 'PDF/BILLPDF.php';

class NewBanquetController{
    
    // public function index()
    // {
    //     View::load('banquet');
    // }

    // public function ViewSubPage($id)
    // {
    //     $data['id'] = $id;
    //     View::load('sub/banquetView', $data);
    // }

    public function selectOption() {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();
        }
        else {
            view::load('dashboard/banquet/selectOption');
        }

    }

    public function search() {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();
        }
        else {
            view::load('dashboard/banquet/bookingSearch');
        }
    }

    public function banquetCheck() {

        if(isset($_POST['submit'])) {
            $errors[] = array();
            $session_hall_type = $_POST['session_hall'];
            $session_date = $_POST['session_date'];
            $session_time = $_POST['session_time'];

            // echo $session_hall_type;
            // die();
            // echo $session_time;
            // echo $id;
            // die();
            
            date_default_timezone_set("Asia/Colombo");
            $current_date = date('Y-m-d');
            if($session_date < $current_date) {
                $errors['session_date'] = "Date is Invalid";
            }

            

            if($session_time == "none") {
                $errors['session_time'] = "Session time is Invalid";
                // $errors['no_of_rooms'] = "Room Type is Invalid";
            }

            if($session_hall_type == "White Horse Banquet") {
                $hall_id = 1;
            }
            elseif($session_hall_type == "White Elephant Banquet Hall") {
                $hall_id = 2;
            }
            elseif($session_hall_type == "White Lion Banquet Hall") {
                $hall_id = 3;
            }

            // print_r($errors);
            // die();

            $errors = array_filter( $errors ); 

            if(count( $errors ) == 0) {
                
                $inputdata = array("session_hall"=>$session_hall_type,"session_date"=>$session_date, "session_time"=>$session_time);
               
                
              
                $db = new NewHallBanquet();
                // $hall_id = $id;
                $result = $db->searchBanquet($hall_id, $session_date, $session_time);
                // echo "Tharindu";
                // var_dump($inputdata);
                // exit;
                // echo $result;
                // die();
                $availability = 0;
                if($result == 1) {
                    $availability = 0;
                    $errors['hallAvailable'] = "0";
                    $hallAvailable = array("availability" => $availability);
                    // var_dump()
                    $data['hallAvailable']  = $hallAvailable;
                    // $data['id'] = $id;
                    $data['errors'] = $errors;
                    $data['details'] = $inputdata;
                    //  print_r($errors);
                    //  die();
               
                    view::load('dashboard/banquet/bookingSearch', $data);
                }
                else {
                    // go hall booking Reservation Page
                    $data['reservation'] = $inputdata;
                    view::load('dashboard/banquet/create', $data);

                }

                
                   
            }
            else {
                // echo "HEllo";
                // show one room view
                $inputdata = array("session_hall_type"=>$session_hall_type,"session_date"=>$session_date, "session_time"=>$session_time);
                $data['errors'] = $errors;
                // $data['id'] = $id;
                $data['details'] = $inputdata;
                view::load('dashboard/banquet/bookingSearch', $data);
            }
        }
    }

    public function create() {
        if(isset($_POST['submit'])) {

            // Validation
            $first_name = $_POST['first_name'];
            $first_name = ucwords($first_name);
            $last_name = $_POST['last_name'];
            $last_name = ucwords($last_name);
            $location = $_POST['location'];
            // echo $location;
            // die();
            $contact_num = $_POST['contact_number'];
            // $date_of_birth = $_POST['date_of_birth'];
            $age = $_POST['age'];
            $email = $_POST['email'];
            $email = strtolower($email);

            $hall_name = $_POST['session_hall'];
            $session_date = $_POST['session_date'];
            $session_time = $_POST['session_time'];
            // $hall_id = $_POST['hall_id'];
            // $price = $_POST['price'];
            // $hall_name = $_POST['hall_name'];
           

            $payment_method = $_POST['payment_method'];
            // echo $payment_method;
            $payment_method = strtoupper($payment_method);
            
            
            

            // Check input is empty
            $errors[] = array();
            $req_fields = array('first_name', 'last_name', 'location', 'contact_number', 'age', 'email', 'session_date', 'payment_method');
            $errors = array_merge($errors, $this->check_req_fields($req_fields));
            

            $max_len_fields = array('first_name' => 20, 'last_name' => 20, 'location' => 30, 'contact_number' => 10, 'age' => 3, 'email' => 30, 'session_date' => 10, 'payment_method' => 13);
            $errors = array_merge($errors, $this->check_max_len($max_len_fields));

            
            
            // Check Email is valid
            if(!$this->is_valid($_POST['first_name'])) {
                $errors['first_name'] = 'First Name is Invalid';
            }

            //check Last Name is valid
            if(!$this->is_valid($_POST['last_name'])) {
                $errors['last_name'] = 'Last Name is Invalid';
            }


            // Check Email is valid
            if(!$this->is_email($_POST['email'])) {
                $errors['email'] = 'Email address is Invalid';
            }

            

            //check Phone number is valid
            if(!$this->is_num($_POST['contact_number'])) {
                $errors['contact_number'] = 'Contact Number is Invalid';
            }
            if(!$this->is_num($_POST['age'])) {
                $errors['age'] = 'Contact Number is Invalid';
            }

            // Check In Date validation
            if(!$this->is_date($_POST['session_date'])) {
                $errors['check_in_date'] = 'Check In Date is Invalid';
            }
            
            
            
            $errors = array_filter( $errors ); 
           
            
            if(count( $errors ) == 0) {
                // Check customer already user
                $dbcustomer = new Customer();
                $result = $dbcustomer->getEmail($email);
                
                if($result == 0) {
                    // Customer already not user

                    $data = array($first_name, $last_name, $location, $contact_num, $age, $email);
                    $result = $dbcustomer->getCreateCustomer($data);

                    if($result == 0) {
                        $errors[] = "Data Created Unsuccessful";
                    }
                     
                }    
                

                // Make Reservation
                
                // Get Customer Id
                $customer= $dbcustomer->getCustomerID($email);
                $customer_id = $customer['customer_id'];

                // Get Hall Id
               
                $hall_id;

                if($hall_name == "White Horse Banquet") {
                    $hall_id = 1;
                }
                elseif($hall_name == "White Elephant Banquet Hall") {
                    $hall_id = 2;
                }
                elseif($hall_name == "White Lion Banquet Hall") {
                    $hall_id = 3;
                }
                

                if(!empty($hall_id)) {
                    // Date Strings convert to Date data types
                    
                    $time1 = strtotime($session_date);
                    $session_date = date('Y-m-d',$time1);
                    $customer_id = (int)$customer_id;
                    
                    $hall_id = (int)$hall_id;
                    // $no_of_guest = (int)$no_of_guest;

                    
                    if($_SESSION['user_id']) {
                        if($_SESSION['user_level'] == "Owner") {
                            $reception_user_id = 1;
                        }
                        else {
                            $reception_user_id = $_SESSION['user_id'];
                            $reception_user_id = (int)$reception_user_id;
                        }
                    }
                        
                    
                
                   
                    $request = 0;
                    
                    
                    $data = array($customer_id, $reception_user_id, $hall_id, $session_date, $session_time,  $request, $payment_method);
                    $dbreservation = new NewHallBanquet();
                    $result = $dbreservation->getCreateReservation($data);

                    if($result == 1) {
                        // echo "Success";
                        // $val = 1; // represent main reservation not room search reservation
                        // $data['create'] = array("value"=>$val);
                        // $data['customer'] = array("id"=>$customer_id);
                        // view::load('dashboard/reservation/reservationOption', $data);

                        // Success and Go to payment process

                        // get hall price
                        $dbreservation = new NewHallBanquet();
                        $hall = $dbreservation->getOneHalleView($hall_id);
                        $price = $hall[0]['price'];
                        
                        $reservation = $dbreservation->getReservationDetails($customer_id, $session_date, $session_time);
                        $reservation_id = $reservation['id'];
                        // echo $reservation_id;
                        // die();
                        

                        $data['reservation'] = array('first_name' => $first_name, 'last_name' => $last_name, 'location' => $location, 'contact_number' => $contact_num, 'age' => $age, 'email' => $email, 'session_date' => $session_date, 'session_time' => $session_time, 'payment_method' => $payment_method,'session_hall'=>$hall_name, 'price'=>$price, 'customer_id'=>$customer_id, 'reservation_id'=>$reservation_id);
                
                        // echo "Succes4";
                        view::load('dashboard/banquet/reservationPayment', $data);

                                
                            
                            
                    }
                        
                    
   
                }
                
                

            }
            else {
                $data['errors'] = $errors;
                $data['reservation'] = array('first_name' => $first_name, 'last_name' => $last_name, 'location' => $location, 'contact_number' => $contact_num, 'age' => $age, 'email' => $email, 'session_date' => $session_date, 'session_time' => $session_time, 'payment_method' => $payment_method,'session_hall'=>$hall_name);
                
                // echo "Succes4";
                view::load('dashboard/banquet/create', $data);
                
                
                
                
            }

        }
    }

    public function payBanquest() {
            

        // Sanitize POST Array
        $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);
    
        $first_name = $POST['first_name'];
        $last_name = $POST['last_name'];
        $email = $POST['email'];
        $contact_number = $POST['contact_number'];
        $hall_name = $POST['session_hall'];
        $hall_view = "Hall Great View";
        $hall_price = $POST['total'];
        $payment_way = $POST['payment_method'];
        $customer_id = $POST['customer_id'];
        $reservation_id = $POST['reservation_id'];
      

        
        $amount = $hall_price;
        
        $amount = $amount*1000;
        

        $stripe_id = "0000";
        $customerstripe_id = "XXXX";
        $hall_description = "Hall Reservation by".$first_name." ".$last_name.":".$email.":".$contact_number;
        $currency = "USD";
        $status = "succeeded";

       

        // Transaction Data
        $transactionData = [
            'reservation_id' => $reservation_id,
            'stripe_id'=> $stripe_id,
            'customerstripe_id'=> $customerstripe_id,
            'customer_id'=> $customer_id,
            'roomdesc'=> $hall_description,
            'amount'=> $amount,
            'currency'=> $currency,
            'status'=> $status
        ];

        // Instantiate Transaction
        $transaction = new Payment();

        // Add Transaction to DB
        $result = $transaction->addTransactionBanquet($transactionData);
        if($result == 1) {
            // Redirect to homepage
            // $dashboard = new DashboardController();
            // $dashboard->index();
            $data['reservation'] = array('reservation_id' => $reservation_id, 'total'=>$hall_price);
            view::load('dashboard/banquet/selectOptionReport', $data);
        }
        
    // }
}

public function generateCustomBill($reservation_id, $total) {
    if(!isset($_SESSION['user_id'])) {
        $dashboard = new DashboardController();
        $dashboard->index();
    }
    else {
       
        $dbreservation = new NewHallBanquet();
        
        $reservation = $dbreservation->getBanquetReservations($reservation_id);
        
        // var_dump($reservation);
        // die();
        
        $customer_id = $reservation['customer_id'];
        $hall_id = $reservation['hall_id'];
        $dbcustomer = new Customer();
        $dbpayment = new Payment();
        
        
        $customer = $dbcustomer->getCustomer($customer_id);
        $hall = $dbreservation->getOneHalleView($hall_id);

        

        // create new PDF document
        // PDF_PAGE_ORIENTATION mean Portrait or Landscape
        // PDF_UNIT mean
        if($reservation['session_type'] == "morning") {
            $session_type =  "Morning Session (9.00AM-3.00PM)";
            $hall_price = $hall[0]['price'] * 1;
        }
        elseif($reservation['session_type'] == "night") {
            $session_type = "Night Session (7.00PM-1.00AM)";
            $hall_price = $hall[0]['price'] * 1;
        }
        elseif($reservation['session_type'] == "both") {
            $session_type = "Both";
            $hall_price = $hall[0]['price'] * 2;
        }
        
        $first_name = $customer['first_name'];
        $last_name = $customer['last_name'];
        $full_name = $first_name." ".$last_name;

        // $Discount = $totalDiscount/$count;

        $Discount = 0;
        $TotalRoomPrice = $hall_price;
        $pdf = new BILLPDF('p', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->setData($full_name, $TotalRoomPrice, $Discount);
        

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Bayfront Hotel');
        $pdf->SetTitle('Customer Bill');
        $pdf->SetSubject('');
        $pdf->SetKeywords('');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
            require_once(dirname(__FILE__).'/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $pdf->SetFont('dejavusans', '', 14, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $pdf->AddPage();

        $pdf->Ln(25);  // height

        date_default_timezone_set("Asia/Colombo");
        $current_date = date('Y-m-d');

        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(189, 3, 'Report as on :- '.$current_date, 0, 1, 'C');
        $pdf->Ln(5);

        
        $pdf->SetFont('times', 'B', 12);
        $pdf->Cell(35, 5, 'Full Name', 0, 0);
        $pdf->Cell(95, 5, ': '.$full_name.'', 0, 0);

        $pdf->Cell(59, 5, 'Customer ID: '.$customer_id.'', 0, 1);

        $pdf->Ln(1);

                // 130+59 =  189
        $pdf->Cell(35, 5, 'Email', 0, 0);
        $pdf->Cell(95, 5, ': '.$customer['email'].'', 0, 0);
        $pdf->Cell(59, 5, 'Method: CASH/ONLINE ', 0, 1);

        $pdf->Ln(1);

        $pdf->Cell(35, 5, 'Contact Number', 0, 0);
        $pdf->Cell(95, 5, ': '.$customer['contact_number'].'', 0, 0);
        $pdf->Cell(59, 5, '', 0, 1);
        $pdf->Ln(1);

        $pdf->Cell(35, 5, 'Country', 0, 0);
        $pdf->Cell(95, 5, ': '.$customer['location'].'', 0, 0);
        $pdf->Cell(59, 5, '', 0, 1);

        $pdf->Ln(5);
        $pdf->SetFont('times', 'B', 15);
        $pdf->Cell(189, 5, 'Dear Customer You Have Following Reservations', 0, 1, 'C');
        $pdf->Ln(10); 

        $pdf->SetFont('times', '', 11);
        $pdf->SetFillColor(224, 235, 255);
                                            //Fill colour or not
        $pdf->Cell(15, 7, 'Re No', 0, 0 , 'C', 1);
        $pdf->Cell(50, 7, 'Hall Name', 0, 0 , 'C', 1);
        $pdf->Cell(50, 7, 'Session Type ', 0, 0 , 'C', 1);
        $pdf->Cell(25, 7, 'Session Date ', 0, 0 , 'C', 1);
        // $pdf->Cell(10, 7, 'Days', 0, 0 , 'C', 1);
        $pdf->Cell(22, 7, 'Hall Price', 0, 0 , 'C', 1);
        $pdf->Cell(22, 7, 'Total Price', 0, 0 , 'C', 1);
        $pdf->SetFont('times', '', 10);
        $pdf->Ln(3);


        $i = 1; // no of page start
        $max = 13; // when sl no == 6 go to next page

        
                        
        $pdf->Ln(6);
        $pdf->Cell(15, 4, $i, 0, 0 , 'C');
        $pdf->Cell(50, 4, ''.$hall[0]['name'].'', 0, 0 , 'C', 1);
        if($reservation['session_type'] == "morning") {
            $session_type =  "Morning Session";
            $hall_price = $hall[0]['price'] * 1;
        }
        elseif($reservation['session_type'] == "night") {
            $session_type = "Night Session";
            $hall_price = $hall[0]['price'] * 1;
        }
        elseif($reservation['session_type'] == "both") {
            $session_type = "Morning & Night Session";
            $hall_price = $hall[0]['price'] * 2;
        }
        $pdf->Cell(50, 4, ''.$session_type.'', 0, 0 , 'C');
        $pdf->Cell(25, 4, ''.$reservation['session_date'].'', 0, 0 , 'C');
        // $pdf->Cell(10, 4, '0', 0, 0 , 'C');
        $pdf->Cell(22, 4, ''.$hall[0]['price'].'', 0, 0 , 'C');
        $pdf->Cell(22, 4, ''.$hall_price.'', 0, 0 , 'C');
        $pdf->SetFont('times', '', 10);
        
        $i++;


        
        // Close and output PDF document
        $pdf->Output('custom_bill.pdf', 'I');

    }

}

  

 

    

    private function date_validation($check_in_date, $check_out_date) {
        date_default_timezone_set("Asia/Colombo");
        $current_date = date('Y-m-d');
        $time1 = strtotime($check_in_date);
        $time2 = strtotime($check_out_date);
        $check_in_date = date('Y-m-d',$time1);
        $check_out_date = date('Y-m-d',$time2);
        $result = 0;
        $validation = 0;
        if($current_date > $check_in_date || $check_in_date >= $check_out_date) {
            $result = 1;
            
        }

        return $result;
    }

    private function date_validationEdit($check_in_date, $check_out_date, $old_check_in_date) {
        date_default_timezone_set("Asia/Colombo");
        $current_date = date('Y-m-d');
        $time1 = strtotime($check_in_date);
        $time2 = strtotime($check_out_date);
        $check_in_date = date('Y-m-d',$time1);
        $check_out_date = date('Y-m-d',$time2);
        $result = 0;
        $validation = 0;


        // $current_date < $check_in_date can ahead reservation change
        if($old_check_in_date > $check_in_date || $check_in_date >= $check_out_date || $current_date > $check_out_date) {
            $result = 1;
            
        }

        return $result;
    }

    private function check_req_fields($req_fields) {
        
        $errors[] = array();

        foreach($req_fields as $field) {
            if(empty(trim($_POST[$field]))) {
                // echo "1";
                $errors[$field] = ' is required';
            }
        }

        return $errors;
    }

    private function check_max_len($max_len_fields) {
        // Check max lengths
        $errors[] = array();
    
        foreach($max_len_fields as $field => $max_len) {
            if(strlen(trim($_POST[$field])) > $max_len ) {
                // echo "2";
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

    private function is_date($date) {
        return(preg_match("/\d{4}\-\d{2}-\d{2}/", $date));
    }

}

?>
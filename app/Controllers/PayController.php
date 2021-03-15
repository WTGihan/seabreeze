<?php 

    session_start();
    require_once 'Libs/payment/vendor/autoload.php';

    class PayController{


        public function paymanual(){
            if(!isset($_SESSION['user_id'])) {
                $dashboard = new DashboardController();
                $dashboard->index();    
            }
            else {
                    $data = array();
                    $db = new Reservation();
                    if(isset($_POST['search'])) {
                        $search = $_POST['search'];
                                          
                            $data['rooms'] = $db->getSearchRoomAll($search);
                            view::load('dashboard/payment/paymentNow/checkout', $data);
                    }
                    else {
                        $data['rooms'] = $db->getAllRoomAll();
                        // var_dump($data['rooms']);
                        // exit;
                        view::load('dashboard/payment/paymentNow/checkout', $data);
                    }
            }
        }
    
        public function checkout($sectionId ,$room_number, $check_in_date, $check_out_date) {
            
    exit;
            if(!isset($_SESSION['user_id'])) {
                $dashboard = new DashboardController();
                $dashboard->index();   
            }
            else {
                 // $db = new Reservation();
                
                
                 $dbroom = new RoomDetails();
                 $room = $dbroom->getRoomID($room_number);
                 $room_id = $room['room_id'];
                 
                 // get that reservation
                 $dbreservation = new Reservation();
                 $reservation = $dbreservation->getReservationDetails($room_id, $check_in_date, $check_out_date);
                 
                //  echo $reservation['reservation_id'];
                //  exit;
                 // get that customer details
                 $customer_id = $reservation['customer_id'];
                 $dbcustomer = new Customer();
                 $customer = $dbcustomer->getCustomer($customer_id);
     
                 //get that reception details
                 $reception_user_id = $reservation['reception_user_id'];
                 $dbreception = new Reception();
                 $reception = $dbreception->getReceptionDetail($reception_user_id);
                 $reception_name = $reception['emp_id'];
                 // echo $reception_name;
     
                 //get room types for room number
                 $room_type_id = $room['type_id'];
                 $dbroom_type = new RoomType();
                 $type = $dbroom_type->getRoomTypeDetail($room_type_id);
                 // echo $reservation_id;

                 $transaction = new Payment();

                // Add Transaction to DB
                $onlinePay = $transaction->readTransaction($reservation['reservation_id']);
                // echo $onlinePay;
                // exit;

     
                 $data['reception'] = $reception;
                 $data['onlinePay'] = $onlinePay;
                 $data['room_type'] = $type;
                 $data['reservation'] = $reservation;
                 $data['room'] = $room;
                 $data['customer'] = $customer;
                $data['sectionId']= $sectionId;
                view::load('dashboard/payment/paymentNow/pay', $data);
                // view::load('dashboard/inc/test', $data);
                
            } 
        }

        public function billprint() {
            
    
            view::load('dashboard/payment/viewBill');
                
        } 
        
    }


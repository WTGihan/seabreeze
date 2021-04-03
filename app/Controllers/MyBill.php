
<?php
require_once (LIBS.'fpdf182/fpdf.php');
$db = new PDO('mysql:host=localhost;dbname=seabreeze','root','');

class MyBill extends FPDF
{
	
	function header()
	{
		$this->Image(BURL.'assets/img/basic/logo.png',5,5,-100);
		$this->setfont('arial', 'B', 13);
		$this->cell(180,4,'Invoice : #'.rand(10000,900000),0,1,'R');
		$this->Ln();
		date_default_timezone_set("Asia/Kolkata"); 
        $Due = date("Y-m-d");
		$this->cell(180,4,'Created: '.$Due,0,1,'R');							
		$this->Ln();
		date_default_timezone_set("Asia/Kolkata"); 
        $Due = date("Y-m-d");
		$this->cell(180,4,'Due: '.$Due,0,1,'R');

			// echo $date->shop_id; exit;
		
			$this->Ln(10);
			$this->setfont('arial', 'B', 13);
			$this->cell(40,8,'Seabreeze Hotel',0,0,'L');
			$this->Ln();
			$this->cell(40,8,'Urawaththa, Ambalangoda',0,0,'L');
			$this->Ln();	
			$this->cell(40,8,'Ambalangoda, Sri Lanka',0,0,'L');
		
		
		$this->Ln(10);
	}
	function footer()
	{
		$this-> setY(-15);
		$this->setfont('arial', '', 8);
		$this->cell(0,10,'page' .$this->PageNo().'/{nb}',0,0,'c');
	}
	function headerTable(){
         $this->setfont('Times', 'B', 10);
         $this->cell(70,10,'#Title',1,0,'C');
         $this->cell(40,10,'Room Rate(LKR)	',1,0,'C');
         $this->cell(30,10,'Nights'	,1,0,'C');
         $this->cell(40,10,'Price(LKR)'	,1,0,'C');
         

	}
	function viewTable($room_id, $room, $reservation,$customer_id,$customer,$reception_user_id,$reception_name, $room_type_id,$type,$onlinePay)
	{
		
		
			$this->Ln();
				// $this->cell(70,10,$reservation['check_in_date'],1,0,'C');
         		// $this->cell(40,10, $datat->sell_unit_price.' LKR',1,0,'C');
				 $this->cell(70,10, $room['room_number'],1,0,'C');
				 $this->cell(40,10, $room['price'],1,0,'C');
                                        
                                        $date1=date_create($reservation['check_in_date']);
                                        $date2=date_create($reservation['check_out_date']);
                                        $diff=date_diff($date1,$date2);
                                        // echo $diff;
                                        // exit;
                                    if(isset($diff)){
                                            
                                        
                                        
                        $this->cell(30,10, $diff->format("%a"),1,0,'C');


                    }
         		// $this->cell(40,10,$data->qty*$datat->sell_unit_price.' LKR',1,0,'R');
			$date1=date_create($reservation['check_in_date']);
                                        $date2=date_create($reservation['check_out_date']);
                                        $diff=date_diff($date1,$date2);
                                        // echo $diff;
                                        // exit;
                                    if(isset($diff)){
                                             $this->cell(40,10, $diff->format("%a")*$room['price'],1,0,'C');
                                        }
                                        
			
		 
		}
		//  exit;
// 		   $this->Ln();

// 		   $this->cell(140,10,'Sub Total'	,0,0,'R');
// 		   $this->cell(40,10,$dataOrder->total_amount.' LKR',0,0,'R');

// 		   $this->Ln();

// 		   $sql=$db->query('SELECT * FROM  return_product WHERE order_id = '.$_GET['order_id'].' LIMIT 1');
// 		   $row2 =$sql->fetch(PDO :: FETCH_OBJ);
// 		   $ret=0;
		   

// 		   if( $row2 != NULL){
			  
// 			   $ret =$row2->return_value;
// 		   }
			
// 		   if($row2 != NULL){
// // 			   echo $row2->return_id;
// // exit;
// 				$sql1=$db->query('SELECT * FROM  return_item WHERE return_id ='.$row2->return_id);
// 				while ($row3 =$sql1->fetch(PDO :: FETCH_OBJ)) {
// // var_dump($row3);
// // exit;
// 					$sql=$db->query('SELECT * FROM  products WHERE product_id = '.$row3->product_id.' LIMIT 1');
// 					$row4 =$sql->fetch(PDO :: FETCH_OBJ);
// 						$this->cell(70,10,$row4->product_name,1,0,'C');
// 						$this->cell(40,10, $row4->sell_unit_price.' LKR',1,0,'R');
// 						$this->cell(30,10,$row3->qty,1,0,'C');
// 						$this->cell(40,10,"-".$row3->qty*$row4->sell_unit_price.' LKR',1,0,'R');
// 						$this->Ln();	
		   
// 				}
// 			}
			
// 			$this->cell(140,10,'Return Total'	,0,0,'R');
// 			$this->cell(40,10,"-".$ret.' LKR',0,0,'R');

// 			$this->Ln();	

// 			$this->cell(140,10,'Total Bill Amount'	,0,0,'L');
// 			$this->cell(40,10,$dataOrder->total_amount-$ret.' LKR',0,0,'R');

// 			$this->Ln();	

// 			$this->cell(140,10,'Payment Recived',0,0,'L');

// 			$this->Ln();	
// 			$sql=$db->query('SELECT * FROM payment WHERE order_id = '.$_GET['order_id'].' ORDER BY payment_id DESC LIMIT 1');
// 			$row5 =$sql->fetch(PDO :: FETCH_OBJ);
// 			$this->cell(140,10,'Cash',0,0,'L');
// 			$this->cell(40,10,$row5->cash_amount.' LKR',0,0,'R');

// 			$this->Ln();
// 			$this->cell(140,10,'Check',0,0,'L');
// 			if($row5->cheque_id == 0) {
// 				$this->cell(40,10,"0.00 LKR",0,0,'R');
// 			}else{
// 				$sql2=$db->query('SELECT * FROM cheque WHERE cheque_id = '.$row5->cheque_id.' LIMIT 1');
// 				$row6 =$sql2->fetch(PDO :: FETCH_OBJ);
// 				$this->cell(40,10,$row6->sub_total.' LKR',0,0,'R');
// 				// echo $row4['sub_total'];;
// 			}
			
// 			$this->Ln();	

// 			$this->cell(140,10,'Full Payment Recived'	,0,0,'L');
// 			$this->cell(40,10,$dataOrder->paid_amount.' LKR',0,0,'R');

// 			$this->Ln();	

// 			$this->cell(140,10,'Payment Arrears'	,0,0,'L');
// 			$this->cell(40,10,($dataOrder->total_amount-$ret)-$dataOrder->paid_amount.' LKR',0,0,'R');

// 			$this->Ln(20);	

// 			$this->cell(140,10,'Signature: ',0,0,'R');
// 			$this->cell(40,10,".............................................",0,0,'c');
			 }




?>

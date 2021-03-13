<?php

require_once (LIBS.'fpdf182/fpdf.php');
$db = new PDO('mysql:host=localhost;dbname=bayfront_hotel','root','');


//require('fpdf182/font/helvetica8.php');
//A4 width :219 mm
//default margin : 10mm each side
//writable horizontal :219. (10*2)=189mm
/**
 * 
 */
class MyRoompdfController extends FPDF
{
	
	function header()
	{
		$this->Image(BURL.'assets/img/basic/logo.png',5,5,-100);
		
		$this->setfont('arial', 'B', 25);
		$this->cell(400,5,'Seabreeze Hotel',0,0,'C');
		$this->Ln();
		
		$this->setfont('Times', '', 15);
		$this->cell(400,10,'Urawaththa, Ambalangoda',0,0,'C');
		$this->Ln();
		$this->Ln();
		$this->cell(400,10,'seabreezesrilanka@gmail.com',0,0,'R');
		$this->Ln();
		$this->cell(400,10,'+94912255161',0,0,'R');
		$this->Ln();
		$this->cell(400,10,'2020-12-4',0,0,'R');
		$this->Ln();
		$this->Ln(30);
		$this->setfont('arial', 'B', 20);
		$this->cell(276,10,'SEABREEZE-ROOMS',0,0,'L');
		$this->Ln(20);
	}
	function footer()
	{
		$this-> setY(-15);
		$this->setfont('arial', '', 8);
		$this->cell(0,10,'page' .$this->PageNo().'/{nb}',0,0,'c');
	}
	function headerTable(){
        $this->setfont('Times', 'B', 14);
        $this->cell(20,10,'Room No',1,0,'C');
        $this->cell(80,10,'Room Name',1,0,'C');
        $this->cell(30,10,'Floor Type',1,0,'C');
        $this->cell(40,10,'Current Price',1,0,'C');
        $this->cell(30,10,'Size',1,0,'C');
        $this->cell(36,10,'Air_Condition',1,0,'C');
        $this->cell(36,10,'View',1,0,'C');
        $this->cell(45,10,'Breakfast Included',1,0,'C');
        $this->cell(45,10,'Hot Water',1,0,'C');
       // $this->cell(45,10,'Free cancelaration',1,0,'C');
        $this->cell(45,10,'Room desc',1,0,'C');
		$this->Ln();
		
    }

	function viewTable($room)
	{
       $this->setfont('Times','',12);
       //$stmt=$db->query('select * from employee');


      // while ($data =$stmt->fetch(PDO :: FETCH_OBJ)) {
          foreach($room as $data) {

			  $this->setfont('Times', '', 14);
			

         $this->cell(20,10,$data['room_number'] ,1,0,'C');
         $this->cell(80,10,$data['room_name'] ,1,0,'C');
         $this->cell(30,10,$data['floor_type'] ,1,0,'C');
         $this->cell(40,10,$data['price'],1,0,'C');
         $this->cell(30,10,$data['room_size'],1,0,'C');
         $this->cell(36,10,$data['air_condition'],1,0,'C');
         $this->cell(36,10,$data['room_view'],1,0,'C');
         $this->cell(45,10,$data['breakfast_included'],1,0,'C');
         $this->cell(45,10,$data['hot_water'],1,0,'C');
        // $this->cell(45,10,$data['free_cancelaration'],1,0,'C');
         $this->cell(45,10,$data['room_desc'],1,0,'C');
         $this->Ln();


       }
	}
	
	
}




?>

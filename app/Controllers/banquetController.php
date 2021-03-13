<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
class BanquetController{
    
    public function index()
    {
        View::load('banquet');
    }

    public function ViewSubPage($id)
    {
        $data['id'] = $id;
        View::load('sub/banquetView', $data);
    }
}

?>
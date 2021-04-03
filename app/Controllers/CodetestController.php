<?php
session_start();
class CodetestController{
   
    public function selectDetails()
    {
        $db = new Codetest;
        $data['rooms'] = $db->roomAllDetails();
        // var_dump($data['rooms'] );
        // exit;
        // exit;
        VIEW::load('dashboard/editweb/select', $data);
    }

}
?>
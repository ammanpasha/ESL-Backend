<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/email.php';

    $test = new Email();

   //get posted data
   $data = json_decode(file_get_contents("php://input"));

   //echo json_encode($data);
   
   $test->email = $data->email;
   $test->name = $data->name;
   $test->phone = $data->phone;
   $test->org = $data->org;
   $test->sub = $data->sub;
   $test->msg = $data->msg;
   $test->debug = $data->debug;
  
   $res = $test->send();
   echo json_encode($res);
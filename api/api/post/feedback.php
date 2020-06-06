<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/email.php';

    $test = new Email();

   //get posted data
   $data = json_decode(file_get_contents("php://input"));

   //echo json_encode($data);
   
   $test->debug = $data->debug;
   $test->email = $data->email;
   $test->feedbackRating = $data->feedbackRating;
   $test->feedback = $data->feedback;
   $test->name = $data->name;
  
   $res = $test->feedback();
   echo json_encode($res);

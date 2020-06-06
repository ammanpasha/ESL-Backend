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
   $test->name = $data->name;
   $test->eqp = $data->eqp;
   $test->vol = $data->vol;
   $test->terms = $data->terms;
   $test->BLmentioned = $data->BLmentioned;
   $test->tradeLane = $data->tradeLane;
   $test->pol = $data->pol;
   $test->pod = $data->pod;
   $test->supplierDetails = $data->supplierDetails;
   $test->CNEEdetails = $data->CNEEdetails;
   $test->notifyCNEE = $data->notifyCNEE;
   //$test->eqp = $data->eqp;
   $test->cmdty = $data->cmdty;
   $test->grossWeight = $data->grossWeight;
   $test->encashmentCert = $data->encashmentCert;
   $test->ftaCert = $data->ftaCert;
   $test->certOfOrigin = $data->certOfOrigin;
   $test->exportLiscense = $data->exportLiscense;
   $test->comments = $data->comments;
   $test->phone = $data->phone;
  
   $res = $test->booking();
   echo json_encode($res);

   //http://www.express-shipping.com/api/api/post/booking.php
   // test edit
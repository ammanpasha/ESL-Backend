<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, X-Requested-With');

    include_once '../../../config/Database.php';
    include_once '../../../models/pod.php';

    $database = new Database();
    $db = $database->connect();

    $test = new Pod($db);

    //get posted data
    $data = json_decode(file_get_contents("php://input"));

    $test->name = $data->name;
    $test->idx = $data->idx;
    $test->isForAir = $data->isForAir;
    $test->isForFcl = $data->isForFcl;
    $test->isForLcl = $data->isForLcl;

    $res = $test->update();
    echo json_encode($res);
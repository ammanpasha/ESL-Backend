<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, X-Requested-With');

    include_once '../../../config/Database.php';
    include_once '../../../models/vendor.php';

    $database = new Database();
    $db = $database->connect();

    $test = new Vendor($db);

    //get posted data
    $data = json_decode(file_get_contents("php://input"));

    $test->name = $data->name;
    $test->idx = $data->idx;

    $res = $test->update();
    echo json_encode($res);
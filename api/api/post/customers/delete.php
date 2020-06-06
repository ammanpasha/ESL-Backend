<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../../config/Database.php';
    include_once '../../../models/customers.php';

    $database = new Database();
    $db = $database->connect();

    $test = new Customer($db);
    $test->idx = isset($_GET['idx']) ? $_GET['idx'] : -1;

    $res = $test->delete();
    echo json_encode($res);
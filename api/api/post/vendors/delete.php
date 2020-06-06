<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../../config/Database.php';
    include_once '../../../models/vendor.php';

    $database = new Database();
    $db = $database->connect();

    $test = new Vendor($db);
    $test->idx = isset($_GET['idx']) ? $_GET['idx'] : -1;

    $res = $test->delete();
    echo json_encode($res);
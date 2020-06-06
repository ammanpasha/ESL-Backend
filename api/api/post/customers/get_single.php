<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../../config/Database.php';
    include_once '../../../models/customers.php';

    $database = new Database();
    $db = $database->connect();

    $test = new Customer($db);
    $test->idx = isset($_GET['idx']) ? $_GET['idx'] : -1;

    $res = $test->get_single();
    $num = $res->rowCount();

    if($num > 0)
    {
        $test_arr = array();
        while($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $test_item = array(
                'idx' => $idx,
                'name' => $name
            );
            array_push($test_arr,$test_item);
        }
        echo json_encode($test_arr);
    }
    else
    {
        $test_arr = array();
        echo json_encode($test_arr);
    }
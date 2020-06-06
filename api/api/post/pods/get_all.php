<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../../config/Database.php';
    include_once '../../../models/pod.php';

    $database = new Database();
    $db = $database->connect();

    $test = new Pod($db);


    $res = $test->get_all();
    $num = $res->rowCount();

    if($num > 0)
    {
        $test_arr = array();
        while($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $test_item = array(
                'idx' => $idx,
                'name' => $name,
                'isForAir' => $isForAir,
                'isForFcl' => $isForFcl,
                'isForLcl' => $isForLcl
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
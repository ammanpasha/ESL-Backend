<?php
ini_set('display_errors', 1);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, X-Requested-With');
    
    include_once '../../config/Database.php';
    include_once '../../models/test.php';
    $database = new Database();
    $db = $database->connect();

    $test = new Test($db);
    if(isset($_GET["pol"]))
    {
    $test->rpol = $_GET["pol"];
    }
    if(isset($_GET["pod"]))
    {
        $test->rrpod = $_GET["pod"];
    }
    $res = $test->getrates();
    $num = $res->rowCount();
    if($num > 0)
    {
        $test_arr = array();
        while($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $test_item = array(
                'idx' => $idx,
                    'pol' => $pol,
                    'pod' => $pod,
                    'equipidx' => $equipment,
                    'equip' => $rctype,
                    'rate' => $rate,
                    'efd' => $effectiveDate,
                    'exd' => $expiryDate,
                    'notes' => $notes,
                    'addedby' => $addedOn,
                    'addedon' => $addedBy
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

?>
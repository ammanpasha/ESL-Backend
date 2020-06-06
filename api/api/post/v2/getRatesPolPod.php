<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, X-Requested-With');

include_once '../../../config/Database.php';
include_once '../../../models/pol.php';
include_once '../../../models/pod.php';

try {
    $database = new Database();
    $db = $database->connect();

    $all_data = array();

    $pol = new Pol($db);

    $pol_arr = array();
    $pod_arr = array();

    //get pols
    $res = $pol->get_all_for_rates();
    $num = $res->rowCount();

    if ($num > 0) {
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $pol_item = array(
                'name' => $pol
            );
            array_push($pol_arr, $pol_item);
        }
    }

    //get pods
    $pod = new Pod($db);

    $res = $pod->get_all_for_rates();
    $num = $res->rowCount();

    if ($num > 0) {
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $pod_item = array(
                'name' => $pod
            );
            array_push($pod_arr, $pod_item);
        }
    }


    $resp = array(
        'iserror' => false,
        'error' => '',
        'pols' => $pol_arr,
        'pods' => $pod_arr
    );
    echo json_encode($resp);
} catch (Exception $e) {
    $resp = array(
        'iserror' => true,
        'error' => $e->getMessage()
    );
    echo json_encode($resp);
}

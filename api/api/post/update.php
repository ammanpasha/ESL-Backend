<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/test.php';

    $database = new Database();
    $db = $database->connect();

    $test = new Test($db);

    //get posted data
    $data = json_decode(file_get_contents("php://input"));

    $test->idx = $data->idx;
    $test->equip = $data->equip;
    $test->customer = $data->customer;
    $test->consignee = $data->consignee;
    $test->pol = $data->pol;
    $test->pod = $data->pod;
    $test->carriercoloader = $data->carriercoloader;
    $test->sell = $data->sell;
    $test->buy = $data->buy;
    $test->volume = $data->volume;
    $test->cbm = $data->cbm;
    $test->air = $data->air;
    $test->mbl = $data->mbl;
    $test->hbl = $data->hbl;
    $test->invoice = $data->invoice;
    $test->etd = $data->etd;
    $test->eta = $data->eta;
    $test->nw = $data->nw;
    $test->gw = $data->gw;
    $test->it = $data->it;
    $test->ft = $data->ft;
    $test->cs = $data->cs;
    $test->vs = $data->vs;
    $test->containers = $data->containers;
    $test->vendor = $data->vendor;

    $res = $test->update();
    echo json_encode($res);
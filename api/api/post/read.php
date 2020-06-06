<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/test.php';

    $database = new Database();
    $db = $database->connect();

    $test = new Test($db);


    $res = $test->read();
    $num = $res->rowCount();

    if($num > 0)
    {
        $test_arr = array();
        while($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $test_item = array(
                'idx' => $idx,
                    'equip' => $equip,
                    'ronum' => $ronum,
                    'customer' => $customer,
                    'consignee' => $consignee,
                    'pol' => $pol,
                    'pod' => $pod,
                    'carriercoloader' => $carriercoloader,
                    'sell' => $sell,
                    'buy' => $buy,
                    'volume' => $volume,
                    'cbm' => $cbm,
                    'air' => $air,
                    'mbl' => $mbl,
                    'hbl' => $hbl,
                    'invoice' => $invoice,
                    'etd' => $etd,
                    'eta' => $eta,
                    'gw' => $grossweight,
                    'nw' => $netweight,
                    'ft' => $fterm,
                    'it' => $iterm,
                    'cs' => $cstatus,
                    'vs' => $vstatus,
                    'ei' => $ei,
                    'vendor' => $vendor,
                    'containers' => array()
            );
            $test->idx = $test_item['idx'];
            $res_cntrs = $test->get_containers_by_masteridx();
            $num_cntrs = $res_cntrs->rowCount();
            
            while($row_cntr = $res_cntrs->fetch(PDO::FETCH_ASSOC))
            {
                extract($row_cntr);
                $foo = array(
                    'idx' => $idx,
                    'type' => $type,
                    'containerno' => $containerno,
                    'sealno' => $sealno,
                    'weight' => $weight,
                    'masteridx' => $masteridx
                );
                array_push($test_item['containers'], $foo);
            }
            array_push($test_arr,$test_item);
            
        }
        echo json_encode($test_arr);
    }
    else
    {
        $test_arr = array();
        echo json_encode($test_arr);
    }
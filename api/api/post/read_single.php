<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/test.php';

    try{
        $database = new Database();
        $db = $database->connect();
        $test = new Test($db);

        $test->idx = isset($_GET['idx']) ? $_GET['idx'] : -1;

        $res = $test->read_single();
        $num = $res->rowCount();
        
        if($num > 0)
        {
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
                
                
            }
            echo json_encode($test_item);
        }
        else
        {
            $test_item = array(
                
            );
            echo json_encode($test_item);
        }
}
catch(Exception $e) {
    echo 'Error: ' .$e->getMessage();
  }
    
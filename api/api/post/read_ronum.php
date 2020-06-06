<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/test.php';

try {
    $database = new Database();
    $db = $database->connect();
    $test = new Test($db);

    $type = '';
    if (isset($_GET['type'])) {
        $type = $_GET['type'];
    } else {
        $test_item = array(
            'error' => 'type not set.'
        );
        echo json_encode($test_item);
        return;
    }


    if ($type == "ro") {
        if (!isset($_GET['ronum'])) {
            $test_item = array(
                'error' => 'ronum not set.'
            );
            echo json_encode($test_item);
            return;
        }
        $test->ronum = isset($_GET['ronum']) ? $_GET['ronum'] : -1;
        $res = $test->get_by_idx();
    } else {
        if (!isset($_GET['mbl'])) {
            $test_item = array(
                'error' => 'mbl not set.'
            );
            echo json_encode($test_item);
            return;
        }
        $test->mbl = isset($_GET['mbl']) ? $_GET['mbl'] : -1;
        $res = $test->get_by_mbl();
    }

    $num = $res->rowCount();

    if ($num > 0) {
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
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
                'containers' => array(),
                'trackinginfo' => new stdClass(),
                '_debug_search_term_' => $type
            );


            $prefix_param = substr($test_item['mbl'], 0, 4);
            $trackres = $test->get_tracking_info($prefix_param);
            $numtrack = $trackres->rowCount();

            if ($numtrack > 0) {
                while ($trkrow = $res->fetch(PDO::FETCH_ASSOC)) {
                    extract($trkrow);
                    $test_item['trackinginfo']->prefix = $prefix;
                    $test_item['trackinginfo']->carrier = $carrier;
                    $test_item['trackinginfo']->url = $url;
                    $test_item['trackinginfo']->debug_prefix_term = $prefix_param;
                }
            } else {
                $test_item['trackinginfo'] = null;
            }

            $test->idx = $idx;
            $res_cntrs = $test->get_containers_by_masteridx();
            $num_cntrs = $res_cntrs->rowCount();
            while ($row_cntr = $res_cntrs->fetch(PDO::FETCH_ASSOC)) {
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
    } else {
        $test_item = array(
            'idx' => '-1'
        );
        echo json_encode($test_item);
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

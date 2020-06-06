<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    
    include_once '../../config/Database.php';
    include_once '../../models/test.php';

    $database = new Database();
    $db = $database->connect();

    $test = new Test($db);

    try{
        $rto = array(
            'customers' => array(),
            'vendors' => array(),
            'pols' => array(),
            'pods' => array(),
            'carriers' => array(),
            'incoterms' => array(),
            'freightterms' => array(),
            'custstatus' => array(),
            'vendstatus' => array(),
            'isError' => false,
            'error' => ''
        );

        //customers
        $res = $test->get_customers();
        while($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $foo = array(
                'idx' => $idx,
                'name' => $name
            );
            array_push($rto['customers'], $foo);
        }

        //vendors
        $res = $test->get_vendors();
        while($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $foo = array(
                'idx' => $idx,
                'name' => $name
            );
            array_push($rto['vendors'], $foo);
        }

        //pols
        $res = $test->get_pols();
        while($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $foo = array(
                'idx' => $idx,
                'name' => $name
            );
            array_push($rto['pols'], $foo);
        }

        //pods
        $res = $test->get_pods();
        while($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $foo = array(
                'idx' => $idx,
                'name' => $name
            );
            if($isForAir)
            {
                $foo['isForFcl'] = false;
                $foo['isForLcl'] = false;
                $foo['isForAir'] = true;
            }
            else if($isForLcl)
            {
                $foo['isForFcl'] = false;
                $foo['isForLcl'] = true;
                $foo['isForAir'] = false;
            }
            else if($isForFcl)
            {
                $foo['isForFcl'] = true;
                $foo['isForLcl'] = false;
                $foo['isForAir'] = false;
            }
            array_push($rto['pods'], $foo);
        }

        //carriers
        $res = $test->get_carriers();
        while($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $foo = array(
                'idx' => $idx,
                'name' => $name
            );
            if($isAir){
                $foo['isAir'] =true;
            }
            else{
                $foo['isAir'] =false;
            }
            array_push($rto['carriers'], $foo);
        }

        //incoterms
        $res = $test->get_incoterms();
        while($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $foo = array(
                'idx' => $idx,
                'name' => $name
            );
            array_push($rto['incoterms'], $foo);
        }

        //freightterms
        $res = $test->get_frieghtterms();
        while($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $foo = array(
                'idx' => $idx,
                'name' => $name
            );
            array_push($rto['freightterms'], $foo);
        }

        //custstatus
        $res = $test->get_custstatus();
        while($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $foo = array(
                'idx' => $idx,
                'name' => $name
            );
            array_push($rto['custstatus'], $foo);
        }

        //vendstatus
        $res = $test->get_vendstatus();
        while($row = $res->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $foo = array(
                'idx' => $idx,
                'name' => $name
            );
            array_push($rto['vendstatus'], $foo);
        }

        //send object
        echo json_encode($rto);
    }
    catch(Exception $e){
        $rto = array(
            'customers' => array(),
            'vendors' => array(),
            'pols' => array(),
            'pods' => array(),
            'carriers' => array(),
            'incoterms' => array(),
            'freightterms' => array(),
            'custstatus' => array(),
            'vendstatus' => array(),
            'isError' => true,
            'error' => $e->getMessage()
        );
        echo json_encode($rto);
    }
<?php
    class Test{
        private $conn;
        private $table='rofiles';

        public $idx;
        public $equip;
        public $ronum;
        public $customer;
        public $consignee;
        public $pol;
        public $pod;
        public $carriercoloader;
        public $sell;
        public $buy;
        public $volume;
        public $cbm;
        public $air;
        public $mbl;
        public $hbl;
        public $invoice;
        public $etd;
        public $eta;
        public $nw;
        public $gw;
        public $it;
        public $ft;
        public $cs;
        public $vs;
        public $vendor;
        public $ei;
        public $addedon;
        public $containers = array();

        //RATES
        public $ridx;
        public $rpol = "";
        public $rrpod = "";
        public $requipidx;
        public $rctype;
        public $rrate;
        public $refd;
        public $rexd;
        public $rnotes;
        public $raddedBy;
        public $addedOn;
        public function __construct($db)
        {
            $this->conn = $db;
        }

        //get data
        public function read()
        {
            $qry = 'SELECT * FROM rofiles ORDER BY idx desc';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }
        
        public function getrates()
        {
            if( $this->rpol != "" || $this->rrpod != "")
            {
                if($this->rpol != "" && $this->rrpod != "")
                {
                    $qry = "SELECT r.* , c.idx as cidx , c.cType as rctype FROM rates as r
                    inner join containertypes as c on r.equipment = c.idx
                    where pol like '%%" .$this->rpol . "%%' and pod like '%%" .$this->rrpod . "%%'  and 
                    expiryDate > '".date("Y.m.d")."'
                     ORDER BY idx desc";
                }
                else if($this->rpol !="")
                {
                    $qry = "SELECT r.* , c.idx as cidx , c.cType as rctype FROM rates as r
                    inner join containertypes as c on r.equipment = c.idx
                    where pol like '%%" .$this->rpol . "%%' and 
                    expiryDate > '".date("Y.m.d")."'
                     ORDER BY idx desc";
                }
                else if($this->rrpod !="")
                {
                    $qry = "SELECT r.* , c.idx as cidx , c.cType as rctype FROM rates as r
                    inner join containertypes as c on r.equipment = c.idx
                    where pod like '%%".$this->rrpod."%%' and 
                    expiryDate > '".date("Y.m.d")."'
                     ORDER BY idx desc";
                }
            
            }
            else{
                $qry = "SELECT r.* , c.idx as cidx , c.cType as rctype FROM rates as r inner join containertypes as c on r.equipment = c.idx where expiryDate > '".date("Y.m.d")."' ORDER BY idx desc";
            }
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }
        public function getratesby_all()
        {
            $qry = 'SELECT r.* , c.idx as cidx , c.cType as rctype FROM rates as r inner join containertypes as c on r.equipment = c.idx ORDER BY idx desc';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }
        //Search Result
        public function searchlist()
        {

            $qry = 'SELECT * FROM rofiles ';

            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }

        //get data by idx
        public function read_single()
        {
            $qry = 'SELECT * FROM rofiles where idx = ' . $this->idx;
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }

        //get data by idx
        public function get_containers_by_masteridx()
        {
            $qry = 'SELECT * FROM rofilescontainers WHERE masteridx = ' . $this->idx;
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }
        public function get_customers_frmfile()
        {
            $qry = 'SELECT distinct(customer) FROM rofiles';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }
        //create new
        public function create()
        {
            try{
                //clean data
                $this->equip = htmlspecialchars(strip_tags($this->equip));
                $this->ronum = htmlspecialchars(strip_tags($this->ronum));
                $this->customer = htmlspecialchars(strip_tags($this->customer));
                $this->consignee = htmlspecialchars(strip_tags($this->consignee));
                $this->pol = htmlspecialchars(strip_tags($this->pol));
                $this->pod = htmlspecialchars(strip_tags($this->pod));
                $this->carriercoloader = htmlspecialchars(strip_tags($this->carriercoloader));
                $this->sell = htmlspecialchars(strip_tags($this->sell));
                $this->buy = htmlspecialchars(strip_tags($this->buy));
                $this->volume = htmlspecialchars(strip_tags($this->volume));
                $this->cbm = htmlspecialchars(strip_tags($this->cbm));
                $this->air = htmlspecialchars(strip_tags($this->air));
                $this->mbl = htmlspecialchars(strip_tags($this->mbl));
                $this->hbl = htmlspecialchars(strip_tags($this->hbl));
                $this->invoice = htmlspecialchars(strip_tags($this->invoice));
                $this->nw = htmlspecialchars(strip_tags($this->nw));
                $this->gw = htmlspecialchars(strip_tags($this->gw));
                $this->it = htmlspecialchars(strip_tags($this->it));
                $this->ft = htmlspecialchars(strip_tags($this->ft));
                $this->cs = htmlspecialchars(strip_tags($this->cs));
                $this->vs = htmlspecialchars(strip_tags($this->vs));
                $this->vendor = htmlspecialchars(strip_tags($this->vendor));

                if($this->sell == ""){
                    $this->sell = "0";
                }
                if($this->buy == ""){
                    $this->buy = "0";
                }
                if($this->cbm == ""){
                    $this->cbm = "0";
                }
                if($this->air == ""){
                    $this->air = "0";
                }
                if($this->nw == ""){
                    $this->nw = "0";
                }
                if($this->gw == ""){
                    $this->gw = "0";
                }

                //$this->ronum = " ";

                $newIdx = substr($this->ronum, -5);

                $qry = "INSERT INTO 
                `rofiles`(`idx`,`equip`, `ronum`, `customer`, `consignee`, `pol`, `pod`, `carriercoloader`, `sell`, `buy`, 
                 `volume`, `cbm`, `air`, `mbl`, `hbl`, `invoice`, `etd`, `eta`, `netweight`, `grossweight`, `iterm`,`fterm`, `cstatus`,`vstatus`,`vendor`, `ei`) 
                VALUES ('$newIdx', '$this->equip', '$this->ronum', 
                '$this->customer', '$this->consignee', 
                '$this->pol', '$this->pod', '$this->carriercoloader', 
                '$this->sell', '$this->buy', 
                '$this->volume', '$this->cbm', '$this->air', 
                '$this->mbl', '$this->hbl', '$this->invoice', 
                '$this->etd', '$this->eta', 
                '$this->nw', '$this->gw',
                '$this->it', '$this->ft',
                '$this->cs', '$this->vs',
                '$this->vendor', '$this->ei')";

                $stmt = $this->conn->prepare($qry);

                $autoRoNum = false;
                //echo($qry);
                if($stmt->execute())
                {
                    if($autoRoNum){
                        $LAST_ID = $this->conn->lastInsertId();
                        $newRoNum = "";
                        if($this->equip == "FCL"){
                            $newRoNum = "ES-" . $this->equip . "-1";
                        }
                        else if($this->equip == "LCL"){
                            $newRoNum = "ES-" . $this->equip . "-2";
                        }
                        else if($this->equip == "AIR"){
                            $newRoNum = "ES-" . $this->equip . "-3";
                        }
    
                        $last_id_str = $LAST_ID . "";
                        if(strlen($last_id_str) == 1){
                            $last_id_str = "000" . $last_id_str;
                        }
                        else if(strlen($last_id_str) == 2){
                            $last_id_str = "00" . $last_id_str;
                        }
                        else if(strlen($last_id_str) == 3){
                            $last_id_str = "0" . $last_id_str;
                        }
                        else if(strlen($last_id_str) == 4){
                            $last_id_str =  $last_id_str;
                        }
    
                        $newRoNum = $newRoNum . $last_id_str;
    
                        //$newRoNum = "ES-" . $this->equip . "-" . $LAST_ID;
                        $roNumQry = "UPDATE rofiles SET ronum = '$newRoNum' WHERE idx = '$LAST_ID'";
                        $stmtRoNum = $this->conn->prepare($roNumQry);
                        $stmtRoNum->execute();
                        if(count($this->containers) > 0)
                        {
                            $qrynew = 'INSERT INTO `rofilescontainers`(`type`, `containerno`, `sealno`, `weight`, `masteridx`) VALUES';
                        
                            $container_count = count($this->containers);
                            $index = 1;
                            foreach ($this->containers as $cntr) {
                                $type = $cntr->type;
                                $cntno = $cntr->containerno;
                                $sealno = $cntr->sealno;
                                $weight = $cntr->weight;
                                $qrynew = $qrynew . " ('$type','$cntno','$sealno', '$weight','$LAST_ID')";
                                if($container_count > 1 && $index != $container_count)
                                {
                                    $qrynew = $qrynew . ", ";
                                }
                                $index++;
                            }
                            
                            $stmtnew = $this->conn->prepare($qrynew);
                            $stmtnew->execute();
                        }
                        $resp = array(
                            'iserror' => false,
                            'error' => '',
                            'idx' => $LAST_ID,
                            'ronum' => $newRoNum
                        );
                        return $resp;
                    }
                    else{
                        $roNumQry = "UPDATE rofiles SET ronum = '$this->ronum' WHERE idx = '$newIdx'";
                        $stmtRoNum = $this->conn->prepare($roNumQry);
                        $stmtRoNum->execute();
                        if(count($this->containers) > 0)
                        {
                            $qrynew = 'INSERT INTO `rofilescontainers`(`type`, `containerno`, `sealno`, `weight`, `masteridx`) VALUES';
                        
                            $container_count = count($this->containers);
                            $index = 1;
                            foreach ($this->containers as $cntr) {
                                $type = $cntr->type;
                                $cntno = $cntr->containerno;
                                $sealno = $cntr->sealno;
                                $weight = $cntr->weight;
                                $qrynew = $qrynew . " ('$type','$cntno','$sealno', '$weight','$newIdx')";
                                if($container_count > 1 && $index != $container_count)
                                {
                                    $qrynew = $qrynew . ", ";
                                }
                                $index++;
                            }
                            
                            $stmtnew = $this->conn->prepare($qrynew);
                            $stmtnew->execute();
                        }
                        $resp = array(
                            'iserror' => false,
                            'error' => '',
                            'idx' => $newIdx,
                            'ronum' => $this->ronum
                        );
                        return $resp;
                    }
                    
                }

            }
            catch(Exception $e)
            {
                $resp = array(
                    'iserror' => true,
                    'error' => $e->getMessage(),
                    'idx' => -1,
                    'ronum' => -1
                );
                return $resp;
            }
        }

        //delete
        public function delete()
        {
            try{
                $qry = 'DELETE FROM rofiles where idx = ' . $this->idx;
                $stmt = $this->conn->prepare($qry);
                $stmt->execute();
                $qry = 'DELETE FROM rofilescontainers where masteridx = ' . $this->idx;
                $stmt = $this->conn->prepare($qry);
                $stmt->execute();
                $resp = array(
                    'iserror' => false,
                    'error' => ''
                );
                return $resp;
            }
            catch(Exception $e)
            {
                $resp = array(
                    'iserror' => true,
                    'error' => $e->getMessage()
                );
                return $resp;
            }
        }

        //get info by ronum
        public function get_by_ronum()
        {
            $qry = "SELECT * FROM rofiles where ronum = '$this->ronum'";
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }
        //get info by idx (ronum)
        public function get_by_idx()
        {
            $qry = "SELECT * FROM rofiles where idx = '$this->ronum'";
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }

        public function get_by_mbl()
        {
            //mbl
            $qry = "SELECT * FROM rofiles where mbl = '$this->mbl'";
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }

        public function get_tracking_info($param_prefix)
        {
            // carriertrackinginfo
            $qry = "SELECT * FROM carriertrackinginfo where prefix = '$param_prefix'";
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }

        public function update()
        {
            try{
                //clean data
                $this->equip = htmlspecialchars(strip_tags($this->equip));
                $this->customer = htmlspecialchars(strip_tags($this->customer));
                $this->consignee = htmlspecialchars(strip_tags($this->consignee));
                $this->pol = htmlspecialchars(strip_tags($this->pol));
                $this->pod = htmlspecialchars(strip_tags($this->pod));
                $this->carriercoloader = htmlspecialchars(strip_tags($this->carriercoloader));
                $this->sell = htmlspecialchars(strip_tags($this->sell));
                $this->buy = htmlspecialchars(strip_tags($this->buy));
                $this->volume = htmlspecialchars(strip_tags($this->volume));
                $this->cbm = htmlspecialchars(strip_tags($this->cbm));
                $this->air = htmlspecialchars(strip_tags($this->air));
                $this->mbl = htmlspecialchars(strip_tags($this->mbl));
                $this->hbl = htmlspecialchars(strip_tags($this->hbl));
                $this->invoice = htmlspecialchars(strip_tags($this->invoice));
                //$this->etd = htmlspecialchars(strip_tags($this->etd));
                //$this->eta = htmlspecialchars(strip_tags($this->eta));
                

                $idxtest = $this->idx;

                if($this->sell == "")
                {
                    $this->sell = "0";
                }
                if($this->buy == "")
                {
                    $this->buy = "0";
                }
                if($this->cbm == "")
                {
                    $this->cbm = "0";
                }
                if($this->air == "")
                {
                    $this->air = "0";
                }

                $qry = "UPDATE `rofiles` SET 
                `equip`='$this->equip',
                `customer`='$this->customer',
                `consignee`='$this->consignee',
                `pol`='$this->pol',
                `pod`='$this->pod',                
                `carriercoloader`='$this->carriercoloader',
                `sell`='$this->sell',
                `buy`='$this->buy',
                `volume`='$this->volume',
                `cbm`='$this->cbm',
                `air`='$this->air',
                `mbl`='$this->mbl',
                `hbl`='$this->hbl',
                `invoice`='$this->invoice',
                `etd`='$this->etd',
                `eta`='$this->eta',
                `vendor`= '$this->vendor',
                `netweight`= '$this->nw',
                `grossweight`= '$this->gw',
                `fterm`= '$this->ft',
                `iterm`= '$this->it',
                `cstatus`= '$this->cs',
                `vstatus`= '$this->vs'
                 WHERE `idx` = $this->idx";
                //echo $qry;
                $stmt = $this->conn->prepare($qry);

                if($stmt->execute())
                {
                    $qry = 'DELETE FROM rofilescontainers where masteridx = ' . $idxtest;
                    $stmt = $this->conn->prepare($qry);
                    $stmt->execute();

                    //$LAST_ID = $this->conn->lastInsertId();
                    
                    if(count($this->containers) > 0)
                    {
                        $qrynew = 'INSERT INTO `rofilescontainers`(`type`, `containerno`, `sealno`, `weight`, `masteridx`) VALUES';
                    
                        $container_count = count($this->containers);
                        $index = 1;
                        foreach ($this->containers as $cntr) {
                            $type = $cntr->type;
                            $cntno = $cntr->containerno;
                            $sealno = $cntr->sealno;
                            $weight = $cntr->weight;
                            $qrynew = $qrynew . " ('$type','$cntno','$sealno', '$weight','$idxtest')";
                            if($container_count > 1 && $index != $container_count)
                            {
                                $qrynew = $qrynew . ", ";
                            }
                            $index++;
                        }
                        $stmtnew = $this->conn->prepare($qrynew);
                        $stmtnew->execute();
                    }
                    
                    $resp = array(
                        'iserror' => false,
                        'error' => ''
                    );
                    return $resp;
                }

            }
            catch(Exception $e)
            {
                $resp = array(
                    'iserror' => true,
                    'error' => $e->getMessage()
                );
                return $resp;
            }
        }

        public function get_customers()
        {
            $qry = 'SELECT * FROM customers';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }
        
        public function get_vendors()
        {
            $qry = 'SELECT * FROM vendors';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }

        public function get_carriers()
        {
            $qry = 'SELECT * FROM carriers';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }

        public function get_pols()
        {
            $qry = 'SELECT * FROM pol';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }

        public function get_pods()
        {
            $qry = 'SELECT * FROM pod';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }

        public function get_incoterms()
        {
            $qry = 'SELECT * FROM incoterms';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }

        public function get_frieghtterms()
        {
            $qry = 'SELECT * FROM frieghtterms';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }

        public function get_custstatus()
        {
            $qry = 'SELECT * FROM custstatus';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }

        public function get_vendstatus()
        {
            $qry = 'SELECT * FROM vendstatus';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }
    }
<?php
    class Pod{
        private $conn;

        public $idx;
        public $name;
        public $isForAir;
        public $isForFcl;
        public $isForLcl;

        public $pod;
        
        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function get_all()
        {
            $qry = 'SELECT * FROM pod';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }
        
        public function get_single()
        {
            $qry = "SELECT * FROM pod WHERE idx  = '$this->idx'";
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }

        public function get_all_for_rates()
        {
            $qry = 'SELECT DISTINCT pod FROM rates';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }

        public function create()
        {
            try{
                //clean data
                $this->name = htmlspecialchars(strip_tags($this->name));
                $qry = "INSERT INTO `pod`(`name`, `isForAir`, `isForFcl`, `isForLcl`) VALUES ('$this->name', '$this->isForAir', '$this->isForFcl', '$this->isForLcl')";
                $stmt = $this->conn->prepare($qry);
                $stmt->execute();
                $resp = array(
                    'iserror' => false,
                    'error' => ""
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

        public function update()
        {
            try{
                //clean data
                $this->name = htmlspecialchars(strip_tags($this->name));
                $qry = "UPDATE `pod` SET name = '$this->name', isForAir = '$this->isForAir'
                , isForFcl = '$this->isForFcl', isForLcl = '$this->isForLcl' where idx = '$this->idx'";
                $stmt = $this->conn->prepare($qry);
                $stmt->execute();
                $resp = array(
                    'iserror' => false,
                    'error' => ""
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

        public function delete()
        {
            try{
                //clean data
                $qry = "DELETE FROM `pod` where idx = '$this->idx'";
                $stmt = $this->conn->prepare($qry);
                $stmt->execute();
                $resp = array(
                    'iserror' => false,
                    'error' => ""
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
    }
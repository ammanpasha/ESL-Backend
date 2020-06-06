<?php
    class Pol{
        private $conn;

        public $idx;
        public $name;

        public $pol;
        
        
        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function get_all()
        {
            $qry = 'SELECT * FROM pol';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }

        public function get_all_for_rates()
        {
            $qry = 'SELECT DISTINCT pol FROM rates';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }
        
        public function get_single()
        {
            $qry = "SELECT * FROM pol WHERE idx  = '$this->idx'";
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }
        public function create()
        {
            try{
                //clean data
                $this->name = htmlspecialchars(strip_tags($this->name));
                $qry = "INSERT INTO `pol`(`name`) VALUES ('$this->name')";
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
                $qry = "UPDATE `pol` SET name = '$this->name' where idx = '$this->idx'";
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
                $qry = "DELETE FROM `pol` where idx = '$this->idx'";
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
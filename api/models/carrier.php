<?php
    class Carrier{
        private $conn;

        public $idx;
        public $name;
        public $isAir;
        
        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function get_all()
        {
            $qry = 'SELECT * FROM carriers';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }
        
        public function get_single()
        {
            $qry = "SELECT * FROM carriers WHERE idx  = '$this->idx'";
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }
        public function create()
        {
            try{
                //clean data
                $this->name = htmlspecialchars(strip_tags($this->name));
                $qry = "INSERT INTO `carriers`(`name`, `isAir`) VALUES ('$this->name', '$this->isAir')";
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
                $qry = "UPDATE `carriers` SET name = '$this->name', isAir = '$this->isAir' where idx = '$this->idx'";
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
                $qry = "DELETE FROM `carriers` where idx = '$this->idx'";
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
<?php
    class Vendor{
        private $conn;

        public $idx;
        public $name;
        
        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function get_all()
        {
            $qry = 'SELECT * FROM vendors';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }
        
        public function get_single()
        {
            $qry = "SELECT * FROM vendors WHERE idx  = '$this->idx'";
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }
        public function create()
        {
            try{
                //clean data
                $this->name = htmlspecialchars(strip_tags($this->name));
                $qry = "INSERT INTO `vendors`(`name`) VALUES ('$this->name')";
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
                $qry = "UPDATE `vendors` SET name = '$this->name' where idx = '$this->idx'";
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
                $qry = "DELETE FROM `vendors` where idx = '$this->idx'";
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
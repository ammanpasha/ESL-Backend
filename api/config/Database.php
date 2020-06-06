<?php
    class Database{
        private $host = 'ft-mysql.cyjdi9flse23.us-east-1.rds.amazonaws.com'; //change host here
        private $db = 'expresss_expshipping'; 
        private $usr = 'admin';
        private $pwd = 'My$ql7878';
        private $conn;

        public function connect()
        {
            $this->conn = null;
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db, $this->usr, $this->pwd);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        }
    }
<?php
    class News{
        private $conn;

        public $news_id;
        public $news_title;
        public $news_description;
        
        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function get_all()
        {
            $qry = 'SELECT * FROM tbl_news order by news_id desc';
            $stmt = $this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }
    }
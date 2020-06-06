<?php
include '../../conn.php';
$conn = new	conn();
$cone =$conn->open();
// Create connection
if ($cone->connect_error) {
    die("Connection failed: " . $cone->connect_error);
}

if(isset($_GET["idx"]))
    {
        $idx = $_GET["idx"];
        $sql1 = "Delete from `containertypes` where idx = ".$idx.";";
        $result = $cone->query($sql1);
        return true;
    }
?>
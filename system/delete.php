<?php 
    if(isset($_GET['id'])){
        $mysqli = new mysqli("localhost", "root", "", "expshipping");
        if($mysqli === false){
            die("ERROR: Could not connect. " . $mysqli->connect_error);
        }

        $sql = "DELETE FROM rofiles where idx = " . $_GET['id'] . "";
        $mysqli->query($sql);
        $mysqli->close();
        echo("<script>location.reload();</script>");
    }
    else
    {
        echo("<script>location.reload();</script>");
    }
?>
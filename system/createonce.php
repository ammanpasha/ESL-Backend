<?php
 include 'conn.php';
 $sql = '';
 $sql = "create table containertypes (`idx` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,cType varchar(500) NOT NULL, addedOn datetime NOT NULL, addedBy int(11) NOT NULL)";


    $conn = new	conn();
    $cone =$conn->open();
    // Create connection
    if ($cone->connect_error) {
        die("Connection failed: " . $cone->connect_error);
    }

    if ($cone->query($sql) === TRUE) {
        echo "Table containertypes created successfully";
    } else {
        echo "Error creating c**types: " . $cone->error;
    }

    $conn = new	conn();
    $cone =$conn->open();
    // Create connection
    if ($cone->connect_error) {
        die("Connection failed: " . $cone->connect_error);
    }
    $sql ="create table rates (`idx` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, pol varchar(500) NOT NULL, pod varchar(500) NOT NULL, equipment int(11) NOT NULL, rate decimal(18,2) NOT NULL, effectiveDate date NOT NULL, expiryDate date NOT NULL, notes varchar(2048) NOT NULL, addedBy int(11) NOT NULL, addedOn datetime NOT NULL)";
    if ($cone->query($sql) === TRUE) {
        echo "Table rates created successfully";
    } else {
        echo "Error creating r***s: " . $cone->error;
    }
    return true;

?>
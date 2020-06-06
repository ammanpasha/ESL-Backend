<form id='frm' method='post' action='far.php'>
<input type='text' id='fart' name='fart'/>
<select id='mysel' name='mysel'>
    <?php
    include 'conn.php';
    // Create connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    $sql1 = "SELECT distinct customer FROM roFiles";
    $result = $con->query($sql1);
while($row = $result->fetch_assoc()) {
?>
    <option value=<?php Print($row['customer']) ?>><?php Print($row["customer"]) ?></option>
<?php
}
$con->close();
?>
</select>
<hr/>
<input type='submit' value='GO' />
</form>
<?php
if(empty($_POST["fart"]))
{
    ?>
    <script>alert('hoo ha')</script>
    <?php
}

?>
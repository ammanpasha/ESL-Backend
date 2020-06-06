<html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<style>
    .col-md-3{
        padding-top: 2% !important;
    }
</style>

<form method="post" action="insert.php">
    <div class="form-group container">
        <div class="row">
            <div class="col-md-3">
                <label>Equip</label>
                <input class="form-control" type="text" id="equip" name="equip">

                <label>RoNum</label>
                <input class="form-control" type="text" id="RoNum" name="RoNum">

                <label>customer</label>
                <input class="form-control" type="text" id="customer" name="customer">
            </div>
            <div class="col-md-3">
                <label>consignee</label>
                <input class="form-control" type="text" id="consignee" name="consignee">

                <label>pol</label>
                <input class="form-control" type="text" id="pol" name="pol">

                <label>carrier/CoLoader</label>
                <input class="form-control" type="text" id="carrierCoLoader" name="carrierCoLoader">
            </div>
            <div class="col-md-3">
                <label>sell</label>
                <input  class="form-control" type="text" id="sell" name="sell">

                <label>buy</label>
                <input  class="form-control" type="text" id="buy" name="buy">

                <label>cm</label>
                <input  class="form-control" type="text" id="cm" name="cm">
            </div>
            <div class="col-md-3">
                <label>cm percentage</label>
                <input  class="form-control" type="text" id="cmpercentage" name="cmpercentage">

                <label>volume 20</label>
                <input  class="form-control" type="text" id="volume20" name="volume20">

                <label>volume 40</label>
                <input  class="form-control" type="text" id="volume40" name="volume40">
            </div>
            <div class="col-md-3">
                <label>volume 40 HC</label>
                <input  class="form-control" type="text" id="volume40hc" name="volume40hc">

                <label>total</label>
                <input  class="form-control" type="text" id="total" name="total">

                <label>cbm</label>
                <input  class="form-control" type="text" id="cbm" name="cbm">
            </div>
            <div class="col-md-3">
                <label>air</label>
                <input  class="form-control" type="text" id="air" name="air">

                <label>carrier</label>
                <input  class="form-control" type="text" id="carrier" name="carrier">

                <label>ref num</label>
                <input  class="form-control" type="text" id="refnum" name="refnum">
            </div>
            <div class="col-md-3">
                <label>mbl</label>
                <input  class="form-control" type="text" id="mbl" name="mbl">

                <label>hbl</label>
                <input  class="form-control" type="text" id="hbl" name="hbl">

                <label>invoice</label>
                <input  class="form-control" type="text" id="invoice" name="invoice">
            </div>
            <div class="col-md-3">
                <label>etd</label>
                <input  class="form-control" type="date" id="etd" name="etd">

                <label>eta</label>
                <input  class="form-control" type="date" id="eta" name="eta">

                <label>payment status</label>
                <input  class="form-control" type="text" id="paymentstatus" name="paymentstatus">
            </div>
            <div class="col-md-3">
                <label>remarks</label>
                <input  class="form-control" type="text" id="remarks" name="remarks">

                <label>week</label>
                <input  class="form-control" type="text" id="week" name="week">

                <label>year</label>
                <input  class="form-control" type="text" id="year" name="year">
            </div>
            <div class="col-md-3">
                <label>period</label>
                <input  class="form-control" type="text" id="period" name="period">

                <label>trade lines</label>
                <input  class="form-control" type="text" id="tradelines" name="tradelines">

                <label>verticals</label>
                <input  class="form-control" type="text" id="verticals" name="verticals">
            </div>
            <div class="col-md-3">
                <label>ei</label>
                <input  class="form-control" type="text" id="ei" name="ei">

                <label>total teus</label>
                <input  class="form-control" type="text" id="totalteus" name="totalteus">

                <label>sales rep</label>
                <input  class="form-control" type="text" id="salesrep" name="salesrep">

            </div>
            <div class="col-md-3">
                <label>quote</label>
                <input  class="form-control" type="text" id="quote" name="quote">

                <br>
                <input  class="btn btn-primary" type="submit" id="Submit" name="Submit" onsubmit="void(0);">
                <span onclick="window.history.back();" class="btn btn-info">Back</span>
            </div>
        </div>
    </div>
</form>

<?php

if(isset($_POST['Submit'])) 
{
    $mysqli = new mysqli("localhost", "root", "", "expshipping");
    
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
    
    $equip = $mysqli->real_escape_string($_REQUEST['equip']);
    $RoNum = $mysqli->real_escape_string($_REQUEST['RoNum']);
    $customer = $mysqli->real_escape_string($_REQUEST['customer']);
    $consignee = $mysqli->real_escape_string($_REQUEST['consignee']);
    $pol = $mysqli->real_escape_string($_REQUEST['pol']);
    $carrierCoLoader = $mysqli->real_escape_string($_REQUEST['carrierCoLoader']);
    $sell = $mysqli->real_escape_string($_REQUEST['sell']);
    $buy = $mysqli->real_escape_string($_REQUEST['buy']);
    $cm = $mysqli->real_escape_string($_REQUEST['cm']);
    $cmpercentage = $mysqli->real_escape_string($_REQUEST['cmpercentage']);
    $volume20 = $mysqli->real_escape_string($_REQUEST['volume20']);
    $volume40 = $mysqli->real_escape_string($_REQUEST['volume40']);
    $volume40hc = $mysqli->real_escape_string($_REQUEST['volume40hc']);
    $total = $mysqli->real_escape_string($_REQUEST['total']);
    $cbm = $mysqli->real_escape_string($_REQUEST['cbm']);
    $air = $mysqli->real_escape_string($_REQUEST['air']);
    $carrier = $mysqli->real_escape_string($_REQUEST['carrier']);
    $refnum = $mysqli->real_escape_string($_REQUEST['refnum']);
    $mbl = $mysqli->real_escape_string($_REQUEST['mbl']);
    $hbl = $mysqli->real_escape_string($_REQUEST['hbl']);
    $invoice = $mysqli->real_escape_string($_REQUEST['invoice']);
    $etd = $mysqli->real_escape_string($_REQUEST['etd']);
    $eta = $mysqli->real_escape_string($_REQUEST['eta']);
    $paymentstatus = $mysqli->real_escape_string($_REQUEST['paymentstatus']);
    $remarks = $mysqli->real_escape_string($_REQUEST['remarks']);
    $week = $mysqli->real_escape_string($_REQUEST['week']);
    $year = $mysqli->real_escape_string($_REQUEST['year']);
    $period = $mysqli->real_escape_string($_REQUEST['period']);
    $tradelines = $mysqli->real_escape_string($_REQUEST['tradelines']);
    $verticals = $mysqli->real_escape_string($_REQUEST['verticals']);
    $ei = $mysqli->real_escape_string($_REQUEST['ei']);
    $totalteus = $mysqli->real_escape_string($_REQUEST['totalteus']);
    $salesrep = $mysqli->real_escape_string($_REQUEST['salesrep']);
    $quote = $mysqli->real_escape_string($_REQUEST['quote']);


    $sql = "INSERT INTO 
    `rofiles`(`equip`, `roNum`, `customer`, `consignee`, `pol`, `carrierCoLoader`, `sell`, `buy`, 
    `cm`, `cmPercentage`, `vol20`, `vol40`, `vol40HC`, `total`, `cbm`, `air`, `carrier`, `refNum`, 
    `mbl`, `hbl`, `invoice`, `etd`, `eta`, `paymentStatus`, `remarks`, `week`, `year`, `period`, 
    `tradelines`, `verticals`, `ei`, `totalTeus`, `salesRep`, `quote`) 
    VALUES ('$equip', '$RoNum', '$customer', '$consignee', '$pol', '$carrierCoLoader', '$sell', '$buy'
    , '$cm', '$cmpercentage', '$volume20', '$volume40', '$volume40hc', '$total', '$cbm', '$air', '$carrier', '$refnum'
    , '$mbl', '$hbl', '$invoice', '$etd', '$eta', '$paymentstatus', '$remarks', '$week', '$year', '$period'
    , '$tradelines', '$verticals', '$ei', '$totalteus', '$salesrep', '$quote')";
    
    

    if($mysqli->query($sql) === true){
        echo "data inserted";
        echo("<script>location.href = '/exship/index.php';</script>");
        die();
    } else{
        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;

    }
        // Close connection
    
    $mysqli->close();
    
}
?>
</html>
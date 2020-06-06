<?php
session_start();

if ( isset( $_SESSION['idx'] ) && isset( $_SESSION['email'] ) ) {
    //all good
} else {
    // Redirect them to the login page
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View</title>
</head>
<!--Auth Check Start-->

<!--Auth Check End-->

<body>
    <style>
    .col-md-3{
        padding-top: 1%;
    }
    #wrap {
  min-height: 100%;
  height: auto;
  /* Negative indent footer by its height */
  margin: 0 auto -60px;
  /* Pad bottom by footer height */
  padding: 0 0 60px;
}

/* Set the fixed height of the footer here */
#footer {
  height: 60px;
  background-color: #f5f5f5;
}

    </style>
    <!-- Bootstrap -->

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://bootswatch.com/_vendor/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="index.php">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
            aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
               
            </ul>

            <form class="form-inline my-2 my-lg-0">
                <button class="btn btn-danger my-2 my-sm-0" type="button" id="logout">Logout</button>
            </form>
        </div>
    </nav>
    <br>
    <div class="" style="width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;">
        <div class="card bg-primary text-white">
            <div class="card-header bg-primary">Job Details</div>
            <div class="card-body bg-white" style="color: black;">
                <form method="post" action="insert.php">
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <strong>RO Number</strong>
                                <input class="form-control" type="text" id="ronum" name="ronum">
                            </div>
                            <div class="col-md-3">
                                <strong>E/I</strong>
                                <input class="form-control" type="text" id="ei" name="ei">
                            </div>
                            <div class="col-md-3">
                                <strong>Equip</strong>
                                <input class="form-control" type="text" id="equip" name="equip">
                            </div>
                            <div class="col-md-3">
                                <strong>Customer</strong>
                                <input class="form-control" type="text" id="customer" name="customer">
                            </div>
                            <div class="col-md-3">
                                <strong>Shipper/Consignee</strong>
                                <input class="form-control" type="text" id="consignee" name="consignee">
                            </div>
                            <div class="col-md-3">
                                <strong>POL</strong>
                                <input class="form-control" type="text" id="pol" name="pol">
                            </div>
                            <div class="col-md-3">
                                <strong>POD</strong>
                                <input class="form-control" type="text" id="pod" name="pod">
                            </div>
                            <div class="col-md-3">
                                <strong>Vendor</strong>
                                <input class="form-control" type="text" id="vendor" name="">
                            </div>
                            <div class="col-md-3">
                                <strong>Carrier</strong>
                                <input class="form-control" type="text" id="carrierCoLoader" name="">
                            </div>
                            <div class="col-md-3">
                                <strong>Buy</strong>
                                <input class="form-control" type="text" id="buy" name="buy">
                            </div>
                            <div class="col-md-3">
                                <strong>Sell</strong>
                                <input class="form-control" type="text" id="sell" name="sell">
                            </div>
                            <div class="col-md-3" name="fclDiv" style="display: none;">
                                <strong>Volume</strong>
                                <input class="form-control" type="text" id="volume" name="volume">
                            </div>
                            <div class="col-md-3" name="lclDiv"  style="display: none;">
                                <strong>CBM</strong>
                                <input class="form-control" type="text" id="cbm" name="cbm">
                            </div>
                            <div class="col-md-3" name="airDiv"  style="display: none;">
                                <strong>KGs</strong>
                                <input class="form-control" type="text" id="air" name="air">
                            </div>
                            <div class="col-md-3">
                                <strong>MBL</strong>
                                <input class="form-control" type="text" id="mbl" name="mbl">
                            </div>
                            <div class="col-md-3">
                                <strong>HBL</strong>
                                <input class="form-control" type="text" id="hbl" name="hbl">
                            </div>
                            <div class="col-md-3">
                                <strong>Gross Weight</strong>
                                <input class="form-control" type="text" id="gw" name="gw">
                            </div>
                            <div class="col-md-3">
                                <strong>Net Weight</strong>
                                <input class="form-control" type="text" id="nw" name="nw">
                            </div>
                            <div class="col-md-3">
                                <strong>Invoice</strong>
                                <input class="form-control" type="text" id="invoice" name="invoice">
                            </div>
                            <div class="col-md-3">
                                <strong>ETD</strong>
                                <input class="form-control" type="text" id="etd" name="etd">
                            </div>
                            <div class="col-md-3">
                                <strong>ETA</strong>
                                <input class="form-control" type="text" id="eta" name="eta">
                            </div>
                            <div class="col-md-3">
                                <strong>Incoterm</strong>
                                <input class="form-control" type="text" id="it" name="it">
                            </div>
                            <div class="col-md-3">
                                <strong>Freight Term</strong>
                                <input class="form-control" type="text" id="ft" name="ft">
                            </div>
                            <div class="col-md-3">
                                <strong>Customer Status</strong>
                                <input class="form-control" type="text" id="cs" name="cs">
                            </div>
                            <div class="col-md-3">
                                <strong>Vendor Status</strong>
                                <input class="form-control" type="text" id="vs" name="vs">
                            </div>
                            <div class="col-md-3">
                                <br>
                                <span onclick="window.location='SearchJobs.php';" class="btn btn-info">Back To List</span>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card bg-primary text-white" name="fclDiv"  style="display: none;">
                    <div class="card-header bg-primary">Container(s) Details</div>
                    <div class="card-body bg-white" style="color: black;">
                        <div class="table-responsive">
                                <table class="table table-hover" id="ctbl">
                                        <thead>
                                            <th>Container #</th>
                                            <th>Type</th>
                                            <th>Weight</th>
                                        </thead>
                                        <tbody id="cbody">
            
                                        </tbody>
                                    </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <br>

<!-- Footer -->
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="url.js"></script>

    <script>
        $(document).ready(function () {
            $("#logout").click(() => {
                window.location = "logout.php";
            });
        });
    </script>
    <script>
        function getParameterByName(name, url) {
            if (!url) url = window.location.href;
            name = name.replace(/[\[\]]/g, "\\$&");
            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, " "));
        }

        $(document).ready(function () {
            $("input").prop("disabled", true);
            var idx = getParameterByName("idx");
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": url + "/read_single.php?idx=" + idx,
                "method": "GET"
            }

            $.ajax(settings).done(function (r) {
                $("#ronum").val(parseSpecialChars(r.ronum));
                $("#consignee").val(parseSpecialChars(r.consignee));
                $("#customer").val(parseSpecialChars(r.customer));
                $("#equip").val(parseSpecialChars(r.equip));
                $("#pol").val(parseSpecialChars(r.pol));
                $("#pod").val(parseSpecialChars(r.pod));
                $("#carrierCoLoader").val(parseSpecialChars(r.carriercoloader));
                $("#sell").val(parseSpecialChars(r.sell));
                $("#buy").val(parseSpecialChars(r.buy));
                $("#volume").val(parseSpecialChars(r.volume));
                $("#cbm").val(parseSpecialChars(r.cbm));
                $("#air").val(parseSpecialChars(r.air));
                $("#mbl").val(parseSpecialChars(r.mbl));
                $("#hbl").val(parseSpecialChars(r.hbl));
                $("#invoice").val(parseSpecialChars(r.invoice));
                $("#etd").val(parseSpecialChars(r.etd));
                $("#eta").val(parseSpecialChars(r.eta));
                $("#it").val(parseSpecialChars(r.it));
                $("#ft").val(parseSpecialChars(r.ft));
                $("#cs").val(parseSpecialChars(r.cs));
                $("#vs").val(parseSpecialChars(r.vs));
                $("#ei").val(parseSpecialChars(r.ei));
                $("#vendor").val(parseSpecialChars(r.vendor));
                $("#gw").val(parseSpecialChars(r.gw));
                $("#nw").val(parseSpecialChars(r.nw));
                console.log(parseSpecialChars(r.containers));
                console.log(r);
                r.containers.forEach(c => {
                    var row = `<tr>
                                    <td>${parseSpecialChars(c.containerno)}</td>
                                    <td>${parseSpecialChars(c.type)}</td>
                                    <td>${parseSpecialChars(c.weight)}</td>
                                </tr>`;
                    $("#cbody").append(row);
                });
                $("#ctbl").DataTable();

                if(r.equip == "FCL"){
                    $("[name=fclDiv]").show();
                    $("[name=lclDiv]").hide();
                    $("[name=airDiv]").hide();
                }
                else if(r.equip == "LCL"){
                    $("[name=fclDiv]").hide();
                    $("[name=lclDiv]").show();
                    $("[name=airDiv]").hide();
                }
                else if(r.equip == "AIR"){
                    $("[name=fclDiv]").hide();
                    $("[name=lclDiv]").hide();
                    $("[name=airDiv]").show();
                }

            });
        });
    </script>
</body>

</html>
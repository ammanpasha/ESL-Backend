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
  <title></title>
</head>
<!--Auth Check Start-->

<!--Auth Check End-->

<body>
  <style>
    #wrap {
      min-height: 100%;
      height: auto;
      margin: 0 auto -60px;
      padding: 0 0 60px;
    }

    .col-md-3 {
      padding-top: 1%;
    }

    #footer {
      height: 60px;
      background-color: #4285F4;
    }
  </style>

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
                <div class="row">
                  <div class="col-md-6">
                    <strong>E/I</strong>
                    <select class="form-control" id="ei">
                      <option value="-1">SELECT</option>
                      <option value="IMPORT">IMPORT</option>
                      <option value="EXPORT">EXPORT</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <strong>Equip</strong>
                    <select class="form-control" id="equip" disabled>
                      <option value="-1">SELECT</option>
                      <option value="FCL">FCL</option>
                      <option value="LCL">LCL</option>
                      <option value="AIR">AIR</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <strong>Customer</strong>
                <select class="form-control" id="customer">
                </select>
              </div>
              <div class="col-md-3">
                <strong>Shipper/Consignee</strong>
                <input class="form-control" type="text" id="consignee" name="consignee">
              </div>
              <div class="col-md-3">
                <div class="row">
                  <div class="col-md-6">
                    <strong>POL</strong>
                    <select class="form-control" id="pol" disabled>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <strong>POD</strong>
                    <select class="form-control" id="pod" disabled>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="row">
                  <div class="col-md-6">
                    <strong>Vendor</strong>
                    <select class="form-control" id="vendorFcl">
                    </select>
                    <input class="form-control" type="text" id="vendorAir" style="display: none;">
                  </div>
                  <div class="col-md-6">
                    <strong>Carrier</strong>
                    <select class="form-control" id="carrierFcl">
                    </select>
                    <input class="form-control" type="text" id="carrierAir" style="display: none;">
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="row">
                  <div class="col-md-6">
                    <strong>Buy</strong>
                    <input class="form-control" type="number" step="0.01" id="buy" name="buy">
                  </div>
                  <div class="col-md-6">
                    <strong>Sell</strong>
                    <input class="form-control" type="number" step="0.01" id="sell" name="sell">
                  </div>
                </div>
              </div>

              <div class="col-md-3" id="volumeDiv" style="display: none;">
                <strong>Volume</strong>
                <select class="form-control" id="volume">
                  <option value="-1">SELECT</option>
                  <option value="20">20</option>
                  <option value="40">40</option>
                  <option value="40 HC">40 HC</option>
                </select>
              </div>
              <div class="col-md-3" id="cbmDiv" style="display: none;">
                <strong>CBM</strong>
                <input class="form-control" type="number" step="0.01" id="cbm" name="cbm">
              </div>
              <div class="col-md-3" id="airDiv" style="display: none;">
                <strong>KGs</strong>
                <input class="form-control" type="number" step="0.01" id="air" name="air">
              </div>
              <div class="col-md-3">
                <div class="row">
                  <div class="col-md-6">
                    <strong>Net Weight</strong>
                    <input class="form-control" type="number" step="0.01" id="netw8">
                  </div>
                  <div class="col-md-6">
                    <strong>Gross Weight</strong>
                    <input class="form-control" type="number" step="0.01" id="grossw8">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="row">
                  <div class="col-md-6">
                    <strong>ETD</strong>
                    <input class="form-control" type="date" id="etd" name="etd">
                  </div>
                  <div class="col-md-6">
                    <strong>ETA</strong>
                    <input class="form-control" type="date" id="eta" name="eta">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="row">
                  <div class="col-md-6">
                    <strong>MBL</strong>
                    <input class="form-control" type="text" id="mbl" name="mbl">
                  </div>
                  <div class="col-md-6">
                    <strong>HBL</strong>
                    <input class="form-control" type="text" id="hbl" name="hbl">
                  </div>
                </div>
              </div>


              <div class="col-md-3">
                <div class="row">
                  <div class="col-md-6">
                    <strong>Incoterm</strong>
                    <select class="form-control" id="iterms"></select>
                  </div>
                  <div class="col-md-6">
                    <strong>Freight Term</strong>
                    <select class="form-control" id="fterms"></select>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <strong>Invoice</strong>
                <input class="form-control" type="text" id="invoice" name="invoice">
              </div>
              <div class="col-md-3">
                <strong>Customer Status</strong>
                <select class="form-control" id="cstatus">
                </select>
              </div>
              <div class="col-md-3">
                <strong>Vendor Status</strong>
                <select class="form-control" id="vstatus">
                </select>
              </div>
            </div>
          </div>
        </form>
        <div class="card bg-primary text-white" id="containerDiv">
          <div class="card-header bg-primary">
            <div class="row">
              <div class="col-md-4">
                Container(s) Details
              </div>
              <div class="col-md-4">
                <span>&nbsp;</span>
              </div>
              <div class="col-md-4">

              </div>
            </div>
          </div>
          <div class="card-body bg-white" style="color: black;">
            <div class="row">
              <div class="col-md-2">
                <strong>Container #</strong>
                <input id="cntno" type="text" placeholder="Container #" class="form-control">
              </div>
              <div class="col-md-2">
                <strong>Weight</strong>
                <input id="weight" type="number" step="0.01" placeholder="Weight" class="form-control">
              </div>
              <div class="col-md-2">
                <strong>Container Type</strong>
                <select class="form-control" id="type">
                  <option value="-1">SELECT TYPE</option>
                  <option value="20 FT">20 FT</option>
                  <option value="40 FT">40 FT</option>
                  <option value="40 FT HC">40 FT HC</option>
                </select>
              </div>
              <div class="col-md-2">
                <hr>
                <input id="addcntr" type="button" value="Add Container" class="btn btn-success my-2 my-sm-0">
              </div>
              <div class="col-md-2">
                <hr>
                <p class="text-danger" id="cntrerr"></p>
              </div>
            </div>
            <hr>
            <div class="table-responsive">
              <table class="table table-hover" id="ctbl">
                <thead>
                  <th>Container #</th>
                  <th>Type</th>
                  <th>Weight</th>
                  <th></th>
                </thead>
                <tbody id="cbody">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer bg-white" style="color: black;">
        <center>
          <a href="#" class="btn btn-primary" id="save">Save</a>
          <span onclick="window.history.back();" class="btn btn-warning">Back To List</span>
        </center>
        <center>
          <span class="text-danger" id="err"></p>
        </center>
      </div>
    </div>
  </div>
  <br>
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
    function removeContainer(x) {
      var contno = ($(x).attr("data-cntrno"));
      for (var i = 0; i < thisjob.containers.length; i++) {
        if (
          thisjob.containers[i].containerno == contno
        ) {
          console.log("found, removing");
          thisjob.containers.splice(i, 1);
          $(`#${contno}_tr`).remove();
          break;
        }
      }
    }
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
      $("#logout").click(() => {
        window.location = "logout.php";
      });

      $("#addcntr").click(() => {
        var cntno = $("#cntno").val();
        var type = $("#type option:selected").val();
        var weight = $("#weight").val();

        if (cntno == "" || type == "-1" || weight == 0 || weight == "") {
          $("#cntrerr").text("Please provide all inputs.");
          return false;
        }
        $("#cntrerr").text("");
        var c = {};
        c.containerno = cntno;
        c.sealno = " ";
        c.type = type;
        c.weight = weight;
        thisjob.containers.push(c);
        console.log(thisjob);

        $("#cntno").val('');
        $("#sealno").val('');
        $("#weight").val('');

        var row = `<tr id="${c.containerno}_tr">
                                    <td>${c.containerno}</td>
                                    <td>${c.type}</td>
                                    <td>${c.weight}</td>
                                    <td><button class="btn btn-danger" data-cntrno="${c.containerno}" onClick="removeContainer(this)">REMOVE</button></td>
                                </tr>`;
        $("#cbody").append(row);
      });

      //$("#").prop("disabled", true);
    });
  </script>
  <script>
    var thisjob = {};
    thisjob.containers = [];

    $(document).ready(function () {
      //load data and fill form
      var idx = getParameterByName("idx");
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": url + "/read_single.php?idx=" + idx,
        "method": "GET"
      }
      $.ajax(settings).done(function (r) {
        $("#idx").val(parseSpecialChars(r.idx));
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
        $("#etd").val(parseSpecialChars(r.etd.split(' ')[0]));
        $("#eta").val(parseSpecialChars(r.eta.split(' ')[0]));
        $("#netw8").val(parseSpecialChars(r.nw));
        $("#grossw8").val(parseSpecialChars(r.gw));
        $("#ei").val(r.ei).change();

        console.log(r.containers);
        r.containers.forEach(c => {
          var row = `<tr id="${c.containerno}_tr">
                                    <td>${parseSpecialChars(c.containerno)}</td>
                                    <td>${parseSpecialChars(c.sealno)}</td>
                                    <td>${parseSpecialChars(c.type)}</td>
                                    <td>${parseSpecialChars(c.weigh)t}</td>
                                    <td><button class="btn btn-danger" data-cntrno="${c.containerno}" onClick="removeContainer(this)">REMOVE</button></td>
                                </tr>`;
          $("#cbody").append(row);
        });
        thisjob = r;
        if(r.equip == "AIR"){
          $("#volumeDiv").hide();
          $("#airDiv").show();
          $("#cbmDiv").hide();
          $("#containerDiv").hide();
        }
        else if(r.equip == "FCL"){
          $("#volumeDiv").show();
          $("#airDiv").hide();
          $("#cbmDiv").hide();
          $("#containerDiv").show();
        }
        else if(r.equip == "LCL"){
          $("#volumeDiv").hide();
          $("#airDiv").hide();
          $("#cbmDiv").show();
          $("#containerDiv").hide();
        }

        console.log("thisjob=");
        console.log(thisjob);
      });


      var settingsD = {
        "async": true,
        "crossDomain": true,
        "url": url + "/get_form_data.php",
        "method": "GET"
      };

      $.ajax(settingsD).done(function (r) {
        console.log(r);
        alldata = r;

        alldata.vendors.forEach(function (c) {
          $("#vendorFcl").append(`<option value="${c.name}">${c.name}</option>`);
          $("#vendorFcl").val(thisjob.vendor).change();
        });
        alldata.customers.forEach(function (c) {
          $("#customer").append(`<option value="${c.name}">${c.name}</option>`);
          $("#customer").val(thisjob.customer).change();
        });

        alldata.incoterms.forEach(function (c) {
          $("#iterms").append(`<option value="${c.name}">${c.name}</option>`);
          $("#iterms").val(thisjob.it).change();

        });

        alldata.freightterms.forEach(function (c) {
          $("#fterms").append(`<option value="${c.name}">${c.name}</option>`);
          $("#fterms").val(thisjob.ft).change();

        });

        alldata.custstatus.forEach(function (c) {
          $("#cstatus").append(`<option value="${c.name}">${c.name}</option>`);
          $("#cstatus").val(thisjob.cs).change();

        });

        alldata.vendstatus.forEach(function (c) {
          $("#vstatus").append(`<option value="${c.name}">${c.name}</option>`);
          $("#vstatus").val(thisjob.vs).change();

        });

        var ei = $("#ei option:selected").val();
        if (ei == "IMPORT") {
          alldata.pols.forEach(function (c) {
            $("#pol").append(`<option value="${c.name}">${c.name}</option>`);
          });

          var val = $("#equip option:selected").val();

          if (val == "FCL") {
            for (var i = 0; i < alldata.pods.length; i++) {
              if (alldata.pods[i].isForFcl) {
                $("#pod").append(`<option value="${alldata.pods[i].name}">${alldata.pods[i].name}</option>`);
              }
            }
          }
          else if (val == "LCL") {
            for (var i = 0; i < alldata.pods.length; i++) {
              if (alldata.pods[i].isForLcl) {
                $("#pod").append(`<option value="${alldata.pods[i].name}">${alldata.pods[i].name}</option>`);
              }
            }
          }
          else if (val == "AIR") {
            for (var i = 0; i < alldata.pods.length; i++) {
              if (alldata.pods[i].isForAir) {
                $("#pod").append(`<option value="${alldata.pods[i].name}">${alldata.pods[i].name}</option>`);
              }
            }
          }
        }
        else if (ei == "EXPORT") {
          var val = $("#equip option:selected").val();
          
          alldata.pols.forEach(function (c) {
            $("#pod").append(`<option value="${c.name}">${c.name}</option>`);
          });
          if (val == "FCL") {
            for (var i = 0; i < alldata.pods.length; i++) {
              if (alldata.pods[i].isForFcl) {
                $("#pol").append(`<option value="${alldata.pods[i].name}">${alldata.pods[i].name}</option>`);
              }
            }
          }
          else if (val == "LCL") {
            for (var i = 0; i < alldata.pods.length; i++) {
              if (alldata.pods[i].isForLcl) {
                $("#pol").append(`<option value="${alldata.pods[i].name}">${alldata.pods[i].name}</option>`);
              }
            }
          }
          else if (val == "AIR") {
            for (var i = 0; i < alldata.pods.length; i++) {
              if (alldata.pods[i].isForAir) {
                $("#pol").append(`<option value="${alldata.pods[i].name}">${alldata.pods[i].name}</option>`);
              }
            }
          }
        }

        $("#pol").val(thisjob.pol).change();
        $("#pod").val(thisjob.pod).change();
        $("#pol").attr("disabled",false);
        $("#pod").attr("disabled",false);
        $("#ei").attr("disabled",true);

      }).fail(function (response) {
        console.log(response);
        alert("An error occured. Please contact Urwasoft");
      });


      $("#save").click(() => {

        if (thisjob.containers.length < 1 && thisjob.equip == "FCL") {
          $("#err").text("Please add at least one container.");
          return false;
        }
        $("#err").text("");
        
        var ronum = $("#ronum").val();
        var consignee = $("#consignee").val();
        var customer = $("#customer").val();
        var equip = $("#equip").val();
        var pol = $("#pol").val();
        var pod = $("#pod").val();
        var carriercoloader = $("#carrierCoLoader").val();
        var sell = $("#sell").val();
        var buy = $("#buy").val();
        var volume = $("#volume").val();
        var cbm = $("#cbm").val();
        var air = $("#air").val();
        var mbl = $("#mbl").val();
        var hbl = $("#hbl").val();
        var invoice = $("#invoice").val();
        var etd = $("#etd").val();
        var eta = $("#eta").val();
        var paymentstatus = $("#paymentstatus").val();
        var remarks = $("#remarks").val();

        thisjob.idx = $("#idx").val();
        thisjob.ronum = ronum;
        thisjob.consignee = consignee;
        thisjob.customer = customer;
        thisjob.equip = equip;
        thisjob.pol = pol;
        thisjob.pod = pod;
        thisjob.carriercoloader = carriercoloader;
        thisjob.sell = sell;
        thisjob.buy = buy;
        thisjob.volume = volume;
        thisjob.cbm = cbm;
        thisjob.air = air;
        thisjob.mbl = mbl;
        thisjob.hbl = hbl;
        thisjob.invoice = invoice;
        thisjob.etd = etd;
        thisjob.eta = eta;
        thisjob.paymentstatus = paymentstatus;
        thisjob.remarks = remarks;

        var settingsUpd = {
          "async": true,
          "crossDomain": true,
          "url": url + "/update.php",
          "method": "POST",
          "processData": false,
          "alldata": JSON.stringify(thisjob)
        };

        $.ajax(settingsUpd).done(function (r) {
          console.log(r);
          if (r.iserror == false) {
            window.location = "view.php?idx=" + $("#idx").val();
          }
          else {
            alert(r.error);
          }
        }).fail((r) => {
          console.log(r);
          alert("Error occured.");
        });


      });

    });
  </script>
</body>

</html>
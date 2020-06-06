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

    #row {
      opacity: 0.5;
    }

    #ldr {
      width: 100px;
      height: 100px;
      position: fixed;
      top: 40%;
      left: 45%;
      background-color: transparent;
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
  <div id="ldr">
    <center>
      <img src="img/ldr.gif" />
    </center>
  </div>
  <div id="errShow">

  </div>
  <input type="hidden" id="oldPod" />
  <input type="hidden" id="oldCrr" />
  <input type="hidden" id="idx" />

  <div class="" id="row"
    style="width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;">
    <div class="card bg-primary text-white">
      <div class="card-header bg-primary">Edit Job</div>
      <div class="card-body bg-white" style="color: black;">
        <form method="post" action="insert.php">
          <div class="form-group">
            <div class="row">
              <div class="col-md-5"></div>
              <div class="col-md-2">
                <strong>RO #: <span class="text-danger">*</span></strong>
                <input class="form-control" type="text" id="ronum" name="ronum" disabled
                  placeholder="Format: ES-EQP-12345" />
              </div>
              <div class="col-md-5">
                <br>
                <p class="text-danger" id="roErr"></p>
                <p class="text-success" id="roSts"></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-3">
                    <div class="row">
                      <div class="col-md-6">
                        <strong>E/I <span class="text-danger">*</span></strong>
                        <select class="form-control" id="ei" disabled>
                          <option value="-1">SELECT</option>
                          <option value="IMPORT">IMPORT</option>
                          <option value="EXPORT">EXPORT</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <strong>Equip <span class="text-danger">*</span></strong>
                        <select class="form-control" id="equip">
                          <option value="FCL">FCL</option>
                          <option value="LCL">LCL</option>
                          <option value="AIR">AIR</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="row">
                      <div class="col-md-6">
                        <strong>Customer <span class="text-danger">*</span></strong>
                        <select class="form-control" id="customer">
                        </select>
                      </div>
                      <div class="col-md-6">
                        <strong>Shipper/Consignee <span class="text-danger">*</span></strong>
                        <input class="form-control" type="text" id="consignee" name="consignee">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-1">
                  </div>
                  <div class="col-md-3">
                    <div class="row">
                      <div class="col-md-6">
                        <strong>POL <span class="text-danger">*</span></strong>
                        <select class="form-control" id="pol">
                        </select>
                      </div>
                      <div class="col-md-6">
                        <strong>POD <span class="text-danger">*</span></strong>
                        <select class="form-control" id="pod">
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="row">
                  <div class="col-md-6">
                    <strong>Vendor <span class="text-danger">*</span></strong>
                    <select class="form-control" id="vendorFcl">
                    </select>
                  </div>
                  <div class="col-md-6">
                    <strong id="fclText">Carrier <span class="text-danger">*</span></strong>
                    <strong id="airText" style="display: none;">Air Line</strong>
                    <select class="form-control" id="carrier">
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <div class="row">
                  <div class="col-md-6">
                    <strong>Buy <span class="text-danger">*</span></strong>
                    <input class="form-control" type="number" step="0.01" id="buy" name="buy">
                  </div>
                  <div class="col-md-6">
                    <strong>Sell <span class="text-danger">*</span></strong>
                    <input class="form-control" type="number" step="0.01" id="sell" name="sell">
                  </div>
                </div>
              </div>

              <div class="col-md-3" id="volumeDiv" style="display: none;">
                <strong>Volume <span class="text-danger">*</span></strong>
                <select class="form-control" id="volume">
                  <option value="-1">SELECT</option>
                  <option value="20">20</option>
                  <option value="40">40</option>
                  <option value="40 HC">40 HC</option>
                </select>
              </div>
              <div class="col-md-3" id="cbmDiv" style="display: none;">
                <strong>CBM <span class="text-danger">*</span></strong>
                <input class="form-control" type="number" step="0.01" id="cbm" name="cbm">
              </div>
              <div class="col-md-3" id="airDiv" style="display: none;">
                <strong>KGs <span class="text-danger">*</span></strong>
                <input class="form-control" type="number" step="0.01" id="air" name="air">
              </div>
              <div class="col-md-3">
                <div class="row">
                  <div class="col-md-6">
                    <strong>Gross Weight</strong>
                    <input class="form-control" type="number" step="0.01" id="grossw8">
                  </div>
                  <div class="col-md-6">
                    <strong>Net Weight</strong>
                    <input class="form-control" type="number" step="0.01" id="netw8">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="row">
                  <div class="col-md-6">
                    <strong>ETD <span class="text-danger">*</span></strong>
                    <input class="form-control" type="date" id="etd" name="etd">
                  </div>
                  <div class="col-md-6">
                    <strong>ETA <span class="text-danger">*</span></strong>
                    <input class="form-control" type="date" id="eta" name="eta">
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="row">
                  <div class="col-md-6">
                    <strong>MBL <span class="text-danger">*</span></strong>
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
                <strong>Customer Status <span class="text-danger">*</span></strong>
                <select class="form-control" id="cstatus">
                </select>
              </div>
              <div class="col-md-3">
                <strong>Vendor Status <span class="text-danger">*</span></strong>
                <select class="form-control" id="vstatus">
                </select>
              </div>
            </div>
          </div>
        </form>
        <div class="card bg-primary text-white" id="containerDiv" style="display: none;">
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
          <span onclick="window.location = 'SearchJobs.php';" class="btn btn-warning">Back To List</span>
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
      for (var i = 0; i < model.containers.length; i++) {
        if (
          model.containers[i].containerno == contno
        ) {
          console.log("found, removing");
          model.containers.splice(i, 1);
          $(`#${contno}_tr`).remove();
          break;
        }
      }
    }

    function triggerChanges(eqp, ei, crr, polVal, podVal, venVal) {
      //vol/cbm/air changes
      if (eqp == "AIR") {
        $("#volumeDiv").hide();
        $("#airDiv").show();
        $("#cbmDiv").hide();
        $("#containerDiv").hide();
        $("#carrier").attr('disabled', false);

      }
      else if (eqp == "FCL") {
        $("#volumeDiv").show();
        $("#airDiv").hide();
        $("#cbmDiv").hide();
        $("#containerDiv").show();
        $("#carrier").attr('disabled', false);

      }
      else if (eqp == "LCL") {
        $("#volumeDiv").hide();
        $("#airDiv").hide();
        $("#cbmDiv").show();
        $("#containerDiv").hide();
        $("#carrier").attr('disabled', true);
      }

      //pol/pod changes
      if (ei == "IMPORT") {
        $('#pol').attr('disabled', false);
        $('#pod').attr('disabled', false);
        $("#pol").find("option").remove();
        $("#pod").find("option").remove();

        data.pols.forEach(function (c) {
          $("#pol").append(`<option value="${c.name}">${c.name}</option>`);
        });

        if (eqp == "FCL") {
          for (var i = 0; i < data.pods.length; i++) {
            if (data.pods[i].isForFcl) {
              $("#pod").append(`<option value="${data.pods[i].name}">${data.pods[i].name}</option>`);
            }
          }
        }
        else if (eqp == "LCL") {
          for (var i = 0; i < data.pods.length; i++) {
            if (data.pods[i].isForLcl) {
              $("#pod").append(`<option value="${data.pods[i].name}">${data.pods[i].name}</option>`);
            }
          }
        }
        else if (eqp == "AIR") {
          for (var i = 0; i < data.pods.length; i++) {
            if (data.pods[i].isForAir) {
              $("#pod").append(`<option value="${data.pods[i].name}">${data.pods[i].name}</option>`);
            }
          }
        }
      }
      else if (ei == "EXPORT") {
        $('#equip').attr('disabled', false);
        $('#pod').attr('disabled', false);
        $('#pol').attr('disabled', false);
        $("#pol").find("option").remove();
        $("#pod").find("option").remove();

        data.pols.forEach(function (c) {
          $("#pod").append(`<option value="${c.name}">${c.name}</option>`);
        });
        if (eqp == "FCL") {
          for (var i = 0; i < data.pods.length; i++) {
            if (data.pods[i].isForFcl) {
              $("#pol").append(`<option value="${data.pods[i].name}">${data.pods[i].name}</option>`);
            }
          }
        }
        else if (eqp == "LCL") {
          for (var i = 0; i < data.pods.length; i++) {
            if (data.pods[i].isForLcl) {
              $("#pol").append(`<option value="${data.pods[i].name}">${data.pods[i].name}</option>`);
            }
          }
        }
        else if (eqp == "AIR") {
          for (var i = 0; i < data.pods.length; i++) {
            if (data.pods[i].isForAir) {
              $("#pol").append(`<option value="${data.pods[i].name}">${data.pods[i].name}</option>`);
            }
          }
        }
      }

      $("#pol").val(polVal).change();
      $("#pod").val(podVal).change();

      //vendor changes
      $("#vendorAir").hide();
      $('#vendorFcl').attr('disabled', false);
      $("#vendorFcl").show();
      $("#vendorFcl").find("option").remove();

      data.vendors.forEach(function (c) {
        $("#vendorFcl").append(`<option value="${c.name}">${c.name}</option>`);
      });
      $("#vendorFcl").val(venVal.replace(/&amp;/g, '&')).change();

      console.log("Crr changes in triigerChanges, crr=" + crr);
      console.log(data);
      //carrier changes
      if (eqp == "FCL") {
        $('#carrier').attr('disabled', false);
        $("#carrier").show();
        $("#airText").hide();
        $("#fclText").show();

        data.carriers.forEach(function (c) {
          if (!c.isAir) {
            $("#carrier").prepend(`<option value="${c.name}">${c.name}</option>`);
          }
        });
      }
      else if (eqp == "LCL") {
        $('#carrier').attr('disabled', true);
        $("#carrier").find("option").remove();
        $("#airText").hide();
        $("#fclText").show();
      }
      else if (eqp == "AIR") {
        $('#carrier').attr('disabled', false);
        $("#carrier").show();
        $("#airText").show();
        $("#fclText").hide();

        data.carriers.forEach(function (c) {
          if (c.isAir) {
            $("#carrier").prepend(`<option value="${c.name}">${c.name}</option>`);
          }
        });
      }
      $("#carrier").val(crr).change();

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

    function getThisData(allData) {
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
        $("#ronum").val(parseSpecialChars(r.ronum));
        $("#consignee").val(parseSpecialChars(r.consignee));
        $("#customer").val(parseSpecialChars(r.customer));
        $("#equip").val(parseSpecialChars(r.equip));
        $("#pol").val(parseSpecialChars(r.pol));
        $("#pod").val(parseSpecialChars(r.pod));
        $("#carrierCoLoader").val(parseSpecialChars(r.carriercoloader));
        $("#sell").val(parseSpecialChars((r.sell)));
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
        $("#ei").val(parseSpecialChars(r.ei)).change();
        $("#fterms").val(parseSpecialChars(r.ft)).change();
        $("#iterms").val(parseSpecialChars(r.it)).change();
        $("#cstatus").val(parseSpecialChars(r.cs)).change();
        $("#vstatus").val(parseSpecialChars(r.vs)).change();
        model.containers = r.containers;
        r.containers.forEach(c => {
          var row = `<tr id="${parseSpecialChars(c.containerno)}_tr">
                                    <td>${parseSpecialChars(c.containerno)}</td>
                                    <td>${parseSpecialChars(c.type)}</td>
                                    <td>${parseSpecialChars(c.weight)}</td>
                                    <td><button class="btn btn-danger" data-cntrno="${c.containerno}" onClick="removeContainer(this)">REMOVE</button></td>
                                </tr>`;
          $("#cbody").append(row);
        });
        thisjob = r;
        //console.log("chnging vendorfcl");
        //$("#vendorFcl").val().change();
        $("#oldPod").val(thisjob.pod);
        $("#oldCrr").val(thisjob.carriercoloader.replace(/&amp;/g, '&'));

        //vol/cbm/kgs changes
        if (r.equip == "AIR") {
          $("#volumeDiv").hide();
          $("#airDiv").show();
          $("#cbmDiv").hide();
          $("#containerDiv").hide();
        }
        else if (r.equip == "FCL") {
          $("#volumeDiv").show();
          $("#airDiv").hide();
          $("#cbmDiv").hide();
          $("#containerDiv").show();
        }
        else if (r.equip == "LCL") {
          $("#volumeDiv").hide();
          $("#airDiv").hide();
          $("#cbmDiv").show();
          $("#containerDiv").hide();
        }

        console.log("thisjob=");
        console.log(thisjob);
        triggerChanges(r.equip, r.ei, r.carriercoloader, r.pol, r.pod,thisjob.vendor);

      }).
        fail((r) => {
          alert("Error occured. Please contact Urwasoft.");
        });
    }

    $(document).ready(function () {
      $("#logout").click(() => {
        window.location = "logout.php";
      });

      $("#equip").change(function () {
        var val = this.value;

        //vol/cbm/air changes
        if (val == "AIR") {
          $("#volumeDiv").hide();
          $("#airDiv").show();
          $("#cbmDiv").hide();
          $("#containerDiv").hide();
        }
        else if (val == "FCL") {
          $("#volumeDiv").show();
          $("#airDiv").hide();
          $("#cbmDiv").hide();
          $("#containerDiv").show();
        }
        else if (val == "LCL") {
          $("#volumeDiv").hide();
          $("#airDiv").hide();
          $("#cbmDiv").show();
          $("#containerDiv").hide();
        }

        //pol/pod changes
        var ei = $("#ei option:selected").val();
        if (ei == "IMPORT") {
          $('#pol').attr('disabled', false);
          $('#pod').attr('disabled', false);
          $("#pol").find("option").remove();
          $("#pod").find("option").remove();

          data.pols.forEach(function (c) {
            $("#pol").append(`<option value="${c.name}">${c.name}</option>`);
          });

          if (val == "FCL") {
            for (var i = 0; i < data.pods.length; i++) {
              if (data.pods[i].isForFcl) {
                $("#pod").append(`<option value="${data.pods[i].name}">${data.pods[i].name}</option>`);
              }
            }
          }
          else if (val == "LCL") {
            for (var i = 0; i < data.pods.length; i++) {
              if (data.pods[i].isForLcl) {
                $("#pod").append(`<option value="${data.pods[i].name}">${data.pods[i].name}</option>`);
              }
            }
          }
          else if (val == "AIR") {
            for (var i = 0; i < data.pods.length; i++) {
              if (data.pods[i].isForAir) {
                $("#pod").append(`<option value="${data.pods[i].name}">${data.pods[i].name}</option>`);
              }
            }
          }
        }
        else if (ei == "EXPORT") {
          $('#equip').attr('disabled', false);
          $('#pod').attr('disabled', false);
          $('#pol').attr('disabled', false);
          $("#pol").find("option").remove();
          $("#pod").find("option").remove();

          data.pols.forEach(function (c) {
            $("#pod").append(`<option value="${c.name}">${c.name}</option>`);
          });
          if (val == "FCL") {
            for (var i = 0; i < data.pods.length; i++) {
              if (data.pods[i].isForFcl) {
                $("#pol").append(`<option value="${data.pods[i].name}">${data.pods[i].name}</option>`);
              }
            }
          }
          else if (val == "LCL") {
            for (var i = 0; i < data.pods.length; i++) {
              if (data.pods[i].isForLcl) {
                $("#pol").append(`<option value="${data.pods[i].name}">${data.pods[i].name}</option>`);
              }
            }
          }
          else if (val == "AIR") {
            for (var i = 0; i < data.pods.length; i++) {
              if (data.pods[i].isForAir) {
                $("#pol").append(`<option value="${data.pods[i].name}">${data.pods[i].name}</option>`);
              }
            }
          }
        }

        //vendor changes
        if (val == "-1") {
          $('#vendorFcl').attr('disabled', true);
          $("#vendorFcl").find("option").remove();
          $("#vendorAir").hide();
        }
        else {
          $("#vendorAir").hide();
          $('#vendorFcl').attr('disabled', false);
          $("#vendorFcl").show();

          $("#vendorFcl").find("option").remove();

          //chk-here
          data.vendors.forEach(function (c) {
            $("#vendorFcl").append(`<option value="${c.name}">${c.name}</option>`);
          });
        }

        //carrier changes
        if (val == "-1") {
          $('#carrier').attr('disabled', true);
          $("#carrier").find("option").remove();
        }
        else if (val == "FCL") {
          $('#carrier').attr('disabled', false);
          $("#carrier").show();
          $("#airText").hide();
          $("#fclText").show();

          data.carriers.forEach(function (c) {
            if (!c.isAir) {
              $("#carrier").prepend(`<option value="${c.name}">${c.name}</option>`);
            }
          });
        }
        else if (val == "LCL") {
          $('#carrier').attr('disabled', true);
          $("#carrier").find("option").remove();
          $("#airText").hide();
          $("#fclText").show();
        }
        else if (val == "AIR") {
          $('#carrier').attr('disabled', false);
          $("#carrier").show();
          $("#airText").show();
          $("#fclText").hide();

          data.carriers.forEach(function (c) {
            if (c.isAir) {
              $("#carrier").prepend(`<option value="${c.name}">${c.name}</option>`);
            }
          });
        }

        $("#pod").val($("#oldPod").val()).change();
        $("#carrier").val($("#oldCrr").val()).change();

      });

      $("#addcntr").click(() => {
        var cntno = $("#cntno").val();
        //var sealno = $("#sealno").val();
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
        model.containers.push(c);
        console.log(model);

        $("#cntno").val('');
        //$("#sealno").val('');
        $("#weight").val('');

        var row = `<tr id="${c.containerno}_tr">
                                    <td>${c.containerno}</td>
                                    <td>${c.type}</td>
                                    <td>${c.weight}</td>
                                    <td><button class="btn btn-danger" data-cntrno="${c.containerno}" onClick="removeContainer(this)">REMOVE</button></td>
                                </tr>`;
        $("#cbody").append(row);
      });

    });
  </script>

  <!--RO# VALIDATOR-->
  <script>
    $(document).ready(() => {
      $("#consignee").width($("#consignee").width() * 2);
      $('#ronum').on('input', function () {
        var roVal = $(this).val();
        var re = new RegExp("\\bES-[A-Z][A-Z][A-Z]-\\d\\d\\d\\d\\d\\b");
        if (re.test(roVal)) {
          $("#roErr").text("");
          $("#roSts").text("Checking RO# for duplicate...");
          var settings = {
            "async": true,
            "crossDomain": true,
            "url": url + "/read_ronum.php?ronum=" + roVal,
            "method": "GET"
          }

          $.ajax(settings).done(function (r) {
            if (r.idx == -1) {
              $("#roErr").text("");
              $("#roSts").text("RO# is valid.");
              $("#roOk").val(1);
            }
            else {
              $("#roErr").text("RO# is duplicate.");
              $("#roSts").text("");
              $("#roOk").val(0);
            }
          }).fail(function (r) {
            console.log(r);
            $("#roOk").val(0);
            alert("An error occured. Please contact urwasoft.");
          });
        }
        else {
          $("#roErr").text("RO# is not in correct format. (ES-EQP-XXXXX)");
          $("#roSts").text("");
          $("#roOk").val(0);
        }
        console.log(roVal);
      });
    });
  </script>

  <script>
    var model = {};
    var data = {};
    var globalThisJob = {};
    model.containers = [];

    $(document).ready(function () {

      //get form data start
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": url + "/get_form_data.php",
        "method": "GET"
      };

      $("#ldr").show();
      $.ajax(settings).done(function (r) {
        $("#ldr").hide();
        $("#row").css('opacity', 1);
        console.log(r);
        data = r;
        data.customers.forEach(function (c) {
          $("#customer").append(`<option value="${c.name}">${c.name}</option>`);
        });

        data.incoterms.forEach(function (c) {
          $("#iterms").append(`<option value="${c.name}">${c.name}</option>`);
        });

        data.freightterms.forEach(function (c) {
          $("#fterms").append(`<option value="${c.name}">${c.name}</option>`);
        });

        data.custstatus.forEach(function (c) {
          $("#cstatus").append(`<option value="${c.name}">${c.name}</option>`);
        });

        data.vendstatus.forEach(function (c) {
          $("#vstatus").append(`<option value="${c.name}">${c.name}</option>`);
        });

        getThisData(data);


      }).fail(function (response) {
        $("#ldr").hide();
        $("#row").css('opacity', 1);
        console.log(response);
        alert("An error occured. Please contact Urwasoft");
      });
      //get form data end

      //save start
      $("#save").click(() => {

        if (thisjob.containers.length < 1 &&  $("#equip option:selected").val() == "FCL") {
          $("#err").text("Please add at least one container.");
          return false;
        }

        if(thisjob.equip != "FCL"){
          thisjob.containers = [];
        }
        else{
          thisjob.containers = model.containers;
        }

        var ei = $("#ei option:selected").val();
        var equip = $("#equip option:selected").val();
        var ronum = $("#ronum").val();
        var consignee = $("#consignee").val();
        var customer = $("#customer option:selected").val();
        var pol = $("#pol option:selected").val();
        var pod = $("#pod option:selected").val();
        var carriercoloader = $("#carrier option:selected").val();
        var vendor = $("#vendorFcl option:selected").val();
        var sell = $("#sell").val();
        var buy = $("#buy").val();
        var volume = $("#volume option:selected").val();
        var cbm = $("#cbm").val();
        var air = $("#air").val();
        var mbl = $("#mbl").val();
        var hbl = $("#hbl").val();
        var invoice = $("#invoice").val();
        var etd = $("#etd").val();
        var eta = $("#eta").val();
        
        if(pol == "" || pod == ""  || pod == null || pod == undefined){
          $("#err").text("Please provide all inputs");
          return false;
        }

        thisjob.idx = $("#idx").val();
        thisjob.ronum = ronum;
        thisjob.ei = ei;
        thisjob.consignee = consignee;
        thisjob.customer = customer;
        thisjob.equip = equip;
        thisjob.pol = pol;
        thisjob.pod = pod;
        thisjob.vendor = vendor;
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
        thisjob.nw = $("#netw8").val();
        thisjob.gw = $("#grossw8").val();
        thisjob.it = $("#iterms option:selected").val();
        thisjob.ft = $("#fterms option:selected").val();
        thisjob.cs = $("#cstatus option:selected").val();
        thisjob.vs = $("#vstatus option:selected").val();
        $("#err").text("");
        if(thisjob.equip == "LCL"){
          thisjob.carriercoloader = " ";
        }

        console.log("updated = ");
        console.log(thisjob);

        

        var settingsUpd = {
          "async": true,
          "crossDomain": true,
          "url": url + "/update.php",
          "method": "POST",
          "processData": false,
          "data": JSON.stringify(thisjob)
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
          alert("Error occured. Please contact Urwasoft.");
          $("#errShow").html(r.responseText);
        });


      });
      //save end
    });
  </script>
</body>

</html>
<?php
include 'conn.php';
session_start();
if (isset($_SESSION['idx']) && isset($_SESSION['email'])) {
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
<?php
$conn = new  conn();
$cone = $conn->open();
// Create connection
if ($cone->connect_error) {
  die("Connection failed: " . $cone->connect_error);
}
$sql1 = "SELECT distinct customer FROM `rofiles`;";
$result = $cone->query($sql1);


?>
<!--Auth Check End-->

<body>

  <style>
    #wrap {
      min-height: 100%;
      height: auto;
      /* Negative indent footer by its height */
      margin: 0 auto -60px;
      /* Pad bottom by footer height */
      padding: 0 0 60px;
    }

    .footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      /* Set the fixed height of the footer here */
      height: 60px;
      background-color: #4285F4;
    }
  </style>

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

    .load {
      position: fixed;
      left: 45%;
      top: 45%;
    }
  </style>
  <!-- Bootstrap -->

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://bootswatch.com/_vendor/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="index.php">HOME</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <button class="btn btn-danger my-2 my-sm-0" type="button" id="logout" onclick="out()">Logout</button>
      </form>
    </div>
  </nav>
  <!--Start Work-->

  <div class="" id="row" style="width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto;margin-top:30px; margin-left: auto;">
    <center>
      <span class="btn btn-lg btn-success" onclick="alll()"><i class="fas fa-address-card"></i> All Jobs </span>
      &nbsp;
      <span onclick="manage()" class="btn btn-lg btn-success"><i class="fas fa-tasks"></i> Manage Data</span>
    </center>
    <hr>
    <div class="card bg-primary text-white" style="background-color:dodgerblue!important">

      <div class="card-header" style="background-color:dodgerblue!important">Search Jobs</div>

      <div class="card-body bg-white" style="color: black;">
        <div class="form-group">
          <form method="Post" action="" id="ros">
            <div class="row">
              <div class="col-md-4">
                <strong>RO#</strong>
                <input class="form-control" type="Text" style="display: none;" id="rnum" name="rnum">
                <div sty class="row">
                  <div class="col-md-4" style="padding-right: 0px;">
                    <select id="type" class="form-control">
                      <option value="ES-FCL-" selected>ES-FCL-</option>
                      <option value="ES-LCL-">ES-LCL-</option>
                      <option value="ES-AIR-">ES-AIR-</option>
                    </select>
                  </div>
                  <div class="col-md-4" style="padding-left: 0px;">
                    <input id="prernum" type="text" class="form-control">
                  </div>
                  <div class="col-md-4">
                <input id="preronumget" class="btn  btn-success"  type="button" value="SUBMIT">
                <input id="ronumget" class="btn  btn-success" style="display: none;"  type="Submit" value="get">
                <p class="text-danger" id="preErr"></p>
                  </div>
                </div>
              </div>
              <!-- <div class="col-md-3">
                <input id="ronumget" class="btn btn-lg btn-success" style="margin-top:11px;" type="Submit" value="Get">
              </div> -->


            </div>
          </form>
          <hr>
          <form class="form-group" method="Post" action="" id="muls">
            <div class="row">
              <div class="col-md-3">
                <strong>Date From</strong>
                <input class="form-control" type="date" id="datefrom" name="datefrom">
              </div>


              <div class="col-md-3">
                <strong>Date To</strong>
                <input class="form-control" type="date" id="dateTo" name="dateTo">
              </div>

              <div class="col-md-3">
                <strong>Customer</strong>
                <select class="form-control" id="cust" name="cust">
                  <option selected value="---Select---">---Select---</option>
                  <?php while ($row = $result->fetch_assoc()) { ?>
                    <option value="<?php print($row["customer"]); ?>"><?php print($row["customer"]); ?></option>
                  <?php }
                  $cone = $conn->close($cone); ?>

                </select>
              </div>

              <div class="col-md-3">
                <input id="search" name="search" class="btn btn-lg btn-success" style="margin-top:11px;" type="Submit" value="Search Jobs">
              </div>
            </div>
          </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>








<script src="url.js"></script>


        <?php
        if (!empty($_POST["datefrom"]) || !empty($_POST["dateTo"]) || (!empty($_POST["cust"]) && $_POST["cust"] != "---Select---") || !empty($_POST["rnum"])) {
          $conn = new  conn();
          $cone = $conn->open();
          if ($cone->connect_error) {
            die("Connection failed: " . $cone->connect_error);
          }
          $_SESSION["to"] = "";
          $_SESSION["from"] = "";
          $_SESSION["cus"] = "";
          $sql1 = "SELECT * FROM rofiles where";
          $from = "";
          $to = "";
          $cus = "";
          $rnum = "";
          if (!empty($_POST["rnum"])) {
            $rnum = $_POST["rnum"];
            $sql1 = $sql1 . " ronum like '%%" . $rnum . "%%'";
          } else {

            if (!empty($_POST["datefrom"])) {
              $from = $_POST["datefrom"];
            }
            if (!empty($_POST["dateTo"])) {
              $to = $_POST["dateTo"];
            }
            try {
              if (!empty($_POST["cust"]) || $_POST["cust"] != "---Select---" || $_POST["cust"] != "" || isset($_POST["cust"])) {
                $cus = $_POST["cust"];
              }
            } catch (Exception $e) {
              $cus = "---Select---";
            }
            $count = 0;
            if (!empty($from)) {
              $sql1 = $sql1 . " addedOn >= '" . $from . "'";
              $count = $count + 1;
            }
            if (!empty($to)) {
              $and = "";

              if ($count > 0) {
                $and = ' and';
              }
              $sql1 = $sql1 . $and . " addedOn <= '" . $to . "'";
              $count = $count + 1;
            }
            if ($cus != "" && $cus != "---Select---") {
              $and = "";
              if ($count > 0) {
                $and = " and";
              }
              $sql1 = $sql1 . $and . " customer = '" . $cus . "'";
            }
          }


          $results = $cone->query($sql1);
          // echo $sql1;
        ?>

          <div class="load" id="ldr">
            <center>
              <img src="img/ldr.gif" />
            </center>
          </div>
       
          <script>
            $("#rnum").val('<?php print($rnum) ?>');
            $("#dateTo").val('<?php print($to) ?>');
            $("#datefrom").val('<?php print($from) ?>');
            $("#cust").val('<?php print($cus) ?>');
          </script>
          <div style="padding-right: 5%; padding-left: 5%; padding-top: 2%">
            <div>
              <a href="new.php" class="btn btn-success">Create New</a>
              <a href="manage.php" class="btn btn-primary">Manage Data</a>

              <hr>
            </div>
            <div class="table-responsive">
              <table class="table-bordered" id="tbl">
                <thead>
                  <th>RO NUMBER</th>
                  <th>CUSTOMER</th>
                  <th>CONSIGNEE</th>
                  <th>MBL</th>
                  <th>HBL</th>
                  <th>EQUIP</th>
                  <th>VOLUME</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </thead>
                <tbody id="body">
                  <?php while ($rows = $results->fetch_assoc()) { ?>
                    <tr>
                      <td><?php print($rows['ronum']); ?></td>
                      <td><?php print($rows['customer']); ?></td>
                      <td><?php print($rows['consignee']); ?></td>
                      <td><?php print($rows['mbl']); ?></td>
                      <td><?php print($rows['hbl']); ?></td>
                      <td><?php print($rows['equip']); ?></td>
                      <td><?php print ($rows['volume'] == "-1") ? "" : $rows['volume']; ?></td>
                      <td><a href="view.php?idx=<?php print($rows['idx']); ?>" class="btn btn-primary">View</a></td>
                      <td><a href="update.php?idx=<?php print($rows['idx']); ?>" class="btn btn-warning">Edit</a></td>
                      <td><button class="btn btn-danger" data-idx="<?php print($rows['idx']); ?>" onClick="deleteJob(this)">Delete</button></td>
                    </tr>
                  <?php }
                  $cone = $conn->close($cone); ?>
                </tbody>
              </table>
            </div>
            <script>
              function deleteJob(x) {
                var idx = ($(x).attr("data-idx"));

                var settings = {
                  "async": true,
                  "crossDomain": true,
                  "url": url + "/delete.php?idx=" + idx,
                  "method": "GET"
                };
                $.ajax(settings).done(function(r) {
                  if (r.iserror == false) {

                    window.location = "Searchjobs.php";
                  } else {
                    alert(r.error);
                  }
                });
              }
            </script>
          </div>
          <script>
            $("#tbl").DataTable({
              dom: 'Bfrtip',
              buttons: [{
                  extend: 'excel',
                  title: '',
                  exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5,6]
                  }
                },
                {
                  extend: 'pdf',
                  title: '',
                  exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5,6]
                  }
                },
                {
                  extend: 'print',
                  title: '',
                  exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5,6]
                  }
                }
              ]
            });
            $('#ldr').hide()
          </script>
      </div>
    <?php
        }

    ?>
    </div>
  </div>


  <script>
    function alll() {
      window.location.href = 'Alljobs.php';
    }

    function search() {
      window.location.href = 'SearchJobs.php';
    }

    function manage() {
      window.location.href = 'manage.php';
    }

    function out() {
      window.location = "logout.php";
    }

    $(document).ready(()=>{
      $("#preronumget").click(()=>{
        var rval = $("#prernum").val();
        var rtype = $("#type").val();
        // if(rval == ""){
        //   $("#preErr").text("Plese enter RO#");
        //   return;
        // }
        $("#preErr").text("");

        var concatVal = rtype + rval;
        // alert(concatVal);
        $("#rnum").val(concatVal);
        $("#ronumget").click();
      });
    });
  </script>


</body>

</html>
<?php
 include '../../conn.php';
session_start();

if ( isset( $_SESSION['idx'] ) && isset( $_SESSION['email'] ) ) {
    //all good
} else {
    // Redirect them to the login page
    header("Location: login.php");
}

$conn = new	conn();
$cone =$conn->open();
// Create connection
if ($cone->connect_error) {
    die("Connection failed: " . $cone->connect_error);
}

if(isset($_POST["pol"]) && isset($_POST["pod"])  && isset($_POST["equip"])  && isset($_POST["rate"])  && isset($_POST["efd"]) && isset($_POST["exd"])  && isset($_POST["note"]))
{
  $sql1 = "update `rates` set pol ='".$_POST["pol"]."',pod ='".$_POST["pod"]."',equipment = ".(int)($_POST["equip"]).", rate = ".(float)($_POST["rate"]).",effectiveDate = '".$_POST["efd"]."', expiryDate = '".$_POST["exd"]."', notes = '".$_POST["note"]."' where idx = ".$_GET["idx"].";";
  $result = $cone->query($sql1);
  header("Location: index.php");
}
// LEFT JOIN KARNA HAI ISS KO <----------------------V
$sql1 ="select * from `rates` where idx = ".$_GET["idx"];
$result1 = $cone->query($sql1);

$sql1 = "select idx, cType from `containertypes`";
$result = $cone->query($sql1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Update Rates</title>
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
    <a class="navbar-brand" href="index.php">View Rates</a>
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
  <div class="" id="row"
    style="width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;">
    <div class="card bg-primary text-white">
      <div class="card-header bg-primary">Edit Rates</div>
      <div class="card-body bg-white" style="color: black;">
      <form method="post" action="">
          <div class="form-group">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-3">
                    <strong>POL <span class="text-danger">*</span></strong>
                    <input class="form-control" id="pol" name="pol" type="text"/>
                  </div>
                  <div class="col-md-3">
                    <strong>POD <span class="text-danger">*</span></strong>
                    <input class="form-control" id="pod" name="pod" type="text"/>
                  </div>
                  <div class="col-md-3">
                    <strong>EQUIPMENT <span class="text-danger">*</span></strong>
                    <select class="form-control" id="equip" name="equip" type="text">
                    <option value="-1" selected>---Select---</option>
                    <?php
                      while($row = $result->fetch_assoc()) {
                    ?>
                     <option value="<?php print($row["idx"]) ?>"><?php print($row["cType"]) ?></option>
                     <?php
                      } $cone = $conn->close($cone);
                    ?>
                   
                    </select>
                  </div>
                  <div class="col-md-3">
                    <strong>RATE <span class="text-danger">*</span></strong>
                    <input class="form-control" id="rate" name="rate" type="text"/>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-3">
                    <strong>EFFECTIVE DATE <span class="text-danger">*</span></strong>
                    <input class="form-control" id="efd" name="efd" type="date"/>
                  </div>
                  <div class="col-md-3">
                    <strong>EXPIRY DATE <span class="text-danger">*</span></strong>
                    <input class="form-control" id="exd" name="exd" type="date"/>
                  </div>
                  <div class="col-md-3">
                    <strong>NOTES <span class="text-danger">*</span></strong>
                    <input class="form-control" id="note" name="note" type="text"/>
                  </div>
                
                </div>
              </div>
            </div>
<br>
            <input type="Submit" class="btn btn-primary" id="save" name="Save" value="Save"/>

          </div>
        </form>
      </div>
      <div class="card-footer bg-white" style="color: black;">
        <center>
          <a href="index.php" class="btn btn-warning">Back To List</a>
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
  <script src="../../url.js"></script>

  <script>
    $(document).ready(function () {
      $('#pol').val('<?php $row = $result1->fetch_assoc(); Print($row["pol"]); ?>');
      $('#pod').val('<?php Print($row["pod"]); ?>');
      // EQUIPMENT KA IDX JAYEGA <----------------------V
      $('#equip').val('<?php Print($row["equipment"]); ?>');
      $('#rate').val('<?php Print($row["rate"]) ?>');
      $('#efd').val('<?php Print($row["effectiveDate"]) ?>');
      $('#exd').val('<?php Print($row["expiryDate"]) ?>');
      $('#note').val('<?php Print($row["notes"]) ?>');


      $("#logout").click(() => {
        window.location = "logout.php";
      });
    });
  </script>
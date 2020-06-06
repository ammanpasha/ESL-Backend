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

if(isset($_POST["cType"]) && $_POST["cType"] != "")
{
    $sql1 = "update `containertypes` set cType ='".$_POST["cType"]."' where idx = ".$_GET["idx"].";";
    $result = $cone->query($sql1);
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Update Container Type</title>
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
    <a class="navbar-brand" href="index.php">View Container Type</a>
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
      <div class="card-header bg-primary">Edit Container Type</div>
      <div class="card-body bg-white" style="color: black;">
        <form method="post" action="">
          <div class="form-group">
            <div class="row">
              <div class="col-md-3">
                <div class="row">
                  <div class="col-md-12">
                    <strong>CONTAINER TYPE <span class="text-danger">*</span></strong>
                    <?php 
                    if(isset($_GET["idx"]))
                    { 
                        
                        
                        $sql1 = "SELECT cType FROM `containertypes` where idx = ".$_GET["idx"].";";
                        $result = $cone->query($sql1);
                        $dat = $result->fetch_assoc();

                    ?>
                    <input class="form-control" name="cType" id="cType" value="<?php print($dat["cType"]); ?>" type="text"/>
                    <?php 
                    }
                    else{
                        header("Location: index.php");
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
                    <input class="btn btn-primary" type="Submit" name="go"/>
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

      $("#logout").click(() => {
        window.location = "logout.php";
      });
    });
  </script>
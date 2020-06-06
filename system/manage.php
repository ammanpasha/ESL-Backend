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
    <title>Index</title>
</head>

<!--Auth Check Start-->

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
            <button class="btn btn-danger my-2 my-sm-0" type="button" onclick="out()" id="logout">Logout</button>
            </form>
        </div>
    </nav>

    <div style="padding-right: 5%; padding-left: 5%; padding-top: 2%">
        <div class="row">
        <div class="col-md-3">
            <a href="crud/vendors/index.php" class="btn btn-lg btn-primary btn-block">Manage Vendors</a>
        </div>
        <div class="col-md-3">
            <a href="crud/carriers/index.php" class="btn  btn-lg btn-primary btn-block">Manage Carriers</a>
        </div>
        <div class="col-md-3">
            <a href="crud/customers/index.php" class="btn btn-lg  btn-primary btn-block">Manage Customers</a>
        </div>
        <div class="col-md-3">
            <a href="crud/pols/index.php" class="btn btn-lg  btn-primary btn-block">Manage POLs</a>
        </div>
        </div>
        <br>
        <div class="row">
        <div class="col-md-3">
            <a href="crud/pods/index.php" class="btn btn-lg  btn-primary btn-block">Manage PODs</a>
        </div>
        <div class="col-md-3">
            <a href="crud/containertype/index.php" class="btn btn-lg  btn-primary btn-block">Manage Container Types</a>
        </div>

        <div class="col-md-3">
            <a href="crud/Rates/index.php" class="btn btn-lg  btn-primary btn-block">Manage Rates</a>
        </div>
        </div>
        <br>
        <span onclick="ind()" class="btn btn-sm btn-warning">Back</span>
    </div>
    

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
    function ind()
    {
        window.location ='index.php';
    }
    function out() {
        window.location = "logout.php";
      }
      </script>
</body>

</html>
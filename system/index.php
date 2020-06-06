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
  <!-- Bootstrap -->

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://bootswatch.com/_vendor/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="index.php">EXPRESS SHIPPING</a>
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

  <!--Start Work-->
  <div id="ldr2">
    <center>
      <img src="img/ldr.gif" />
    </center>
  </div>
<div class="container">
    <br>
<!-- <center>
    
     <span class="btn btn-lg btn-success" onclick="alll()"><i class="fas fa-address-card"></i> All Jobs </span> 
     &nbsp;
     <span class="btn btn-lg btn-success" onclick="search()"><i class="fas fa-search"></i> Search Jobs </span>
     &nbsp;
     <span onclick="manage()" class="btn btn-lg btn-success"><i class="fas fa-tasks"></i> Manage Data</span>
 </center> -->
</div>





  <!--End Work-->
  <footer class="footer font-small">
    <div class="footer-copyright text-center text-white py-3">
      ESL
    </div>
  </footer>
  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <!-- JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
    crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      window.location = "SearchJobs.php";
      $("#logout").click(() => {
        window.location = "logout.php";
      });
    });
    function alll()
    {
        window.location.href = 'Alljobs.php';
    }
    function search()
    {
      window.location.href = 'SearchJobs.php';
    }
    function manage()
    {
      window.location.href = 'manage.php';
    }
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
      var idx = getParameterByName("idx");
      $('#ldr').hide();
    });
    
  </script>
</body>

</html>

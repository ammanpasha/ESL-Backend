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
      <img src="../../img/ldr.gif" />
    </center>
  </div>
  <div class="" id="row"
    style="width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;">
    <div class="card bg-primary text-white">
      <div class="card-header bg-primary">Add New Vendor</div>
      <div class="card-body bg-white" style="color: black;">
        <form method="post" action="insert.php">
          <div class="form-group">
            <div class="row">
              <div class="col-md-3">
                <div class="row">
                  <div class="col-md-12">
                    <strong>Name <span class="text-danger">*</span></strong>
                    <input class="form-control" id="name" type="text"/>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="card-footer bg-white" style="color: black;">
        <center>
          <a href="#" class="btn btn-primary" id="save">Save</a>
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
  <script>
    var model = {};
    var data = {};
    model.containers = [];

    $(document).ready(function () {

      function getParameterByName(name, url) {
      if (!url) url = window.location.href;
      name = name.replace(/[\[\]]/g, "\\$&");
      var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
      var idx = getParameterByName("idx");
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": url + "/vendors/get_single.php?idx=" + idx,
        "method": "GET"
      };

      $("#ldr").show();
      $.ajax(settings).done(function (r) {
        $("#ldr").hide();
        $("#row").css('opacity', 1);
        $("#name").val(r[0].name);
        console.log(r);
        data = r;
       
        
      }).fail(function (response) {
        $("#ldr").hide();
        $("#row").css('opacity', 1);
        console.log(response);
        alert("An error occured. Please contact Urwasoft");
      });

      $("#save").click(() => {
        var n = $("#name").val();

        if(n == ""){
        $("#err").text("Please provide all inputs");
          return false;
        }

        $("#err").text("");

        model.name = n;
        model.idx = idx;

        console.log(model);

        var settings = {
          "async": true,
          "crossDomain": true,
          "url": url + "/vendors/update.php",
          "method": "POST",
          "processData": false,
          "data": JSON.stringify(model)
        };

        $.ajax(settings).done(function (r) {
          console.log(r);
          if (r.iserror == false) {
            window.location = "index.php?";
          }
          else {
            alert(r.error);
          }
        }).fail(function (r) {
          console.log(r);
          alert("An error occurred.");
        });

      });
    });
  </script>
</body>

</html>
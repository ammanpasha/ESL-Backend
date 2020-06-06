<?php
include 'conn.php';
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


if (!empty( $_POST )) {
    if ( isset( $_POST['email'] ) && isset( $_POST['pwd'] ) ) {
      $em = $_POST['email'];
      $pw = $_POST['pwd'];
        $conn = new	conn();
        $cone =$conn->open();
        $qry = "SELECT * FROM users WHERE email = '$em' and pwd = '$pw'";
        $stmt = $cone->prepare($qry);
        $stmt->execute();
        $result = $stmt->get_result();
    	  $user = $result->fetch_object();
        
        if ( $user != null  ) {
          $_SESSION['idx'] = $user->idx;
          $_SESSION['email'] = $user->email;
          echo '<center><p style="color:green">Loading..</p></center>';
          
          //header("Location: index.php");
          $cone = $conn->close($cone);
		 echo "<script>window.location='SearchJobs.php'</script>";
          return;
        }
        else
        {
          echo '<center><p style="color:red">Invalid login.</p></center>';
        }
    }
    else{
      echo '<center><p style="color:red">Please provide all inputs.</p></center>';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
</head>

<body>
  <!-- Bootstrap -->

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://bootswatch.com/_vendor/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

 
  <div class="row" style="padding-top: 15%">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <div class="login-box">
        <center><img class="brand-logo" src="img/explogo.png" /></center>
        <div class="login-logo">
          <b style="font-size:large; font-family:'Arial Unicode MS'">Log In</b>
        </div>
        <div class="card"></div>
        <div class="card-body login-card-body">
          <form action="login.php" method="post">
            <div class="form-horizontal">
              <div class="form-group has-feedback">
                <input class="form-control text-box single-line" id="email" name="email" placeholder="Email" type="text"
                  value="">
                <span class="fa fa-envelope form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input class="form-control text-box single-line" id="pwd" name="pwd" placeholder="Password"
                  type="password" value="">
                <span class="fa fa-lock form-control-feedback"></span>
              </div>
            </div>
            <div class="row">
              <p style="color:red"></p>
              <div class="col-4 offset-4">
                <input type="submit" value="Sign In" class="btn btn-primary btn-block btn-flat">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4"></div>

  </div>
  </div>

  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <!-- JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
    integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
    crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


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
    });
  </script>
</body>





</html>
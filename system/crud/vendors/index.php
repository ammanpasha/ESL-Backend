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
        <a class="navbar-brand" href="../../index.php">Home</a>
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

    <div style="padding-right: 5%; padding-left: 5%; padding-top: 2%">
        <div>
            <a href="new.php" class="btn btn-success">Add New</a>
            
            <hr>
        </div>
        <div class="table-responsive">
            <table class="table-bordered" id="tbl">
                <thead>
                    <th>ID</th>
                    <th>NAME</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody id="body">

                </tbody>
            </table>
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
    <script src="../../url.js"></script>

    <script>
        function deleteJob(x)
        {
            var idx = ($(x).attr("data-idx"));
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": url + "/vendors/delete.php?idx=" + idx,
                "method": "GET"
                };
                $.ajax(settings).done(function (r) {
                        if (r.iserror == false) {
                    window.location = "index.php";
            }
            else {
                alert(r.error);
            }
                });
        }
    
        $(document).ready(function () {
            $("#logout").click(() => {
                window.location = "../../logout.php";
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": url + "/vendors/get_all.php",
                "method": "GET"
            }

            $.ajax(settings).done(function (r) {
                r.forEach(e => {
                    var body = $("#body");
                    var row = `<tr>
                        <td>${e.idx}</td>
                        <td>${e.name}</td>
                        <td><a href="edit.php?idx=${e.idx}" class="btn btn-warning">Edit</a></td>
                        <td><button class="btn btn-danger" data-idx="${e.idx}" onClick="deleteJob(this)">Delete</button></td>
                    </tr>`
                    body.append(row);
                });
                $("#tbl").DataTable({ "order": []});
            });
        });
    </script>
</body>

</html>
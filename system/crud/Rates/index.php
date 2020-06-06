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
$sql1 = "SELECT r.* , c.idx as cid , c.cType FROM `rates`as r inner join `containertypes` as c on r.equipment = c.idx;";
$result = $cone->query($sql1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VIEW RATES</title>
</head>
<!--RATES-->
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
                    <th>POL</th>
                    <th>POD</th>
                    <th>Equipment</th>
                    <th>Rate</th>
                    <th>Effective Date</th>
                    <th>Expiry Date</th>
                    <th>Notes</th>
                    <th>EDIT</th>
                    <th>DELETE</th>
                </thead>
                <tbody id="body">
<?php           

        while($row = $result->fetch_assoc()) {
?>
        <tr>
        <td> <?php print($row["idx"]); ?> </td>
        <td> <?php print($row["pol"]); ?> </td>
        <td> <?php print($row["pod"]); ?> </td>
        <td> <?php print($row["cType"]); ?> </td>
        <td> <?php print($row["rate"]); ?> </td>
        <td> <?php print(date("m-d-Y", strtotime($row["effectiveDate"]))); ?> </td>
        <td> <?php print(date("m-d-Y", strtotime($row["expiryDate"]))); ?> </td>
        <td> <?php print($row["notes"]); ?> </td>
        <td><a href="update.php?idx=<?php Print($row["idx"]); ?>" class="btn btn-warning" >Edit</a></td>
        <td><button class="btn btn-danger" data-idx="<?php Print($row["idx"]); ?>" onClick="deleteJob(this)">Delete</button></td>
                
        </tr>
        <?php }  $cone = $conn->close($cone);  ?>
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
                "url": "delete.php?idx=" + idx,
                "method": "GET"
                };
                $.ajax(settings).done(function (r) {
            window.location = "index.php";
            console.log(r);
                }).fail((r) =>{
                    alert("Error");
                    console.log(r);
                })
        }
        function editjob()
        {

        }

        $(document).ready(function () {
            $("#logout").click(() => {
                window.location = "../../logout.php";
            });
        });
        $("#tbl").DataTable({ });
    </script>
</body>

</html>
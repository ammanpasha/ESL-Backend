<?PHP
$con = new mysqli('localhost', 'root','Mysql7878', 'expresss_expshipping');
// $con = new mysqli('ft-mysql.cyjdi9flse23.us-east-1.rds.amazonaws.com', 'admin','My$ql7878', 'expresss_expshipping');
class conn{
  
    function open()
    {
        // $cone = new mysqli('ft-mysql.cyjdi9flse23.us-east-1.rds.amazonaws.com', 'admin','My$ql7878', 'expresss_expshipping');
        $cone = new mysqli('localhost', 'root','Mysql7878', 'expresss_expshipping');
        return $cone;
    }
    function close($cone)
    {
        $cone->close();
        return $cone;
    }
}
?>
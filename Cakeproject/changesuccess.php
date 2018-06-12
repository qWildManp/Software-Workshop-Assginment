<html>
<body>
<?php
session_start();
if(empty($_SESSION['adminName'])){ //check if the admin is login
    //jump to the admin login page
    echo "<script language='javascript'>";
    echo "document.location='login_admin.php'";
    echo "</script>";
}
?>
<h1>Change Successfully!!</h1>
<?php sleep(5);
//jump to admin page
echo "<script language='javascript'>";
echo "document.location='admin.php'";
echo "</script>";
?>
</body>
</html>
<html>
<body>

<?php
session_start();
if(empty($_SESSION['registName'])){ //check user regist before
    //jump to registration page
    echo "<script language='javascript'>";
    echo "document.location='registrationpage.php'";
    echo "</script>";
}
?>
<h1 style="position: center">Successful Registration !</h1>
<?php sleep(5);
    //jump to login page
    echo "<script language='javascript'>";
    echo "document.location='login_bs.php'";
    echo "</script>";
?>
</body>
</html>
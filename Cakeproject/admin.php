<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="LOGO.png">

    <title>DDL Cake Shop</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="bootstrap/signin.css" rel="stylesheet">
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body class="text-center">
<?php
session_start();
$nameErr = $pwdErr = $loginErr = "";
$name = $pwd = "";
$servername = "localhost";
$username = "m730026028";
$password = "abc123xyz";
$dbname = "cakeshop";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sqluser = "SELECT  * FROM userlist WHERE (name='$name'  AND pwd='$pwd')";
    $resultuser = $conn->query($sqluser);

    $conn->close();

}

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <img src="LOGOwhite.png" width="30" height="30">
        <a class="navbar-brand" href="homepage.php">DDL Cake Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07"
                aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="homepage.php"> Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="userpage.php"> Order </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login_bs.php"> Login </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="login_admin.php"> Admin </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact.php">About</a>
                </li>
            </ul>
            <p class="text-white form-inline my-2 my-md-0 ">
                <?php echo 'Hi,' . $_SESSION["adminName"]; ?>
            </p>
        </div>
    </div>
</nav>
<div class="container">
    <div class="container">
        <h1>User List For All Customers</h1>
        <table border=1>
            <?php

            session_start();
            if (empty($_SESSION['adminName'])) {
                echo "<script language='javascript'>";
                echo "document.location='login_bs.php'";
                echo "</script>";
            }
            $servername = "localhost";
            $username = "m730026028";
            $password = "abc123xyz";
            $dbname = "cakeshop";
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM booklist";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) { //if database have cake orders
                // output data of each row
                echo "<tr><th>Order Number</th><th>User Name</th><th>Cake style</th><th>Size</th><th>Order Time</th><th>Chocolate</th><th>Fruit</th><th>Oreo</th><th>Candy</th><th>Nut</th><th>Jelly</th><th>Gift Card</th><th>Comment</th><th>City</th><th>Phone Number</th><th>Complete</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["orderNo"] . "</td><td>" . $row["username"] . "</td><td>" . $row["cakestyle"] . "</td><td>" . $row["size"] . "</td><td>" . $row["time"] . "</td><td>" . $row["chocolate"] . "</td><td>" . $row["fruit"] . "</td><td>" . $row["oreo"] . "</td><td>" . $row["candy"] . "</td><td>" . $row["nut"] . "</td><td>" . $row["jelly"] . "</td><td>" . $row["giftcard"] . "</td><td>" . $row["comment"] . "</td><td>" . $row["city"] . "</td><td>" . $row["phoneNO"] . "</td><td>" . $row["complete"] . "</td>";
                }
            } else {// if there is no order in the database
                echo "0 results";
            }
            ?>
        </table>
    </div>

    <div class="container">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            <?php
            $nameErr = "";
            $servername = "localhost";
            $username = "m730026028";
            $password = "abc123xyz";
            $dbname = "cakeshop";
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                /* Search order by user name*/
                $name = $_POST["username"];
                if (empty($name)) {//if username input is empty
                } else {//if the username isn't empty
                    $sql = "SELECT * FROM userlist WHERE name='$name'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) { //if there are cake orders
                        $sql = "SELECT * FROM booklist WHERE username = '$name'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {//if there are cake orders
                            // output data of each row
                            echo "The result is :";
                            echo "<table border= 1>";
                            echo "<tr><th>Order Number</th><th>User Name</th><th>Cake style</th><th>Size</th><th>Order Time</th><th>Chocolate</th><th>Fruit</th><th>Oreo</th><th>Candy</th><th>Nut</th><th>Jelly</th><th>Gift Card</th><th>Comment</th><th>City</th><th>Phone Number</th><th>Complete</th></tr>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["orderNo"] . "</td><td>" . $row["username"] . "</td><td>" . $row["cakestyle"] . "</td><td>" . $row["size"] . "</td><td>" . $row["time"] . "</td><td>" . $row["chocolate"] . "</td><td>" . $row["fruit"] . "</td><td>" . $row["oreo"] . "</td><td>" . $row["candy"] . "</td><td>" . $row["nut"] . "</td><td>" . $row["jelly"] . "</td><td>" . $row["giftcard"] . "</td><td>" . $row["comment"] . "</td><td>" . $row["city"] . "</td><td>" . $row["phoneNO"] . "</td><td>" . $row["complete"] . "</td>";
                            }
                            echo "</table>";
                        } else {
                            $nameErr = "0 result";
                        }
                    } else {
                        $nameErr = "User doesn't exist !";
                    }
                }
            }
            ?>
            Search(By User Name):<input type="text" name="username"> <input type="submit" value="Search"><span
                    class="error">*<?php echo $nameErr ?></span>
        </form>
    </div>
    <br/>
    <div class="container">
        <div>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <?php
                $cityErr = "";
                $servername = "localhost";
                $username = "m730026028";
                $password = "abc123xyz";
                $dbname = "cakeshop";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $city = $_POST["city"];
                    if (empty($city)) {//if city input is empty
                    } else {
                        $sql = "SELECT * FROM booklist WHERE city = '$city'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) { //if there are cake orders
                            $sql = "SELECT * FROM booklist WHERE city = '$city'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) { //if there are cake orders
                                // output data of each row
                                echo "The result is :<br/>";
                                echo "<table border= 1>";
                                echo "<tr><th>Order Number</th><th>User Name</th><th>Cake style</th><th>Size</th><th>Order Time</th><th>Chocolate</th><th>Fruit</th><th>Oreo</th><th>Candy</th><th>Nut</th><th>Jelly</th><th>Gift Card</th><th>Comment</th><th>City</th><th>Phone Number</th><th>Complete</th></tr>";
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr><td>" . $row["orderNo"] . "</td><td>" . $row["username"] . "</td><td>" . $row["cakestyle"] . "</td><td>" . $row["size"] . "</td><td>" . $row["time"] . "</td><td>" . $row["chocolate"] . "</td><td>" . $row["fruit"] . "</td><td>" . $row["oreo"] . "</td><td>" . $row["candy"] . "</td><td>" . $row["nut"] . "</td><td>" . $row["jelly"] . "</td><td>" . $row["giftcard"] . "</td><td>" . $row["comment"] . "</td><td>" . $row["city"] . "</td><td>" . $row["phoneNO"] . "</td><td>" . $row["complete"] . "</td>";
                                }
                                echo "</table>";
                            } else {
                                $cityErr = "0 result";
                            }
                        } else {
                            $cityErr = "Address doesn't exist";
                        }
                    }
                }
                ?>
                Search(By City) :<input type="text" name="city"> <input type="submit" value="Search"><span
                        class="error">*<?php echo $cityErr ?></span><br/>
            </form>
        </div>
    </div>
    <div class="container">
        <div>
            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <?php
                /* Modify the order*/
                $servername = "localhost";
                $username = "m730026028";
                $password = "abc123xyz";
                $dbname = "cakeshop";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $Err = "";
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (empty($_POST["ordernum"])) { //if the order number is empty
                        $Err = "Order number required";
                    } else {
                        $ordernum = $_POST["ordernum"];
                        $sql = "SELECT * FROM booklist WHERE orderNo = '$ordernum'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $modify = $_POST["modify"];
                            if ($_POST["modify"] == 'D') { //if admin want to delete a order
                                $sql = "DELETE FROM booklist WHERE orderNo='$ordernum'";
                                if ($conn->query($sql) != false) {
                                    echo "<script language='javascript'>";
                                    echo "document.location='changesuccess.php'";
                                    echo "</script>";
                                } else {
                                    $Err = "Failed";
                                }
                                $conn->close();
                            } else { //if admin want to modify the order complete
                                $sql = "UPDATE booklist SET complete = '$modify' WHERE orderNo = '$ordernum'";
                                if ($conn->query($sql) != false) { //if change successfully then upload the change
                                    echo "<script language='javascript'>";
                                    echo "document.location='changesuccess.php'";
                                    echo "</script>";
                                } else { //if it doesn't upload the change
                                    $Err = "Failed";
                                }
                                $conn->close();
                            }
                        } else { //if the order number doesn't exist
                            $Err = "Order Number doesn't exist !!";
                        }
                    }
                }
                ?>
                <h2>Order Number</h2><input type="text" name="ordernum"><span class="error">*<?php echo $Err ?></span>
                <br/>
                <h2>Modify the order</h2>
                <select name="modify">
                    <option value="Y">Complete</option>
                    <option value="N">Incomplete</option>
                    <option value="D">Delete</option>
                </select>
                <br/><br/>
                <input type="submit" value="Submit"><span>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="bootstrap/jquery-slim.min.js"><\/script>')</script>
<script src="bootstrap/popper.min.js"></script>
<script src="bootstrap/bootstrap.min.js"></script>
</body>
</html>
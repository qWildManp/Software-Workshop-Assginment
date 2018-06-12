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
        .loginErr {
            color: red;
        }
    </style>
</head>

<body class="text-center">
<?php
$nameErr = $pwdErr = $loginErr = "";
$name = $pwd = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) { //if username is empty
        $loginErr .= "User name is required <br>";
    } else {
        $name = $_POST["username"];
    }
    if (empty($_POST["userpwd"])) { //if password is empty
        $loginErr .= "Password is required";
    } else {
        $pwd = $_POST["userpwd"];
    }
    if ($name != "" && $pwd != "") { //if user inputs all
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

        //check user's input from the user list
        $sqluser = "SELECT  * FROM userlist WHERE (name='$name'  AND pwd='$pwd')";
        $resultuser = $conn->query($sqluser);
        if ($resultuser->num_rows > 0) { //if input matches the data
            session_start();
            $_SESSION['loginName'] = $name;
            // jump to the order website
            echo "<script language='javascript'>";
            echo "document.location='userpage.php'";
            echo "</script>";
        } else { //if input doesn't matches
            $loginErr = "Login failed : incorrect password OR user name doesn't exist!";
        }
        $conn->close();

    }
}

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <img src="LOGOwhite.png" width="30" height="30">
        <a class="navbar-brand" href="#"> DDL Cake Shop</a>
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
                <li class="nav-item active">
                    <a class="nav-link" href="login_bs.php"> Login </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login_admin.php"> Admin </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">About</a>
                </li>
            </ul>

            <p class="text-white form-inline my-2 my-md-0 ">
            </p>
        </div>
    </div>
</nav>
<form class="form-signin" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">

    <div>
        <img class="mb-4" src="DDL.png" alt="" width="120" height="120">
        <h1 class="h3 mb-3 font-weight-normal">DDL Cake Shop </h1>
        <label for="username" class="sr-only">User Name</label>
        <input type="text" name="username" class="form-control" placeholder="User Name">
        <label for="userpwd" class="sr-only">Password</label>
        <input type="password" name="userpwd" class="form-control" placeholder="Password">
        <span class="loginErr"> <?php echo $loginErr ?></span><br>
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Sign in">
        <button class="btn btn-lg btn-success btn-block" type="button" onclick="window.open('registrationpage.php')">
            Sign up
        </button>
        <p class="mt-5 mb-3 text-muted">&copy; 2018 Workshop 1 Group 13 </p>
        <p class="mt-1 mb-3 text-muted">Power by Harry & ZiHo </p>
    </div>
</form>
<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="bootstrap/jquery-slim.min.js"><\/script>')</script>
<script src="bootstrap/popper.min.js"></script>
<script src="bootstrap/bootstrap.min.js"></script>
</body>
</html>
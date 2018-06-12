<html>
<head>
    <style>
        .error {
            color: red;
        }

        #registGUI {
            width: 450px;
            height: 650px;
            position: absolute;
            left: auto;
            right: auto;
            top: auto;
            padding-left: 20px;
        }
    </style>
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
    <link href="bootstrap/carousel.css" rel="stylesheet">
</head>
<body>
<?php
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
$nameErr = $pwdErr = $confirErr = $addrErr = $emailErr = $phoneNOErr = "";
$toptips = "";
$name = $userpwd = $addr = $email = $phoneNO = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) { //if username is empty
        $nameErr = "<br>Username required";
    } else {
        $name = $_POST['username'];
        $sqluser = "SELECT * FROM userlist WHERE name='$name'";
        $resultuser = $conn->query($sqluser);
        if ($resultuser->num_rows > 0) { //if user name has existed
            $nameErr = "<br>Username has existed";
            $name = "";
        }
    }
    if (empty($_POST["userpwd"])) { //if password is empty
        $pwdErr = "<br>Password required";
    } else {
        if (!preg_match("/^(?=.*\d{2,})(?=.*[a-z]{2,})(?=.*[^0-9a-zA-Z]{2})[A-Z]{1}.{8,}[A-Z]{1}$/", $_POST["userpwd"])) {//check password format
            $pwdErr = "<br/>
                           •	10 + characters<br/>
                           •	Start and end with uppercase<br/>
                           •	2 non-alphanumeric<br/>
                           •	Minimum of 2 numerical characters<br/>
                           •	Minimum of 2 lowercase";
        } else { //if format is right
            $userpwd = $_POST["userpwd"];
        }
    }
    if ($_POST["userpwd"] != $_POST["confirpwd"] || empty($_POST["confirpwd"])) {//check the input matches password or not
        $confirErr = "<br>Your confirmed password and new password do not match";
    } else {//if it is right
        $confirpwd = $_POST["confirpwd"];
    }

    if (empty($_POST["addr"])) { //if address is empty
        $addrErr = "<br>Your address id required";
    } else {
        $addr = $_POST["addr"];
    }
    if (empty($_POST["phoneNO"])) { //if phone number is empty
        $phoneNOErr = "<br>Phone number is required";
    } else if (!preg_match("/^[0-9]{11}$/", $_POST["phoneNO"])) {
        $phoneNOErr = "<br>Invalid phone number";
    } else {
        $phoneNO = $_POST["phoneNO"];
    }
    if (empty($_POST["email"])) { //if email is empty
        $emailErr = "<br>Your email is required";
    } else {
        if (!preg_match("/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/", $_POST["email"])) { //check email's format
            $emailErr = "<br>Invalid email format";
        } else {// if format is right
            $email = $_POST["email"];
        }
    }
    if ($name != "" && $userpwd != "" && $addr != "" && $email != "" && $phoneNO != "") {//if user finish his input
        insertNewMember($name, $userpwd, $addr, $email, $phoneNO);//insert user information
        $toptips = "Success !!";
        session_start();
        $_SESSION['registName'] = $name;
        //jump to the remind registration page
        echo "<script language='javascript'>";
        echo "document.location='registsuccess.php'";
        echo "</script>";
    }
}
function insertNewMember($name, $pwd, $addr, $email, $phoneNO)
{
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
    //insert the user information into user list
    $sql = "INSERT INTO userlist (name,pwd,addr,phon,email) VALUES('$name','$pwd','$addr','$phoneNO','$email')";
    $conn->query($sql);
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
                <li class="nav-item">
                    <a class="nav-link" href="login_admin.php"> Admin </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php">About</a>
                </li>
            </ul>
            <p class="text-white form-inline my-2 my-md-0 ">
                <?php echo 'Hi,' . $_SESSION["loginName"]; ?>
            </p>
        </div>
    </div>
</nav>
<div id="registGUI">
    <h1>Registration</h1>
    <p class="error"><?php echo $toptips ?></p>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">

        User Name : <input type="text" name="username"><span class="error">*<?php echo $nameErr; ?></span><br/><br/>
        Password : <input type="text" name="userpwd"><span class="error">*<?php echo $pwdErr; ?></span><br/><br/>
        Confirm Password : <input type="text" name="confirpwd"><span
                class="error">*<?php echo $confirErr; ?></span><br/><br/>
        Address : <input type="text" name="addr"><span class="error">*<?php echo $addrErr ?></span><br/><br/>
        Phone Number : <input type="text" name="phoneNO"><span class="error">*<?php echo $phoneNOErr ?></span><br/><br/>
        E-mail : <input type="text" name="email"><span class="error">*<?php echo $emailErr ?></span><br/><br/>
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Submit" name="submit">
    </form>
</div>
</body>
</html>
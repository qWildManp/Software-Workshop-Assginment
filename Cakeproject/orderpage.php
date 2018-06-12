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
            font-size: large;
        }
    </style>
</head>

<body class="text-center">

<?php
session_start();
if (empty($_SESSION['loginName'])) {
    echo "<script language='javascript'>";
    echo "document.location='login_bs.php'";
    echo "</script>";
} else {
    $caketype = "";
    $typeErr = "";
    $success = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["caketype"])) { //if cake type doesn't been selected
            $typeErr = "You need to chose one type of cake !";
        } else {
            $toppings = $topping = "";
            $complete = "N";
            $name = $_SESSION["loginName"];
            $caketype = $_POST["caketype"];
            $size = $_POST["size"];
            $giftcard = $_POST["giftCard"];
            $comment = $_POST["comment"];
            $time = date("Y-m-d-h:ia");
            $Chocolate = $Fruit = $Oreo = $Candy = $Nut = $Jelly = "N";
            foreach ($_POST["extra"] as $topping) { //check users need of toppings with "Y" and "N"
                switch ($topping) {
                    case "Chocolate" :
                        {
                            $Chocolate = "Y";
                            break;
                        }
                    case "Fruit" :
                        {
                            $Fruit = "Y";
                            break;
                        }
                    case "Oreo" :
                        {
                            $Oreo = "Y";
                            break;
                        }
                    case "Candy" :
                        {
                            $Candy = "Y";
                            break;
                        }
                    case "Nut" :
                        {
                            $Nut = "Y";
                            break;
                        }
                    case "Jelly" :
                        {
                            $Jelly = "Y";
                            break;
                        }
                }
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
            $sqluser = "SELECT * FROM userlist WHERE name='$name'";
            $result = $conn->query($sqluser);
            if ($result->num_rows > 0) { //if find this kind of user
                while ($row = $result->fetch_assoc()) {//get user's phone number and address
                    $phonNo = $row["phon"];
                    $address = $row["addr"];
                }
            }
            $sql = "INSERT INTO booklist(username,cakestyle,size,chocolate,fruit,oreo,candy,nut,jelly,giftcard,
                    comment,city,phoneNO,complete) VALUES('$name','$caketype','$size','$Chocolate','$Fruit','$Oreo',
                    '$Candy','$Nut','$Jelly','$giftcard','$comment','$address','$phonNo','$complete')";
            if ($conn->query($sql) != false) { //if order successfully uploaded
                $success = "Your order is upload to the server!!";
                echo "<script> alert('success'); document.location='userpage.php';</script>";
            }
            else { //if order doesn't been uploaded
                $success = "Failed";
            }
            $conn->close();
        }

    }
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
                <li class="nav-item active">
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
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
    <div class="container">
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <h2>Cake Type</h2>
        <table border="1">
            <tr>
                <td>
                    <img src="pics/cake1.jpeg" width="200px" height="200px">
                    <input type="radio" name="caketype" value="A">A
                </td>
                <td>
                    <img src="pics/cake2.jpg" width="200px" height="200px">
                    <input type="radio" name="caketype" value="B">B
                </td>
                <td>
                    <img src="pics/cake3.jpg" width="200px" height="200px">
                    <input type="radio" name="caketype" value="C">C
                </td>
            </tr>
            <tr>
                <td>
                    <img src="pics/cake4.jpg" width="200px" height="200px">
                    <input type="radio" name="caketype" value="D">D
                </td>
                <td>
                    <img src="pics/cake5.jpg" width="200px" height="200px">
                    <input type="radio" name="caketype" value="E">E
                </td>
                <td>
                    <img src="pics/cake6.jpg" width="200px" height="200px">
                    <input type="radio" name="caketype" value="F">F
                </td>
            </tr>
        </table>
        <span class="error"><?php echo $typeErr ?></span>
        <br/><br/>
        <h2>Cake Size</h2>
        <select name="size">
            <option value="Small">Small</option>
            <option value="Medium">Medium</option>
            <option value="Large">Large</option>
        </select>
        <br/><br/>
        <h2>Extra toppings</h2>
        <table>
            <tr>
                <td>
                    <img src="pics/top1.jpg" width="100px" height="100px">
                    <input type="checkbox" name="extra[]" value="Chocolate">Chocolate
                </td>
                <td>
                    <img src="pics/top2.jpg" width="100px" height="100px">
                    <input type="checkbox" name="extra[]" value="Fruit">Fruit
                </td>
                <td>
                    <img src="pics/top3.jpg" width="100px" height="100px">
                    <input type="checkbox" name="extra[]" value="Oreo">Oreo
                </td>
                <td>
                    <img src="pics/top4.jpeg" width="100px" height="100px">
                    <input type="checkbox" name="extra[]" value="Candy">Candy
                </td>
                <td>
                    <img src="pics/top5.jpg" width="100px" height="100px">
                    <input type="checkbox" name="extra[]" value="Nut">Nut
                </td>
                <td>
                    <img src="pics/top6.jpg" width="100px" height="100px">
                    <input type="checkbox" name="extra[]" value="Jelly">Jelly
                </td>
            </tr>
        </table>
        <br/>
        <h3>Gift Card</h3>
        <input type="radio" name="giftCard" value="Y">Yes
        <input type="radio" name="giftCard" value="N" checked>No
        <br/>
        <h3>Message & Comment</h3>
        <textarea rows="10" cols="50" name="comment"></textarea>
        <br/><br/>
        <input type="submit" value="Submit">
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="bootstrap/jquery-slim.min.js"><\/script>')</script>
<script src="bootstrap/popper.min.js"></script>
<script src="bootstrap/bootstrap.min.js"></script>
</body>
</html>

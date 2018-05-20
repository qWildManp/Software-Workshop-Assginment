<html>
    <head>
        <style>
            .error{
                color:red;
            }
        </style>
    </head>
	<body>
    <?php
    $nameErr=$pwdErr=$loginErr=$firstname=$familyname=$age=$creditscore="";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["username"])){
            $nameErr = "User name required";
        }
        if(empty($_POST["userpwd"])){
            $pwdErr = "Password required";
        }
            else{
                $servername = "localhost";
                $username = "m730026028";
                $password = "abc123xyz";
                $dbname = "test";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $name = $_POST["username"];
                $pwd = $_POST["userpwd"];
                $sql = "SELECT  firstname , familyname , age , creditscore FROM usertable WHERE (username='$name' OR id_number='$name')  AND password='$pwd'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $firstname = $row["firstname"];
                        $familyname = $row["familyname"];
                        $age = $row["age"];
                        $creditscore = $row["creditscore"];

                    }
                }
                else {
                    $loginErr = "Login failed : incorrect password OR user name doesn't exist!";
                }
                $conn->close();

            }
    }

    ?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
		User Name : <input type="text" name="username"><span class="error">* <?php echo $nameErr;?></span><br/><br/>
		Password : <input type="text" name="userpwd"><span class="error">* <?php echo $pwdErr;?></span><br/><br/>
		<input type="submit" name="Submit" ><span class="error"><?php echo $loginErr;?></span>
        <?php
              echo "<table border=1>";
              echo "<tr><th>Name</th><td>$firstname $familyname </td></tr>";
              echo "<tr><th>Age</th><td>$age</td></tr>";
              echo "<tr><th>Credit Scores</th><td>$creditscore </td></tr>";
              echo"</table>";
        ?>
	</form>
    <a href="registration.php" >New user ?</a>
	</body>
</html>
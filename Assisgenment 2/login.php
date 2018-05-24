<html>
    <head>
        <style>
            .error{
                color:red;
            }
            #loginGUI{
                width : 450px;
                height: 500px;
                position:absolute;
                border-collapse:collapse;
                border:3px solid cadetblue;
                padding-left: 40px;
                left:700px;
                top :300px;
            }
        </style>
    </head>
	<body>
    <?php
    $nameErr=$pwdErr=$loginErr=$firstname=$familyname=$age=$creditscore=$table="";
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
                $dbname = "m730026028";

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
					 $table="<table border=1>.
							<tr><th>Name</th><td>$firstname $familyname </td></tr>
							<tr><th>Age</th><td>$age</td></tr>
							<tr><th>Credit Scores</th><td>$creditscore </td></tr>
							</table>";
					$loginErr = "Success";
                }
                else {
                    $loginErr = "Login failed : incorrect password OR user name doesn't exist!";
                }
                $conn->close();

            }
    }

    ?>
    <div id="loginGUI">
     <h1 style="text-align: center">Login</h1>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
		User Name : <input type="text" name="username"><span class="error">* <?php echo $nameErr;?></span><br/><br/>
		Password  : <input type="text" name="userpwd"><span class="error">* <?php echo $pwdErr;?></span><br/><br/>
		<input type="submit" name="Submit" ><span class="error"><?php echo $loginErr;?></span>
	</form>
    <a href="registration.php" >New user ?</a><span>
	<?php echo $table?></span>
    </div>
	</body>
</html>
<?php
	$servername = "localhost";
	$username = "m730026028";
	$password = "abc123xyz";
	$dbname = "m730026028";
	// $servername = "localhost";
	// $username = "sdw1User";
	// $password = "sdw1pwd";
	// $dbname = "sdw1DB";
	$myList = ""; // Output sandwich ingridients
	$messages=""; //
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$nameErr=$mobileErr=$dormErr="";
    $name=$mobileNO=$dorm="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    if(empty($_POST['username'])){
	        $nameErr = "username required";
        }
        elseif(!preg_match("/^([i-m])([0-9]{9})$/",$_POST['username'])){
	        $nameErr= "Invalid username format";
        }
        else{
            $name=$_POST['username'];
	        $sql = "SELECT * FROM myCustomers WHERE username = '$name'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $nameErr="Name has exist";
                $name = "";
            }
            else{
                $name = $_POST['username'];
            }
        }
        if(empty($_POST['mobileno'])){
	        $mobileErr = "mobile number required";
        }
        elseif(!preg_match("/^[0-9]{11}$/",$_POST['mobileno'])){
	        $mobileErr = "Invalid mobile number";
        }
        else{
	        $mobileNO=$_POST['mobileno'];
        }
        if(empty($_POST['dorm'])){
	        $dormErr = "Your Dormitory is needed";
        }
        else{
	        if(!preg_match("/^([V])([0-9]{2})$/",$_POST['dorm'])){
	            $dormErr = "Invalid Dormitory address";
            }
            else{
	            $dorm = $_POST['dorm'];
            }
        }
        if($name==""||$mobileNO==""||$dorm==""){
	        $tip = "Please complete your information";
        }
        else{
	        $sql = "INSERT INTO myCustomers(username,mobileNo,dormAddr) VALUES ('$name','$mobileNO','$dorm')";
	        $tip = "Success";
        }

}
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        #messages{color:red;}
        td{
            vertical-align: top;
            padding:15px;
        }
        table{margin: 50px auto;
            border: 1px solid black;
        }
        div{text-align: center;

        }
    </style>
</head>

<body>
<h1 class ="message"><?php echo $tip?></h1>
<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="Post">
    <table>
        <tr>
            <th colspan="3"><h2>My Sandwich - My Way</h2></th>
        </tr>
        <tr>
            <td>
                Username:<input type="text" name="username" id="username" /><span class ="message"><?php echo $nameErr?></span>
            </td>
            <td>
                MobileNo:<input type="text" name="mobileno" id="mobileno" /><span class ="message"><?php echo $mobileErr?></span>
            </td>
            <td>
                Dorm Address:<input type="text" name="dorm" id="dorm" /><span class ="message"><?php echo $dormErr?></span>
            </td>
        </tr>
        <tr>
            <th colspan="3"><input type="submit" name="button" id="button" value="Order" /></td>
        </tr>
    </table>
</form>

<div>
    <p id="messages"><?php echo $messages; ?></p>
    <p id="myList"><?php echo $myList;?></p>
</div>
</body>
</html>
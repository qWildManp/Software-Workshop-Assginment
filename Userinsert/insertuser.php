<?php
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
$name=$_POST["username"];
$pwd =$_POST["userpwd"];
$sql = "INSERT INTO User (username,userpassword) VALUES ('$name','$pwd')";
$result = $conn->query($sql);
    echo " success";
$conn->close();

?>
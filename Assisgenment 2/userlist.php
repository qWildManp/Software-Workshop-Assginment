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
$sql = "SELECT familyname, id_number,age,gender,creditscore FROM usertable";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    echo"<table border= 1>";
    echo"<tr><th>Family Name</th><th>ID Number</th><th>Age</th><th>Gender</th><th>Credit Score</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row['familyname']."</td><td>".$row["id_number"]."</td><td>".$row["age"]."</td><td>".$row["gender"]."</td><td>".$row["creditscore"]."</td>";
    }
}
else {
    echo "0 results";
}
?>
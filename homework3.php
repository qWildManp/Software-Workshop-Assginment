<html>
<head>
    <style>
        .error {color:red;
        td{
            min-width: 5rem;
        }
    </style>
</head>

<body>
<?php
$nameErr=$programmeErr=$idErr=$dobErr=$genderErr="";
$name=$programme=$id=$dob=$gender=$favorites=$proout=$fruitiac="";
$favorites=array();
$month=["January","February","March","April","May","June","July","August","September","October","November","December"];
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    //Name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $_POST["name"])) {
            $nameErr = "Only letters and white space allowed";
        }
        else{$name = $_POST["name"];}
        // check if name only contains letters and whitespace
    }


    //Programme
    if (empty($_POST["programme"])) {
        $programmeErr = "programme is required";
    } else {
        if (prog($_POST["programme"]) == "null") {
            $programmeErr = "This is not a programme in DST or Invalid format(you should only use capital english characters and it should be abbreviation)";
        }
        else {
            $programme = $_POST["programme"];
            $proout = prog($_POST["programme"]);
        }
    }


    //StudentID
    if (empty($_POST["id"])) {
        $idErr = "student's id is needed";
    }
    else {
        if(!preg_match("/^[a-z][0-9]{9}$/",$_POST["id"])){
            $idErr = "This is not an UIC student's ID";
        }
        else{$id = $_POST["id"];}
    }


    //Date of birth
    $mm = date("m",strtotime($_POST["dob"]));
    $dd = date("d",strtotime($_POST["dob"]));
    if (empty($_POST["dob"])) {
        $dobErr = "Date of birth is required";
    }
    else {
        $dob = date("d F Y",strtotime($_POST["dob"]));
        $fruitiac = fruitiac($mm, $dd);
    }


    //Gender
    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    }
    else {
        $gender = $_POST["gender"];
    }
    if (empty($_POST["favorites"])){
        $favorites = null;
    }
    else{
        $favorites = $_POST["favorites"];
    }

}

function fruitiac($mm, $dd) {  //function to check the date of birth and output the fruits
//allocate friut depending on the date of birth
    switch($mm){
        case 1 :{
            if ($dd>=14){$fruitiac = "Cherry";break;}
            elseif($dd<=5){$fruitiac = "Lychees";break;}
        }
        case 2 : {$fruitiac = "Cherry";break;}
        case 3 :{
            if($dd<=2){$fruitiac = "Cherry";break;}
            elseif ($dd>=10){$fruitiac = "Durian";break;}
        }
        case 4 : {
            if($dd<=27){$fruitiac = "Durian";break;}
        }
        case 6 : {
            if($dd>=5&&$dd<=29){$fruitiac = "Starfruit";break;}
        }
        case 7 : {
            if($dd>=11){$fruitiac = "Oranges";break;}
        }
        case 8 : {
            if($dd<=27){$fruitiac = "Oranges";break;}
        }
        case 9 : {
            if($dd>=17){$fruitiac = "Banana";break;}
        }
        case 10 :{
            if($dd<=21){$fruitiac = "Banana";break;}
        }
        case 11 : {
            if($dd>=3){$fruitiac = "Lychees";break;}
        }
        case 12 : {$fruitiac = "Lychees";break;}
        default : {$fruitiac = "you only like vegetables";}
    }
    return $fruitiac;

}


function prog($data) {  //function to check student's programme
//use PHP switch statement
    switch($data){
        case "CST" :{$progTitle = "Computer Science and Technology(CST)";break;}
        case "APSY":{$progTitle = "Applied Psychology(APSY)";break;}
        case "FST": {$progTitle = "Food Science and Technology(FST)";break;}
        case "ENVS":{$progTitle = "Environmental Science(ENVS)";break;}
        case "STAT":{$progTitle = "Statistic(STAT)";break;}
        case "FM":{$progTitle = "Financial mathematics(FM)";break;}
        case "CDS":{$progTitle = "Computer Data Science(CDS)";break;}
        default :{$progTitle = "null";break;}
    }
    return $progTitle;
}
?>
<p><span class="error">* required field</span></p><br>
<form method="post" action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Name: <input type="text" name="name" value="<?php echo $name;?>">
    <span class="error">* <?php echo $nameErr;?></span><br><br>
    Programme: <input type="text" name="programme" value="<?php echo $programme;?>">
    <span class="error">* <?php echo $programmeErr;?></span><br><br>
    UIC ID: <input type="text"  name="id" value="<?php echo $id;?>">
    <span class="error">*<?php echo $idErr?></span><br><br>
    Date of Birth: <input type="date" name="dob" value="<?php echo $dob?>">
    <span class="error">*<?php echo $dobErr?></span><br>
    <br><br>
    List of favorite:<br>
    Watching movies<input type="checkbox" name="favorites[]"  value="Watching movies"><br>
    Collecting Stamps<input type="checkbox" name="favorites[]" value="Collecting Stamps"><br>
    Eating out<input type="checkbox" name="favorites[]"  value="Eating out"><br>
    Badminton<input type="checkbox" name="favorites[]" value="Badminton"><br>
    Table Tennis<input type="checkbox" name="favorites[]" value="Table Tennis"><br>
    playing the guitar<input type="checkbox" name="favorites[]"  value="playing the guitar"><br>
    coffee with friends<input type="checkbox" name="favorites[]" value="coffee with friends"><br>
    playing on my phone<input type="checkbox" name="favorites[]" value="playing on my phone"><br>
    <br><br>
    Gender:
    <input type="radio" name="gender"<?php if (isset($gender) && $gender=="female") echo "checked";?> value="Female">Female
    <input type="radio" name="gender"<?php if (isset($gender) && $gender=="male") echo "checked";?> value="Male">Male
    <input type="radio" name="gender"<?php if (isset($gender) && $gender=="other") echo "checked";?> value="Other">Other
    <span class="error">*<?php echo $genderErr?></span><br>
    <br><br>
    <input type="submit" name="submit" value="submit">
</form>
<?php
echo "<h2>Your Input</h2>";
echo"<table border=1>";
echo"<th colspan=2> Student Information</th>";
echo"<tr><th>Name</th><td>$name</td></tr>";
echo"<tr><th>UIC ID</th><td>$id</td></tr>";
echo"<tr><th>Gender</th><td>$gender</td></tr>";
echo"<tr><th>Programme</th><td>$proout</td></tr>";
echo"<tr><th>DOB</th><td>$dob</td></tr>";
echo"<tr><th>Fruitiac</th><td>$fruitiac</td></tr>";
echo"<tr><th>List of favourites</th><td>";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!$favorites){  //if no favorite is selected
        echo "no favourites were selected";
    }
    else{
        for($x=0;$x<count($favorites);$x++) { //loop to output the favorites
            echo $favorites[$x];
            echo "<br/>";
        }
    }
}
echo"</td></tr>";
echo"</table>";
?>
</body>

</html>
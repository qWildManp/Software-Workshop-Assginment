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

	function getFillings($array){
		$fillings = "";
		foreach ($array as $value) {
		    switch($value){
                case "cu":{$type ="Cucumber"; break;}
                case "on" :{$type = "Onions"; break;}
                case "to" :{$type ="Tomatoes"; break;}
                case "ch" :{$type = "Cheese";break;}
                default :{$type = "Nothing";break;}
            }
			$fillings .= "$type ";
		}
		return $fillings;
	}	

	function calculateCost($sandwich, $bread, $fillings ) { 
	// add code here to calculate the cost
        $fillingvalues=$sum=0;
        switch ($bread) {
            case "white" :
                {
                    $typevalue = 8;
                    $type ="White Slice";
                    break;
                }
            case "brone" :
                {
                    $typevalue = 9;
                    $type ="Brown Slice";
                    break;
                }
            case "baguette" :
                {
                    $typevalue = 10;
                    $type ="Baguette";
                    break;
                }
            case "panini" :
                {
                    $typevalue = 12;
                    $type ="Panini";
                    break;
                }
            default :
                {
                    $typevalue = 0;
                    $type ="Nothing";
                }

        }

        switch ($sandwich) {
            case "melt" :
                {
                    $sandwichvalue = 42;
                    $sandwichtype="Subway Melt";
                    break;
                }
            case "veggie":
                {
                    $sandwichvalue = 28;
                    $sandwichtype="Veggie";
                    break;
                }
            case "club" :
                {
                    $sandwichvalue = 33;
                    $sandwichtype="Club Sandwich";
                    break;
                }
            case "Fishy" :
                {
                    $sandwichvalue = 28;
                    $sandwichtype= "Fishy wrap";
                    break;
                }
            case "burger" :
                {
                    $sandwichvalue = 48;
                    $sandwichtype ="Buger";
                    break;
                }
            default:
                {
                    $sandwichvalue = 0;
                    $sandwichtype ="Nothing";
                }
        }
        if (is_array($fillings)) {
            foreach ($fillings as $fill) {
                switch ($fill) {
                    case "cu" :
                        {
                            $fillingvalue = 2.5;
                            break;
                        }
                    case "on" :
                        {
                            $fillingvalue = 1.0;
                            break;
                        }
                    case "to" :
                        {
                            $fillingvalue = 3.0;
                            break;
                        }
                    case "ch" :
                        {
                            $fillingvalue = 5.0;
                            break;
                        }
                }
                $fillingvalues = $fillingvalues + $fillingvalue;
            }
        } else {
            $fillingvalues = 0;
        }
        $sum =$typevalue + $sandwichvalue + $fillingvalues;
		$ingridients="";
		$ingridients .="Sandwich: $sandwichtype <br/>";
		$ingridients .= "Bread Type: $type <br/>";
		$ingridients .= "Fillings: ". getFillings($fillings) . "<br/>";
		$ingridients .= "The cost :$sum";
		return $ingridients;
	}


	// If form submitted - 
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $formSandwichType = $_POST['sandwichType'];
        $formBreadType = $_POST['breadType'];
        $formFillings = $_POST['fillings'];
        $formUsername = $_POST['username'];
        $formMobileNo = $_POST['mobileno'];
        $formDormAddr = "";
        $result = "";


        // check username exist and matches mobile number
        if (empty($_POST['username']) || empty($_POST['mobileno'])) {
            $messages = "Please complete informations to order";

        } else {
            $sql = "SELECT * FROM myCustomers WHERE username = '$formUsername'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($formMobileNo == $row['mobileNo']) { // replace the TRUE with your expression between the brackets
                    $messages = "Dear" . $row['username'] . " ,your order will be delivered to " . $row['dormAddr'] .
                        " ,we will cal you on " . $row['mobileNo'];

                } else {
                    $messages = "Dear" . $formUsername . ", your mobile number" . $formMobileNo . " does not match";
                }
                // Calculate sandwich cost
                $myList = calculateCost($formSandwichType, $formBreadType, $formFillings);


            } else {
                $messages = "Sorry , you are not a member - please register if you wish to order a sandwich";

            }
        }


        $conn->close();
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
		<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="Post">
		<table>
			<tr>
				<th colspan="3"><h2>My Sandwich - My Way</h2></th>
			</tr>
			<tr>
				<td>
			  		Username:<input type="text" name="username" id="username" />
			  	</td>
				<td>
					MobileNo:<input type="text" name="mobileno" id="mobileno" />
				</td>
				<td>
					Dorm Address:<input type="text" name="dorm" id="dorm" />
				</td>
			</tr>
			<tr>
				<td><h4>Sandwich</h4>
				  	<input type="radio" name="sandwichType" id="melt" value="melt" />Subway Melt(42) <br/>
					<input type="radio" name="sandwichType" id="veggie" value="veggie" />Veggie(28) <br/>
					<input type="radio" name="sandwichType" id="club" value="club" />Club Sandwich(33)<br/>
					<input type="radio" name="sandwichType" id="Fishy" value="Fishy" />Fishy wrap(28) <br/>
					<input type="radio" name="sandwichType" id="burger" value="burger" />Burger(48) <br/>
				</td>
				<td><h4>Bread type</h4>
					<input type="radio" name="breadType" id="white" value="white" />White Slice(8) <br/>
					<input type="radio" name="breadType" id="brown" value="brown" />Brown Slice(9)<br/>
					<input type="radio" name="breadType" id="baguette" value="baguette" />Baguette(10) <br/>
					<input type="radio" name="breadType" id="panini" value="panini" />Panini(12)<br/>
				</td>
				<td><h4>filling</h4>
				    <input type="checkbox" name="fillings[]" value="cu" />Cumcumber (2.5) <br/>
				 	<input type="checkbox" name="fillings[]" value="on" />Onions(1.0) <br/>
				  	<input type="checkbox" name="fillings[]" value="to" />Tomatoes(3.0) <br/>
				    <input type="checkbox" name="fillings[]" value="ch" />Cheese(5.0) <br/>
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
            <p><a href="registration.php">NEW COMER</a></p>
		</div>
	</body>
</html>

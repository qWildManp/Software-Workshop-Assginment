<html>
    <head>
        <style>
            .error{
                color:red;
            }
            #registGUI{
                width : 450px;
                height : 800px;
                position : absolute;
                border-collapse: collapse;
                border : 3px solid cadetblue;
                left :700px;
                top :200px;
                padding-left: 20px;
            }
        </style>
    </head>
    <body>
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

		
        $nameErr=$pwdErr=$confirErr=$fnameErr=$firnameErr=$idErr=$genderErr=$loanErr="";
        $lvalues=$lvalue=$gvalue=$pvalue=$age=0;
        $name=$userpwd=$familyname=$firstname=$id=$loan=$gender=$confirpwd=$toptips="";
        $loan = array();
        if($_SERVER["REQUEST_METHOD"] == "POST"){
			//username check
            if(empty($_POST["username"])){
                $nameErr = "Username required";
            }
            else{
                $name = $_POST['username'];
                $sql = "SELECT username FROM usertable WHERE username='$name'";
                $result = $conn->query($sql);
                if($result->num_rows>0){
                    $nameErr = "Username has existed";
                    $name = "";
                }
             }

			 
			 //password check
            if(empty($_POST["userpwd"])){//if user don't input password
                $pwdErr = "Password required";
            }
            else{
				//password Invalidation
                if(!preg_match("/^(?=.*\d{2,})(?=.*[a-z]{2,})(?=.*[^0-9a-zA-Z]{2})[A-Z]{1}.{8,}[A-Z]{1}$/",$_POST["userpwd"])){
                $pwdErr = "•	10 + characters
                           •	Start and end with uppercase
                           •	2 non-alphanumeric
                           •	Minimum of 2 numerical characters
                           •	Minimum of 2 lowercase";
                }
                else{
                    $userpwd = $_POST["userpwd"];
                }
            }
			
			
			//password confirom
            if($_POST["userpwd"]!=$_POST["confirpwd"]||empty($_POST["confirpwd"])){
                 $confirErr = "Your confirmed password and new password do not match";
            }
            else{
                $confirpwd = $_POST["confirpwd"];
            }
			
			
			//familyname check
            if(empty($_POST["fname"])) {
                $fnameErr = "Family name required";
            }
                else{
                    $familyname = $_POST["fname"];
                }

				
			//firstname check
            if(empty($_POST["firname"])){
                $firnameErr = "First name required";
            }
            else{
                $firstname = $_POST["firname"];
            }
			
			
			//id check
			$id=$_POST["id"];
			if(empty($id)){
                $idErr = "ID card number required";
            }
                else{//id Invalidation
                    if(!preg_match("/^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$/",$_POST["id"])){
                $idErr = "Invalid id number";
                }
                else{   //calculate age and age check
                        $y = (int)substr($id,6,4);
                        $m = (int)substr($id,10,2);
                        $d = (int)substr($id,12,2);
                        $today = (int)date("md");
                        $birth =(int)substr($id,10,4);
                        $agey = date("Y")-$y;
                        if($today<$birth){
                            $age=$agey-1;
                        }
                        else{
                            $age=$agey;
                        }
                        if($age<18){
                            $idErr = "You are under 18 years old";
                        }
                    }
                }
				
				
			//gender check	
            if(empty($_POST["gender"])) {
                $genderErr = "Gender required";
            }
            else if($age>=18){
                    $gender = $_POST["gender"];
                    switch($gender){
                        case "M":{
                            if ($age <= 24 && $age >= 18) {
                                $gvalue = -50;
                                break;
                            } else if ($age >= 25 && $age <= 40) {
                                $gvalue = 25;
                                break;
                            } else if ($age >= 41 && $age <= 60) {
                                $gvalue = 40;
                                break;
                            } else if ($age > 60) {
                                $gvalue = 11;
                                break;
                            }
                        }
                        case "F":{
                            if($age <=24 && $age>= 18){
                                $gvalue = 25;
                                break;
                            }
                            else if($age >= 25&& $age<= 40){
                                $gvalue = 50;
                                break;
                            }
                            else if($age >= 41&& $age <= 60){
                                $gvalue = 40;
                                break;
                            }
                            else if($age > 60){
                                $gvalue = 1;
                                break;
                            }
                        }
                    }
                }
				
				
                if($age>=18){
                switch($_POST["province"]){// province value return
                    case "Municipalities" :{$pvalue = 100;break;}
                    case "Province" :{$pvalue = 60;break;}
                    case "Autonomous" :{$pvalue = 72;break;}
                    case "SAR" :{$pvalue = 123;break;}
                    }
                if(is_array($loan = $_POST["Loan"])){// loan values return
                $lvalues = 0;
                }
                else{
                $lvalues = 0;
                foreach($loan = $_POST["Loan"] as $i){
                    switch($i){
                        case "Loanforthehouse" :{$lvalue = 200;break;}
                        case "MasterCard" : {$lvalue = 55;break;}
                        case "Visa" : {$lvalue = 50;break;}
                        case "StoreCard" : {$lvalue = -25;break;}
                        case "OtherLoan" : {$lvalue = -100;break;}
                        }
                        $lvalues = $lvalues + $lvalue;
                    }
                }
            }
    } 
	
	
	//userinformation check
    if($name==""||$userpwd==""||$gender==""||$firstname==""||$familyname==""||$id==""||$confirpwd==""){ 
            $toptips = "Please complete your user information !";
    }
    else {
         $creditscore=creditScoreCalc($pvalue,$lvalues,$gvalue);
        $toptips = insertNewMember($name, $userpwd, $familyname, $firstname, $id, $age, $gender, $loan, $creditscore,$toptips);
    }
	
	
//function to calculate credit scores	
function creditScoreCalc($pvalue,$lvalues,$gvalue){
        $creditscore = $pvalue+$lvalues+$gvalue;
        return $creditscore;
           }

		   
//function to insert new user information
function insertNewMember($name,$pwd,$familyname,$firstname,$id,$age,$gender,$loan,$creditscore,$toptips){
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
    $houseloan=$mastercard=$visacard=$storecard=$otherloan="N";
    if(is_array($loan)){
    foreach($loan as $loantype){
        if($loantype=="Loanforthehouse"){
            $houseloan = "Y";
        }
        if($loantype=="MasterCard"){
            $mastercard = "Y";
        }
        if($loantype=="Visa"){
            $visacard = "Y";
        }
        if($loantype=="StoreCard"){
            $storecard = "Y";
        }
        if($loantype=="OtherLoan"){
            $otherloan = "Y";
        }
    }
    }
    if($age<18){
        $toptips = "Failed";

    }
    else{
    $sql = "INSERT INTO usertable (username,password,id_number,firstname,familyname,age,gender,houseloan,mastercard,visacard,storecard,otherloan,creditscore) VALUES('$name','$pwd','$id','$firstname','$familyname','$age','$gender','$houseloan','$mastercard','$visacard','$storecard','$otherloan','$creditscore')";
    $conn->query($sql);
       $toptips =  "Success";
    $conn->close();
    }
    return $toptips;
}
?>
        <div id="registGUI">
        <h1>Registration</h1>
        <p class="error"><?php echo $toptips?></p>
        <form  action = "<?php htmlspecialchars($_SERVER["PHP_SELF"])?>"method = "POST">

            User Name : <input type="text" name="username"><span class="error">*<?php echo $nameErr;?></span><br/><br/>
            Password : <input type="text" name="userpwd"><span class="error">*<?php echo $pwdErr;?></span><br/><br/>
            Confirm Password : <input type="text" name="confirpwd"><span class="error">*<?php echo $confirErr;?></span><br/><br/>
            Family Nmae : <input type="text" name="fname"> <span class="error">*<?php echo $fnameErr;?></span><br/><br/>
            First Name : <input type="text" name="firname"> <span class="error">*<?php echo $firnameErr?></span><br/><br/>
            ID Card : <input type="text" name="id"> <span class="error">*<?php echo $idErr?></span><br/><br/>
            Gender : <input type="radio" name="gender" value="M">Male
                     <input type="radio" name="gender" value="F">Female
                     <br/><span class="error">*<?php echo $genderErr;?></span>
            <br/><br/>
            Province: <select name="province">
                            <option value="Municipalities">Municipalities</option>
                            <option value="Province">Province</option>
                            <option value="Autonomous">Autonomous</option>
                            <option value="SAR">SAR</option>
                      </select><br/><br/>
            Loans :<br/>
            <input type="checkbox" name="Loan[]" value="Loanforthehouse">Loan for the house<br/>
            <input type="checkbox" name="Loan[]" value="MasterCard">MasterCard<br/>
            <input type="checkbox" name="Loan[]" value="Visa">Visa<br/>
            <input type="checkbox" name="Loan[]" value="StoreCard">StoreCard<br/>
            <input type="checkbox" name="Loan[]" value="OtherLoan">OtherLoan
            <br/><br/>
            <input type="submit" name="submit">
        </form>
        <a href="login.php"> Already a member ?</a>
        </div>
    </body>
</html>
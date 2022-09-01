<?php

// Starting the session, necessary for using session variables
session_start();

$host="localhost";
$user="root";
$password="";
$db="project";
$errors = array();
$_SESSION['success'] = "";

// Connect to database
$conn = mysqli_connect($host,$user,$password,$db);

// Visits for Patient
if(isset($_POST['visitdate'])) {
        
    $visitdate = $_POST['visitdate'];
    $patientId = $_POST['patientId'];
    $weight = $_POST['weight'];
    $temperature = $_POST['temperature'];
    $bloodPressure = $_POST['bloodPressure'];
    $height = $_POST['height'];
    $reason = $_POST['reason'];
    
    // Get doctor's id
    $sql = "SELECT * FROM doctor WHERE email='".$_SESSION['DoctorEmail']."' limit 1";
    $result = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result)==1) {
        $row = mysqli_fetch_row($result);
        $doctorId = $row[0];

        $sql = "INSERT INTO visits (patient_ID, doctor_ID, visit_Date, weight, temp, blood_Pressure, height, reason)
            VALUES ('".$patientId."', '".$doctorId."', '".$visitdate."', '".$weight."', '".$temperature ."', '".$bloodPressure."', '".$height."', '".$reason."')";

        $result = mysqli_query($conn,$sql);

        if ($result) {
            echo "<html>
            <style>
            h1 {
                color: #f1ebd5
            }
            </style>

            <h1>Visit added successfully!</h1>
            </html>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    else {
        echo "Please login and then try. Invalid doctor id.";
    }
}

?>

<!DOCTYPE html>    
<html>    
<style>
	body{
		background-color: darkred;
	}
	h1,h2, p{
		color: #f1ebd5
	}
	table{
		width: 900px;
		border-collapse: collapse;
	}
	caption{
		color: #f1ebd5
	}
	table , th, td{
		border: 1px solid black;
	}
	tr:nth-child(even){
		background-color: #f1ebd5;
	}
	tr:nth-child(odd){
		background-color: white;
	}
h1,h2 {text-align: center;}
p {text-align: center;}
form {text-align: center; margin: auto;}

form {
    width: 80%;
    max-width: 40em;
    margin: 0 right;
    color: #FFFFFF;
    padding: 0.5em;
}

label, input[type=text], select {
    display: inline-block;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -o-box-sizing: border-box;
    -box-sizing: border-box;
    margin-bottom: .7em;    
}

label {
    width: 16%;
    text-align: right;
    margin: 0 0% 0 0;
}

input[type=text] {
    width: 30%;
}

select {
    width: 10%;
}

fieldset {
    margin: 0 0 2em 0;
}
</style>
	<head>    
        <title>Visit form</title>    
   		<link rel="stylesheet" type="text/css" href="css/double_login.css">    
	</head>    
    <body>    
        
    <div class="login-block">    
    <h2>Visit Form</h2><br>

        <form  method="POST" action="#">    
        <label><b>Visit Date    
            </b>    
            </label>    
            <input type="date" name="visitdate" placeholder="Visit Date" required/>    
            <br><br>    

            <label><b>Patient Id     
            </b>    
            </label>    
            <input type="text" name="patientId" placeholder="Patient Id" required/>    
            <br><br>   
            
            <label><b>Weight (lbs)   
            </b>    
            </label>    
            <input type="text" name="weight" placeholder="Weight (lbs)" required/>    
            <br><br> 

            <label><b>Temperature
            </b>    
            </label>    
            <input type="text" name="temperature" placeholder="Temperature" required/>    
            <br><br> 

            <label><b>Blood pressure
            </b>    
            </label>    
            <input type="text" name="bloodPressure" placeholder="Blood pressure" required/>    
            <br><br> 

            <label><b>Height
            </b>    
            </label>    
            <input type="text" name="height" placeholder="Height" required/>    
            <br><br> 

            <label><b>Reason
            </b>    
            </label>    
            <input type="text" name="reason" placeholder="Reason" required/>    
            <br><br> 

            <input type="submit" name="submit" value="Add Visit" CLASS="btn-login"/>  
            <br><br>

        </form>     

    </div> 
    </body>    

    <form method="POST" action="doctor_visits.php">
 
    <input type="submit" name="visits" value="Back to Visits"/>  
    <br><br>
    </form>

</html> 
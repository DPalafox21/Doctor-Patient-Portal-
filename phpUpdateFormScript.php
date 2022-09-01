<!DOCTYPE html>
<html lang="en">
<head>
<title>Patient Homepage</title>
<link rel="profile" hrf="profile.php">
<link rel="logout" hrf="double_login.php">
<link rel="profile" hrf="profile.php">
<link rel="logout" hrf="double_login.php">
</head>
<body>

<style>
	body{
		background-color: darkred;
	}
	h1, p{
		color: #f1ebd5;
        margin: center;
	}
	table{
		width: 900px;
		border-collapse: collapse;
	}
	caption{
		color: #f1ebd5;
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
    
</style>



<?php

session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION["PatientEmail"]);
    header("location: double_login.php");
}
$username = "root"; 
$password = ""; 
$database = "project";

$mysqli = new mysqli("localhost", $username, $password, $database);

$query = "SELECT * FROM patient WHERE email = '".$_SESSION["PatientEmail"]."' limit 1";
$result1 = $mysqli->query($query);
$row_p = $result1->fetch_assoc();

$doc_id = $row_p["patient_ID"];
$doc_fname = $_POST["first_Name"];
$doc_lname = $_POST["last_Name"];
$doc_email = $_POST["email"];
$doc_pass = $_POST["password"];
$doc_gender = $_POST["gender"];
$policy_num = $_POST["policy_Num"];

if ($mysqli->connect_error){
	die("Connection failed: ". $mysqli->connect_error);
}

$sql3 = "UPDATE patient set first_Name='$doc_fname', last_Name='$doc_lname', email='$doc_email', password = '$doc_pass', policy_Num = '$policy_num', gender='$doc_gender' where patient_id='$doc_id'";
if ($mysqli->query($sql3) === TRUE) {
	echo
     "<html>
     <style>
     h1 {text-align: center;}
     p {text-align: center;}
     label {text-align: center; margin: auto;}
     form {text-align: center; margin: auto;}

form {
    width: 80%;
    max-width: 40em;
    margin: 0 center;
    color: #FFFFFF;
    padding: 0.5em;
}
     
     label, input[type=text], select {
        display: inline-block;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        -o-box-sizing: border-box;
        -box-sizing: border-box;
        margin-bottom: 0.7em;    
    }
    
    label {
        width: 15%;
        text-align: right;
        margin: 0 0% 0 0;
        color: #FFFFFF;

    }
    .center {
        margin: 0;
        position: absolute;
        left: 73%;
        top: 15%;
        width: 65%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        color: #FFFFFF;
      }
     </style>


     <h1>Records updated:</h1>
     
     <div class='center'>
     <label for='first_Name'>First Name:</label> $doc_fname <br>
     <label for='last_Name'>Last Name:</label> $doc_lname <br>
     <label for='email'>E-Mail:</label> $doc_email <br>
     <label for='password'>Password:</label> $doc_pass <br>
     <label for='policy_Num'>Policy #:</label> $policy_num <br>   
     <label for='gender'>Gender:</label> $doc_gender <br>  
     </div>
     <br><br><br><br><br><br><br><br>
     <form method='POST' action='patient_visits.php'>
<input type='submit' name='addVisit' value='Back to Visits'/>  
</form>
<form action='double_login.php' method='POST'>
<input type='submit' name='logout' value='Logout'/>  
     </html>
      ";
} else {
	echo "Error: ".$sql3."<br>".$mysqli->error;
}

$mysqli->close();

?>
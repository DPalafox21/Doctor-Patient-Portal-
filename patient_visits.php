<!DOCTYPE html>
<html lang="en">
<head>
<title>Patient Homepage</title>
<link rel="profile" hrf="profile.php">
<link rel="logout" hrf="double_login.php">
</head>
<body>

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
form, table {text-align: center; margin: auto;}

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
    margin-bottom: .7em;    
}

label {
    width: 16%;
    text-align: center;
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
.center {
  margin: 0;
  position: absolute;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
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
//print_r($result1);
$row_p = $result1->fetch_assoc();
//print_r($row_p);
$pat_id = $row_p["patient_ID"];
$pat_fname = $row_p["first_Name"];

echo '<h1>Welcome, '.$pat_fname.' '.$row_p["last_Name"].'! </h1>';
echo '<p> Gender: '.$row_p["gender"].'</p>';
echo '<p> DoB: '.$row_p["DOB"].'</p>';
echo '<p> Email: '.$row_p["email"].'</p>';
echo '<p> Policy Number: '.$row_p["policy_Num"].'</p>';

$query2 = "SELECT * FROM visits WHERE patient_id = $pat_id";
echo '<p>This is a summary of your past visits.</p>';
echo '<table>
      <caption>Visit Information</caption>
      <tr> 
          <th> Visit Date </th>
 	  <th> Doctor </th>
          <th> Weight(lbs) </th> 
          <th> Temperature </th> 
          <th> Blood Pressure </th> 
          <th> Height </th>
	  <th> Reason </th>
      </tr>';

if ($result2 = $mysqli->query($query2)) {
    while ($row = $result2->fetch_assoc()) {
        $field1name = $row["visit_Date"];
	$field7name = $row["doctor_ID"];
        $field2name = $row["weight"];
        $field3name = $row["temp"];
        $field4name = $row["blood_Pressure"];
        $field5name = $row["height"];
	$field6name = $row["reason"]; 

        echo '<tr> 
                  <td>'.$field1name.'</td>
		  <td>'.$field7name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td> 
                  <td>'.$field4name.'</td> 
                  <td>'.$field5name.'</td>
		  <td>'.$field6name.'</td> 
              </tr>';
    }
    $result2->free();
}

?>
<br>

<div class="center">  
<form method="POST" action="profile.php">   
<input type="submit" name="profile" value="Profile"/>  
</div>
</form>

<br><br><br>
<div class="center">  
<form method="POST" action="double_login.php">
  
<input type="submit" name="logout" value="Logout"/>  
<br><br><br><br>
</div>
</form>

<br><br>
</body>
</html>
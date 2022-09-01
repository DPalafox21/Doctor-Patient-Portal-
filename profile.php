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
    
//Notify if DB is not connected
if (!$mysqli) {
  echo 'not connected';
}
 
$query = "SELECT * FROM patient WHERE email = '".$_SESSION["PatientEmail"]."' limit 1";
$result1 = $mysqli->query($query);
//print_r($result1);
$row_p = $result1->fetch_assoc();
//print_r($row_p);
$doc_id = $row_p["patient_ID"];
$doc_fname = $row_p["first_Name"];
$doc_lname = $row_p["last_Name"];
$doc_email = $row_p["email"];
$doc_pass = $row_p["password"];
$doc_gender = $row_p["gender"];
$policy_num = $row_p["policy_Num"];


if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $del = $mysqli->query("delete from visits where visit_ID = '$id'");

    if($del) {
        echo "Delete patient visit with visit ID: ", $id;
    } else {
        echo "Failed to delete patient visit with visit ID: ", $id;
    }
}


echo '<h1>Patient Profile Page</h1>';

$sql = "SELECT * from patient where patient_id='$doc_id'";

$result = $mysqli->query($sql);

if ($result->num_rows > 0){

$row = $result->fetch_assoc();
echo
"<html>
<style>

h1 {text-align: center;}
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
    margin-bottom: 0.7em;    
}

label {
    width: 15%;
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
    margin: 0 0 1em 0;
}
</style>
<body>

<form action='phpUpdateFormScript.php' method='post'>
<label for='first_Name'>First Name:</label><input type='text' name='first_Name' value='$doc_fname'><br>
<label for='last_Name'>Last Name:</label><input type='text' name='last_Name' value='$doc_lname'><br>
<label for='email'>E-Mail:</label><input type='text' name='email' value='$doc_email'><br>
<label for='password'>Password:</label><input type='text' name='password' value='$doc_pass'><br>
<label for='policy_Num'>Policy #:</label><input type='text' name='policy_Num' value='$policy_num'><br>
<label for='gender'>Gender:</label><select name='gender'>
	<option value='$doc_gender' selected>$doc_gender </option>
	<option value='Male'>Male</option>
	<option value='Female'>Female</option>
	</select><br>
    <br></br>
<input type ='submit' value='Update'>
</form>

<form method='POST' action='patient_visits.php'>
<input type='submit' name='addVisit' value='Back to Visits'/>  
</form>
<form action='double_login.php' method='POST'>
<input type='submit' name='logout' value='Logout'/>  
</form>
</body>
</html>";

} else {
	echo "Not Found";
}
$conn->close();

?>

    

</body>
</html>
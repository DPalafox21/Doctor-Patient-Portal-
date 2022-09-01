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

// Login for Patient
if(isset($_POST['PatientEmail'])) {
        
        $email = $_POST['PatientEmail'];
        $pass = $_POST['PatientPass'];
    
        // Ensuring that the user has not left any input field blank
        // error messages will be displayed for every blank input
        //if (empty($username)) { array_push($errors, "Username is required"); }
        if (empty($email)) { array_push($errors, "Email is required"); }
        if (empty($pass)) { array_push($errors, "Password is required"); }
    
        if (count($errors) == 0){
            
            $sql = "SELECT * FROM patient WHERE email='".$email."' AND password='".$pass."' limit 1";
        
            $result = mysqli_query($conn,$sql);
            
            if(mysqli_num_rows($result)==1){
                 // Storing email in session variable
                $_SESSION['PatientEmail'] = $email;
             
                // Welcome message
                $_SESSION['success'] = "You have logged in!";
                
                // Page on which the user is sent
                // to after logging in
                header('location: patient_visits.php');
                
            }
            else{
            // If the username and password doesn't match
            array_push($errors, "Username or password incorrect");
            }
            
        }

}

// Login for Admin
if(isset($_POST['DoctorEmail'])) {
        
        $email = $_POST['DoctorEmail'];
        $pass = $_POST['DoctorPass'];
    
        // Ensuring that the user has not left any input field blank
        // error messages will be displayed for every blank input
        //if (empty($username)) { array_push($errors, "Username is required"); }
        if (empty($email)) { array_push($errors, "Email is required"); }
        if (empty($pass)) { array_push($errors, "Password is required"); }
    
        if (count($errors) == 0){
            
            $sql = "SELECT * FROM doctor WHERE email='".$email."' AND password='".$pass."' limit 1";
        
            $result = mysqli_query($conn,$sql);
            
            if(mysqli_num_rows($result)==1){
                 // Storing email in session variable
                $_SESSION['DoctorEmail'] = $email;
                
             
                // Welcome message
                $_SESSION['success'] = "You have logged in!";
                
                // Page on which the user is sent
                // to after logging in
                header('location: doctor_visits.php');
                
            }
            else{
            // If the username and password doesn't match
            array_push($errors, "Username or password incorrect");
            }
            
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
    margin: 0 left;
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
        <title>Login</title>    
   		<link rel="stylesheet" type="text/css" href="css/double_login.css">    
	</head>    
    <body>    
        
    <div class="login-block">    
    <h2>Patient Login</h2><br>
        <form  method="POST" action="#">    
            <label><b>User Name     
            </b>    
            </label>    
            <input type="text" name="PatientEmail" placeholder="Email Address"/>    
            <br><br>    
            <label><b>Password     
            </b>    
            </label>    
            <input type="Password" name="PatientPass" placeholder="Password"/>    
            <br><br>    
            <input type="submit" name="submit" value="LOGIN" CLASS="btn-login"/>  
            <br><br>
            </a>    
        </form>     
        </div> 
    
    <div class="login-block last">    
    <h2>Doctor Login</h2><br>
        <form  method="POST" action="#">    
            <label><b>User Name     
            </b>    
            </label>    
            <input type="text" name="DoctorEmail" placeholder="Email Address"/>    
            <br><br>    
            <label><b>Password     
            </b>    
            </label>    
            <input type="Password" name="DoctorPass" placeholder="Password"/>    
            <br><br>    
            <input type="submit" name="submit" value="LOGIN" CLASS="btn-login"/>  
            <br><br> 
            </a>    
        </form>     
        </div>    

    </body>    
</html> 
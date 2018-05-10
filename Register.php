<?php
    require("password.php");


    $connect = mysqli_connect("localhost", "root", "", "ldme");

    
$email = $_POST["email"];

    $lastname = $_POST["lastname"];

    $firstname = $_POST["firstname"];

    $password = $_POST["password"];

    $phone = $_POST["phone"];
	function registerUser() {

        global $connect, $email, $lastname, $firstname, $password, $phone;

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $statement = mysqli_prepare($connect, "INSERT INTO user (email, lastname, firstname, password, phone) VALUES (?, ?, ?, ?, ?)");

        mysqli_stmt_bind_param($statement, "sssss", $email, $lastname, $firstname, $passwordHash, $phone);

        mysqli_stmt_execute($statement);

        mysqli_stmt_close($statement);     
    }


    function usernameAvailable() {

        global $connect, $email;

        $statement = mysqli_prepare($connect, "SELECT * FROM user WHERE email = ?");
 
       mysqli_stmt_bind_param($statement, "s", $email);

        mysqli_stmt_execute($statement);

        mysqli_stmt_store_result($statement);

        $count = mysqli_stmt_num_rows($statement);

        mysqli_stmt_close($statement);
 
       if ($count < 1){
            return true; 
        }
        else {
            return false; 
        }
    }

    
	$response = array();
    $response["success"] = false;  

    
	if (usernameAvailable()){
        registerUser();
        $response["success"] = true;  
    }
    
    echo json_encode($response);
?>

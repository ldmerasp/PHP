<?php



    $con = mysqli_connect("localhost", "root", "", "ldme");

    
    $email = $_POST["email"];
    
        $firstname = $_POST["firstname"];

        $lastname = $_POST["lastname"];

        $phone = $_POST["phone"];

    
    $statement = "UPDATE user SET firstname = '$firstname', lastname = '$lastname', phone = '$phone' WHERE email = '$email'";

    $response = array();

    $response["success"] = false;
    if(mysqli_query($con, $statement)){
         $response["success"] = true;
     }
  
  echo json_encode($response);
?>
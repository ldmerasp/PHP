<?php



    $con = mysqli_connect("localhost", "root", "", "ldme");

    
    $email = $_POST["email"];
    
        $onoff = $_POST["onoff"];

    
    $statement = "UPDATE user SET onoff = '$onoff' WHERE email = '$email'";

    $response = array();

    $response["success"] = false;
    if(mysqli_query($con, $statement)){
         $response["success"] = true;
     }
  
  echo json_encode($response);
?>
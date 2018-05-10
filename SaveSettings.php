<?php



    $con = mysqli_connect("localhost", "root", "", "ldme");

    
    $email = $_POST["email"];
    
        $svideo = $_POST["svideo"];

        $spicture = $_POST["spicture"];

        $sphone = $_POST["sphone"];

    
    $statement = "UPDATE user SET svideo = '$svideo', spicture = '$spicture', sphone = '$sphone' WHERE email = '$email'";

    $response = array();

    $response["success"] = false;
    if(mysqli_query($con, $statement)){
         $response["success"] = true;
     }
  
  echo json_encode($response);
?>
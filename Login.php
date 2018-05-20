<?php
    require("password.php");


    $con = mysqli_connect("localhost", "root", "", "ldme");

    
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $statement = mysqli_prepare($con, "SELECT * FROM user WHERE email = ?");

    mysqli_stmt_bind_param($statement, "s", $email);

    mysqli_stmt_execute($statement);

    mysqli_stmt_store_result($statement);

    mysqli_stmt_bind_result($statement, $colUserID, $colEmail, $colFirstname, $colLastname, $colPassword, $colPhone, $colSvideo, $colSpicture, $colSphone, $colOnoff);
    
    $response = array();

    $response["success"] = false;
  
    while(mysqli_stmt_fetch($statement)){

        if (password_verify($password, $colPassword))
        {
              $response["success"] = true;
              $response["firstname"] = $colFirstname;
              $response["lastname"] = $colLastname;
	      $response["phone"] = $colPhone;
              $response["svideo"] = $colSvideo;
              $response["spicture"] = $colSpicture;
              $response["sphone"] = $colSphone;
              $response["onoff"] = $colOnoff;
              $deviceList = mysqli_query($con, "SELECT id FROM devices WHERE userID = (SELECT user_id FROM user WHERE email = '$email')");
              $array = mysqli_fetch_all($deviceList);
              $response["devicelist"] = $array;
        }
    }

    echo json_encode($response);
?>
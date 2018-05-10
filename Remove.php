<?php
    $connect = mysqli_connect("localhost", "root", "", "ldme");

    
    $device = $_POST["device"];

    $email = $_POST["email"];
    function deleteDevice() {

        global $connect, $email, $device;
        $statement = "DELETE FROM devices WHERE id = '$device' AND userID = (SELECT user_id FROM user WHERE email = '$email')";
        mysqli_query($connect, $statement);
    }


    function deviceAvailable() {

        global $connect, $device;

        $statement = mysqli_prepare($connect, "SELECT * FROM devices WHERE id = ?");
 
        mysqli_stmt_bind_param($statement, "s", $device);

        mysqli_stmt_execute($statement);

        mysqli_stmt_store_result($statement);

        $count = mysqli_stmt_num_rows($statement);

        mysqli_stmt_close($statement);
 
       if ($count == 1){
            return true; 
        }
        else {
            return false; 
        }
    }

    
    $response = array();
    $response["success"] = false;  

    
    if (deviceAvailable()){
        deleteDevice();
        $response["success"] = true;  
        $deviceList = mysqli_query($connect, "SELECT id FROM devices WHERE userID = (SELECT user_id FROM user WHERE email = '$email')");
        $array = mysqli_fetch_all($deviceList);
        $response["devicelist"] = $array;
    }
    
    echo json_encode($response);
?>

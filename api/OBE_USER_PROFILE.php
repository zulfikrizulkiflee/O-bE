<?php
include("conn.php");
$action = $_GET['action'];

if ($action == "register") {
    $name     = $_GET['regname'];
    $callsign = $_GET['regcallsign'];
    $email    = $_GET['regemail'];
    $password = $_GET['regpassword1'];
    $phone    = $_GET['regphone'];
    
    // To protect from MySQL injection
    $name     = stripslashes($name);
    $callsign = stripslashes($callsign);
    $email    = stripslashes($email);
    $password = stripslashes($password);
    $phone    = stripslashes($phone);
    $name     = mysqli_real_escape_string($db, $name);
    $callsign = mysqli_real_escape_string($db, $callsign);
    $email    = mysqli_real_escape_string($db, $email);
    $password = mysqli_real_escape_string($db, $password);
    $phone    = mysqli_real_escape_string($db, $phone);
    $password = md5($password);
    
    $check_email_for_duplicates = mysqli_query($db, "select * from `obe_user` where `user_email` = '" . $email . "'");
    if (mysqli_num_rows($check_email_for_duplicates) > 0) {
        echo 'false';
    } else {
        $sql    = "INSERT INTO obe_user (user_name,user_callsign,user_email,user_password,user_phone) VALUES ('" . $name . "','" . $callsign . "','" . $email . "','" . $password . "','" . $phone . "')";
        $result = mysqli_query($db, $sql);
        if ($result) {
            echo "Successful Registration";
        } else {
            echo "Failed To Register";
        }
    }
}

if ($action == "login") {
    $email    = $_GET['logemail'];
    $password = $_GET['logpassword'];
    
    // To protect from MySQL injection
    $email    = stripslashes($email);
//    $password = stripslashes($password);
    
    $email    = mysqli_real_escape_string($db, $email);
//    $password = mysqli_real_escape_string($db, $password);
    
    $password = md5($password);
    
    $myArray = array();
    if ($result = $db->query("SELECT obe_id,user_name FROM obe_user WHERE user_email='".$email."' AND user_password='".$password."'")) {
        $tempArray = array();
        while($row = $result->fetch_object()) {
            $tempArray = $row;
            array_push($myArray, $tempArray);
        }
        echo json_encode($myArray);
    }
    $result->close();
}
$db->close();
?>

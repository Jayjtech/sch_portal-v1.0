<?php
include "../config/db.php";
if(isset($_GET['id'])){
    $userId = $_SESSION['userId'];
    $name = $_SESSION['name'];
    $userCategory = $_SESSION['userCategory'];
    $pin = base64_encode($_GET['id']);
    $check = $conn->query("SELECT * FROM $users_tbl WHERE (pin = '$pin' AND name='$name' 
    AND userId='$userId' AND user_type='$userCategory')");
    while($row = $check->fetch_object()){
        $img = $row->img;
        $user = $row->name;
        switch($row->user_type){
            case "c3R1ZHk=":
                 $_SESSION['user_type'] = "Student";
                break;
            case "d29yaw==":
                 $_SESSION['user_type'] = "Staff";
                break;
        }
        $_SESSION['userId'] = $row->userId;
    }
    if($check->num_rows > 0){
        $response = [
            "avatar_url" => "$img",
            "text" => "$user",
            "icon" => "success"
            ];
        $_SESSION['userCategory'] = false;
    }else{
        $response = [
            "text" => "User does not exist!",
            "icon" => "error"
            ];
    }
}
    
echo json_encode($response);
?>
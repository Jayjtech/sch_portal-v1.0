<?php
include "../config/db.php";
include "../includes/calls.php";

if(isset($_POST['key']) == "testAccess"){
    $accessKey = mysqli_real_escape_string($conn, $_POST['accessKey']);
    $check = $conn->query("SELECT * FROM $score_tbl WHERE (exam_token = '$accessKey' AND adm_no='$userId' AND term='$log_term' AND session='$log_session')");
    $access = $check->fetch_object();
    if($check->num_rows != 0){
       $response = [
            "title" => "Redirecting to CBE!",
            "icon" => "success"
            ];
    }else{
          $response = [
            "title" => "Invalid access key!",
            "text" => "Provide a valid 6-digit access key to proceed.",
            "icon" => "error"
            ];
    }
    
      $data = json_encode($response);
            echo '['.$data.']';
}

?>
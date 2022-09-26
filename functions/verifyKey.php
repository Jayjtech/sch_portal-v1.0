<?php
include "../config/db.php";
if(isset($_GET['disburseKey'])){
    $disburseKey = $_GET['disburseKey'];
    $disburseKey = substr(md5($disburseKey), 4);
    $check = $conn->query("SELECT * FROM $settings_tbl WHERE (disbursement_key='$disburseKey')");
 
    if($check->num_rows != 0){
        $response = [
            "text" => "Redirecting",
            "icon" => "success"
            ];
    }else{
        $response = [
            "text" => "Wrong disbursement key!",
            "icon" => "error"
            ];
    }
}
    
echo json_encode($response);
?>
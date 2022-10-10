<?php
include "constants.php";
include "UserInfo.php";
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

$query = "CREATE DATABASE IF NOT EXISTS " . DB_NAME . "";

$run = mysqli_query($conn, $query);

if ($run) {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
}

include ".php";

$adminDetails = $conn->query("SELECT * FROM $settings_tbl");
$admin_det = $adminDetails->fetch_object();
switch($admin_det->img){
    case false:
    $sch_logo = 'default-img.jpg';
    break;
    case true:
    $sch_logo = $admin_det->img;
    break;
}
$monnify_token = base64_encode('' . $admin_det->monnify_key . ':' . $admin_det->monnify_secret . '');
$current_term = $admin_det->current_term;
$current_session = $admin_det->current_session;
$sch_short_icon = "";

switch($current_term){
    case 1:
        $current_term_syntax = "First Term";
        break;
    case 2:
        $current_term_syntax = "Second Term";
        break;
    case 3:
        $current_term_syntax = "Third Term";
        break;
}

$sch_short_icon = ''.BASE_URL.'/images/'.$admin_det->img.'';
?>
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


/**class format array */
$jss1Array = ["JSS-1","JSS1","JS-1","JS1","J-1","J1","jss-1","jss1","js-1","j-1","j1","jss 1","Jss 1","Js 1","js 1","J 1","j 1","JSS 1","JS 1",1];
$jss2Array = ["JSS-2","JSS2","JS-2","JS2","J-2","J2","jss-2","jss2","js-2","j-2","j2","jss 2","Jss 2","Js 2","js 2","J 2","j 2","JSS 2","JS 2",2];
$jss3Array = ["JSS-3","JSS3","JS-3","JS3","J-3","J3","jss-3","jss3","js-3","j-3","j3","jss 3","Jss 3","Js 3","js 3","J 3","j 3","JSS 3","JS 3",3];
$sss1Array = ["SSS-1","SSS1","SS-1","SS1","S-1","S1","sss-1","sss1","ss-1","s-1","s1","sss 1","sss 1","Ss 1","ss 1","S 1","s 1","SSS 1","SS 1",1];
$sss2Array = ["SSS-2","SSS2","SS-2","SS2","S-2","S2","sss-2","sss2","ss-2","s-2","s2","sss 2","sss 2","Ss 2","ss 2","S 2","s 2","SSS 2","SS 2",2];
$sss3Array = ["SSS-3","SSS3","SS-3","SS3","S-3","S3","sss-3","sss3","ss-3","s-3","s3","sss 3","sss 3","Ss 3","ss 3","S 3","s 3","SSS 3","SS 3",3];

?>
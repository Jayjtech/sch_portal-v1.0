<?php
if(isset($_SESSION['log_term']) == false || isset($_SESSION['log_session']) == false){
    $log_term = $current_term;
    $log_session = $current_session;
}

switch($log_term){
    case 1:
        $term_syntax = "First";
        break;
    case 2:
        $term_syntax = "Second";
        break;
    case 3:
        $term_syntax = "Third";
        break;
}
$callSession = $conn->query("SELECT * FROM $session_tbl ORDER BY session ASC");
$callClass = $conn->query("SELECT * FROM $class_tbl ORDER BY id ASC");
while($caClass = $callClass->fetch_object()){
    $classData[] = $caClass;
}
$callStudentAward = $conn->query("SELECT * FROM $student_award_tbl");

$exp_c_s = explode("/", $current_session);
$exp_l_s = explode("/", $log_session);

if($exp_l_s[1] < $exp_c_s[1]){
    $exp_acad_period = true;
}
?>
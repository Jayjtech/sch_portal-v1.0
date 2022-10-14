<?php
include "../config/db.php";
include "../includes/calls.php";

if(isset($_POST['retake_exam'])){
    $exam_token = $_POST['retake_exam'];
    $student_name = $_POST['student_name'];
    
    $update = $conn->query("UPDATE $score_tbl SET status=0, score=0 WHERE exam_token='$exam_token'");
    if($update){
        $_SESSION['message'] = 'Exam status has been changed!';
        $_SESSION['msg_type'] = 'success';
        $_SESSION['remedy'] = ''.$student_name.' can now re-take the exam.';
    }else{
        $_SESSION['message'] = 'Exam status could not be changed';
        $_SESSION['msg_type'] = 'error';
        $_SESSION['remedy'] = '';
    }
    header('location:../adm_exam?enrolment_list');
}
?>
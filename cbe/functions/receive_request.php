<?php 
include "../../config/db.php";
include "../../includes/calls.php";
if(isset($_POST['quest_type'])){
    $quest_type = mysqli_real_escape_string($conn, $_POST['quest_type']);
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $userId = mysqli_real_escape_string($conn, $_POST['userId']);
    $paper_type = mysqli_real_escape_string($conn, $_POST['paper_type']);
    $log_session;
    $getDuration = $conn->query("SELECT * FROM $course_tbl WHERE course_code='$course_code' AND term='$log_term' AND session='$log_session'");
    $gD = $getDuration->fetch_object();
    $getDuration->num_rows;
    $ass_duration = $gD->ass_duration;
    $test_duration = $gD->test_duration;
    $exam_duration = $gD->exam_duration;
    switch($quest_type){
        case"Ass":
        $_SESSION['exam_duration'] = $ass_duration;
        break;
        case"Test":
        $_SESSION['exam_duration'] = $test_duration;
        break;
        case"Exam":
        $_SESSION['exam_duration'] = $exam_duration;
        break;
    }
    $_SESSION['exam_course_code'] = $course_code;
    $_SESSION['quest_type'] = $quest_type;
    $_SESSION['paper_type'] = $paper_type;
    $_SESSION['course'] = $course;

    header('location:../test');
}
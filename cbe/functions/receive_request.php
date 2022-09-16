<?php 
include "../../config/db.php";
include "../../includes/calls.php";
if(isset($_POST['quest_type'])){
    $quest_type = mysqli_real_escape_string($conn, $_POST['quest_type']);
    $paper_type = mysqli_real_escape_string($conn, $_POST['paper_type']);
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $teacher_token = mysqli_real_escape_string($conn, $_POST['teacher_token']);
    $quest_id = mysqli_real_escape_string($conn, $_POST['quest_id']);

    $getDuration = $conn->query("SELECT * FROM $course_tbl WHERE course_code='$course_code' AND token='$teacher_token' AND term='$log_term' AND session='$log_session'");
    $gD = $getDuration->fetch_object();
    $ass_duration = $gD->ass_duration;
    $test_duration = $gD->test_duration;
    $exam_duration = $gD->exam_duration;

    $ass_unit = $gD->ass_unit;
    $test_unit = $gD->test_unit;
    $exam_unit = $gD->exam_unit;

    switch($quest_type){
        case"Ass":
        $_SESSION['exam_duration'] = $ass_duration;
        $_SESSION['exam_unit'] = $ass_unit;
        break;
        case"Test":
        $_SESSION['exam_duration'] = $test_duration;
        $_SESSION['exam_unit'] = $test_unit;
        break;
        case"Exam":
        $_SESSION['exam_duration'] = $exam_duration;
        $_SESSION['exam_unit'] = $exam_unit;
        break;
    }
   
    $_SESSION['exam_course_code'] = $course_code;
    $_SESSION['paper_type'] = $paper_type;
    $_SESSION['exam_course'] = $course;
    $_SESSION['quest_type'] = $quest_type;
    $_SESSION['teacher_token'] = $teacher_token;
    $_SESSION['quest_id'] = $quest_id;


    if($quest_type == "Exam"){
        header('location:../../test_proceed');
    }else{
        header('location:../test');
    }
}
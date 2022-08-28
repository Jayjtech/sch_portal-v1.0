<?php 
include "../../config/db.php";
if(isset($_POST['examDet'])){
    $score = $_POST['score'];
    $answered_quest = $_POST['answered_quest'];
    $minLeft = $_POST['minLeft'];

    $examDet = base64_decode($_POST['examDet']);
    $examDet = json_decode($examDet);
    
    $class = $examDet->class;
    $name = $examDet->name;
    $examSession = $examDet->examSession;
    $paper_type = $examDet->paper_type;
    $course_code = $examDet->course_code;
    $subject = $examDet->subject;
    $examTerm = $examDet->examTerm;
    $duration = $examDet->duration;
    $adm_no = $examDet->userId;
   
    // echo '<pre>';
    // print_r($examDet);
    // echo '</pre>';
    // exit();
    $save = $conn->query("UPDATE $score_tbl SET
            minLeft = '$minLeft',
            score = '$score',
            answeredQuestions = '$answered_quest',
            duration = '$duration',
            day = '$day',
            month = '$month',
            year = '$year',
            date = '$date'
            WHERE (course_code = '$course_code' 
            AND adm_no = '$adm_no' 
            AND term='$examTerm' 
            AND session='$examSession')
        ");
}
?>
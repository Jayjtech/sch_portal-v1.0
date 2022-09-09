<?php 
include "../../config/db.php";
include "../../includes/calls.php";
if(isset($_GET['del'])){
    $id = $_GET['del'];
    $check = $conn->query("SELECT * FROM $course_tbl WHERE id='$id'");
    $cos = $check->fetch_object();
    $course_code = $cos->course_code;

        //CHECKING QUESTION TABLES
        $check_questions = $conn->query("SELECT * FROM $question_tbl_a 
        INNER JOIN $question_tbl_b
        on $question_tbl_a.course_code = $question_tbl_b.course_code
        INNER JOIN $question_tbl_c 
        on $question_tbl_b.course_code = $question_tbl_c.course_code
        ");
        
        if($check_questions->num_rows == 0){
            $del = $conn->query("DELETE FROM $course_tbl WHERE id='$id'");
        }else{
        $del = $conn->query("DELETE $course_tbl, $question_tbl_a, $question_tbl_b, $question_tbl_c 
        FROM $course_tbl INNER JOIN $question_tbl_a
        on $course_tbl.course_code=$question_tbl_a.course_code
        INNER JOIN $question_tbl_b 
        on $course_tbl.course_code=$question_tbl_b.course_code
        INNER JOIN $question_tbl_c 
        on $course_tbl.course_code=$question_tbl_c.course_code
        AND ($course_tbl.course_code='$course_code' AND $course_tbl.session='$log_session')");
        }

        if($del){
            $_SESSION['message'] = "Course has been successfully deleted!";
            $_SESSION['msg_type'] = "success";
            $_SESSION['remedy'] = "";
        }else{
            $_SESSION['message'] = "Course could not be deleted!";
            $_SESSION['msg_type'] = "error";
            $_SESSION['remedy'] = "";
        }
    header('location:../../dashboard');
}

if(isset($_GET['del_course'])){
    $course_code = $_GET['del_course'];
    $course = $_GET['course'];
    $del = $conn->query("DELETE FROM $score_tbl WHERE adm_no='$userId' AND course_code='$course_code' AND term='$log_term' AND session='$log_session'");

    if($del){
        $_SESSION['message'] = 'Your score sheet for '.$course.'['.$course_code.'] has been deleted!';
        $_SESSION['msg_type'] = "success";
        $_SESSION['remedy'] = "";
    }else{
        $_SESSION['message'] = "Score sheet for '.$course.'['.$course_code.'] could not be deleted!";
        $_SESSION['msg_type'] = "error";
        $_SESSION['remedy'] = "";
    }
    header('location:../../my_course');
}
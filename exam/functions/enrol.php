<?php 
include "../../config/db.php";
include "../../includes/calls.php";
if(isset($_GET['course_code'])){
    $course_code = $_GET['course_code'];
    $course = $_GET['course'];

    $check = $conn->query("SELECT * FROM $score_tbl 
    WHERE (adm_no = '$userId' AND course_code='$course_code' AND session='$log_session' AND term='$log_term')");
    if($check->num_rows == 0){
            if($course_code == true){
                    $insert = $conn->query("INSERT INTO $score_tbl SET
                                        name = '$name',
                                        adm_no = '$userId',
                                        term = '$log_term',
                                        session = '$log_session',
                                        course_code = '$course_code',
                                        course = '$course',
                                        class = '".$det->curr_class."'
                    ");
                }

                if($insert){
                    $_SESSION['message'] = 'You have successfully enrolled for '.$course.'['.$course_code.']!';
                    $_SESSION['msg_type'] = "success";
                    $_SESSION['remedy'] = "";
                }
    }else{
        $_SESSION['message'] = 'You have already enrolled for '.$course.'['.$course_code.']!';
        $_SESSION['msg_type'] = "info";
        $_SESSION['remedy'] = "";
    }

    header('location: ../../my_course');
    
}
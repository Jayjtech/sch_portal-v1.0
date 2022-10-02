<?php 
include "../../config/db.php";
include "../../includes/calls.php";
if(isset($_GET['course_code'])){
    $course_code = $_GET['course_code'];
    $course = $_GET['course'];
    $teacher_token = $_GET['teacher_token'];
    $exam_token = rand(100000,999999); 
    $check_paper_type = $conn->query("SELECT * FROM $score_tbl ORDER BY id DESC LIMIT 1");
    $PT = $check_paper_type->fetch_object();
    /**Get last Paper type */
    $last_PT = $PT->paper_type;
    switch($last_PT){
        case false:
            $paper_type = "A";
            break;
        case "A":
            $paper_type = "B";
            break;
        case "B":
            $paper_type = "C";
            break;
        case "C":
            $paper_type = "A";
            break;
    }

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
                                        exam_token = '$exam_token',
                                        paper_type = '$paper_type',
                                        teacher_token = '$teacher_token',
                                        class = '".$det->curr_class."'
                            ");
                }

                if($insert){
                    $_SESSION['message'] = 'You have successfully enrolled for '.$course.'['.$course_code.']!';
                    $_SESSION['msg_type'] = "success";
                    $_SESSION['remedy'] = "";
                }
                /**Stating previous course code[1st and 2nd term] */
            $ft_CD = substr($course_code, 0, 5) . '1';
            $st_CD = substr($course_code, 0, 5) . '2';

            switch($log_term){
                case 1:
                    $cumulative = $ft_score;
                    break;
                case 2:
                    $checkFt_score = $conn->query("SELECT * FROM $score_tbl WHERE adm_no ='$userId' AND course_code = '$ft_CD' AND term='1' AND session='$log_session'");
                    $prev = $checkFt_score->fetch_object();
                    if($prev->ft_score == true){
                        $ft_score = $prev->ft_score;
                    }else{
                        $ft_score = 0;
                    }
                    $update2 = $conn->query("UPDATE $score_tbl SET 
                           ft_score = '$ft_score'
                           WHERE adm_no = '$userId'
                           AND course_code = '$course_code'
                           AND term = '$log_term'
                           AND session = '$log_session'     
                    ");
                    break;
                case 3:
                    $checkFt_score = $conn->query("SELECT * FROM $score_tbl WHERE adm_no ='$userId' AND course_code = '$st_CD' AND term='2' AND session='$log_session'");
                    $prev = $checkFt_score->fetch_object();
                    if($prev->ft_score == true){
                        $ft_score = $prev->ft_score;
                    }else{
                        $ft_score = 0;
                    }
                    if($prev->st_score == true){
                        $st_score = $prev->st_score;
                    }else{
                        $st_score = 0;
                    }
                    $update2 = $conn->query("UPDATE $score_tbl SET 
                           ft_score = '$ft_score',
                           st_score = '$st_score'
                           WHERE adm_no = '$userId'
                           AND course_code = '$course_code'
                           AND term = '$log_term'
                           AND session = '$log_session'     
                    ");
                    break;
            }
    }else{
        $_SESSION['message'] = 'You have already enrolled for '.$course.'['.$course_code.']!';
        $_SESSION['msg_type'] = "info";
        $_SESSION['remedy'] = "";
    }
    /**Standardize supposed score and insert into Evaluation */
    $standardize = $conn->query("SELECT * FROM $score_tbl WHERE adm_no='$userId' AND session='$log_session' AND term='$log_term'");
    $registerCourse = $standardize->num_rows;
    $out_of = ($registerCourse * 100);

    $check2 = $conn->query("SELECT * FROM $evaluation_tbl WHERE adm_no='$userId' AND session='$log_session' AND term='$log_term'");
    if($check2->num_rows == 0){
        $insert = $conn->query("INSERT INTO $evaluation_tbl SET 
                                adm_no ='$userId',
                                name ='$name',
                                out_of ='$out_of',
                                term ='$log_term',
                                class ='$curr_class',
                                session ='$log_session'
                            ");
    /**Generate result checker code */
    $code = rand(100000,999999);
        $rcc = $conn->query("INSERT INTO $result_checker_tbl SET
                                    name = '$name',
                                    adm_no = '$userId',
                                    class = '$curr_class',
                                    code = '$code',
                                    term = '$log_term',
                                    session = '$log_session'
                            ");
    }else{
        $update = $conn->query("UPDATE $evaluation_tbl SET
                                out_of ='$out_of'
                                WHERE adm_no = '$userId' 
                                AND session='$log_session' 
                                AND term='$log_term'
        ");
    }
    header('location: ../../my_course');
    
}
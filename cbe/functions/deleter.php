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
    header('location:../../create_course');
}

if(isset($_GET['del_course'])){
    $course_code = $_GET['del_course'];
    $course = $_GET['course'];
    $del = $conn->query("DELETE FROM $score_tbl WHERE adm_no='$userId' AND course_code='$course_code' AND term='$log_term' AND session='$log_session'");
  /**Standardize supposed score and insert into Evaluation */
    $standardize = $conn->query("SELECT * FROM $evaluation_tbl WHERE adm_no='$userId' AND session='$log_session' AND term='$log_term'");
    $st = $standardize->fetch_object();
    $out_of = $st->out_of;
    $out_of = ($out_of - 100);

    $update = $conn->query("UPDATE $evaluation_tbl SET
                        out_of ='$out_of'
                        WHERE adm_no = '$userId' 
                        AND session='$log_session' 
                        AND term='$log_term'
              ");
    if($del){
        $_SESSION['message'] = 'Your score sheet for '.$course.'['.$course_code.'] has been deleted!';
        $_SESSION['msg_type'] = "success";
        $_SESSION['remedy'] = "";
    }else{
        $_SESSION['message'] = 'Score sheet for '.$course.'['.$course_code.'] could not be deleted!';
        $_SESSION['msg_type'] = "error";
        $_SESSION['remedy'] = "";
    }
    header('location:../../my_course');
}

if(isset($_GET['del_table'])){
     $term = $_GET['term'];
     $session = $_GET['session'];
     $class_category = $_GET['class_category'];

      if($class_category == "Junior-School"){
        $class_array = 'JSS-1,JSS-2,JSS-3';
      }else if($class_category == "Senior-School"){
        $class_array = 'SSS-1,SSS-2,SSS-3';
      }else if($class_category == "Primary-School"){
        $class_array = 'Creche,KG-1,KG-2,NUR-1,NUR-2[Basic-1],PRY-1[Basic-2],PRY-2[Basic-3],PRY-3[Basic-4],PRY-4[Basic-5],PRY-5[Basic-6]';
      }else{
        $class_array = '';
      }

      $del = $conn->query("DELETE FROM $time_tbl WHERE class_array= '$class_array' AND term='$log_term' AND session='$log_session'");
      if($del){
        $_SESSION['message'] = ''.$class_category.' time-table has been deleted!';
        $_SESSION['msg_type'] = "success";
        $_SESSION['remedy'] = "";
      }else{
        $_SESSION['message'] = ''.$class_category.' could not be deleted!';
        $_SESSION['msg_type'] = "error";
        $_SESSION['remedy'] = "";
      }
      header('location:../../adm_exam');
}

if(isset($_GET['del_quest'])){
  $course_code = $_GET['del_quest'];
  $quest_type = $_GET['quest_type'];

  $del = $conn->query("DELETE FROM $question_tbl_a WHERE 
  (course_code='$course_code' AND session='$log_session' AND token='$token' AND quest_type='$quest_type')");
  $del1 = $conn->query("DELETE FROM $question_tbl_b WHERE 
  (course_code='$course_code' AND session='$log_session' AND token='$token' AND quest_type='$quest_type')");
  $del2 = $conn->query("DELETE FROM $question_tbl_c WHERE 
  (course_code='$course_code' AND session='$log_session' AND token='$token' AND quest_type='$quest_type')");


if($del2){
        $_SESSION['message'] = ''.$course_code.' questions have been deleted!';
        $_SESSION['msg_type'] = "success";
        $_SESSION['remedy'] = "";
      }else{
        $_SESSION['message'] = 'Questions on '.$course_code.' could not be deleted!';
        $_SESSION['msg_type'] = "error";
        $_SESSION['remedy'] = "";
      }
       header('location:../../create_course');
}
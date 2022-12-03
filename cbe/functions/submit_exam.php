<?php 
include "../../config/db.php";
include "../../includes/calls.php";
if(isset($_POST['examDet'])){
    echo $score = $_POST['score'];
    $answered_quest = $_POST['answered_quest'];
    $minLeft = $_POST['minLeft'];
    $quest_id = $_SESSION['quest_id'];

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
    $quest_type = $examDet->quest_type;
   
    $check = $conn->query("SELECT * FROM $score_tbl WHERE (adm_no='$adm_no' AND term='$examTerm' AND session='$examSession' AND course_code='$course_code')");
    $ch = $check->fetch_object();

    if($ch->ca1 == 0){
        $ca_slot = 'ca1';
    }else if($ch->ca2 == 0){
        $ca_slot = 'ca2';
    }else{
        $ca_slot = 'ca3';
    }
    
 
    if($quest_type == "Exam"){
        $current_score = ($ch->score+$score);
        $save = $conn->query("UPDATE $score_tbl SET
                    minLeft = '$minLeft',
                    score = '$current_score',
                    -- answeredQuestions = '$answered_quest',
                    duration = '$duration',
                    day = '$day',
                    status = '1',
                    month = '$month',
                    year = '$year',
                    date = '$date'
                    WHERE (course_code = '$course_code' 
                    AND adm_no = '$adm_no' 
                    AND term='$examTerm'
                    AND session='$examSession')
                ");
    }else if($quest_type == "Ass"){
        $current_score = ($ch->ass+$score);
            $save = $conn->query("UPDATE $score_tbl SET
                                ass = '$current_score'
                                WHERE (course_code = '$course_code' 
                                AND adm_no = '$adm_no' 
                                AND term='$examTerm' 
                                AND session='$examSession')
                            ");
    }else if($quest_type == "Test"){
        $current_score = ($ch->$ca_slot+$score);
            $save = $conn->query("UPDATE $score_tbl SET
                                $ca_slot = '$current_score'
                                WHERE (course_code = '$course_code' 
                                AND adm_no = '$adm_no' 
                                AND term='$examTerm' 
                                AND session='$examSession')
                            ");
    }

    
    if($save){
        $record = $conn->query("INSERT INTO $cbe_report_tbl SET 
                        adm_no = '$adm_no',
                        test_taken = '$quest_id'
                            ");
                            
        $_SESSION['message'] = "Exam submitted successfully!";
        $_SESSION['msg_type'] = "success";
        $_SESSION['remedy'] = "";

        unset($_SESSION['exam_course_code']);
        unset($_SESSION['exam_course']);
        unset($_SESSION['paper_type']);
        unset($_SESSION['quest_type']);
        unset($_SESSION['teacher_token']);
        unset($_SESSION['quest_id']);
        unset($_SESSION['exam_duration']);
        unset($_SESSION['exam_unit']);
    }else{
        $_SESSION['message'] = "There was an error with your submission!";
        $_SESSION['msg_type'] = "error";
        $_SESSION['remedy'] = "";
    }
     ?>
<script>
localStorage.removeItem('score');
localStorage.removeItem('answeredQuestions');
localStorage.removeItem('timeLeft');
</script>
<?php
    header('location:../../e_exam');
}
?>
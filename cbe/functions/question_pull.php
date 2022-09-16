<?php include "../includes/calls.php";
/**Request requirements */
$user_paper_type = $_SESSION['paper_type'];
$exam_course = $_SESSION['exam_course'];
$exam_course_code = $_SESSION['exam_course_code'];
$exam_term = $_SESSION['log_term'];
$exam_session = $_SESSION['log_session'];
$duration = $_SESSION['exam_duration'];
$unit = $_SESSION['exam_unit'];
$quest_type = $_SESSION['quest_type'];
$teacher_token = $_SESSION['teacher_token'];
/**End of request */

/**Process request */
switch($user_paper_type){
    case "A":
        $quest_tbl = $question_tbl_a;
        break; 
    case "B":
        $quest_tbl = $question_tbl_b;
        break; 
    case "C":
        $quest_tbl = $question_tbl_c;
        break; 
}

  /**Checking if student has enrolled for the course */
$checkIfEnrolled = $conn->query("SELECT * FROM $score_tbl WHERE 
(adm_no='$userId' AND teacher_token='$teacher_token' AND course_code='$exam_course_code' AND session='$log_session')");

if($checkIfEnrolled->num_rows == 0){
    $_SESSION['message'] = 'You have not enrolled for this course!';
    $_SESSION['remedy'] = 'Navigate to My Courses page to enrol.';
    $_SESSION['msg_type'] = 'info';
    header('location: ../e_exam');
}else{

/**Pull instructions from database */
$callInstruc = $conn->query("SELECT * FROM $instruction_tbl WHERE (term='$exam_term' AND teacher_token='$teacher_token' AND session='$exam_session' AND quest_type='$quest_type' AND course_code='$exam_course_code')");
while($ins = $callInstruc->fetch_object()){
    $inst[] = $ins;
}

if($callInstruc->num_rows == 0){
    $_SESSION['message'] = 'Instruction is yet to be uploaded by the subject teacher!';
    $_SESSION['remedy'] = 'Kindly inform the teacher involved.';
    $_SESSION['msg_type'] = 'info';
    header('location: ../e_exam');
}


for($i = 0; $i < count($inst); $i++){
    $instructions_json = ''.$inst[$i]->instruction.'';
}

/**Call Questions from database */
$callQuestions = $conn->query("SELECT * FROM $quest_tbl WHERE (quest_type = '$quest_type' AND term='$exam_term' AND session='$exam_session' AND course_code='$exam_course_code'  AND token='$teacher_token') ORDER BY quest_no ASC");
while($row = $callQuestions->fetch_object()){
    $data[] = $row;
}

if($callQuestions->num_rows == 0){
    $_SESSION['message'] = 'Questions are yet to be uploaded by the subject teacher!';
    $_SESSION['remedy'] = 'Kindly inform the teacher involved.';
    $_SESSION['msg_type'] = 'info';
    header('location: ../e_exam');
}

$output = "";
for($x = 0; $x < count($data)-1; $x++){
   $output .= '{"quest":"'.$data[$x]->quest.'", "ans":'.$data[$x]->ans.', "isCorrect":'.$data[$x]->isCorrect.'},';
}

$class = $data[$x]->class;
$no_of_question = count($data);
// Last question
$output .= '{"quest":"'.$data[$x]->quest.'", "ans":'.$data[$x]->ans.', "isCorrect":'.$data[$x]->isCorrect.'}';

// covering up all questions into a single array
$output = '['.$output.']';
// echo $output;
$exam_detail = '{"duration":'.$duration.',"examTerm":'.$exam_term.',"examSession":"'.$exam_session.'","courseCode":"'.$exam_course_code.'","paperType":"'.$user_paper_type.'"}';
// $instructions = '[]';
}
?>
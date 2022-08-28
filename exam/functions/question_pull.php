<?php
/**Request requirements */
$user_paper_type = "C";
$subject = "ICT";
$course_code = "ICT401";
$exam_term = 1;
$exam_session = "2022/2023";
$duration = 10;
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
/**Pull instructions from database */
$callInstruc = $conn->query("SELECT * FROM $instruction_tbl WHERE (term='$exam_term' AND session='$exam_session' AND course_code='$course_code')");
while($ins = $callInstruc->fetch_object()){
    $inst[] = $ins;
}
for($i = 0; $i < count($inst); $i++){
    $instructions_json = ''.$inst[$i]->instruction.'';
}

// echo $instructions_json;
/**Call Questions from database */
$callQuestions = $conn->query("SELECT * FROM $quest_tbl WHERE (term='$exam_term' AND session='$exam_session' AND course_code='$course_code') ORDER BY quest_no ASC");
while($row = $callQuestions->fetch_object()){
    $data[] = $row;
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
$exam_detail = '{"duration":'.$duration.',"examTerm":'.$exam_term.',"examSession":"'.$exam_session.'","courseCode":"'.$course_code.'","paperType":"'.$user_paper_type.'"}';
// $instructions = '[]';
?>
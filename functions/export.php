<?php
require "../config/db.php";
require "../includes/calls.php";
$log_term = $_SESSION['log_term'];
$log_session = $_SESSION['log_session'];
$token = $_SESSION['token'];

if ($_GET['table'] == $time_tbl) {
     $term = $_GET['term'];
     $session = $_GET['session'];
     $class_category = $_GET['class_category'];
    
     header('Content-Type: text/csv; charset=utf-8');
     header('Content-Disposition: attachment; filename='.$term.' ['.$session.'] time-table.csv');
     $output = fopen("php://output", "w");
     fputcsv($output, array('DAY', 'PERIOD 1', 'PERIOD 2', 'PERIOD 3', 'PERIOD 4', 'PERIOD 5', 'DATE[eg. '.$date.']'));

      if($class_category == "Junior-School"){
          $class_array = 'JSS-1,JSS-2,JSS-3';
          $query = $conn->query("SELECT day, period_1, period_2, period_3, period_4, period_5, exam_date
          FROM $time_tbl WHERE (class_array='$class_array' AND term='$log_term' AND session='$log_session')");
     }else if($class_category == "Senior-School"){
          $class_array = 'SSS-1,SSS-2,SSS-3';
          $query = $conn->query("SELECT day, period_1, period_2, period_3, period_4, period_5, exam_date
          FROM $time_tbl WHERE (class_array='$class_array' AND term='$log_term' AND session='$log_session')");
     }else if($class_category == "Primary-School"){
          $class_array = 'Creche,KG-1,KG-2,NUR-1,NUR-2[Basic-1],PRY-1[Basic-2],PRY-2[Basic-3],PRY-3[Basic-4],PRY-4[Basic-5],PRY-5[Basic-6]';
          $query = $conn->query("SELECT day, period_1, period_2, period_3, period_4, period_5, exam_date
          FROM $time_tbl WHERE (class_array='$class_array' AND term='$log_term' AND session='$log_session')");
     }else{
          $query = $conn->query("SELECT day, period_1, period_2, period_3, period_4, period_5, exam_date
          FROM $time_tbl WHERE (term='$log_term' AND session='$log_session')");
     }
      
      while ($row = $query->fetch_assoc()) {
          fputcsv($output, $row);
     }
     fclose($output);
}

if ($_GET['table'] == $score_tbl) {
     $term = $_GET['term'];
     $session = $_GET['session'];
     $course_code = $_GET['course_code'];
    
     header('Content-Type: text/csv; charset=utf-8');
     header('Content-Disposition: attachment; filename='.$term.' ['.$session.'] score-sheet for '.$course_code.'.csv');
     $output = fopen("php://output", "w");
     fputcsv($output, array('NAME', 'ADM NO', 'COURSE CODE', 'ASS', 'CA1', 'CA2', 'CA3', 'THEORY SCORE', 'OBJECTIVE SCORE'));

     $query = $conn->query("SELECT name, adm_no, course_code, ass, ca1, ca2, ca3, theory, score FROM $score_tbl 
     WHERE (course_code='$course_code' AND teacher_token='$token' AND term='$log_term' AND session='$log_session')");
      while ($row = $query->fetch_assoc()) {
          fputcsv($output, $row);
     }
     
     fclose($output);
}

if (isset($_GET['quest_instruct']) == "question") {
     header('Content-Type: text/csv; charset=utf-8');
     header('Content-Disposition: attachment; filename=Question-format.csv');
     $output = fopen("php://output", "w");
     fputcsv($output, array('Number', 'Question', 'A', 'B', 'C', 'D', 'IS CORRECT'));
     fputcsv($output, array('1', 'Apple begins with what letter?', 'Letter Q', 'Letter B', 'Letter A', 'Letter O', 'C'));
     fclose($output);
}

if (isset($_GET['quest_instruct']) == "instruction") {
     header('Content-Type: text/csv; charset=utf-8');
     header('Content-Disposition: attachment; filename=Instruction-format.csv');
     $output = fopen("php://output", "w");
     fputcsv($output, array('INSTRUCTION 1', 'INSTRUCTION 2', 'INSTRUCTION 3', 'INSTRUCTION 4', 'INSTRUCTION 5', 'INSTRUCTION 6'));
     fputcsv($output, array('Write instruction 1 here...', 'Write instruction 2 here...', 'Write instruction 3 here...', 'Write instruction 4 here...', 'Write instruction 5 here...', 'Write instruction 6 here...'));
     fclose($output);
}

if ($_GET['table'] == $bill_tbl) {
     $class = $_GET['class'];
     $term = $_GET['term'];
     $session = $_GET['session'];
        
     header('Content-Type: text/csv; charset=utf-8');
     header('Content-Disposition: attachment; filename=Bill for '.$term.' ['.$session.'] ' . $class . '.csv');
     $output = fopen("php://output", "w");
     fputcsv($output, array('Name', 'Admission NO', 'Class', 'School fee', 'Registration', 'Uniform', 'Sport wear', 'Cardigan', 'School badge', 'ID card', 'Handbook', 'Extra lesson', 'Security', 'Media', 'Club', 'Vocational', 'Boarding fee',
      'ICT', 'Health', 'PTA', 'Sport', 'Music', 'Excursion', 'Valedictory service', 'Transport', 'Development', 'Others', 'What does others cover?', 'Actual total', 'Compulsory total', 'Outstanding', 'Paid'));
     
       if($class == "all"){
          $query = $conn->query("SELECT name, userId, class, sch_fee, reg_fee, uniform, sport_wear, cardigan, sch_badge, id_card, handbook, lesson, security, sch_media, club, vocational, boarding_fee,
          ict, health, pta, sport, music, excursion, vs_fee, transport, development, others, others_covers, actual_total, compulsory_total, outstanding, paid
     FROM $bill_tbl WHERE (term='$log_term' AND session='$log_session') ORDER BY class ASC");
     }else{
          $query = $conn->query("SELECT name, userId, class, sch_fee, reg_fee, uniform, sport_wear, cardigan, sch_badge, id_card, handbook, lesson, security, sch_media, club, vocational, boarding_fee,
          ict, health, pta, sport, music, excursion, vs_fee, transport, development, others, others_covers, actual_total, compulsory_total, outstanding, paid
     FROM $bill_tbl WHERE class='$class' AND  term='$log_term' AND session='$log_session' ORDER BY compulsory_total DESC");
     }
     
     while ($row = $query->fetch_assoc()) {
          fputcsv($output, $row);
     }
     fclose($output);
}


if ($_GET['table'] == $evaluation_tbl && $_GET['type'] == "teacher") {
     header('Content-Type: text/csv; charset=utf-8');
     header("Content-Disposition: attachment; filename=Teacher's comment for ".$class_officiating." ".$term_syntax." ".$log_session.".csv");
     $output = fopen("php://output", "w");
     if($log_term == 1 || $log_term == 2){
 fputcsv($output, array(
          'Name', 'Admission NO', 'Class', 'Overall Score', 'Out of', 'Percent Score', 'No Absent', 'No Present',
          'Punctuality', 'Attentiveness', 'Neatness', 'Honesty', 'Relationship with others', 'Skills in Co-curricular', 'Sports/games', 'Club', 'Fluency', 'Handwriting', 'Comment'
     ));

     $query = "SELECT name, adm_no, class, overall_score, out_of, percent_score, n_absent, n_present, punctuality, attentiveness,
 neatness, honesty, relationship, skills, sport, clubs, fluency, handwriting, t_comment FROM $evaluation_tbl WHERE session='$log_session' AND term='$log_term' AND class='$class_officiating' ORDER BY percent_score DESC";
     }else if($log_term == 3){
 fputcsv($output, array(
          'Name', 'Admission NO', 'Class', 'Overall Score', 'Out of', 'Percent Score', 'No Absent', 'No Present',
          'Punctuality', 'Attentiveness', 'Neatness', 'Honesty', 'Relationship with others', 'Skills in Co-curricular', 'Sports/games', 'Club', 'Fluency', 'Handwriting', 'Comment', 'Promoted-to'
     ));

     $query = "SELECT name, adm_no, class, overall_score, out_of, percent_score, n_absent, n_present, punctuality, attentiveness,
 neatness, honesty, relationship, skills, sport, clubs, fluency, handwriting, t_comment, promoted_to FROM $evaluation_tbl WHERE session='$log_session' AND term='$log_term' AND class='$class_officiating' ORDER BY percent_score DESC";
     }
    
     $result = mysqli_query($conn, $query);
     while ($row = mysqli_fetch_assoc($result)) {
          fputcsv($output, $row);
     }
     fclose($output);
}

if ($_GET['table'] == $evaluation_tbl && $_GET['type'] == "head_teacher") {
     header('Content-Type: text/csv; charset=utf-8');
      header("Content-Disposition: attachment; filename=Head teacher's comment for ".$class_officiating." ".$term_syntax." ".$log_session.".csv");
     $output = fopen("php://output", "w");
       if($log_term == 1 || $log_term == 2){
     fputcsv($output, array('Name', 'Admission NO', 'Class', 'Percent score', 'Position', 'Comment by class teacher', 'Comment by head teacher'));

     $query = "SELECT name, adm_no, class, percent_score, position, t_comment, p_comment FROM $evaluation_tbl WHERE session='$log_session' AND term='$log_term' ORDER BY percent_score DESC";
       }else if($log_term == 3){
 fputcsv($output, array('Name', 'Admission NO', 'Class', 'Percent score', 'Position', 'Comment by class teacher', 'Comment by head teacher', 'Promoted to', 'Next resumption date'));

     $query = "SELECT name, adm_no, class, percent_score, position, t_comment, p_comment, promoted_to, next_term_date FROM $evaluation_tbl WHERE session='$log_session' AND term='$log_term' ORDER BY percent_score DESC";
       }
     $result = mysqli_query($conn, $query);
     while ($row = mysqli_fetch_assoc($result)) {
          fputcsv($output, $row);
     }
     fclose($output);
}
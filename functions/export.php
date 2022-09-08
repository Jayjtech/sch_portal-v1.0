<?php
require "../config/db.php";
$log_term = $_SESSION['log_term'];
$log_session = $_SESSION['log_session'];

if ($_GET['table'] == $question_tbl_a) {
    $token = $_GET['token'];
     header('Content-Type: text/csv; charset=utf-8');
     header('Content-Disposition: attachment; filename=Question-format.csv');
     $output = fopen("php://output", "w");
     fputcsv($output, array('Number', 'Question', 'A', 'B', 'C', 'D', 'IS CORRECT'));
     fputcsv($output, array('1', 'Apple begins with what letter?', 'Letter Q', 'Letter B', 'Letter A', 'Letter O', 'C'));
     fclose($output);
}

if ($_GET['table'] == $bill_tbl) {
     $class = $_GET['class'];
     $term = $_GET['term'];
     $session = $_GET['session'];
     switch($log_term){
          case 1:
          $paid = "ft_paid";
          $outstanding = "ft_outstanding";
          break;
          case 2:
          $paid = "st_paid";
          $outstanding = "st_outstanding";
          break;
          case 3:
          $paid = "tt_paid";
          $outstanding = "tt_outstanding";
          break;
     }
   
     header('Content-Type: text/csv; charset=utf-8');
     header('Content-Disposition: attachment; filename=Bill for '.$term.' ['.$session.'] ' . $class . '.csv');
     $output = fopen("php://output", "w");
     fputcsv($output, array('Name', 'Admission NO', 'Class', 'School fee', 'ICT', 'Health', 'PTA', 'Sport', 'Music', 'Excursion', 'Valedictory Service', 'Transport', 'Development', 'Others', 'What does others cover?', 'Total', 'Outstanding', 'Paid'));
     
       if($class == "all"){
          $query = $conn->query("SELECT name, userId, class, sch_fee, ict, health, pta, sport, music, excursion, vs_fee, transport, development, others, others_covers, total, $outstanding, $paid
     FROM $bill_tbl WHERE term='$log_term' AND session='$log_session' ORDER BY total DESC");
     }else{
          $query = $conn->query("SELECT name, userId, class, sch_fee, ict, health, pta, sport, music, excursion, vs_fee, transport, development, others, others_covers, total, $outstanding, $paid
     FROM $bill_tbl WHERE class='$class' AND  term='$log_term' AND session='$log_session' ORDER BY total DESC");
     }
     

     while ($row = $query->fetch_assoc()) {
          fputcsv($output, $row);
     }
     fclose($output);
}


// if ($_GET['table'] == "evaluation") {
//      $class = $_GET['class'];
//      header('Content-Type: text/csv; charset=utf-8');
//      header("Content-Disposition: attachment; filename=Teacher's comment.csv");
//      $output = fopen("php://output", "w");
//      fputcsv($output, array(
//           'Student Name', 'Admission NO', 'Class', 'Term', 'Session', 'No Absent', 'No Present',
//           'Punctuality', 'Attentiveness', 'Neatness', 'Honesty', 'Relationship with others', 'Skills in Co-curriculars', 'Sports/games', 'Club', 'Fluency', 'Handwriting', 'Position', 'Comment', 'Promoted-to'
//      ));

//      $query = "SELECT fullname, adm_no, class, term, session, n_absent, n_present, punctuality, attentiveness,
//  neatness, honesty, relationship, skills, sport, clubs, fluency, handwriting, position, t_comment, promoted_to FROM evaluation WHERE session='$current_session' AND term='$current_term' AND class='$class' ORDER BY class ASC";
//      $result = mysqli_query($conn, $query);
//      while ($row = mysqli_fetch_assoc($result)) {
//           fputcsv($output, $row);
//      }
//      fclose($output);
// }

// if ($_GET['table'] == "p_evaluation") {
//      header('Content-Type: text/csv; charset=utf-8');
//      header("Content-Disposition: attachment; filename=Principal's comment.csv");
//      $output = fopen("php://output", "w");
//      fputcsv($output, array('Student Name', 'Admission NO', 'Class', 'Term', 'Session', 'Comment from Principal', 'Next resumption date'));

//      $query = "SELECT fullname, adm_no, class, term, session, p_comment, next_term_date FROM evaluation WHERE session='$current_session' AND term='$current_term'";
//      $result = mysqli_query($conn, $query);
//      while ($row = mysqli_fetch_assoc($result)) {
//           fputcsv($output, $row);
//      }
//      fclose($output);
// }
// if ($_GET['table'] == "result_checker") {
//      header('Content-Type: text/csv; charset=utf-8');
//      header("Content-Disposition: attachment; filename=Result-Pin " . $current_term . " " . $current_session . ".csv");
//      $output = fopen("php://output", "w");
//      fputcsv($output, array('Student Name', 'Admission NO', 'Term', 'Session', 'Result Pin'));

//      $query = "SELECT fullname, adm_no, term, session, code FROM $result_checker_tbl WHERE session='$current_session' AND term='$current_term'";
//      $result = mysqli_query($conn, $query);
//      while ($row = mysqli_fetch_assoc($result)) {
//           fputcsv($output, $row);
//      }
//      fclose($output);
// }

// if ($_GET['table'] == $time_table) {
//      header('Content-Type: text/csv; charset=utf-8');
//      header('Content-Disposition: attachment; filename=Time-table.csv');
//      $output = fopen("php://output", "w");
//      fputcsv($output, array('SUBJECT', 'COURSE CODE', 'EXAM DAY', 'EXAM PERIOD'));
//      $query = "SELECT subject, course_code, day, exam_order FROM $time_table WHERE session='$current_session'";
//      $result = mysqli_query($conn, $query);
//      while ($row = mysqli_fetch_assoc($result)) {
//           fputcsv($output, $row);
//      }
//      fclose($output);
// }


// if ($_GET['table'] == $answer_table) {
//      $teacher = $_SESSION['name'];
//      header('Content-Type: text/csv; charset=utf-8');
//      header('Content-Disposition: attachment; filename=Answer-formart.csv');
//      $output = fopen("php://output", "w");
//      fputcsv($output, array('Quesion Number', 'Right(1)/Wrong(0)', 'Options', 'Answer Text'));
//      $query = "SELECT question_number, is_correct, alpha_opt, text FROM $answer_table WHERE session='$current_session' AND teacher='$teacher'";
//      $result = mysqli_query($conn, $query);
//      while ($row = mysqli_fetch_assoc($result)) {
//           fputcsv($output, $row);
//      }
//      fclose($output);
// }



// if ($_GET['table'] == 'instruction_tbl') {
//      $teacher = $_SESSION['name'];
//      header('Content-Type: text/csv; charset=utf-8');
//      header('Content-Disposition: attachment; filename=Instruction.csv');
//      $output = fopen("php://output", "w");
//      fputcsv($output, array('Instruction 1', 'Instruction 2', 'Instruction 3', 'Instruction 4', 'Instruction 5'));
//      $query = "SELECT instruction1, instruction2, instruction3, instruction4, instruction5 FROM instruction_tbl";
//      $result = mysqli_query($conn, $query);
//      while ($row = mysqli_fetch_assoc($result)) {
//           fputcsv($output, $row);
//      }
//      fclose($output);
// }

// if ($_GET['students']) {
//      header('Content-Type: text/csv; charset=utf-8');
//      header('Content-Disposition: attachment; filename=Student-list.csv');
//      $output = fopen("php://output", "w");
//      fputcsv($output, array('Full name', 'Admission No', 'Class', 'Gender', 'Username', 'Phone', 'Email', 'Password'));
//      $query = "SELECT fullname, adm_no, class, gender, username, phone, email, keyp FROM $student_tbl";
//      $result = mysqli_query($conn, $query);
//      while ($row = mysqli_fetch_assoc($result)) {
//           fputcsv($output, $row);
//      }
//      fclose($output);
// }

// if ($_GET['staff']) {
//      header('Content-Type: text/csv; charset=utf-8');
//      header('Content-Disposition: attachment; filename=Staff-list.csv');
//      $output = fopen("php://output", "w");
//      fputcsv($output, array('Name', 'Surname', 'Email', 'Username', 'Phone', 'gender', 'Assigned Class', 'Password', 'Token'));
//      $query = "SELECT name, surname, email, username, phone, gender, assignedClass, keyp, token FROM $admin_tbl";
//      $result = mysqli_query($conn, $query);
//      while ($row = mysqli_fetch_assoc($result)) {
//           fputcsv($output, $row);
//      }
//      fclose($output);
// }
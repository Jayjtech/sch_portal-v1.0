<?php 
if($_SESSION['userId'] == false){
$userId = "";
$token = "";
$name =  "";
$log_session =  "";
$log_term =  "";
}else{
$userId = $_SESSION['userId'];
$token = $_SESSION['token'];
$name = $_SESSION['name'];
$log_session = $_SESSION['log_session'];
$log_term = $_SESSION['log_term'];
}


if($_SESSION['log_term'] == false || $_SESSION['log_session'] == false){
    $log_term = $current_term;
    $log_session = $current_session;
}

switch($log_term){
    case 1:
        $term_syntax = "First";
        break;
    case 2:
        $term_syntax = "Second";
        break;
    case 3:
        $term_syntax = "Third";
        break;
}

$callSession = $conn->query("SELECT * FROM $session_tbl ORDER BY session ASC");
$callClass = $conn->query("SELECT * FROM $class_tbl ORDER BY class ASC");
$callStudentAward = $conn->query("SELECT * FROM $student_award_tbl");

/**User details */
$callUserDetails = $conn->query("SELECT * FROM $users_tbl WHERE userId='$userId'");
$det = $callUserDetails->fetch_object();
$department = $det->department;
switch($det->position){
    case 0:
        $POD = '<div class="text-danger">Yet to be assigned!</div>';
        break;
    case 1:
        $POD = "Proprietor";
        break;
    case 2:
        $POD = "Principal";
        break;
    case 3:
        $POD = "Vice Principal";
        break;
    case 4:
        $POD = "Head Teacher";
        break;
    case 5:
        $POD = "Teacher";
        break;
    case 6:
        $POD = "Bursar";
        break;
    case 7:
        $POD = "Treasurer";
        break;
}


/**Courses Staff*/
$callCourses = $conn->query("SELECT * FROM $course_tbl WHERE token='$token' AND term='$log_term' AND session='$log_session'");
$selCourses = $conn->query("SELECT * FROM $course_tbl WHERE token='$token' AND term='$log_term' AND session='$log_session'");
$created_course_count = $callCourses->num_rows;
/**Call all staff */
$callStaff = $conn->query("SELECT * FROM $users_tbl WHERE user_type = 'd29yaw=='");

/**Call students */
$callStudents = $conn->query("SELECT * FROM $users_tbl WHERE user_type = 'c3R1ZHk='");

/**Course student */
$availableCourse = $conn->query("SELECT * FROM $course_tbl WHERE department='$department' OR department='general' AND (term='$log_term' AND session='$log_session')");
?>
<?php 
$userId = $_SESSION['userId'];
$token = $_SESSION['token'];
$callSession = $conn->query("SELECT * FROM $session_tbl ORDER BY session ASC");
$callClass = $conn->query("SELECT * FROM $class_tbl ORDER BY class ASC");

/**User details */
$callUserDetails = $conn->query("SELECT * FROM $users_tbl WHERE userId='$userId'");
$det = $callUserDetails->fetch_object();
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


/**Courses */
$callCourses = $conn->query("SELECT * FROM $course_tbl WHERE token='$token'");
$created_course_count = $callCourses->num_rows;
?>
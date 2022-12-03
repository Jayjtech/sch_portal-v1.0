<?php
$choose_pod = "Choose POD";
$choose_pod_val = "";
$assign_priv = "Assign Privileges";
$assign_level = "Assign Level";
$assign_class = "Assign Class";
$curr_class = "Change Class";
$award_val = "Give award";
$award = "";
// Review course parameters:
$sch_catValue = "";
$departValue = "";
$assValue = "";
$ass = "Ass";
$test = "Test";
$testValue = "";
$exam = "Exam";
$examValue = "";
$departM = "Choose department";
$sch_cat = "School category";
$revCourseQuery = "pushCourse";
$revCourseTag = "Save";
$readonly = "";
/**REVIEW STAFF */
if(isset($_GET['pod'])){
    $token = mysqli_real_escape_string($conn,$_GET['pod']);
    $selectStaff = $conn->query("SELECT * FROM $users_tbl WHERE token='$token'");
    $edS = $selectStaff->fetch_object();

     switch($edS->img){
        case false:
        $ed_img = 'default-img.jpg';
        break;
        case true:
        $ed_img = $edS->img;
        break;
    }
switch($edS->position){
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

switch($edS->privileges){
    case 0:
        $priv = '<div class="text-danger">Yet to be assigned!</div>';
        break;
    case 1:
        $priv = "|Student|Staff|Exam|Documents|Revenue|";
        break;
    case 2:
        $priv = "|Student|Staff|Exam|Documents|";
        break;
    case 3:
        $priv = "|Student|Staff|Exam|";
        break;
    case 4:
        $priv = "|Student|Staff|";
        break;
    case 5:
        $priv = "|Student|";
        break;
}
    $choose_pod = $POD;
    $choose_pod_val = $edS->position;
    $assign_priv = $priv;
    $assign_priv_val = $edS->privileges;
    $assign_class_val = $edS->class_officiating;
    $assign_level_val = $edS->staff_level;
    $assign_level = 'Level-'.$edS->staff_level;
    $assign_class = $edS->class_officiating;
}

/**REVIEW STUDENT */
if(isset($_GET['rev'])){
    $adm_no = $_GET['ac'];
    $token = mysqli_real_escape_string($conn,$_GET['rev']);
    $selectStudent = $conn->query("SELECT * FROM $users_tbl WHERE token='$token'");
    $edStu = $selectStudent->fetch_object();
   switch($edStu->img){
        case false:
        $ed_img = 'default-img.jpg';
        break;
        case true:
        $ed_img = $edStu->img;
        break;
    }
    $curr_class_val = $edStu->curr_class;
    $curr_class = $edStu->curr_class;
    $award_val = $edStu->award_type;
    $award = $edStu->award_type;

    $selectBills = $conn->query("SELECT * FROM $bill_tbl WHERE (userId = '$adm_no' AND term='$log_term' AND session='$log_session')");
    $bil = $selectBills->fetch_object();
}

/**REVIEW COURSE */
if(isset($_GET['index']) && isset($_GET['sch_category'])){
    $course_code = $_GET['index'];
    $sch_category = $_GET['sch_category'];
    $courseDetails = $conn->query("SELECT * FROM $course_tbl WHERE (token = '$token' AND sch_category='$sch_category' AND course_code= '$course_code' AND term='$log_term' AND session='$log_session')");
    $courseDet = $courseDetails->fetch_object();
    $sch_catValue = $sch_cat = $courseDet->sch_category;
    $departValue = $departM = $courseDet->department;
    $assValue = $ass = $courseDet->ass_no_of_quest;
    $testValue = $test = $courseDet->test_no_of_quest;
    $examValue = $exam = $courseDet->exam_no_of_quest;
    $revCourseQuery = "reviewCourse";
    $revCourseTag = "Update";
    $readonly = "readonly";
}


/**SORT STUDENT BILLS */
if(isset($_GET['sort_bill'])){
    $adm_no = $_GET['sort_bill'];
    $selectBills = $conn->query("SELECT * FROM $bill_tbl WHERE (userId = '$adm_no' AND term='$log_term' AND session='$log_session')");
    $bil = $selectBills->fetch_object();

    /**Get outstanding fee */
    $curr_sess_oust = $conn->query("SELECT * FROM $bill_tbl WHERE (userId = '$adm_no' AND session <='$log_session')");

    /**Get Succesful payment for current academic period */
    $curr_sess_bill_report = $conn->query("SELECT * FROM $bill_report_tbl WHERE (adm_no = '$adm_no' AND term='$log_term' AND session ='$log_session')");
    
    /**Wallet balance */
    $selectWalletBal = $conn->query("SELECT * FROM $users_tbl WHERE userId = '$adm_no'");
    $wal = $selectWalletBal->fetch_object();
}

/**FUND STUDENT'S WALLET */
if(isset($_GET['cash_funding'])){
    $adm_no = $_GET['cash_funding'];
    $getStudent = $conn->query("SELECT * FROM $users_tbl WHERE (userId = '$adm_no')");
    $userDet = $getStudent->fetch_object();
}


?>
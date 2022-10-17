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
$exp_acad_period = false;
$unapproved_acad_period = false;

if(isset($_SESSION['log_term']) == false || isset($_SESSION['log_session']) == false){
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
$callClass = $conn->query("SELECT * FROM $class_tbl ORDER BY id ASC");
while($caClass = $callClass->fetch_object()){
    $classData[] = $caClass;
}
$callStudentAward = $conn->query("SELECT * FROM $student_award_tbl");

$exp_c_s = explode("/", $current_session);
$exp_l_s = explode("/", $log_session);

if($exp_l_s[1] < $exp_c_s[1]){
    $exp_acad_period = true;
}
/**User details */
$callUserDetails = $conn->query("SELECT * FROM $users_tbl WHERE userId='$userId'");
$det = $callUserDetails->fetch_object();
$department = $det->department;
$curr_class = $det->curr_class;
switch($det->img){
    case false:
    $p_img = 'default-img.jpg';
    break;
    case true:
    $p_img = $det->img;
    break;
}

$monnify_account = json_decode($det->monnify_account);
$bank_account = json_decode($det->bank_details);
$class_officiating = $det->class_officiating;

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
    case 8:
        $POD = "Casual staff";
        break;
}

/**Privilege Authenticator */
$adminLevel1 = [1];
$adminLevel2 = [1,2,3,4];
$bursar = [1,6,7];
$worker = [1,2,3,4,5,6,7];

/**Courses Staff*/
$callCourses = $conn->query("SELECT * FROM $course_tbl WHERE token='$token' AND term='$log_term' AND session='$log_session'");
$callMaterial = $conn->query("SELECT * FROM $course_material_tbl WHERE token='$token' AND term='$log_term'");
$created_course_count = $callCourses->num_rows;
$selCourses = $conn->query("SELECT * FROM $course_tbl WHERE token='$token' AND term='$log_term' AND session='$log_session'");
while($courseList = $selCourses->fetch_object()){
    $coList[] = $courseList;
}

/**Call all staff */
$callStaff = $conn->query("SELECT * FROM $users_tbl WHERE (user_type = 'd29yaw==' OR user_type = 'QWRtaW4=')");
/**Total Salary */
$salaryTotal = $conn->query("SELECT sum(salary) as total_salary FROM $users_tbl WHERE (user_type = 'd29yaw==' OR user_type = 'QWRtaW4=')");
$salTol = $salaryTotal->fetch_object();
/**User salary details */
$mySalDet = $conn->query("SELECT * FROM $payroll_tbl WHERE staffToken='$token'");
$payrollList = $conn->query("SELECT * FROM $payroll_title_tbl");
while($payR = $payrollList->fetch_object()){
    $payRData[]= $payR;
}

$callDisList = $conn->query("SELECT * FROM $payroll_tbl");

/**Call students */
$callStudents = $conn->query("SELECT * FROM $users_tbl WHERE user_type = 'c3R1ZHk=' ORDER BY curr_class ASC");

/**Course student */
$availableCourse = $conn->query("SELECT * FROM $course_tbl WHERE (class='$curr_class' AND term='$log_term' AND session='$log_session') AND (department='$department' OR department='General' OR department='Non')");
$enrolledCourse = $conn->query("SELECT * FROM $score_tbl WHERE adm_no='$userId' AND term='$log_term' AND session='$log_session'");
/**Time table */
$callTimeTable = $conn->query("SELECT * FROM $time_tbl WHERE (term='$log_term' AND session='$log_session')");

if($det->position == 5){
    /**Teacher */
    $callEnrolmentList = $conn->query("SELECT * FROM $score_tbl WHERE (class = '$class_officiating' AND term='$log_term' AND session = '$log_session')");
}else{
    $callEnrolmentList = $conn->query("SELECT * FROM $score_tbl WHERE (term='$log_term' AND session = '$log_session')");
}

$callScoreSheet = $conn->query("SELECT * FROM $score_tbl WHERE (term='$log_term' AND session = '$log_session' AND teacher_token='$token') ORDER BY class ASC");

if(in_array($det->position, $adminLevel2)){
$callEvaluation = $conn->query("SELECT * FROM $evaluation_tbl WHERE (term='$log_term' AND session = '$log_session') ORDER BY percent_score DESC");
}else{
$callEvaluation = $conn->query("SELECT * FROM $evaluation_tbl WHERE (term='$log_term' AND session = '$log_session' AND class='$class_officiating') ORDER BY percent_score DESC");
}
/**Bills */
$callBills = $conn->query("SELECT * FROM $bill_tbl WHERE (term='$log_term' AND session = '$log_session') ORDER BY compulsory_total ASC");
$compulsoryBillSettings = $conn->query("SELECT * FROM $bill_setting_tbl WHERE status=1");
$actualBillSettings = $conn->query("SELECT * FROM $bill_setting_tbl WHERE status=0");
$getTotalCompulsoryBill = $conn->query("SELECT sum(compulsory_total) as comp_total FROM $bill_tbl WHERE (term='$log_term' AND session='$log_session')");
$compBill = $getTotalCompulsoryBill->fetch_object();

$earning = $conn->query("SELECT sum(amount_paid) as already_earned FROM $bill_report_tbl WHERE (term='$log_term' AND session='$log_session')");
$earn = $earning->fetch_object();

$callStaffLevels = $conn->query("SELECT * FROM $staff_level_tbl ORDER BY salary_amount DESC");
$callPayroll = $conn->query("SELECT * FROM $payroll_title_tbl ORDER BY id DESC");

$bankList = $conn->query("SELECT * FROM $banks_tbl ORDER BY bank ASC");

/**Loan request list */
$callLoanList = $conn->query("SELECT * FROM $loan_tbl WHERE amount != 0 ORDER BY id DESC");
$myLoanDet = $conn->query("SELECT * FROM $loan_tbl WHERE userId='$userId' ORDER BY id DESC");
$callLoanDisburseList = $conn->query("SELECT * FROM $loan_disbursement_tbl ORDER BY id DESC");
$myLoanReq = $conn->query("SELECT * FROM $loan_tbl WHERE (token='$token' AND amount != 0) ORDER BY id DESC");



/**Loan Availability */
if($admin_det->loan_availability == 0){
    $loan_availability = "Unavailable";
}else{
     $loan_availability = "Available";
}

/**Expenses */
$callExpenses = $conn->query("SELECT * FROM $expenses_tbl");

/**Raw score */
$callRawScore = $conn->query("SELECT * FROM $score_tbl WHERE (adm_no='$userId' AND term='$log_term' AND session='$log_session')");

$callResultPins = $conn->query("SELECT * FROM $result_checker_tbl WHERE adm_no='$userId'");

/**Result template */
if($admin_det->result_template == 1){
    $result_sheet_url = "a_result_template";
}else if($admin_det->result_template == 2){
    $result_sheet_url = "b_result_template";
}


/**My Bills */
$myBill = $conn->query("SELECT * FROM $bill_tbl WHERE (userId='$userId' AND term='$log_term' AND session='$log_session')");
$mb = $myBill->fetch_object();
/**My course materials */
$myCourseMat = $conn->query("SELECT * FROM $course_material_tbl WHERE (term='$log_term' AND class='$curr_class') AND (category='Lesson note' OR category='Document')");
/**My Syllabus */
$myCourseMat = $conn->query("SELECT * FROM $course_material_tbl WHERE (term='$log_term' AND class='$curr_class' AND category='Syllabus')");


?>
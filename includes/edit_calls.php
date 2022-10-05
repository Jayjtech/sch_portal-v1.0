<?php
$choose_pod = "Choose POD";
$choose_pod_val = "";
$assign_priv = "Assign Privileges";
$assign_level = "Assign Level";
$assign_class = "Assign Class";
$curr_class = "Change Class";
$award_val = "Give award";
$award = "";
$callClass2 = $conn->query("SELECT * FROM $class_tbl ORDER BY id ASC");
/**REVIEW STAFF */
if(isset($_GET['pod'])){
    $token = mysqli_real_escape_string($conn,$_GET['pod']);
    $selectStaff = $conn->query("SELECT * FROM $users_tbl WHERE token='$token'");
    $edS = $selectStaff->fetch_object();
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

    $curr_class_val = $edStu->curr_class;
    $curr_class = $edStu->curr_class;
    $award_val = $edStu->award_type;
    $award = $edStu->award_type;

    $selectBills = $conn->query("SELECT * FROM $bill_tbl WHERE (userId = '$adm_no' AND term='$log_term' AND session='$log_session')");
    $bil = $selectBills->fetch_object();
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
?>
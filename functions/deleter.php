<?php
include "../config/db.php";
if(isset($_POST['staffToken'])){
    $staffToken = $_POST['staffToken'];
    $staff_name = $_POST['staff_name'];
    $payment_month = $_POST['payment_month'];
    $disbursement_id = $_POST['disbursement_id'];

    $del = $conn->query("DELETE FROM $payroll_tbl WHERE staffToken = '$staffToken' AND disbursement_id='$disbursement_id'");
    if($del){
        $_SESSION['message'] = ''.$staff_name.' has been removed from the disbursement list for '.$payment_month.'';
        $_SESSION['msg_type'] = 'success';
        $_SESSION['remedy'] = '';
    }else{
        $_SESSION['message'] = ''.$staff_name.' could not be removed from the disbursement list for '.$payment_month.'';
        $_SESSION['msg_type'] = 'error';
        $_SESSION['remedy'] = '';
    }
header('location: ../adm_disbursement?key=disbursement_list');
}
?>
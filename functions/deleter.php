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
header('location: ../adm_disbursement?disbursement_list');
}


if(isset($_POST['delete_payroll'])){
    $disbursement_id = $_POST['delete_payroll'];
    $month = $_POST['month'];
    $check = $conn->query("SELECT * FROM $payroll_tbl WHERE disbursement_id='$disbursement_id'");
    if($check->num_rows == 0){
         $del = $conn->query("DELETE FROM $payroll_title_tbl WHERE disbursement_id='$disbursement_id'");
        if($del){
            $_SESSION['message'] = 'Disbursement list for '.$month.' has been deleted';
            $_SESSION['msg_type'] = 'success';
            $_SESSION['remedy'] = '';
        }else{
            $_SESSION['message'] = 'An error occurred during the process';
            $_SESSION['msg_type'] = 'error';
            $_SESSION['remedy'] = '';
        }
    }else{
        $_SESSION['message'] = 'Payroll can not be deleted';
        $_SESSION['msg_type'] = 'info';
        $_SESSION['remedy'] = 'Staff already exist on this payroll. Remove staff that exist on this payroll from the disbursement list page.';
    }
    header('location:../adm_disbursement?create_payroll');
}
?>
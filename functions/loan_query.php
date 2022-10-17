<?php
    include "../config/db.php";
    include "../includes/calls.php";
    
if(isset($_POST['set_loan'])){
    $loan_max_amount = mysqli_real_escape_string($conn, stripcslashes($_POST['loan_max_amount']));
    $loan_num_month_legibility = mysqli_real_escape_string($conn, stripcslashes($_POST['loan_num_month_legibility']));
    $loan_refund_rate = mysqli_real_escape_string($conn, stripcslashes($_POST['loan_refund_rate']));
    $loan_interest = mysqli_real_escape_string($conn, stripcslashes($_POST['loan_interest']));
    $availability = $_POST['availability'];

    $update = $conn->query("UPDATE $settings_tbl SET
                            loan_max_amount = '$loan_max_amount',
                            loan_num_month_legibility = '$loan_num_month_legibility',
                            loan_refund_rate = '$loan_refund_rate',
                            loan_availability = '$availability',
                            loan_interest = '$loan_interest'
                        ");

    if($update){
        $_SESSION['message'] = "Changes successfully saved!";
        $_SESSION['msg_type'] = "success";
        $_SESSION['remedy'] = "";
    }else{
        $_SESSION['message'] = "An error occurred during the process!";
        $_SESSION['msg_type'] = "error";
        $_SESSION['remedy'] = "";
    }

    header('location: ../adm_loan_approval?loan_setting');
}



if(isset($_POST['loan_request'])){
    $loan_amount = mysqli_real_escape_string($conn, stripcslashes($_POST['loan_amount']));

    $check = $conn->query("SELECT * FROM $loan_tbl WHERE userId = '$userId'");
    $chk = $check->fetch_object();
    // if($chk->balance == true){
    //     $old_balance = $chk->balance;
    // }else{
    //     $old_balance = 0;
    // }
    
    /**Calculating current balance */
    // $curr_balance = ($old_balance+$amount);

    $insert_loan = $conn->query("INSERT INTO $loan_tbl SET 
                            name = '$name',
                            amount = '$loan_amount',
                            userId = '$userId',
                            token = '$token',
                            date = '$date',
                            time = '$time',
                            status = 0
                        ");
    if($insert_loan){
        $_SESSION['message'] = "Your request has been sent and it's being processed!";
        $_SESSION['msg_type'] = "success";
        $_SESSION['remedy'] = "";
    }else{
        $_SESSION['message'] = "An error occurred during the process!";
        $_SESSION['msg_type'] = "error";
        $_SESSION['remedy'] = "";
    }
     header('location: ../adm_incentive?take_loan');
}

if(isset($_POST['approve_loan'])){
    $staffToken = mysqli_real_escape_string($conn, stripcslashes($_POST['staffToken']));
    $staff_name = mysqli_real_escape_string($conn, stripcslashes($_POST['staff_name']));
    $loan_amount = mysqli_real_escape_string($conn, stripcslashes($_POST['loan_amount']));
    $loan_id = mysqli_real_escape_string($conn, $_POST['loan_id']);
    $loan_date = mysqli_real_escape_string($conn, $_POST['loan_date']);

    $getDetail = $conn->query("SELECT * FROM $users_tbl WHERE token='$staffToken'");
    $gD = $getDetail->fetch_object();

    $bankDet = $gD->bank_details;
    $staffId = $gD->userId;
  if($bankDet != ""){
    $description = 'Loan request of '.$loan_amount.'. Request date: '.$loan_date.'';

    $approve = $conn->query("UPDATE $loan_tbl SET 
                            status = 4
                            WHERE token = '$staffToken'
                            AND id = '$loan_id'
                            AND status = 0
                        ");

    if($approve){
        $insert = $conn->query("INSERT INTO $loan_disbursement_tbl SET
                            name='$staff_name',
                            loan_id='$loan_id',
                            staffToken='$staffToken',
                            userId='$staffId',
                            bankDet='$bankDet',
                            amount='$loan_amount',
                            description='$description'
        ");
    }
    if($insert){
        $_SESSION['message'] = 'You have successfully approved the loan for '.$staff_name.'!';
        $_SESSION['msg_type'] = "success";
        $_SESSION['remedy'] = "";
    }else{
        $_SESSION['message'] = "An error occurred during the process!";
        $_SESSION['msg_type'] = "error";
        $_SESSION['remedy'] = "";
    }
}else{
        $_SESSION['message'] = ''.$staff_name.' has not provided his/her bank account details!';
        $_SESSION['msg_type'] = "info";
        $_SESSION['remedy'] = "";
}
    
     header('location: ../adm_loan_approval?approve_loan');
}


if(isset($_POST['cancel_loan'])){
    $loan_id = $_POST['loan_id'];

    $check = $conn->query("SELECT * FROM $loan_tbl WHERE id='$loan_id'");
    $ls = $check->fetch_object();
    
    if($ls->status != 4 && $ls->status != 5){
        $update = $conn->query("UPDATE $loan_tbl SET status=6 WHERE (userId = '$userId' AND id='$loan_id')");
        $_SESSION['message'] = "You have successfully cancelled your loan request!";
        $_SESSION['msg_type'] = "success";
        $_SESSION['remedy'] = "";
    }else{
        $_SESSION['message'] = "It's too late to cancel your loan request!";
        $_SESSION['msg_type'] = "error";
        $_SESSION['remedy'] = "";
    }
header('location: ../adm_incentive?take_loan');
}

if(isset($_POST['deny_loan'])){
    $loan_id = $_POST['loan_id'];
    
    $update = $conn->query("UPDATE $loan_tbl SET status=3 WHERE id='$loan_id'");
    if($update){
        $del = $conn->query("DELETE FROM $loan_disbursement_tbl WHERE loan_id='$loan_id'");
    }

    if($del){
        $_SESSION['message'] = "You have successfully denied the loan request!";
        $_SESSION['msg_type'] = "success";
        $_SESSION['remedy'] = "";
    }else{
        $_SESSION['message'] = "An error occurred during the process!";
        $_SESSION['msg_type'] = "error";
        $_SESSION['remedy'] = "";
    }

      header('location: ../adm_loan_approval?loan_disbursement_list');
}
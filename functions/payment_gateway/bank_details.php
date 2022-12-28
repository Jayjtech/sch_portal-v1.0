<?php
include "../../config/db.php";
include "../../includes/calls.php";
if(isset($_POST['add_account'])){
    $bank = mysqli_real_escape_string($conn, stripcslashes($_POST['bank']));
    $acc_no = mysqli_real_escape_string($conn, stripcslashes($_POST['acc_no']));
    $acc_holder = mysqli_real_escape_string($conn, stripcslashes($_POST['acc_holder']));
    $valid = mysqli_real_escape_string($conn, stripcslashes($_POST['valid']));

    if($valid == 1){
        $getBC = $conn->query("SELECT * FROM $banks_tbl WHERE bank='$bank'");
            $bc = $getBC->fetch_object();
            $split_bank = explode("|",$bank);
            $bank = $split_bank[0];
            $bank_code = $split_bank[1];
            $bank_details = [
            "bank" => "$bank",
            "acc_no" => "$acc_no",
            "bank_code" => "$bank_code",
            "acc_holder" => "$acc_holder"
        ];
        $bank_details = json_encode($bank_details);
        if($acc_holder == true){
            $update = $conn->query("UPDATE $users_tbl SET 
                bank_details='$bank_details'
                WHERE userId = '$userId'
        ");
            if($update){
            $_SESSION['message'] = 'Account details successfully added!'; 
            $_SESSION['msg_type'] = 'success'; 
            $_SESSION['remedy'] = ''; 
            }else{
            $_SESSION['message'] = 'Account details could not be added!'; 
            $_SESSION['msg_type'] = 'error'; 
            $_SESSION['remedy'] = 'Try again later'; 
            }
        }else{
            $_SESSION['message'] = 'All field is required!'; 
            $_SESSION['msg_type'] = 'error'; 
            $_SESSION['remedy'] = ''; 
        }
    }else{
            $_SESSION['message'] = 'You cannot add an invalid account number!'; 
            $_SESSION['msg_type'] = 'error'; 
            $_SESSION['remedy'] = 'Try again later'; 
    }


    header('location:../../account_details');
}
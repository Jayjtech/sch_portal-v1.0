<?php
include "../config/db.php";
include "../includes/calls.php";

if(isset($_POST['record_expenses'])){
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $insert = $conn->query("INSERT INTO $expenses_tbl SET
                            subject = '$subject',
                            amount ='$amount',
                            description = '$description',
                            term = '$log_term',
                            session = '$log_session',
                            token = '$token',
                            date = '$date'
                            ");
        if($insert){
            $_SESSION['message'] = 'Details have been recorded!';
            $_SESSION['msg_type'] = 'success';
            $_SESSION['remedy'] = '';
        }else{
            $_SESSION['message'] = 'An error occurred during the process';
            $_SESSION['msg_type'] = 'error';
            $_SESSION['remedy'] = '';
        }
        header('location: ../adm_expenses?table');
}
?>
<?php
include "../../config/db.php";
include "../../includes/calls.php";

if(isset($_POST['cash_funding'])){
    $adm_no = $_POST['adm_no'];
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $description = mysqli_real_escape_string($conn, $_POST['description']).'<br>';
    $getWalletBal = $conn->query("SELECT * FROM $users_tbl WHERE userId='$adm_no'");
    $wal = $getWalletBal->fetch_object();
    /**New balance */
    $new_bal = ($amount+$wal->wallet);
    $track_id = 'MD'.rand(10000,99999);
    $description .= 'Method: Cash funding'; 
    $update = $conn->query("UPDATE $users_tbl SET wallet='$new_bal' WHERE userId='$adm_no'");
    if($update){
        $record = $conn->query("INSERT INTO $transaction_tbl SET
                                    confirmed_by = '$name',
                                    userId = '$adm_no',
                                    amount = '$amount',
                                    wallet_bal = '$new_bal',
                                    description = '$description',
                                    track_id = '$track_id',
                                    term = '$log_term',
                                    session = '$log_session',
                                    time = '$time',
                                    date = '$date',
                                    status = 1
                                ");

        $_SESSION['message'] = "Wallet successfully funded";
        $_SESSION['msg_type'] = "success";
        $_SESSION['remedy'] = "";
    }else{
        $_SESSION['message'] = "Wallet could not be funded";
        $_SESSION['msg_type'] = "error";
        $_SESSION['remedy'] = "Try again later";
    }
header('location: ../../adm_revenue?cash_funding='.$adm_no.'');
}
?>
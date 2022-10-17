<?php
include "../../config/db.php";
include "../../includes/calls.php";
include "monnify_auth.php";

if(isset($_POST['process_disbursement'])){
    $table = $payroll_tbl;
    $disbursement_id = $_POST['disbursement_id'];
    $batch_id = $_POST['disb_id'];
if($_POST['type'] == "Salary"){
    $Qualifiers = $conn->query("SELECT * FROM $payroll_tbl WHERE (disbursement_id='$disbursement_id' AND bankDet != '' AND status=0)");
}else if($_POST['type'] == "Loan"){
    $table = $loan_disbursement_tbl;
    $disbursement_id = date('YmdHi').uniqid();
    $Qualifiers = $conn->query("SELECT * FROM $loan_disbursement_tbl WHERE bankDet != '' AND status = 0");
}else{
    //Invalid request
}
$type = $_POST['type'];
while($row = $Qualifiers->fetch_object()){
    $l_id = $row->id;
    //To update the disbursement-id of each request
    $reference = $row->userId.'-'.uniqid();
    $record = $conn->query("UPDATE $table SET 
                    disbursement_id = '$reference',
                    batch_id = '$batch_id'
                    WHERE id = '$l_id'
                ");
}
if($record){
 $_SESSION['table'] = $table;
    $_SESSION['batch_id'] = $batch_id;
    header('location: process_disbursement.php');
}else{
    $_SESSION['message'] = 'Disbursement record could not be updated!';
    $_SESSION['msg_type'] = 'error';
    $_SESSION['remedy'] = '';

    if($_SESSION['page'] == 'loan'){
            header('location: ../../adm_loan_approval?loan_disbursement_list');
        }else if($_SESSION['page'] == 'salary'){
            header('location: ../../adm_disbursement?disbursement_list');
        }
}
   
}








    

    // if($resp->requestSuccessful != 1){
    //     $_SESSION['message'] = ''.$resp->responseMessage.'';
    //     $_SESSION['msg_type'] = 'error';
    //     $_SESSION['remedy'] = '';
    // }else{
    //     $update = $conn->query("UPDATE $table SET
    //                             paid_by = '$name', 
    //                             date = '$date', 
    //                             status = 7 
    //                             WHERE batch_id = '$disb_id' 
    //                             ");
    // }







// stdClass Object
// (
//     [requestSuccessful] => 
//     [responseMessage] => You do not have sufficient balance in your wallet to process this transaction. Please fund your wallet and try again.
//     [responseCode] => D04
// )


// stdClass Object
// (
//     [requestSuccessful] => 1
//     [responseMessage] => success
//     [responseCode] => 0
//     [responseBody] => stdClass Object
//         (
//             [totalAmount] => 700
//             [totalFee] => 20
//             [batchReference] => 20220927194063334393c1d40
//             [batchStatus] => AWAITING_PROCESSING
//             [totalTransactionsCount] => 2
//             [dateCreated] => 2022-09-27T18:40:29.402+0000
//         )

// )
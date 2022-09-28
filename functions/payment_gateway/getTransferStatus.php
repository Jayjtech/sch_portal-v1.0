<?php
include "../../config/db.php";
include "../../includes/calls.php";
include "monnify_auth.php";

$getList = $conn->query("SELECT * FROM $payroll_tbl WHERE status = 7 LIMIT 1");
if($getList->num_rows != 0){
    $li = $getList->fetch_object();
    $reference = $li->disbursement_id;
    $staffToken = $li->staffToken;
    $rec_name = $li->name;
    $description = $li->description;
    $amount = $li->amount;
    $payment_month = $li->payment_month;
    $table = $payroll_tbl;
}else{
    $getLoanList = $conn->query("SELECT * FROM $loan_disbursement_tbl WHERE status = 7");
    $li = $getLoanList->fetch_object();
    $reference = $li->disbursement_id;
    $loan_id = $li->loan_id;
    $amount = $li->amount;
    $description = $li->description;
    $rec_name = $li->name;
    $staffToken = $li->staffToken;
    $table = $loan_disbursement_tbl;

    /**Getting previous loan balance */
    $getLoanBal = $conn->query("SELECT * FROM $loan_tbl WHERE token = '$staffToken' ORDER BY id DESC LIMIT 1");
    $lb = $getLoanBal->fetch_object();
    $balance = $lb->balance;
    /**confirming current balance */
    $new_balance = ($balance+$amount);
}

$otherDet = $conn->query("SELECT * FROM $users_tbl WHERE token='$staffToken'");
$otd = $otherDet->fetch_object();
$rec_email = $otd->email;


$period = explode("-", $payment_month);
$given_month= $period[1];
include "../../includes/status_const.php";


$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => '' . $monnify_base_url . '/api/v2/disbursements/single/summary?reference='.$reference.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: ' . $AcessToken . '',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
$res = json_decode($response);
$status_msg = false;
if($res->responseBody->status == "SUCCESS"){
    $status = 1;
    if($table == $payroll_tbl){
        $status_msg = '<div class="alert alert-success">Salary of ['.number_format($amount).'] successfully disbursed to '.$rec_name.'!</div>';
    }else{
        $status_msg = '<div class="alert alert-success">Loan of ['.number_format($amount).'] successfully disbursed to '.$rec_name.'!</div>';
    }
}else if($res->responseBody->status == "PENDING"){
    $status = 0;
}else if($res->responseBody->status == "FAILED"){
    $status = 2;
    if($table == $payroll_tbl){
        $status_msg = '<div class="alert alert-danger">Salary of ['.number_format($amount).'] failed to disbursed to '.$rec_name.'!</div>';
    }else{
        $status_msg = '<div class="alert alert-danger">Loan of ['.number_format($amount).'] failed to disbursed to '.$rec_name.'!</div>';
    }
}else if($res->responseBody->status == "OTP_EMAIL_DISPATCH_FAILED"){
    $status = 9;
}else if($res->responseBody->status == "PENDING_AUTHORIZATION"){
    $status = 8;
}else{
    $status = 3;
}

echo $status_msg;

$update = $conn->query("UPDATE $table SET 
                    status = '$status'
                    WHERE disbursement_id = '$reference'
                    ");

if($res->responseBody->status == "SUCCESS"){
if($table == $loan_disbursement_tbl){
    $debitLoanTbl = $conn->query("UPDATE $loan_tbl SET
                    debit = '$amount',         
                    balance = '$new_balance',         
                    status = 1  
                    WHERE id= '$loan_id'
                    AND token='$staffToken'       
                  ");

  $message = '
            <!DOCTYPE html>
                <html>
                    <head>
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <link rel="stylesheet" href="style.css">
                <style type="text/css" rel="stylesheet" media="all">
                    /* Media Queries */
                    @media  only screen and (max-width: 500px) {
                        .button {
                            width: 100% !important;
                        }
                    }
                </style>
            </head>
            <body style="margin: 0; padding: 0; width: 100%; background-color: rgb(2, 2, 43); color:#fff">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="width: 100%; margin: 0; padding: 0; background-color: rgb(2, 2, 43); color:#fff" align="center">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <!-- Logo -->
                                <tr>
                                    <td style="padding: 25px 0; text-align: center;">
                                        <a style="font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
                 Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif; color:#000;" href="' . BASE_URL . '" target="_blank">
                                            <img src="' . $sch_short_icon . '" width="100">
                                        </a>
                                    </td>
                                </tr>
                    <tr>
                        <td style="width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;" width="100%">
                            <table style="width: auto; max-width: 570px; margin: 0 auto; padding: 0;" align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="font-family: Arial, &#039;Helvetica Neue&#039;, Helvetica, sans-serif; padding: 35px;">
                                        <!-- Greeting -->
                                        
                                        <h1 style="margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold;">
                                         Loan request.
                                        </h1>
                                                
                                        <!-- Salutation -->
                                        
                                        <h1 style="margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold;">
                                         Details
                                        </h1>
                                        
                                        <p style="margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
                                             Hello '.$rec_name.', the loan you 
                                             requested for has been transferred to your bank account.
                                        </p>

                                        <p style="margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
                                            Amount: '.$currency.''.number_format($amount).'
                                            Interest rate: '.$admin_det->loan_interest.'%
                                            Description: '.$description.'<br>
                                            Disbursement Date: '.$date.'
                                        </p>

                                        <p style="margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
                                            Kindly note that refund will automatically be deducted from your monthly salary.
                                        </p>
                                        

                                        <p style="margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
                                           <strong> Regards <br/> ' . $admin_det->sch_name . ' </strong>
                                        </p>
                                      </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
            
                      <!-- Footer -->
                        <tr>
                            <td>
                                <table style="width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;" align="center" width="570" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="font-family: Arial, &#039;Helvetica Neue&#039;, Helvetica, sans-serif; color: #AEAEAE; padding: 35px; text-align: center;">
                                            <p style="margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;">
                                                &copy; ' . date('Y') . ' <a href="' . BASE_URL . '">' . $admin_det->sch_name . '</a>
                                                All right reserved
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            </table>
            </body>
            </html> 
            ';  
            $msg_subject = "Loan Disbursement";                
}else if($table == $payroll_tbl){
    $message = '
            <!DOCTYPE html>
                <html>
                    <head>
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <link rel="stylesheet" href="style.css">
                <style type="text/css" rel="stylesheet" media="all">
                    /* Media Queries */
                    @media  only screen and (max-width: 500px) {
                        .button {
                            width: 100% !important;
                        }
                    }
                </style>
            </head>
            <body style="margin: 0; padding: 0; width: 100%; background-color: rgb(2, 2, 43); color:#fff">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="width: 100%; margin: 0; padding: 0; background-color: rgb(2, 2, 43); color:#fff" align="center">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <!-- Logo -->
                                <tr>
                                    <td style="padding: 25px 0; text-align: center;">
                                        <a style="font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
                 Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif; color:#000;" href="' . BASE_URL . '" target="_blank">
                                            <img src="' . $sch_short_icon . '" width="100">
                                        </a>
                                    </td>
                                </tr>
                    <tr>
                        <td style="width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;" width="100%">
                            <table style="width: auto; max-width: 570px; margin: 0 auto; padding: 0;" align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="font-family: Arial, &#039;Helvetica Neue&#039;, Helvetica, sans-serif; padding: 35px;">
                                        <!-- Greeting -->
                                        
                                        <h1 style="margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold;">
                                         Salary payment.
                                        </h1>
                                                
                                        <!-- Salutation -->
                                        
                                        <h1 style="margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold;">
                                         Details
                                        </h1>
                                        
                                        <p style="margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
                                             Hello '.$rec_name.', Your salary for the month of '.$month_syntax.' '.$period[0].' has been paid 
                                             into your bank account.
                                        </p>
                                        <p style="margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
                                            Amount: '.$currency.''.number_format($amount).'<br>
                                            Description: '.$description.'<br>
                                            Disbursement Date: '.$date.'
                                        </p>
                                        

                                        <p style="margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;">
                                           <strong> Regards <br/> ' . $admin_det->sch_name . ' </strong>
                                        </p>
                                      </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
            
                      <!-- Footer -->
                        <tr>
                            <td>
                                <table style="width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;" align="center" width="570" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="font-family: Arial, &#039;Helvetica Neue&#039;, Helvetica, sans-serif; color: #AEAEAE; padding: 35px; text-align: center;">
                                            <p style="margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;">
                                                &copy; ' . date('Y') . ' <a href="' . BASE_URL . '">' . $admin_det->sch_name . '</a>
                                                All right reserved
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            </table>
            </body>
            </html> 
            '; 
            $msg_subject = "Salary Disbursement";
}



  /**Send mail to the receiver */
        ini_set('display_error', 1);
        $to = $rec_email;
        $from = $admin_det->sch_support_email;
        $subject = $msg_subject;
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From:" . $from;
        mail($to, $subject, $message, $headers);

}



// stdClass Object
// (
//     [requestSuccessful] => 1
//     [responseMessage] => success
//     [responseCode] => 0
//     [responseBody] => stdClass Object
//         (
//             [amount] => 100
//             [reference] => 3373973965-633362d5b68d8
//             [narration] => Loan request of 100. Request date: September 27, 2022
//             [currency] => NGN
//             [fee] => 10
//             [twoFaEnabled] => 
//             [status] => SUCCESS
//             [transactionDescription] => Transaction successful
//             [transactionReference] => MFDS79820220927095625181755S33NY8
//             [createdOn] => 2022-09-27T20:56:26.000+0000
//             [sessionId] => 090405220927215628072908868015
//             [sourceAccountNumber] => 6013432866
//             [destinationAccountNumber] => 7069056472
//             [destinationAccountName] => OLUWATOSIN EMMANUEL JEGEDE
//             [destinationBankCode] => 100033
//             [destinationBankName] => PALMPAY
//         )

// )
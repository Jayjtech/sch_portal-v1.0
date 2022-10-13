<?php
include "../../config/db.php";
// echo $comp_name;
$MONNIFY_SIGNATURE = $_SERVER['HTTP_MONNIFY_SIGNATURE']; // Accessing monnify signature from the header.

$dateTime = new DateTime('now', new DateTimeZone('Africa/Lagos'));

$DEFAULT_MERCHANT_CLIENT_SECRET = $monnify_secret_key;

$json = file_get_contents('php://input');
$data = json_decode($json);

$amount = $data->eventData->amountPaid;
$totalPayable = $data->eventData->totalPayable;
$paidOn = $data->eventData->paidOn;
$track_id = $data->eventData->paymentReference;
$transactionReference = $data->eventData->transactionReference;
$userId = $data->eventData->product->reference;
$type = $data->eventData->product->type;
$description = $data->eventData->paymentDescription;
$code = $data->eventData->offlineProductInformation->code;
$type2 = $data->eventData->offlineProductInformation->type;
$paymentMethod = $data->eventData->paymentMethod;
$currency = $data->eventData->currency;
$settlementAmount = $data->eventData->settlementAmount;
$paymentStatus = $data->eventData->paymentStatus;
$email = $data->eventData->customer->email;
$fullname = $data->eventData->customer->name;
$eventType = $data->eventType;

$description = 'Fund wallet with &#8358;' . number_format($amount, 2) . 'p-method[monnify]';
class CustomTransactionHashUtil
{

    public static function computeSHA512TransactionHash($stringifiedData, $clientSecret)
    {
        $computedHash = hash_hmac('sha512', $stringifiedData, $clientSecret);
        return $computedHash;
    }
}

$data_decod = $json;
$computedHash = CustomTransactionHashUtil::computeSHA512TransactionHash($data_decod, $DEFAULT_MERCHANT_CLIENT_SECRET);

if ($MONNIFY_SIGNATURE == $computedHash) {

    $checkTrans = $conn->query("SELECT * FROM $transaction_tbl WHERE amount='$amount' AND track_id='$track_id'");
    if ($checkTrans->num_rows == 0) {
        //CHECK PREVIOUS BALANCE
        $checkBalance = $conn->query("SELECT * FROM $users_tbl WHERE userId='$userId'");
        $row = $checkBalance->fetch_object();

        $new_wallet_balance = ($amount+$row->wallet);
       //RECORD TO TRANSACTIONS
        $record = $conn->query("INSERT INTO $transaction_tbl (userId, amount, track_id, description, wallet_bal, date, time, status) 
            VALUES('$userId', '$amount', '$track_id', '$description', '$new_wallet_balance', '$date', '$time', 1)");
        
        if ($record) {
            $update = $conn->query("UPDATE $users_tbl SET wallet='$new_wallet_balance' WHERE userId='$userId'");
        }
    }
}
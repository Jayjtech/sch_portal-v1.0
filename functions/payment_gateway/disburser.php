<?php
include "../../config/db.php";
include "monnify_auth.php";

if(isset($_POST['process_disbursement'])){
    $disbursement_id = $_POST['disbursement_id'];
    $disb_id = $_POST['disb_id'];
if($_POST['type'] == "Salary"){
    $Qualifiers = $conn->query("SELECT * FROM $payroll_tbl WHERE (disbursement_id='$disbursement_id' AND bankDet != '')");
}else if($_POST['type'] == "Loan"){
    $disbursement_id = date('YmdHi').uniqid();
    $Qualifiers = $conn->query("SELECT * FROM $loan_disbursement_tbl WHERE bankDet != ''");
}else{
    //Invalid request
}
$type = $_POST['type'];
while($row = $Qualifiers->fetch_object()){
    $data[] = $row;
}

$narration = $data[0]->description;

$request = '{"title":"'.$type.'","batchReference":"'.$disb_id.'","narration":"","sourceAccountNumber":"'.$admin_det->disbursementSource.'","onValidationFailure":"CONTINUE","notificationInterval":25,
    "transactionList":[';
        for($x = 0; $x < count($data); $x++){
            $bankDet = json_decode($data[$x]->bankDet);
                $acc_no = $bankDet->acc_no;
                $bank_code = $bankDet->bank_code;
            $amount = $data[$x]->amount;
            $reference = $data[$x]->userId.'-'.uniqid();
            $narration = $data[$x]->description;
    $request .='{"amount":'.$amount.',"reference":"'.$reference.'","narration":"'.$narration.'","destinationBankCode":"'.$bank_code.'","destinationAccountNumber":"'.$acc_no.'","currency":"'.$currency_type.'"}';
            if($x == count($data)-1){
                $request .='';
            }else{
                $request .=',';
            }                
        }
    $request .='
        ]
    }';
    
// $request = json_decode($request);
// echo '<pre>';
// print_r($request);
// echo '</pre>';



$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => '' . $monnify_base_url . '/api/v2/disbursements/batch',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $request,
  CURLOPT_HTTPHEADER => array(
    'Authorization: ' . $AcessToken . '',
    'Content-Type: application/json'
  ),
));

$response1 = curl_exec($curl);

curl_close($curl);
$resp = json_decode($response1);
echo '<pre>';
print_r($resp);
echo '</pre>';



// stdClass Object
// (
//     [requestSuccessful] => 
//     [responseMessage] => You do not have sufficient balance in your wallet to process this transaction. Please fund your wallet and try again.
//     [responseCode] => D04
// )


    if($resp->requestSuccessful != "success"){
        $_SESSION['message'] = ''.$resp->responseMessage.'';
        $_SESSION['msg_type'] = 'error';
        $_SESSION['remedy'] = '';
    }else{
        
    }
}
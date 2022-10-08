<?php
include "../../config/db.php";
include "../../includes/calls.php";
include "monnify_auth.php";


 $table = $_SESSION['table'];
 $batch_id = $_SESSION['batch_id'];

$getList = $conn->query("SELECT * FROM $table WHERE batch_id = '$batch_id'");
while($row = $getList->fetch_object()){
    $data[] = $row;
}

 $narration = $data[0]->description;
$request = '{"title":"'.$type.'","batchReference":"'.$batch_id.'","narration":"'.$narration.'","sourceAccountNumber":"'.$admin_det->disbursementSource.'","onValidationFailure":"CONTINUE","notificationInterval":25,
    "transactionList":[';
        for($x = 0; $x < count($data); $x++){
            $bankDet = json_decode($data[$x]->bankDet);
                $acc_no = $bankDet->acc_no;
                $bank_code = $bankDet->bank_code;
            $amount = $data[$x]->amount;
            $reference = $data[$x]->disbursement_id;
            $narration = $data[$x]->description;
            $l_id = $data[$x]->id;

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

// echo '<pre>';
// print_r($resp);
// echo '</pre>';

if($resp->requestSuccessful != 1){
        $_SESSION['message'] = ''.$resp->responseMessage.'';
        $_SESSION['msg_type'] = 'error';
        $_SESSION['remedy'] = '';
        if($_SESSION['page'] == 'loan'){
            header('location: ../../adm_loan_approval');
        }else if($_SESSION['page'] == 'salary'){
            header('location: ../../adm_disbursement');
        }
    }else{
        $_SESSION['message'] = 'Disbursement is being processed';
        $_SESSION['msg_type'] = 'success';
        $_SESSION['remedy'] = '';
        $update = $conn->query("UPDATE $table SET
                                paid_by = '$name', 
                                date = '$date', 
                                status = 7 
                                WHERE batch_id = '$batch_id' 
                                ");
        if($_SESSION['page'] == 'loan'){
            header('location: ../../adm_loan_approval?key=loan_disbursement_list');
        }else if($_SESSION['page'] == 'salary'){
            header('location: ../../adm_disbursement?key=disbursement_list');
        }
    }
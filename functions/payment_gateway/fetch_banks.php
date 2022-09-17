<?php
include "../../config/db.php";
include "monnify_auth.php";
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => '' . $monnify_base_url . '/api/v1/banks',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_POSTFIELDS => '',
  CURLOPT_HTTPHEADER => array(
    'Authorization: ' . $AcessToken . '',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$res = json_decode($response);
$insert = false;
for($x = 0; $x < count($res->responseBody); $x++){
    $bank = $res->responseBody[$x]->name;
    $bankCode = $res->responseBody[$x]->code;
    $ussdTemplate = $res->responseBody[$x]->ussdTemplate;
    $baseUssdCode = $res->responseBody[$x]->baseUssdCode;
    $transferUssdTemplate = $res->responseBody[$x]->transferUssdTemplate;

    $check = $conn->query("SELECT * FROM $banks_tbl WHERE bank_code='$bankCode'");
    $count = $check->num_rows;

    if($count == 0){
        $insert = $conn->query("INSERT INTO $banks_tbl SET 
                bank = '$bank',
                bank_code = '$bankCode',
                ussdTemplate = '$ussdTemplate',
                baseUssdCode = '$baseUssdCode',
                transferUssdTemplate = '$transferUssdTemplate'
        ");
    }
    header('location: ../../account_details');
}
?>
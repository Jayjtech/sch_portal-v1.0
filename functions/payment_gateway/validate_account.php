<?php
if(isset($_POST['account_no'])){
    extract($_POST);
include "../../config/db.php";
include "../../includes/calls.php";
include "monnify_auth.php";

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => '' . $monnify_base_url . '/api/v1/disbursements/account/validate?accountNumber='.$account_no.'&bankCode='.$bank_code,
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
echo $response;

}
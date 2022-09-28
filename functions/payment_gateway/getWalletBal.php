<?php
include "../../config/db.php";
include "../../includes/calls.php";
include "monnify_auth.php";

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => '' . $monnify_base_url . '/api/v2/disbursements/wallet-balance?accountNumber='.$admin_det->disbursementSource.'',
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

$response1 = curl_exec($curl);
curl_close($curl);
$res1 = json_decode($response1);

echo '<div class="alert alert-info">Monnify wallet balance: '.$currency.''.number_format($res1->responseBody->availableBalance).'</div>';
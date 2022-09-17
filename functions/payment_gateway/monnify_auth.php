<?php
//GENERATE ACCESS TOKEN
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => ''.$monnify_base_url.'/api/v1/auth/login/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic ' . $monnify_token . '',
            'Accept: application/json',
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($response);

    $AcessToken = 'Bearer ' . $res->responseBody->accessToken;
?>
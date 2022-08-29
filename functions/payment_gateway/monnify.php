<?php
include "../../config/db.php";
if ($_SESSION['userId']) {
     if($_SESSION['userCategory'] == "d29yaw=="){
                $_SESSION['message'] = 'Thanks for registering with us ' . $sch_name . '!';
                $_SESSION['msg_type'] = "success";
                $_SESSION['remedy'] = '';
                $_SESSION['btn'] = "Ok";
                header("location:../../dashboard");
            }else{
    $userId = $_SESSION['userId'];

    $callUserDetails = $conn->query("SELECT * FROM $users_tbl WHERE userId = '$userId'");
    while ($row = $callUserDetails->fetch_assoc()) {
        //USER DETAILS
        $customerEmail = $row['email'];
        $customerName = $row['name'];
    }

    //GENERATE ACCESS TOKEN
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.monnify.com/api/v1/auth/login/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic ' . $token . '',
            'Accept: application/json',
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($response);


    $accountName = $customerName;
    $AcessToken = 'Bearer ' . $res->responseBody->accessToken;
    if ($res->requestSuccessful == 1) {
        //RESERVE ACCOUNT
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.monnify.com/api/v2/bank-transfer/reserved-accounts',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "accountReference": "' . $userId . '",
            "accountName": "' . $accountName . '",
            "currencyCode": "NGN",
            "contractCode": "' . $monnify_live_contract . '",
            "customerEmail": "' . $customerEmail . '",
            "customerName": "' . $customerName . '",
            "getAllAvailableBanks": false,
            "preferredBanks": ["035", "232", "50515", "070"]
        }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: ' . $AcessToken . '',
                'Content-Type: application/json'
            ),
        ));

        $response1 = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response1);

        //UPDATE USER TABLE
        if ($data->requestSuccessful != "success") {
            echo "YES";
            $_SESSION['message'] = '' . $data->responseMessage . '';
            $_SESSION['msg_type'] = "warning";
            $_SESSION['remedy'] = '';
            $_SESSION['btn'] = "Ok";
            header("location:../../fund-wallet");
        } else {
            $update = $conn->query("UPDATE $users_tbl SET 
                                monnify_account='$response1' 
                                WHERE userId='$userId'
                                ");
            if ($update) {
                if($_SESSION['page'] == "Register"){
                    $_SESSION['message'] = 'Thanks for registering with us ' . $sch_name . '!';
                }else{
                    $_SESSION['message'] = 'You have successfully reserved four accounts with ' . $sch_name . '!';
                }
                
                $_SESSION['msg_type'] = "success";
                $_SESSION['remedy'] = '';
                $_SESSION['btn'] = "Ok";
                header("location:../../dashboard");
            } else {
                $_SESSION['message'] = "Oops! An error occurred during the process!";
                $_SESSION['msg_type'] = "error";
                $_SESSION['remedy'] = "";
                $_SESSION['btn'] = "Ok";
                header("location:../../dashboard");
            }
        }
    } else {
        if($_SESSION['page'] == "Register"){
                    $_SESSION['message'] = 'Thanks for registering with us ' . $sch_name . '!';
                }else{
                   $_SESSION['message'] = "Service currently unavailable!";
                }
        
        $_SESSION['msg_type'] = "error";
        $_SESSION['remedy'] = 'Please try again later';
        $_SESSION['btn'] = "Ok";
        header("location:../../dashboard");
    }
    }
} else {
    $_SESSION['message'] = "Access denied!";
    $_SESSION['msg_type'] = "warning";
    $_SESSION['remedy'] = '';
    $_SESSION['btn'] = "Ok";
    header("location:../../login");
}
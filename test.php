<?php
$response = '{"status":"Successful", 
              "statusCode":"200", 
              "network":"9mobile", 
              "denomination":"100", 
              "quantity":3, 
              "vouchers": { 
              "1": "158395947836214", 
              "2": "937183739484493", 
              "3": "378594957023291"
              }, 
              "requestRef": "75Qd543c1607766805|qa35h78hhjgRFD5666728", 
              "wallet": 15379.95 
                }';
// $response = '{"status":"Successful","statusCode":200,"network":"AIRTEL","denomination":"100","quantity":"1","vouchers":"1869634728994791","requestRef":"57M1c4Pg1661629627|RC87092221661629615","wallet":4500}';


$res = json_decode($response);
$quantity = $res->quantity;
for($x = 1; $x <= $quantity; $x++){
    if($quantity == 1){
        echo $voucher = $res->vouchers;
    }else{
        echo $voucher = $res->vouchers->$x;
    }
        
        // $insert = $con->query("INSERT INTO recharge_card SET
        //     voucher = '$voucher',
        //     user_id = '$user_code',
        //     denomination = '$denomination',
        //     network = '$network',
        //     response = '$response',
        //     status = 'Unused'
        // ");
    }


                // Success Response 
                // $res = json_decode('{ 
                //     "status":"Successful", 
                //     "statusCode":"200", 
                //     "network":"9mobile", 
                //     "denomination":"100", 
                //     "quantity":3, 
                //     "vouchers": { 
                //     "1": "158395947836214", 
                //     "2": "937183739484493", 
                //     "3": "378594957023291"
                //     }, 
                //     "requestRef": "75Qd543c1607766805|qa35h78hhjgRFD5666728", 
                //     "wallet": 15379.95 
                // }');
?>
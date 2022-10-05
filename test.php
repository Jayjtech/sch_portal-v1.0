<?php
include "config/db.php";
?>
<!-- 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>


    <script>
    function show() {
        let txt = document.testForm.x.value;
        let msg = document.querySelector(".msg");
        msg.innerHTML = txt;
    }
    </script>

    <form name="testForm">
        <input type="text" id="x" name="x" onchange="show()">
        <input type="text" id="x" name="x" onchange="show()">
    </form>
    <div class="msg"></div>
</body>

</html> -->

<?php 
// $class = ["JSS-1", "JSS-2", "JSS-3", "SSS-1", "SSS-2", "SSS-3"];
// if (in_array("JSS-1", $class)){
// echo true;
// }

// $callTimeTable = $conn->query("SELECT * FROM $time_tbl");
// while($tim = $callTimeTable->fetch_object()){
// $class_array = explode(",", $tim->class_array);
// if(in_array("JSS-1", $class_array)){
//     echo $tim->period_1;
// }
// echo '<pre>';
// print_r($class_array);
// echo '</pre>';
// }

                         
    /**To update the evaluation table */
    // $checkRows = $conn->query("SELECT * FROM $score_tbl WHERE adm_no='5490703669' AND term='1' AND session='2022/2023'");
    // $checkAllScore = $conn->query("SELECT sum(total) as overall_score  FROM $score_tbl WHERE adm_no='5490703669' AND term='1' AND session='2022/2023'");
    // $cal = $checkAllScore->fetch_object();
    //  $overall_score = $cal->overall_score;
    //  $out_of = ($checkRows->num_rows*100);
    //  $percent_score = (($overall_score/$out_of)*100);
    // echo stripcslashes($percent_score);

// $con = mysqli_connect("localhost", "u107570811_phil", "0kOIj1TtBLTD", "u107570811_gent");
// session_start();
// $date = date('Y-m-d H:i:s');

// if(isset($_POST['generate_recharge'])){
//     $network = $_POST['network'];
//     $denomination = mysqli_real_escape_string($con, $_POST['denomination']);
//     $user_code = $_POST['user_id'];
//     $quantity = mysqli_real_escape_string($con, $_POST['quantity']);
//     $trans_id=  $_POST['trans_id'];
    
    
//     switch($network){
//         case "MTN":
//             $network_name = "mtn";
//             $networkCode = "803";
//             break;
//         case "MTN-10D":
//             $network_name = "mtn-10d";
//             $networkCode = "810";
//             break;
//         case "GLO":
//             $network_name = "glo";
//             $networkCode = "805";
//             break;
//         case "AIRTEL":
//             $network_name = "airtel";
//             $networkCode = "802";
//             break;
//         case "9MOBILE":
//             $network_name = "9mobile";
//             $networkCode = "809";
//             break;
//     }
    
    
    
//     $create_price = $con->query("SELECT * FROM services WHERE network_name='$network' AND product_id='5'");
//     while($row = $create_price->fetch_object()){
//         $agent_discount = $row->agent_discount;
//         $superagent_discount = $row->superagent_discount;
//     }
    
//     $amount = ($denomination*$quantity);
//     $description = ucfirst( $network) . ' Recharge card, Denomination of N'.$denomination.', Quantity: '.$quantity.' | <br>';
//     $checkWallet = $con->query("SELECT * FROM users WHERE user_code='$user_code'");
//         while ($row = $checkWallet->fetch_assoc()) {
//             $wallet_bal = $row['wallet'];
//             $myId = $row['id'];
//             $membership_type = $row['membership_type'];
//         }
        
//         switch($membership_type){
//         case "user": 
//             $discount = 1;
//             break;
//         case "agent": 
//             $discount = $agent_discount;
//             break;
//         case "superagent": 
//             $discount = $superagent_discount;
//             break;
//         }
        
        //declaring amount
        // $amount = $discount*$amount;
   
        
        // if ($wallet_bal < $amount) {
        //     $_SESSION['message'] = '<div class="alert alert-danger">Wallet balance is too low!</div>';
        //     $_SESSION['msg_type'] = 'error';
        //     $_SESSION['remedy'] = 'Wallet balance: NGN' . number_format($wallet_bal) . '';
        //     $_SESSION['btn'] = 'Okay';

        //     header('location:dashboard/rechargeCard?msg='.$_SESSION['message'].'');
        // } else {
        //     $new_wallet_bal = ($wallet_bal - $amount);
        //      $check = $con->query("SELECT * FROM transactions WHERE trans_id = '$trans_id'");
        //     if ($check->num_rows == 0) {
        //         $save = $con->query("INSERT INTO transactions (user_id, amount, trans_id, description, product_id, date_initiated, platform) 
        //         VALUES('$myId', '$amount', '$trans_id', '$description', 5, '$date', 'web')");

        //         /**RUN API */
        //     $update_wallet = $con->query("UPDATE users SET wallet= '$new_wallet_bal' WHERE user_code ='$user_code'");
                    
        //      if ($update_wallet) {
        //         $token = base64_encode("21b66fdefea1b1cc03a51997844908|911757");
        //          $request = [
        //                 "requestType" => "VCHR",
        //                 "networkCode" => "$networkCode", 
        //                 "pinDenomination" => $denomination, 
        //                 "pinQuantity" => $quantity,
        //                 "requestReference" => "$trans_id", 
        //                 "encodedKey" => "$token"
        //             ];
                //  $request = [
                //         "requestType" => "EPIN",
                //         "networkCode" => "$networkCode", 
                //         "pinDenomination" => $denomination, 
                //         "pinQuantity" => $quantity, 
                //         "pinFormat" => "STANDARD", 
                //         "requestReference" => "$trans_id", 
                //         "encodedKey" => "$token"
                //     ];
            
                //     $curl = curl_init();
                //     curl_setopt_array($curl, array(
                //     CURLOPT_URL => 'https://thebizklub.com/api',
                //     CURLOPT_RETURNTRANSFER => true,
                //     CURLOPT_ENCODING => '',
                //     CURLOPT_MAXREDIRS => 10,
                //     CURLOPT_TIMEOUT => 0,
                //     CURLOPT_FOLLOWLOCATION => true,
                //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                //     CURLOPT_CUSTOMREQUEST => 'POST',
                //     CURLOPT_POSTFIELDS => json_encode($request),
                //     CURLOPT_HTTPHEADER => array(
                //         'Content-Type: application/json'
                //     ),
                // ));
            
                // $response = curl_exec($curl);
                // curl_close($curl);
                // $res = json_decode($response);
    
 
            // echo $denomination;
            // echo '<pre>';
            // print_r($res);
            // echo '</pre>';
            // exit();
            
//             if($res){
//                 $status = $res->status;
//                 $message = $res->message;
//                 $statusCode = $res->statusCode;
//                 $network = $res->network;
//                 $denomination = $res->denomination;
//                 $quantity = $res->quantity;
//                 $requestRef = $res->requestRef;
               
//                 if($statusCode == 200){
//                     $voucher = "";
//                     if($quantity == 1){
//                             $voucher .= ' Pin: '.$res->vouchers.'<br>';
//                             $description .= ' Pin: '.$voucher.'<br>';
//                         }else{
//                             for($x = 1; $x <= $quantity; $x++){
//                                 $voucher .= ' Pin('.$x.'): '.$res->vouchers->$x.'<br>';
//                                 $description .= ' Pin('.$x.'): '.$voucher.'<br>';
//                             }
//                         }
                    
//                          $insert = $con->query("INSERT INTO recharge_card SET
//                                     voucher = '$voucher',
//                                     user_id = '$user_code',
//                                     denomination = '$denomination',
//                                     network = '$network',
//                                     response = '$response',
//                                     status = 'Unused'
//                                 ");
//                         $updateTrans = $con->query("UPDATE transactions SET balance='$new_wallet_bal', status='success', description='$description' WHERE trans_id='$trans_id'");
//                         $_SESSION['message'] = '<div class="alert alert-success">Your transaction was successful, Check the recharge card table!</div>';
//                         header('location:dashboard/rechargeCard?msg='.$_SESSION['message'].'');
//                 }else{
//                     $update_wallet = $con->query("UPDATE users SET wallet= '$wallet_bal' WHERE user_code ='$user_code'");
//                     $updateTrans = $con->query("UPDATE transactions SET balance = '$wallet_bal', status='failed' WHERE trans_id='$trans_id'");
//                     $_SESSION['message'] = '<div class="alert alert-danger">Unsuccessful transaction, '.$message.'!</div>';
//                     // $_SESSION['status'] = base64_encode('<div class="alert alert-danger">'.$status.'</div>');
//                     header('location:dashboard/rechargeCard?msg='.$_SESSION['message'].'');
//                     }
//                  }
//              }
//         }else{
//             $_SESSION['message'] = '<div class="alert alert-danger">Reset page to continue!</div>';
//             header('location:dashboard/rechargeCard?msg='.$_SESSION['message'].'');
//         }
//     }
// }

// if(isset($_GET['used'])){
//     $id = $_GET['used'];
//     $update = $con->query("UPDATE recharge_card SET status='Used' WHERE id='$id'");
//     if($update){
//         header('location:dashboard/rechargeCard');
//     }
// }




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
                
//                 { 
// "status": "Successful", 
// "statusCode": "200", 
// "network": "MTN", 
// "denomination": "100", 
// "pinQuantity": 2, 
// "pins": { 
// "1":"000000577193478161423259183791326000000100BC", 
// "2":"000000579060420726404796971280482000000100BC" 
// }, 
// "requestRef": "d1uP2VaLIJ1607765203|gioljjh7qwYYU55166728", 
// "wallet": 16279.95 
// }
?>


<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <input type="number" id="num" onkeyup="check();">
    <div class="response"></div>
    <script type="text/javascript">
    function check() {
        let userId = document.querySelector("#num").value;
        let res = document.getElementById("num")
        res.value = userId.toUpperCase();
        let response = document.querySelector(".response")
        response.textContent = userId * 5;
    }
    </script>

-->

<?php
// $getCompulsoryFees = $conn->query("SELECT * FROM $bill_setting_tbl WHERE status=1");
//     while($gcsf = $getCompulsoryFees->fetch_assoc()){
//         $list[] = $gcsf;
//     }

//     for($x = 0; $x<count($list); $x++){
//         echo $li += $$list[$x]['bill_name']; 
//     }

$n = 1;
$m = 'n';
echo $$m;
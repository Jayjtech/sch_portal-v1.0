<?php
include "../config/db.php";
$selectBill = $conn->query("SELECT * FROM $bill_tbl WHERE compulsory_total = 0 LIMIT 1");
while($row = $selectBill->fetch_assoc()){
    $adm_no = $row['userId'];
    $term = $row['term'];
    $session = $row['session'];

    $data[] = $row;

    for($i = 0; $i < count($data); $i++){
        $_SESSION['comp_bill'] = null;
        $initial = $data[$i];
        
       $getCompulsoryFees = $conn->query("SELECT * FROM $bill_setting_tbl WHERE status=1");
        while($gcsf = $getCompulsoryFees->fetch_assoc()){
            $list[] = $gcsf;
        }

        for($x = 0; $x<count($list); $x++){
            $li = $initial[$list[$x]['bill_name']]; 
            $_SESSION['comp_bill'] = $_SESSION['comp_bill']+$li;
        }
        $compulTotal = $_SESSION['comp_bill'];
        $insert = $conn->query("UPDATE $bill_tbl SET
                    compulsory_total = '$compulTotal',
                    paid = '$compulTotal',
                    outstanding = '$compulTotal'
                    WHERE userId = '$adm_no'
                    AND term = '$term'
                    AND session = '$session'
                    ");
    }
}

unset($_SESSION['comp_bill']);
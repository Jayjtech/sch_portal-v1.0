<?php
include "../config/db.php";
include "../includes/calls.php";
if($det->wallet > "10000"){
    $col = "success";
}else{
    $col = "danger";
}
echo '<h3 class="font-weight-bold text-'.$col.'">Wallet balance: '.$currency.''.number_format($det->wallet,2).'</h3>';

?>
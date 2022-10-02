<?php
include "../config/db.php";
if(isset($_POST['resultType'])){
    $resultType = $_POST['resultType'];
    switch($resultType){
        case 1:
            $syntax = "Default template";
            break;
        case 2:
            $syntax = "Type 2 template";
            break;
    }
    $update = $conn->query("UPDATE $settings_tbl SET result_template='$resultType'");
    if($update){
        echo '<div class="alert alert-info">Result template has been updated to <em><strong>'.$syntax.'</strong></em></div>';
    }
}
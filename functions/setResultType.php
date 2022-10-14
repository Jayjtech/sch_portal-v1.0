<?php
include "../config/db.php";
if(isset($_POST['resultType'])){
    $resultType = $_POST['resultType'];
    switch($resultType){
        case 1:
            $syntax = "Default template";
            $imgUrl = $default_result_template;
            break;
        case 2:
            $syntax = "Type 2 template";
            $imgUrl = $result_template_a;
            break;
    }
    $update = $conn->query("UPDATE $settings_tbl SET result_template='$resultType'");
    if($update){
        echo '<div class="alert alert-info col-sm-8">Result template has been updated to <em><strong>'.$syntax.'</strong></em></div>';
        echo '<div class="mt-3">
        <img src="'.$imgUrl.'" class="img-thumbnail">
            </div>
            ';
    }
}
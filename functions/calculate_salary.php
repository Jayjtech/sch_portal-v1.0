<?php
include "../config/db.php";
include "../includes/calls.php";
if(isset($_POST['payRollPeriod'])){
 $disbursement_id = $_POST['payRollPeriod'];
 $cal = $conn->query("SELECT sum(salary) as total_salary FROM $payroll_tbl WHERE disbursement_id='$disbursement_id' AND bankDet !='' ");
 $getTotalSal = $cal->fetch_object();
 if($cal->num_rows != 0){
    echo number_format($getTotalSal->total_salary,2);
 }else{
    echo number_format(0,2);
 }
 
}
?>
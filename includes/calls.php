<?php 
$callSession = $conn->query("SELECT * FROM $session_tbl ORDER BY session ASC");
$callClass = $conn->query("SELECT * FROM $class_tbl ORDER BY class ASC");
?>
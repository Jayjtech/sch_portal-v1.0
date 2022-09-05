<?php
    include "../config/db.php";
    include "../includes/calls.php";
    if(isset($_GET['department'])){
        $department = mysqli_real_escape_string($conn, $_GET['department']);
        $pre_class = mysqli_real_escape_string($conn, $_GET['pre_class']);
        $phone = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['phone']));
        $religion = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['religion']));
        $state_of_origin = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['state_of_origin']));
        $nationality = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['nationality']));
        $local_government = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['local_government']));
        $dob = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['dob']));
        $home_address = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['home_address']));
        $father_name = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['father_name']));
        $mother_name = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['mother_name']));

        $update = $conn->query("UPDATE $users_tbl SET 
                            department = '$department',
                            pre_class = '$pre_class',
                            phone = '$phone',
                            religion = '$religion',
                            state_of_origin = '$state_of_origin',
                            nationality = '$nationality',
                            local_government = '$local_government',
                            dob = '$dob',
                            home_address = '$home_address',
                            father_name = '$father_name',
                            num_update = 1,
                            mother_name = '$mother_name'
                            WHERE userId = '$userId'
        ");
    if($update){
        $_SESSION['message'] = "Details successfully updated!";
        $_SESSION['msg_type'] = "success";
        $_SESSION['remedy'] = "";
    }else{
        $_SESSION['message'] = "Details could not be updated!";
        $_SESSION['msg_type'] = "success";
        $_SESSION['remedy'] = "";
    }
    header('location: ../bio');
    }
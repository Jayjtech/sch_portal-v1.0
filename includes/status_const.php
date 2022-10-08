<?php
switch($status){
    case 0:
        $status_syntax = '<p class="badge badge-warning">Pending</p>';
    break;
    case 1:
        $status_syntax = '<p class="badge badge-success">Success</p>';
    break;
    case 2:
        $status_syntax = '<p class="badge badge-danger">Failed</p>';
    break;
    case 3:
        $status_syntax = '<p class="badge badge-danger">Denied</p>';
    break;
    case 4:
        $status_syntax = '<p class="badge badge-info">Approved</p>';
    break;
    case 5:
        $status_syntax = '<p class="badge badge-success">Disbursed</p>';
    break;
    case 6:
        $status_syntax = '<p class="badge badge-danger">Cancelled</p>';
    break;
    case 7:
        $status_syntax = '<p class="badge badge-info">Processing</p>';
    break;
    case 8:
        $status_syntax = '<p class="badge badge-warning">Pending authorization</p>';
    break;
    case 9:
        $status_syntax = '<p class="badge badge-danger">OTP Email dispatch failed</p>';
    break;
    case 10:
        $status_syntax = '<p class="badge badge-warning">On-hold</p>';
    break;
}

switch($given_month){
            case "01":
                $month_syntax = "January";
                break;
            case "02":
                $month_syntax = "February";
                break;
            case "03":
                $month_syntax = "March";
                break;
            case "04":
                $month_syntax = "April";
                break;
            case "05":
                $month_syntax = "May";
                break;
            case "06":
                $month_syntax = "June";
                break;
            case "07":
                $month_syntax = "July";
                break;
            case "08":
                $month_syntax = "August";
                break;
            case "09":
                $month_syntax = "September";
                break;
            case "10":
                $month_syntax = "October";
                break;
            case "11":
                $month_syntax = "November";
                break;
            case "12":
                $month_syntax = "December";
                break;
        }



        switch($st_position){
            case 0:
                $POD = '<div class="text-danger">Yet to be assigned!</div>';
                break;
            case 1:
                $POD = "Proprietor";
                break;
            case 2:
                $POD = "Principal";
                break;
            case 3:
                $POD = "Vice Principal";
                break;
            case 4:
                $POD = "Head Teacher";
                break;
            case 5:
                $POD = "Teacher";
                break;
            case 6:
                $POD = "Bursar";
                break;
            case 7:
                $POD = "Treasurer";
                break;
        }

        switch($st_privileges){
            case 0:
                $priv = '<div class="text-danger">Yet to be assigned!</div>';
                break;
            case 1:
                $priv = "|Student|Staff|Exam|Documents|Revenue|";
                break;
            case 2:
                $priv = "|Student|Staff|Exam|Documents|";
                break;
            case 3:
                $priv = "|Student|Staff|Exam|";
                break;
            case 4:
                $priv = "|Student|Staff|";
                break;
            case 5:
                $priv = "|Student|";
                break;
        }
?>
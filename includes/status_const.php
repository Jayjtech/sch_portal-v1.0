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
        $status_syntax = '<p class="badge badge-info">On-hold</p>';
    break;
    case 4:
        $status_syntax = '<p class="badge badge-success">Approved</p>';
    break;
    case 5:
        $status_syntax = '<p class="badge badge-success">Disbursed</p>';
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
?>
<?php
$cl = substr($course_code, 3, 1);
//FOR SECONDARY SCHOOL
if ($cl == 1) {
    $class = "JSS-1";
}
if ($cl == 2) {
    $class = "JSS-2";
}
if ($cl == 3) {
    $class = "JSS-3";
}
if ($cl == 4) {
    $class = "SSS-1";
}
if ($cl == 5) {
    $class = "SSS-2";
}
if ($cl == 6) {
    $class = "SSS-3";
}
//POSITION
if ($pos == 1) {
    $position = "1st";
}else if ($pos == 2) {
    $position = "2nd";
}else if ($pos == 3) {
    $position = "3rd";
}else if ($pos == 4) {
    $position = "4th";
}else if ($pos == 5) {
    $position = "5th";
}else if ($pos == 6) {
    $position = "6th";
}else if ($pos == 7) {
    $position = "7th";
}else if ($pos == 8) {
    $position = "8th";
}else if ($pos == 9) {
    $position = "9th";
}else if ($pos == 10) {
    $position = "10th";
}else if ($pos == 11) {
    $position = "11th";
}else if ($pos == 12) {
    $position = "12th";
}else if ($pos == 13) {
    $position = "13th";
}else if ($pos == 14) {
    $position = "14th";
}else if ($pos == 15) {
    $position = "15th";
}else if ($pos == 16) {
    $position = "16th";
}else if ($pos == 17) {
    $position = "17th";
}else if ($pos == 18) {
    $position = "18th";
}else if ($pos == 19) {
    $position = "19th";
}else if ($pos == 20) {
    $position = "20th";
}else if ($pos == 21) {
    $position = "21st";
}else if ($pos == 22) {
    $position = "22nd";
}else if ($pos == 23) {
    $position = "23rd";
}else if ($pos == 24) {
    $position = "24th";
}else if ($pos == 25) {
    $position = "25th";
}else if ($pos == 26) {
    $position = "26th";
}else if ($pos == 27) {
    $position = "27th";
}else if ($pos == 28) {
    $position = "28th";
}else if ($pos == 29) {
    $position = "29th";
}else if ($pos == 30) {
    $position = "30th";
}else if ($pos == 31) {
    $position = "31st";
}else if ($pos == 32) {
    $position = "32nd";
}else if ($pos == 33) {
    $position = "33rd";
}else if ($pos == 34) {
    $position = "34th";
}else if ($pos == 35) {
    $position = "35th";
}else if ($pos == 36) {
    $position = "36th";
}else if ($pos == 37) {
    $position = "37th";
}else if ($pos == 38) {
    $position = "38th";
}else if ($pos == 39) {
    $position = "39th";
}else if ($pos == 40) {
    $position = "40th";
}else if ($pos == 41) {
    $position = "41st";
}else if ($pos == 42) {
    $position = "42nd";
}else if ($pos == 43) {
    $position = "43rd";
}else if ($pos == 44) {
    $position = "44th";
}else if ($pos == 45) {
    $position = "45th";
}else if ($pos == 46) {
    $position = "46th";
}else if ($pos == 47) {
    $position = "47th";
}else if ($pos == 48) {
    $position = "48th";
}else if ($pos == 49) {
    $position = "49th";
}else if ($pos == 50) {
    $position = "50th";
}else if ($pos == 51) {
    $position = "51st";
}else if ($pos == 52) {
    $position = "52nd";
}else if ($pos == 53) {
    $position = "53rd";
}else if ($pos == 54) {
    $position = "54th";
}else if ($pos == 55) {
    $position = "55th";
}else if ($pos == 56) {
    $position = "56th";
}else if ($pos == 57) {
    $position = "57th";
}else if ($pos == 58) {
    $position = "58th";
}else if ($pos == 59) {
    $position = "59th";
}else if ($pos == 60) {
    $position = "60th";
}else {
    $position = $pos;
}

if ($class == 'SSS-1' || $class == 'SSS-2' || $class == 'SSS-3') {
    if ($total <= 39) {
        $grade = "F9";
        $remark = "Poor";
        $color = "Red";
    } else if ($total == 40 || $total == 41 || $total == 42 || $total == 43 || $total == 43 || $total == 44) {
        $grade = "E8";
        $remark = "Fair";
        $color = "Red";
    } else if ($total == 45 || $total == 46 || $total == 47 || $total == 48 || $total == 49) {
        $grade = "D7";
        $remark = "Pass";
        $color = "Orange";
    } else if ($total == 50 || $total == 51 || $total == 52 || $total == 53 || $total == 54 || $total == 55 || $total == 56 || $total == 57 || $total == 58 || $total == 59) {
        $grade = "C6";
        $remark = "Credit";
        $color = "Yellow";
    } else if (
        $total == 60 || $total == 61 || $total == 62 || $total == 63 || $total == 64
    ) {
        $grade = "C5";
        $remark = "Credit";
        $color = "LightSeaGreen";
    } else if ($total == 65 || $total == 66 || $total == 67 || $total == 68 || $total == 69) {
        $grade = "C4";
        $remark = "Credit";
        $color = "LightSeaGreen";
    } else if ($total == 70 || $total == 71 || $total == 72 || $total == 73 || $total == 74) {
        $grade = "B3";
        $remark = "V.Good";
        $color = "Lime";
    } else if ($total == 75 || $total == 76 || $total == 77 || $total == 78 || $total == 79) {
        $grade = "B2";
        $remark = "Distinction";
        $color = "green";
        $color = "LimeGreen";
    } else if ($total >= 80) {
        $grade = "A";
        $remark = "Excellent";
        $color = "darkGreen";
    }
} else if ($class == 'JSS-1' || $class == 'JSS-2' || $class == 'JSS-3') {
    if ($total <= 39) {
        $grade = "E";
        $remark = "Poor";
        $color = "Red";
    } else if (
        $total == 40 || $total == 41 || $total == 42 || $total == 43 || $total == 43 || $total == 44 || $total == 45 || $total == 46 || $total == 47 || $total == 48 || $total == 49
    ) {
        $grade = "D";
        $remark = "Average";
        $color = "Orange";
    } else if ($total == 50 || $total == 51 || $total == 52 || $total == 53 || $total == 54 || $total == 55 || $total == 56 || $total == 57 || $total == 58 || $total == 59) {
        $grade = "C";
        $remark = "Good";
        $color = "Yellow";
    } else if (
        $total == 60 || $total == 61 || $total == 62 || $total == 63 || $total == 64 || $total == 65 || $total == 66 || $total == 67 || $total == 68 || $total == 69
    ) {
        $grade = "B";
        $remark = "V.Good";
        $color = "Green";
    } else if ($total >= 70) {
        $grade = "A";
        $remark = "Excellent";
        $color = "darkGreen";
    } else {
        $grade = "";
        $remark = "";
        $color = "";
    }
}
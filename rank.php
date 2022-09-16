<?php
include "config/db.php";
$cr_ranklist = $conn->query("CREATE TABLE IF NOT EXISTS ranklist(
        id int(11) AUTO_INCREMENT NOT NULL,
        name varchar(50) NOT NULL,
        total int NOT NULL,
        rank int NOT NULL,
        PRIMARY KEY (id))
");

// $names = array("Solomon", "vickey", "Adeola", "Sunday");
// $marks = array(67,81,56,55,72,90,83,81,54,59,65,70);
// $rankarray = array();
// $k = 0;
// for($x = 0; $x<count($marks); $x+=3){
//     $total = $marks[$x]+$marks[$x+1]+$marks[$x+2].'<br>';
//     $rankarray[$names[$k]]=$total;
//     $k++;
// }
// arsort($rankarray);
// echo '<pre>';
// print_r($rankarray);
// echo '</pre> <br>';

// $rank = 1;
// foreach($rankarray as $key => $value){
//     echo '<br>';
//     echo $key.' '.$value.' '.$rank. '<br>';
//     $query = "INSERT INTO ranklist(name, total, rank) VALUES('$key', '$value', '$rank')";
//     $run = mysqli_query($conn, $query);
//     $rank ++;
// }

$callList = $conn->query("SELECT * FROM $score_tbl WHERE course_code='MAT401'");
while($li = $callList->fetch_assoc()){
    $data[] = $li;
}

$rankArray = array();
for($x = 0; $x<count($data); $x++){
    $rankArray[$data[$x]['adm_no']] = $data[$x]['total'].'<br>';   
}
arsort($rankArray);
// echo '<pre>';
// print_r($rankArray);
// echo '</pre> <br>';
$pos = 1;
foreach($rankArray as $key => $score){
   
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
 $pos ++;
    $update = $conn->query("UPDATE $score_tbl SET
                position = '$position'
                WHERE course_code= 'MAT401'
                AND adm_no = '$key'
    ");
}

// echo ((25+3)/5);
?>
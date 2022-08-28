<?php
$checkI = $conn->query("SELECT * FROM $instruction_tbl WHERE instruction ='$instruction' AND course_code='$course_code'");
        if($checkI->num_rows == 0){
            $insert = $conn->query("INSERT INTO $instruction_tbl SET 
                    num = '$num',
                    instruction = '$instruction',
                    term = '$exam_term',
                    session = '$exam_session',
                    class = '$class',
                    course_code = '$course_code'
            ");
        }
?>
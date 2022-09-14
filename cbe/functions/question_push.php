<?php
$checkA = $conn->query("SELECT * FROM $question_tbl_a WHERE quest ='$quest' AND course_code='$course_code'");
        if($checkA->num_rows == 0){
            $insert = $conn->query("INSERT INTO $question_tbl_a SET 
                    quest_no = '$q_no',
                    quest = '$quest',
                    ans = '$ans',
                    isCorrect = '$isCorrect',
                    q_id = '$q_id',
                    term = '$term',
                    session = '$session',
                    class = '$class',
                    course_code = '$course_code'
            ");
        }

        $checkB = $conn->query("SELECT * FROM $question_tbl_b WHERE quest ='$quest' AND course_code='$course_code'");
        if($checkB->num_rows == 0){
            $insert = $conn->query("INSERT INTO $question_tbl_b SET 
                    quest_no = '$q_no_B',
                    quest = '$quest',
                    ans = '$ans',
                    isCorrect = '$isCorrect',
                    q_id = '$q_id',
                    term = '$term',
                    session = '$session',
                    class = '$class',
                    course_code = '$course_code'
            ");
        }

        $checkC = $conn->query("SELECT * FROM $question_tbl_c WHERE quest ='$quest' AND course_code='$course_code'");
        if($checkC->num_rows == 0){
            $insert = $conn->query("INSERT INTO $question_tbl_c SET 
                    quest_no = '$q_no_C',
                    quest = '$quest',
                    ans = '$ans',
                    isCorrect = '$isCorrect',
                    q_id = '$q_id',
                    term = '$term',
                    session = '$session',
                    class = '$class',
                    course_code = '$course_code'
            ");
        }
?>
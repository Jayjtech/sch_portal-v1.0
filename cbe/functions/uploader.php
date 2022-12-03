<?php 
include "../../config/db.php";
include "../../includes/calls.php";
try{
if(isset($_POST['pushCourse'])){
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $exam_unit = mysqli_real_escape_string($conn, $_POST['exam_unit']);
    $test_unit = mysqli_real_escape_string($conn, $_POST['test_unit']);
    $ass_unit = mysqli_real_escape_string($conn, $_POST['ass_unit']);
    $exam_duration = mysqli_real_escape_string($conn, $_POST['exam_duration']);
    $test_duration = mysqli_real_escape_string($conn, $_POST['test_duration']);
    $ass_duration = mysqli_real_escape_string($conn, $_POST['ass_duration']);
    $ass_no_of_quest = mysqli_real_escape_string($conn, $_POST['ass_no_of_quest']); 
    $test_no_of_quest = mysqli_real_escape_string($conn, $_POST['test_no_of_quest']); 
    $exam_no_of_quest = mysqli_real_escape_string($conn, $_POST['exam_no_of_quest']); 
    $department = mysqli_real_escape_string($conn, $_POST['department']); 
    $sch_category = mysqli_real_escape_string($conn, $_POST['sch_category']); 
    
    $classNo = substr($course_code, 3, 1);
    $term = substr($course_code, 5, 1);

    if(in_array($sch_category,$secondarySchArray)){
        switch($classNo){
                case 1;
                $class = "JSS-1";
                break;
                case 2;
                $class = "JSS-2";
                break;
                case 3;
                $class = "JSS-3";
                break;
                case 4;
                $class = "SSS-1";
                break;
                case 5;
                $class = "SSS-2";
                break;
                case 6;
                $class = "SSS-3";
                break;
            }
    }else if(in_array($sch_category,$primarySchArray)){
        switch($classNo){
                case 1;
                $class = "NUR-2[Book-1]";
                break;
                case 2;
                $class = "PRY-1[Book-2]";
                break;
                case 3;
                $class = "PRY-2[Book-3]";
                break;
                case 4;
                $class = "PRY-3[Book-4]";
                break;
                case 5;
                $class = "PRY-4[Book-5]";
                break;
                case 6;
                $class = "PRY-5[Book-6]";
                break;
            }
    }

    // echo $class.'<br>';
    // echo $term;
    // exit();
    /**CHECK */
    $check = $conn->query("SELECT * FROM $course_tbl WHERE (course_code ='$course_code' AND token='$token' AND sch_category='$sch_category' AND session='$log_session')");
    if($check->num_rows > 0){
        $_SESSION['message'] = "This course already exist!";
        $_SESSION['msg_type'] = "warning";
        $_SESSION['remedy'] = "You can upload a different course";
    }else{
        $insert = $conn->query("INSERT INTO $course_tbl SET
                            course_code = '$course_code',
                            course = '$course',
                            sch_category = '$sch_category',
                            ass_no_of_quest = '$ass_no_of_quest',
                            test_no_of_quest = '$test_no_of_quest',
                            exam_no_of_quest = '$exam_no_of_quest',
                            session = '$log_session',
                            term = '$term',
                            exam_unit = '$exam_unit',
                            test_unit = '$test_unit',
                            ass_unit = '$ass_unit',
                            exam_duration = '$exam_duration',
                            test_duration = '$test_duration',
                            ass_duration = '$ass_duration',
                            department = '$department',
                            token = '$token',
                            taken_by = '$name',
                            created_at = '$date',
                            class = '$class'");
            if($insert){
                $_SESSION['message'] = "Course has been added successfully!";
                $_SESSION['msg_type'] = "success";
                $_SESSION['remedy'] = "";
            }else{
                $_SESSION['message'] = "An error occurred the process!";
                $_SESSION['msg_type'] = "error";
                $_SESSION['remedy'] = "Try again later";
            }
    }
    header('location: ../../create_course?index');
}

if(isset($_POST['reviewCourse'])){
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $exam_unit = mysqli_real_escape_string($conn, $_POST['exam_unit']);
    $test_unit = mysqli_real_escape_string($conn, $_POST['test_unit']);
    $ass_unit = mysqli_real_escape_string($conn, $_POST['ass_unit']);
    $exam_duration = mysqli_real_escape_string($conn, $_POST['exam_duration']);
    $test_duration = mysqli_real_escape_string($conn, $_POST['test_duration']);
    $ass_duration = mysqli_real_escape_string($conn, $_POST['ass_duration']);
    $ass_no_of_quest = mysqli_real_escape_string($conn, $_POST['ass_no_of_quest']); 
    $test_no_of_quest = mysqli_real_escape_string($conn, $_POST['test_no_of_quest']); 
    $exam_no_of_quest = mysqli_real_escape_string($conn, $_POST['exam_no_of_quest']); 
    $department = mysqli_real_escape_string($conn, $_POST['department']); 
    $sch_category = mysqli_real_escape_string($conn, $_POST['sch_category']); 
    
    $classNo = substr($course_code, 3, 1);
    $term = substr($course_code, 5, 1);

    if(in_array($sch_category,$secondarySchArray)){
        switch($classNo){
                case 1;
                $class = "JSS-1";
                break;
                case 2;
                $class = "JSS-2";
                break;
                case 3;
                $class = "JSS-3";
                break;
                case 4;
                $class = "SSS-1";
                break;
                case 5;
                $class = "SSS-2";
                break;
                case 6;
                $class = "SSS-3";
                break;
            }
    }else if(in_array($sch_category,$primarySchArray)){
        switch($classNo){
                case 1;
                $class = "NUR-2[Book-1]";
                break;
                case 2;
                $class = "PRY-1[Book-2]";
                break;
                case 3;
                $class = "PRY-2[Book-3]";
                break;
                case 4;
                $class = "PRY-3[Book-4]";
                break;
                case 5;
                $class = "PRY-4[Book-5]";
                break;
                case 6;
                $class = "PRY-5[Book-6]";
                break;
            }
    }

    // echo $class.'<br>';
    // echo $term;
    // exit();
    /**CHECK */
    $check = $conn->query("SELECT * FROM $score_tbl WHERE (course_code ='$course_code' AND teacher_token='$token' AND sch_category='$sch_category' AND session='$log_session')");
    if($check->num_rows > 0){
        $_SESSION['message'] = "Some students already registered this course!";
        $_SESSION['msg_type'] = "warning";
        $_SESSION['remedy'] = "You can delete and recreate the course.";
    }else{
        $update = $conn->query("UPDATE $course_tbl SET
                            course = '$course',
                            sch_category = '$sch_category',
                            ass_no_of_quest = '$ass_no_of_quest',
                            test_no_of_quest = '$test_no_of_quest',
                            exam_no_of_quest = '$exam_no_of_quest',
                            exam_unit = '$exam_unit',
                            test_unit = '$test_unit',
                            ass_unit = '$ass_unit',
                            exam_duration = '$exam_duration',
                            test_duration = '$test_duration',
                            ass_duration = '$ass_duration',
                            department = '$department'
                            WHERE course_code = '$course_code'
                            AND token = '$token'
                            ");
            if($update){
                $_SESSION['message'] = "Course has been successfully updated!";
                $_SESSION['msg_type'] = "success";
                $_SESSION['remedy'] = "";
            }else{
                $_SESSION['message'] = "An error occurred the process!";
                $_SESSION['msg_type'] = "error";
                $_SESSION['remedy'] = "Try again later";
            }
        }
    header('location: ../../create_course?index='.$course_code.'&sch_category='.$sch_category.'');
}


if(isset($_POST['push_quest'])){
    $quest_type = mysqli_real_escape_string($conn, $_POST['quest_type']);
    $course_details = $_POST['course_code'];
    $quest_id = rand(100000,999999);
    
    $course_details = json_decode(base64_decode($course_details));
    $course_code = $course_details->course_code;
    $sch_category = $course_details->sch_category;
    $classNo = substr($course_code, 3, 1);
    $term = substr($course_code, 5, 1);

   if(in_array($sch_category,$secondarySchArray)){
        switch($classNo){
                case 1;
                $class = "JSS-1";
                break;
                case 2;
                $class = "JSS-2";
                break;
                case 3;
                $class = "JSS-3";
                break;
                case 4;
                $class = "SSS-1";
                break;
                case 5;
                $class = "SSS-2";
                break;
                case 6;
                $class = "SSS-3";
                break;
            }
    }else if(in_array($sch_category,$primarySchArray)){
        switch($classNo){
                case 1;
                $class = "NUR-2[Book-1]";
                break;
                case 2;
                $class = "PRY-1[Book-2]";
                break;
                case 3;
                $class = "PRY-2[Book-3]";
                break;
                case 4;
                $class = "PRY-3[Book-4]";
                break;
                case 5;
                $class = "PRY-4[Book-5]";
                break;
                case 6;
                $class = "PRY-5[Book-6]";
                break;
            }
    }

    $check = $conn->query("SELECT * FROM $course_tbl WHERE (course_code = '$course_code' AND term='$log_term' AND sch_category='$sch_category' AND session='$log_session')");
    if($check->num_rows > 0){
        $row = $check->fetch_object();
        if($quest_type == "Ass"){
            $no_of_quest = $row->ass_no_of_quest;
        }else if($quest_type == "Test"){
            $no_of_quest = $row->test_no_of_quest;
        }else if($quest_type == "Exam"){
            $no_of_quest = $row->exam_no_of_quest;
        }
       
        // Allowed mime types
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

        // Validate whether selected file is a CSV file
        if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {

            // If the file is uploaded
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {

                // Open uploaded CSV file with read-only mode
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                // Skip the first line
                fgetcsv($csvFile);

                // Parse data from CSV file line by line
                while (($line = fgetcsv($csvFile)) !== FALSE) {

                    // Get row data
                    $q_no   =  mysqli_real_escape_string($conn, $line[0]);
                    $quest  =  mysqli_real_escape_string($conn, $line[1]);
                    $A  =  mysqli_real_escape_string($conn, $line[2]);
                    $B  =  mysqli_real_escape_string($conn, $line[3]);
                    $C  =  mysqli_real_escape_string($conn, $line[4]);
                    $D  =  mysqli_real_escape_string($conn, $line[5]);
                    $option  =  mysqli_real_escape_string($conn, $line[6]);
                    $q_id = 'Q'.$q_no;
                   
                    /**Switching from alpha to integer */
                    if($option == "A" || $option == "a"){$isCorrect = 0;}
                    if($option == "B" || $option == "b"){$isCorrect = 1;}
                    if($option == "C" || $option == "c"){$isCorrect = 2;}
                    if($option == "D" || $option == "d"){$isCorrect = 3;}

                    $ans = '["'.$A.'","'.$B.'","'.$C.'","'.$D.'"]';
                    // NEEDED TO SHUFFLE QUESTION NUMBERS
                    include "../../config/q_type.php";

        
                //To ensure that The same class is not uploaded over and again
                $checkQuestion = $conn->query("SELECT * FROM $question_tbl_a WHERE (course_code='$course_code' AND sch_category='$sch_category' AND session='$log_session' AND term='$log_term' AND quest_no='$q_no' AND quest_type='$quest_type'  AND token='$token')");

                    //insert data from CSV file 
                    if ($checkQuestion->num_rows == 0) {
                        $query_a = "INSERT INTO $question_tbl_a (session, token, term, course_code, sch_category, class, quest_no, quest, ans, isCorrect, q_id, quest_type, quest_id)
     VALUES ('$log_session','$token', '$term', '$course_code', '$sch_category', '$class', '$q_no','$quest', '$ans', '$isCorrect', '$q_id', '$quest_type', '$quest_id')";
                        mysqli_query($conn, $query_a);

                        $query_b = "INSERT INTO $question_tbl_b (session, token, term, course_code, sch_category, class, quest_no, quest, ans, isCorrect, q_id, quest_type, quest_id)
     VALUES ('$log_session','$token', '$term', '$course_code', '$sch_category', '$class', '$q_no_B','$quest', '$ans', '$isCorrect', '$q_id', '$quest_type', '$quest_id')";
                        mysqli_query($conn, $query_b);

                        $query_c = "INSERT INTO $question_tbl_c (session, token, term, course_code, sch_category, class, quest_no, quest, ans, isCorrect, q_id, quest_type, quest_id)
     VALUES ('$log_session','$token', '$term', '$course_code', '$sch_category', '$class', '$q_no_C','$quest', '$ans', '$isCorrect', '$q_id', '$quest_type', '$quest_id')";
                        mysqli_query($conn, $query_c);

                       
                if($query_c){
                    $_SESSION['message'] = "Questions have been Uploaded!";
                    $_SESSION['msg_type'] = "success";
                    $_SESSION['remedy'] = "";
                    }else{
                        $_SESSION['message'] = "Questions could not be Uploaded!";
                        $_SESSION['msg_type'] = "error";
                        $_SESSION['remedy'] = "Try again later";
                    }
                        
                    } else {
                        $_SESSION['message'] = "Questions already exist!";
                        $_SESSION['msg_type'] = "warning";
                        $_SESSION['remedy'] = "Multiple questions with the same academic period cannot be accepted";
                    }
                }
            }
        }
    }
 header("location: ../../create_course?upload_question");
 fclose($csvFile);
    }
   
if(isset($_POST['push_instruct'])){
    $quest_type = mysqli_real_escape_string($conn, $_POST['quest_type']);
    $course_details = $_POST['course_code'];
     
    $course_details = json_decode(base64_decode($course_details));
    $course_code = $course_details->course_code;
    $sch_category = $course_details->sch_category;

    $classNo = substr($course_code, 3, 1);
    $term = substr($course_code, 5, 1);

   if(in_array($sch_category,$secondarySchArray)){
        switch($classNo){
                case 1;
                $class = "JSS-1";
                break;
                case 2;
                $class = "JSS-2";
                break;
                case 3;
                $class = "JSS-3";
                break;
                case 4;
                $class = "SSS-1";
                break;
                case 5;
                $class = "SSS-2";
                break;
                case 6;
                $class = "SSS-3";
                break;
            }
    }else if(in_array($sch_category,$primarySchArray)){
        switch($classNo){
                case 1;
                $class = "NUR-2[Book-1]";
                break;
                case 2;
                $class = "PRY-1[Book-2]";
                break;
                case 3;
                $class = "PRY-2[Book-3]";
                break;
                case 4;
                $class = "PRY-3[Book-4]";
                break;
                case 5;
                $class = "PRY-4[Book-5]";
                break;
                case 6;
                $class = "PRY-5[Book-6]";
                break;
            }
    }

   
        // Allowed mime types
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

        // Validate whether selected file is a CSV file
        if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {

            // If the file is uploaded
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {

                // Open uploaded CSV file with read-only mode
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                // Skip the first line
                fgetcsv($csvFile);

                // Parse data from CSV file line by line
                while (($line = fgetcsv($csvFile)) !== FALSE) {

                    // Get row data
                    $instruct1   =  mysqli_real_escape_string($conn, stripcslashes($line[0]));
                    $instruct2  =  mysqli_real_escape_string($conn, stripcslashes($line[1]));
                    $instruct3  =  mysqli_real_escape_string($conn, stripcslashes($line[2]));
                    $instruct4  =  mysqli_real_escape_string($conn, stripcslashes($line[3]));
                    $instruct5  =  mysqli_real_escape_string($conn, stripcslashes($line[4]));
                    $instruct6  =  mysqli_real_escape_string($conn, stripcslashes($line[5]));

                    $instructions = '["'.$instruct1.'","'.$instruct2.'","'.$instruct3.'","'.$instruct4.'","'.$instruct5.'","'.$instruct6.'"]';
                    
                    if($instruct6 == false){
                        $instructions = '["'.$instruct1.'","'.$instruct2.'","'.$instruct3.'","'.$instruct4.'","'.$instruct5.'"]';
                    }
                    if($instruct5 == false || $instruct6 == false){
                        $instructions = '["'.$instruct1.'","'.$instruct2.'","'.$instruct3.'","'.$instruct4.'"]';
                    }
                    //To ensure that The same class is not uploaded over and again
                    $checkInstruction = $conn->query("SELECT * FROM $instruction_tbl WHERE (course_code='$course_code' AND sch_category='$sch_category' AND session='$log_session' AND term='$log_term' AND quest_type='$quest_type')");
                    if($checkInstruction->num_rows == 0){
                    //insert data from CSV file 
                    $insert = $conn->query("INSERT INTO $instruction_tbl SET
                                            course_code = '$course_code',
                                            teacher_token = '$token',
                                            quest_type = '$quest_type',
                                            instruction = '$instructions',
                                            term = '$log_term',
                                            sch_category='$sch_category',
                                            session = '$log_session',
                                            class = '$class'
                                        ");
                       
                if($insert){
                    $_SESSION['message'] = "Instructions have been Uploaded!";
                    $_SESSION['msg_type'] = "success";
                    $_SESSION['remedy'] = "";
                    }else{
                        $_SESSION['message'] = "Instructions could not be Uploaded!";
                        $_SESSION['msg_type'] = "error";
                        $_SESSION['remedy'] = "Try again later";
                    }
                        
                }else{
                    $_SESSION['message'] = 'Instructions for the selected '.$quest_type.' already exist!';
                    $_SESSION['msg_type'] = "error";
                    $_SESSION['remedy'] = "";
                }
            }
            }
        }
    
 header("location: ../../create_course?upload_question");
 fclose($csvFile);
    }

    /**Upload time table */
    if(isset($_POST['push_time_table'])){
      $class_category  =  mysqli_real_escape_string($conn, $_POST['class_category']);
      $term  =  $_POST['term'];
      if($class_category == "Junior-School"){
        $class_array = 'JSS-1,JSS-2,JSS-3';
      }else if($class_category == "Senior-School"){
        $class_array = 'SSS-1,SSS-2,SSS-3';
      }else if($class_category == "Primary-School"){
        $class_array = 'Creche,KG-1,KG-2,NUR-1,NUR-2[Basic-1],PRY-1[Basic-2],PRY-2[Basic-3],PRY-3[Basic-4],PRY-4[Basic-5],PRY-5[Basic-6]';
      }else{
        $class_array = '';
      }
      
           // Allowed mime types
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        // Validate whether selected file is a CSV file
        if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {

            // If the file is uploaded
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {

                // Open uploaded CSV file with read-only mode
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                // Skip the first line
                fgetcsv($csvFile);

                // Parse data from CSV file line by line
                while (($line = fgetcsv($csvFile)) !== FALSE) {

                    // Get row data
                    $day  =  mysqli_real_escape_string($conn, stripcslashes($line[0]));
                    $p1  =  mysqli_real_escape_string($conn, stripcslashes($line[1]));
                    $p2  =  mysqli_real_escape_string($conn, stripcslashes($line[2]));
                    $p3  =  mysqli_real_escape_string($conn, stripcslashes($line[3]));
                    $p4  =  mysqli_real_escape_string($conn, stripcslashes($line[4]));
                    $p5  =  mysqli_real_escape_string($conn, stripcslashes($line[5]));
                    $exam_date  =  mysqli_real_escape_string($conn, stripcslashes($line[6]));
                    $line_id = rand(10000,99999);
                    //To ensure that The same class is not uploaded over and again
                    $check = $conn->query("SELECT * FROM $time_tbl WHERE (class_array='$class_array' AND session='$log_session' AND term='$log_term' AND line_id='$line_id')");

                    //insert data from CSV file 
                    if ($check->num_rows == 0) {
                        $insert = $conn->query("INSERT INTO $time_tbl  SET
                                                uploaded_by = '$userId',
                                                day = '$day',
                                                period_1 = '$p1',
                                                period_2 = '$p2', 
                                                period_3 = '$p3', 
                                                period_4 = '$p4', 
                                                period_5 = '$p5', 
                                                exam_date = '$exam_date', 
                                                class_array = '$class_array', 
                                                line_id = '$line_id', 
                                                term = '$log_term', 
                                                session = '$log_session'
                                              ");
                    } else {
                        $_SESSION['message'] = ''.$term.' | '.$log_session.' time table for '.$class_category.' already exist';
                        $_SESSION['msg_type'] = "warning";
                        $_SESSION['remedy'] = "";
                    }
                }
                  if($insert){
                        $_SESSION['message'] = ''.$term.' | '.$log_session.' time table for '.$class_category.' has been uploaded successfully!';
                        $_SESSION['msg_type'] = "success";
                        $_SESSION['remedy'] = "";
                    }
            }
        }
         header("location: ../../adm_exam?time_table");
 fclose($csvFile);
    }





    /**Upload score */
    if(isset($_POST['push_score_sheet'])){
        // Allowed mime types
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        // Validate whether selected file is a CSV file
        if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {

            // If the file is uploaded
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {

                // Open uploaded CSV file with read-only mode
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                // Skip the first line
                fgetcsv($csvFile);

                // Parse data from CSV file line by line
                while (($line = fgetcsv($csvFile)) !== FALSE) {

                    // Get row data
                    $sch_category = mysqli_real_escape_string($conn, $line[0]);
                    $adm_no = mysqli_real_escape_string($conn, $line[2]);
                    $course_code = mysqli_real_escape_string($conn, stripcslashes($line[3]));
                    $ass = mysqli_real_escape_string($conn, stripcslashes($line[4]));
                    $ca1 = mysqli_real_escape_string($conn, stripcslashes($line[5]));
                    $ca2 = mysqli_real_escape_string($conn, stripcslashes($line[6]));
                    $ca3 = mysqli_real_escape_string($conn, stripcslashes($line[7]));
                    $theory = mysqli_real_escape_string($conn, $line[8]);
                    $obj_score = mysqli_real_escape_string($conn, $line[9]);
                    $exam = ($theory+$obj_score);
                    $total = ($ass+$ca1+$ca2+$ca3+$exam);

                    /**Here, test is over 100 */
                    $ca_cumulative = (($ca1+$ca2+$ca3)/3);
                    $average = (($ca_cumulative + $exam)/2);
                    
                    switch($log_term){
                        case 1:
                            $slot = "ft_score";
                            $slot_b = "ft_score_b";
                            break;
                        case 2:
                            $slot = "st_score";
                            $slot_b = "st_score_b";
                            break;
                        case 3:
                            $slot = "tt_score";
                            $slot_b = "tt_score_b";
                            break;
                    }

                    $cl = substr($course_code, 3, 1);
                    
                    if(in_array($sch_category,$secondarySchArray)){
                        switch($cl){
                                case 1;
                                $class = "JSS-1";
                                break;
                                case 2;
                                $class = "JSS-2";
                                break;
                                case 3;
                                $class = "JSS-3";
                                break;
                                case 4;
                                $class = "SSS-1";
                                break;
                                case 5;
                                $class = "SSS-2";
                                break;
                                case 6;
                                $class = "SSS-3";
                                break;
                            }
                    }else if(in_array($sch_category,$primarySchArray)){
                        switch($cl){
                                case 1;
                                $class = "NUR-2[Book-1]";
                                break;
                                case 2;
                                $class = "PRY-1[Book-2]";
                                break;
                                case 3;
                                $class = "PRY-2[Book-3]";
                                break;
                                case 4;
                                $class = "PRY-3[Book-4]";
                                break;
                                case 5;
                                $class = "PRY-4[Book-5]";
                                break;
                                case 6;
                                $class = "PRY-5[Book-6]";
                                break;
                            }
                    }
                    //update score-sheet 
                    $update1 = $conn->query("UPDATE $score_tbl SET
                                            ass = '$ass',
                                            ca1 = '$ca1',
                                            ca2 = '$ca2',
                                            ca3 = '$ca3',
                                            exam = '$exam',
                                            theory = '$theory', 
                                            score = '$obj_score', 
                                            total = '$total',
                                            average = '$average',
                                            $slot = '$total',
                                            $slot_b = '$average'
                                            WHERE course_code = '$course_code'
                                            AND adm_no = '$adm_no'
                                            AND term = '$log_term'
                                            AND sch_category = '$sch_category'
                                            AND session = '$log_session'
                                            AND teacher_token = '$token'
                                            ");

            $getOtherScore = $conn->query("SELECT * FROM $score_tbl 
                    WHERE (course_code= '$course_code' AND teacher_token='$token' AND adm_no='$adm_no' AND term='$log_term' AND session='$log_session')");
                    $oth = $getOtherScore->fetch_object();
                    $ft_score = $oth->ft_score;
                    $st_score = $oth->st_score;
                    $tt_score = $oth->tt_score;

                    $ft_score_b = $oth->ft_score_b;
                    $st_score_b = $oth->st_score_b;
                    $tt_score_b = $oth->tt_score_b;
                    
                    switch($log_term){
                        case 1:
                            $cumulative = $ft_score;
                            $cumulative_b = $ft_score_b;
                            break;
                        case 2:
                            $cumulative = (($ft_score+$st_score)/2);
                            $cumulative_b = (($ft_score_b+$st_score_b)/2);
                            break;
                        case 3:
                            $cumulative = (($ft_score+$st_score+$tt_score)/3);
                            $cumulative_b = (($ft_score_b+$st_score_b+$tt_score_b)/3);
                            break;
                    }
                    /**Grade */
                    include "grade.php";
                    /**End of grade */

                    $update2 = $conn->query("UPDATE $score_tbl SET
                                            ca_cumulative = '$ca_cumulative',
                                            cumulative = '$cumulative',
                                            cumulative_b = '$cumulative_b',
                                            grade = '$grade',
                                            remark = '$remark',
                                            grade_b = '$grade_b',
                                            remark_b = '$remark_b'
                                            WHERE (course_code = '$course_code'
                                            AND adm_no = '$adm_no'
                                            AND term = '$log_term'
                                            AND session = '$log_session'
                                            AND teacher_token = '$token')
                                            ");
                                            
                    /**To update the evaluation table */
                    $checkRows = $conn->query("SELECT * FROM $score_tbl WHERE adm_no='$adm_no' AND term='$log_term' AND session='$log_session'");
                    $checkAllScore = $conn->query("SELECT sum(total) as overall_score, sum(average) as overall_score_b  FROM $score_tbl WHERE (adm_no='$adm_no' AND term='$log_term' AND session='$log_session')");
                    $cal = $checkAllScore->fetch_object();
                    $overall_score = $cal->overall_score;
                    $overall_score_b = $cal->overall_score_b;
                    $out_of = ($checkRows->num_rows*100);
                    $percent_score = (($overall_score/$out_of)*100);
                    $percent_score_b = (($overall_score_b/$out_of)*100);

                    /**Update Evaluation */
                    $updateEva = $conn->query("UPDATE $evaluation_tbl SET 
                                            overall_score = '$overall_score',
                                            overall_score_b = '$overall_score_b',
                                            out_of = '$out_of',
                                            percent_score = '$percent_score',
                                            percent_score_b = '$percent_score_b'
                                            WHERE adm_no = '$adm_no'
                                            AND term = '$log_term'
                                            AND session = '$log_session'
                                            ");

                        }
            /**Positioning */            
        $callList = $conn->query("SELECT * FROM $score_tbl WHERE course_code='$course_code' AND term='$log_term' AND session='$log_session' AND teacher_token='$token'");
            while($li = $callList->fetch_assoc()){
                $data[] = $li;
            }

        $rankArray = array();
            for($x = 0; $x<count($data); $x++){
                $rankArray[$data[$x]['adm_no']] = $data[$x]['cumulative'];   
            }
        arsort($rankArray);
        $pos = 1;
        foreach($rankArray as $key => $score){
            /**Positioner */
            include "position.php";
            /**End of ... */
            $pos ++;
        $setPosition = $conn->query("UPDATE $score_tbl SET
                position = '$position'
                WHERE course_code= '$course_code'
                AND adm_no = '$key'
                AND term = '$log_term'
                AND session = '$log_session'
                AND teacher_token = '$token'
    "); 
        }

if($setPosition){
       $rankArray = array();
            for($x = 0; $x<count($data); $x++){
                $rankArray[$data[$x]['adm_no']] = $data[$x]['cumulative_b'];   
            }
        arsort($rankArray);
        $pos = 1;
        foreach($rankArray as $key => $score){
            /**Positioner */
            include "position.php";
            /**End of ... */
            $pos ++;
        $setPositionb = $conn->query("UPDATE $score_tbl SET
                position_b = '$position'
                WHERE course_code= '$course_code'
                AND adm_no = '$key'
                AND term = '$log_term'
                AND session = '$log_session'
                AND teacher_token = '$token'
            "); 
        }
    }
                    
                if($setPositionb){
                    $_SESSION['message'] = ''.$term_syntax.' term | '.$log_session.' score-sheet for '.$course_code.' has been uploaded successfully!';
                    $_SESSION['msg_type'] = "success";
                    $_SESSION['remedy'] = "";
                }else{
                    $_SESSION['message'] = ''.$term_syntax.' term | '.$log_session.' score-sheet for '.$course_code.' could not be uploaded!';
                    $_SESSION['msg_type'] = "error";
                    $_SESSION['remedy'] = "There may be error in the file you tried to upload.";
                }
            }
        }
    header("location: ../../adm_upload_score");
 fclose($csvFile);
}



/**Upload teacher's comment */
if(isset($_POST['upload_t_comment'])){
    if($_POST['class_officiating']){
        $class_to_be_evaluated = $_POST['class_officiating'];
    }else{
        $class_to_be_evaluated = $class_officiating;
    }
    
// Allowed mime types
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        // Validate whether selected file is a CSV file
        if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {

            // If the file is uploaded
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {

                // Open uploaded CSV file with read-only mode
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                // Skip the first line
                fgetcsv($csvFile);

                // Parse data from CSV file line by line
                while (($line = fgetcsv($csvFile)) !== FALSE) {

                    // Get row data
                    $adm_no  =  mysqli_real_escape_string($conn, $line[1]);
                    $class  =  mysqli_real_escape_string($conn, $line[2]);
                    $n_absent  =  mysqli_real_escape_string($conn, $line[6]);
                    $n_present  =  mysqli_real_escape_string($conn, $line[7]);
                    $punctuality  =  mysqli_real_escape_string($conn, $line[8]);
                    $attentiveness  =  mysqli_real_escape_string($conn, $line[9]);
                    $neatness  =  mysqli_real_escape_string($conn, $line[10]);
                    $honesty  =  mysqli_real_escape_string($conn, $line[11]);
                    $relationship  =  mysqli_real_escape_string($conn, $line[12]);
                    $skills  =  mysqli_real_escape_string($conn, $line[13]);
                    $sport  =  mysqli_real_escape_string($conn, $line[14]);
                    $clubs  =  mysqli_real_escape_string($conn, $line[15]);
                    $fluency  =  mysqli_real_escape_string($conn, $line[16]);
                    $handwriting  =  mysqli_real_escape_string($conn, $line[17]);
                    $t_comment  =  mysqli_real_escape_string($conn, stripcslashes($line[18]));
                    $prom  = mysqli_real_escape_string($conn, stripcslashes($line[19]));

                    if(in_array($prom,$jss1Array)){
                        $promoted_to = "JSS-1";
                    }else if(in_array($prom,$jss2Array)){
                        $promoted_to = "JSS-2";
                    }else if(in_array($prom,$jss3Array)){
                        $promoted_to = "JSS-3";
                    }else if(in_array($prom,$sss1Array)){
                        $promoted_to = "SSS-1";
                    }else if(in_array($prom,$sss2Array)){
                        $promoted_to = "SSS-2";
                    }else if(in_array($prom,$sss3Array)){
                        $promoted_to = "SSS-3";
                    }else{
                        $promoted_to = $class;
                    }

                $updateEva = $conn->query("UPDATE $evaluation_tbl SET
                                            t_comment = '$t_comment',
                                            n_absent = '$n_absent',
                                            n_present = '$n_present',
                                            punctuality = '$punctuality',
                                            attentiveness = '$attentiveness',
                                            neatness = '$neatness',
                                            honesty = '$honesty',
                                            relationship = '$relationship',
                                            skills = '$skills',
                                            sport = '$sport',
                                            clubs = '$clubs',
                                            fluency = '$fluency',
                                            handwriting = '$handwriting',
                                            promoted_to = '$promoted_to'
                                            WHERE adm_no = '$adm_no'
                                            AND term='$log_term'
                                            AND session='$log_session'
                                        ");

                    $updateUser = $conn->query("UPDATE $users_tbl SET 
                                                curr_class = '$promoted_to'
                                                WHERE userId = '$adm_no'
                    ");
                }
            /**Positioning */            
        $callList = $conn->query("SELECT * FROM $evaluation_tbl WHERE (term='$log_term' AND session='$log_session' AND class='$class_to_be_evaluated')");
            while($li = $callList->fetch_assoc()){
                $data[] = $li;
            }

        $rankArray = array();
            for($x = 0; $x<count($data); $x++){
                $rankArray[$data[$x]['adm_no']] = $data[$x]['percent_score'];   
            }
        arsort($rankArray);
    
        $pos = 1;
        foreach($rankArray as $key => $score){
            /**Positioner */
            include "position.php";
            /**End of ... */
            $pos ++;
        $setPosition = $conn->query("UPDATE $evaluation_tbl SET
                position = '$position'
                WHERE adm_no = '$key'
                AND term = '$log_term'
                AND session = '$log_session'
    "); 
        }
                    
                if($setPosition){
                    $_SESSION['message'] = "".$term_syntax." term | ".$log_session." teacher's comment for ".$class_to_be_evaluated." has been uploaded successfully!";
                    $_SESSION['msg_type'] = "success";
                    $_SESSION['remedy'] = "";
                }else{
                    $_SESSION['message'] = "".$term_syntax." term | ".$log_session." teacher's comment for ".$class_to_be_evaluated." could not be uploaded!";
                    $_SESSION['msg_type'] = "error";
                    $_SESSION['remedy'] = "There may be error in the file you tried to upload.";
                }
            }
        }
         header("location: ../../adm_upload_comment");
 fclose($csvFile);
    }


     /**Upload teacher's comment */
    if(isset($_POST['upload_h_comment'])){
// Allowed mime types
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        // Validate whether selected file is a CSV file
        if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)) {

            // If the file is uploaded
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {

                // Open uploaded CSV file with read-only mode
                $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
                // Skip the first line
                fgetcsv($csvFile);

                // Parse data from CSV file line by line
                while (($line = fgetcsv($csvFile)) !== FALSE) {

                    // Get row data
                    $adm_no  =  mysqli_real_escape_string($conn, $line[1]);
                    $class  =  mysqli_real_escape_string($conn, $line[2]);
                    $t_comment  =  mysqli_real_escape_string($conn, stripcslashes($line[5]));
                    $p_comment  =  mysqli_real_escape_string($conn, stripcslashes($line[6]));
                    $prom  = mysqli_real_escape_string($conn, stripcslashes($line[7]));
                    $next_term_date  = mysqli_real_escape_string($conn, $line[8]);

                    if(in_array($prom,$jss1Array)){
                        $promoted_to = "JSS-1";
                    }else if(in_array($prom,$jss2Array)){
                        $promoted_to = "JSS-2";
                    }else if(in_array($prom,$jss3Array)){
                        $promoted_to = "JSS-3";
                    }else if(in_array($prom,$sss1Array)){
                        $promoted_to = "SSS-1";
                    }else if(in_array($prom,$sss2Array)){
                        $promoted_to = "SSS-2";
                    }else if(in_array($prom,$sss3Array)){
                        $promoted_to = "SSS-3";
                    }else {
                        $promoted_to = $class;
                    }
                   
                $updateEva = $conn->query("UPDATE $evaluation_tbl SET
                                            t_comment = '$t_comment',
                                            p_comment = '$p_comment',
                                            promoted_to = '$promoted_to',
                                            next_term_date = '$next_term_date'
                                            WHERE adm_no = '$adm_no'
                                            AND term='$log_term'
                                            AND session='$log_session'
                                        ");

                    $updateUser = $conn->query("UPDATE $users_tbl SET 
                                                curr_class = '$promoted_to'
                                                WHERE userId = '$adm_no'
                    ");

                        }
    
                    
                if($updateUser){
                    $_SESSION['message'] = "".$term_syntax." term | ".$log_session." head teacher's comment has been uploaded successfully!";
                    $_SESSION['msg_type'] = "success";
                    $_SESSION['remedy'] = "";
                }else{
                    $_SESSION['message'] = "".$term_syntax." term | ".$log_session." head teacher's comment could not be uploaded!";
                    $_SESSION['msg_type'] = "error";
                    $_SESSION['remedy'] = "There may be error in the file you tried to upload.";
                }
            }
        }
         header("location: ../../adm_upload_comment");
 fclose($csvFile);
    }

/**Teachers uploading course materials */
if(isset($_POST['course_material'])){    
    $category = mysqli_real_escape_string($conn,$_POST['category']);
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $course_details = $_POST['course_code'];

    $course_details = json_decode(base64_decode($course_details));
    $course_code = $course_details->course_code;
    $sch_category = $course_details->sch_category;

      $query = $conn->query("SELECT * FROM $course_tbl WHERE course_code = '$course_code' AND sch_category='$sch_category'");
      while($row = $query->fetch_assoc()){
          $class = $row['class'];
          $course = $row['course'];
          $department = $row['department'];
      }
     
    $file = rand(1000,9999)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $folder="course_material/";
 
    // new file size in KB
    $new_size = $file_size/1024;  
    // make file name in lower case
    $new_file_name = strtolower($file);
    // make file name in lower case
    $final_file = str_replace(' ','-',$new_file_name);
    
    if(move_uploaded_file($file_loc,'../../'.$folder.$final_file)){
    $sql = $conn->query("INSERT INTO $course_material_tbl SET 
                file = '$final_file', 
                userId = '$userId', 
                token = '$token', 
                size = '$new_size', 
                category = '$category',
                sch_category = '$sch_category',
                name = '$name', 
                class = '$class',
                title = '$title',
                course = '$course',
                course_code = '$course_code',
                date = '$date',
                term = '$log_term',
                session = '$log_session'
                ");
    if($sql){
        $_SESSION['message'] = ''.$category.' has been Uploaded!';
        $_SESSION['msg_type'] = 'success';
        $_SESSION['remedy'] = '';
    }else{
        $_SESSION['message'] = ''.$category.'could not be Uploaded!';
        $_SESSION['msg_type'] = 'error';
        $_SESSION['remedy'] = '';
    }
  }
  header("location: ../../create_course?course_material");
 }

 /**Student submitting document */
if(isset($_POST['submission'])){    
    $mat_id = $_POST['mat_id'];
      $query = $conn->query("SELECT * FROM $course_material_tbl WHERE id = '$mat_id'");
      $row = $query->fetch_object();
        $teacher = $row->name;
        $course_code = $row->course_code;
        $course = $row->course;
        $teacher_token = $row->token;
        $title = $row->title;
      
    $check = $conn->query("SELECT * FROM $submissions_tbl WHERE par_id = '$mat_id'");
    if($check->num_rows == 0){
            $file = rand(1000,9999)."-".$_FILES['file']['name'];
                $file_loc = $_FILES['file']['tmp_name'];
                $file_size = $_FILES['file']['size'];
                $file_type = $_FILES['file']['type'];
                $folder="student_submissions/";
            
                // new file size in KB
                $new_size = $file_size/1024;  
                // make file name in lower case
                $new_file_name = strtolower($file);
                // make file name in lower case
                $final_file = str_replace(' ','-',$new_file_name);
                
                if(move_uploaded_file($file_loc,'../../'.$folder.$final_file)){
                $sql = $conn->query("INSERT INTO $submissions_tbl SET 
                            par_id = '$mat_id', 
                            file = '$final_file', 
                            adm_no = '$userId', 
                            token = '$token', 
                            teacher = '$teacher', 
                            teacher_token = '$teacher_token', 
                            size = '$new_size', 
                            name = '$name', 
                            class = '$curr_class',
                            title = '$title',
                            course = '$course',
                            course_code = '$course_code',
                            date = '$date',
                            term = '$log_term',
                            session = '$log_session'
                            ");
        if($sql){
            $_SESSION['message'] = ''.$title.' successfully submitted!';
            $_SESSION['msg_type'] = 'success';
            $_SESSION['remedy'] = '';
        }else{
            $_SESSION['message'] = ''.$title.' could not be submitted!';
            $_SESSION['msg_type'] = 'error';
            $_SESSION['remedy'] = '';
        }
    }
    }else{
        $_SESSION['message'] = ''.$title.' has already been submitted!';
        $_SESSION['msg_type'] = 'warning';
        $_SESSION['remedy'] = '';
    }
   
  
  header("location: ../../course_materials?submissions");
 }


$optionE = false;
 if(isset($_POST['update_question'])){
    $questionText = mysqli_real_escape_string($conn, $_POST['questionText']);
    $optionA = mysqli_real_escape_string($conn, $_POST['optionA']);
    $optionB = mysqli_real_escape_string($conn, $_POST['optionB']);
    $optionC = mysqli_real_escape_string($conn, $_POST['optionC']);
    $optionD = mysqli_real_escape_string($conn, $_POST['optionD']);
    $quest_type = mysqli_real_escape_string($conn, $_POST['quest_type']);
    $sch_category = mysqli_real_escape_string($conn, $_POST['sch_category']);
    // $optionE = mysqli_real_escape_string($conn, $_POST['optionE']);
    $isCorrect = mysqli_real_escape_string($conn, $_POST['isCorrect']);
    $ans = '["'.$optionA.'","'.$optionB.'","'.$optionC.'","'.$optionD.'"]';
    $course_code = $_POST['course_code'];
    $quest_img = $_POST['quest_img'];
    $q_id = $_POST['q_id'];
    $quest_id = $_POST['quest_id'];

    $img_name = $_FILES['quest_img']['name'];
    $img_size = $_FILES['quest_img']['size'];
    $img_tmp = $_FILES['quest_img']['tmp_name'];

     // ANSWER
    if(empty($_FILES['quest_img']['name'])){
        $target_dir = '';
        }else{
            $allowed_etx = array('png','jpg', 'jpeg', 'gif');
            //Get file extension 
            $file_ext = explode('.', $img_name);
            $file_ext = strtolower(end($file_ext));
            //CHECK IMAGE EXT
            if(in_array($file_ext, $allowed_etx)){
                // IMAGE DIRECTORY
                $target_dir = "${img_name}";
            }
        }
    
    if($img_size <= 1000000){
    // IF NO IMG IS UPLOADED, SET IT BACK TO THE PREVIOUS IMAGE
            if($target_dir == ""){
                $target_dir = $quest_img;
            }else{
                move_uploaded_file($img_tmp, '../../images/exam/'.$target_dir);
            }
            $updateA = $conn->query("UPDATE $question_tbl_a SET 
                                    quest='$questionText', 
                                    ans='$ans', 
                                    img='$target_dir', 
                                    isCorrect='$isCorrect' 
                                    WHERE quest_id = '$quest_id'
                                    AND q_id = '$q_id'
                                    AND sch_category = '$sch_category'
                                    AND course_code = '$course_code'
                                    ");
            $updateB = $conn->query("UPDATE $question_tbl_b SET 
                                    quest='$questionText', 
                                    ans='$ans', 
                                    img='$target_dir', 
                                    isCorrect='$isCorrect' 
                                    WHERE quest_id = '$quest_id'
                                    AND q_id = '$q_id'
                                    AND sch_category = '$sch_category'
                                    AND course_code = '$course_code'
                                    ");
            $updateC = $conn->query("UPDATE $question_tbl_c SET 
                                    quest='$questionText', 
                                    ans='$ans', 
                                    img='$target_dir', 
                                    isCorrect='$isCorrect' 
                                    WHERE quest_id = '$quest_id'
                                    AND q_id = '$q_id'
                                    AND sch_category = '$sch_category'
                                    AND course_code = '$course_code'
                                    ");

if($updateC){
            $_SESSION['message'] = 'The changes made has been saved!';
            $_SESSION['msg_type'] = 'success';
            $_SESSION['remedy'] = '';
        }else{
            $_SESSION['message'] = 'Changes could not be saved!';
            $_SESSION['msg_type'] = 'error';
            $_SESSION['remedy'] = '';
        }
    }
     header('location:../../adm_question_editor?qid='.$q_id.'&cd='.$course_code.'&qt='.$quest_type.'&sch_category='.$sch_category.'');
}

if(isset($_POST['add_passage'])){
    $passage = mysqli_real_escape_string($conn, $_POST['passage']);
    $tagged_questions = mysqli_real_escape_string($conn, $_POST['tagged_questions']);
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $sch_category = mysqli_real_escape_string($conn, $_POST['sch_category']);
    $quest_id = mysqli_real_escape_string($conn, $_POST['quest_id']);

    $check = $conn->query("SELECT * FROM $passage_tbl WHERE quest_id = '$quest_id'");
    if($check->num_rows == 0){
        $insert = $conn->query("INSERT INTO $passage_tbl SET
                        passage = '$passage',
                        tagged_questions = '$tagged_questions',
                        course_code = '$course_code',
                        sch_category = '$sch_category',
                        quest_id = '$quest_id',
                        token = '$token',
                        term = '$log_term',
                        session = '$log_session'
        ");
    }else{
        $update = $conn->query("UPDATE $passage_tbl SET
                        passage = '$passage',
                        tagged_questions = '$tagged_questions'
                        WHERE quest_id = '$quest_id' 
                        AND course_code = '$course_code'
                        AND token = '$token'
                        AND term = '$log_term'
                        AND sch_category = '$sch_category'
                        AND session = '$log_session'
        ");
    }
    if($insert){
            $_SESSION['message'] = 'Passage successfully saved!';
            $_SESSION['msg_type'] = 'success';
            $_SESSION['remedy'] = '';
    }else if($update){
            $_SESSION['message'] = 'Passage successfully updated!';
            $_SESSION['msg_type'] = 'success';
            $_SESSION['remedy'] = '';
    }else{
            $_SESSION['message'] = 'An error occurred during the process!';
            $_SESSION['msg_type'] = 'error';
            $_SESSION['remedy'] = '';
    }
    header('location:../../adm_add_passage?qd='.$quest_id.'&sch_category='.$sch_category.'');
}


if(isset($_GET['val_res'])){
    $id = $_GET['val_res'];
    $update = $conn->query("UPDATE $submissions_tbl SET status = 11");
    if($update){
        $_SESSION['message'] = 'Response has been approved!';
        $_SESSION['msg_type'] = 'success';
        $_SESSION['remedy'] = '';
    }else{
        $_SESSION['message'] = 'Response could not be approved!';
        $_SESSION['msg_type'] = 'error';
        $_SESSION['remedy'] = '';
    }
     header("location: ../../create_course?course_material");
}

if(isset($_POST['set_to_public'])){
    $course_code = $_POST['course_code'];
    $course_details = json_decode(base64_decode($course_code));
    $course_code = $course_details->course_code;
    $sch_category = $course_details->sch_category;

    $update = $conn->query("UPDATE $score_tbl SET public = '1' 
    WHERE course_code = '$course_code'
    AND teacher_token = '$token'
    AND sch_category = '$sch_category'
     ");

     if($update){
        $_SESSION['message'] = 'Exam tokens have successfully been set to public!';
        $_SESSION['msg_type'] = 'success';
        $_SESSION['remedy'] = 'Students can now see the exam token!';
     }else{
        $_SESSION['message'] = 'An error occurred during the process!';
        $_SESSION['msg_type'] = 'error';
        $_SESSION['remedy'] = '';
     }
     header("location: ../../adm_enrolment_list?index");
}


if(isset($_GET['changeExamStatus'])){
    $adm_no = $_GET['changeExamStatus'];
    $tokenStatus = $_GET['status'];
    $course_code = $_GET['course_code'];

    if($tokenStatus == 0){
        $newStatus = 1;
    }else{
        $newStatus = 0;
    }

    $check = $conn->query("SELECT * FROM $score_tbl WHERE adm_no='$adm_no'");
    if($check->num_rows == 0){
        $_SESSION['message'] = 'Invalid request!';
        $_SESSION['msg_type'] = 'warning';
        $_SESSION['remedy'] = '';
    }else{
        $update = $conn->query("UPDATE $score_tbl SET public = '$newStatus' 
            WHERE course_code = '$course_code'
            AND teacher_token = '$token'
            AND adm_no = '$adm_no'
            ");

        $_SESSION['message'] = 'Exam token status successfully updated!';
        $_SESSION['msg_type'] = 'success';
        $_SESSION['remedy'] = '';
    }
    header("location: ../../adm_enrolment_list?index");
}


throw new Exception($conn->error);
}catch(Exception $e){
    echo '<div style="color:red;font-size:20px;">Oops, a programming error occurred during the process. Return to previous page and contact Ekreat solutions.</div>';
}
?>
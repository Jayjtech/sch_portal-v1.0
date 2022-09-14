<?php 
include "../../config/db.php";
include "../../includes/calls.php";
if(isset($_POST['exam_unit'])){
    $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $exam_unit = mysqli_real_escape_string($conn, $_POST['exam_unit']);
    $test_unit = mysqli_real_escape_string($conn, $_POST['test_unit']);
    $ass_unit = mysqli_real_escape_string($conn, $_POST['ass_unit']);
    $exam_duration = mysqli_real_escape_string($conn, $_POST['exam_duration']);
    $test_duration = mysqli_real_escape_string($conn, $_POST['test_duration']);
    $ass_duration = mysqli_real_escape_string($conn, $_POST['ass_duration']);
    $no_of_quest = mysqli_real_escape_string($conn, $_POST['no_of_quest']); 
    $department = mysqli_real_escape_string($conn, $_POST['department']); 
    
    $classNo = substr($course_code, 3, 1);
    $term = substr($course_code, 5, 1);
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
       echo $class;
    /**CHECK */
    $check = $conn->query("SELECT * FROM $course_tbl WHERE (course_code ='$course_code' AND session='$log_session')");
    if($check->num_rows > 0){
        $_SESSION['message'] = "This course already exist!";
        $_SESSION['msg_type'] = "warning";
        $_SESSION['remedy'] = "You can upload a different course";
    }else{
        $insert = $conn->query("INSERT INTO $course_tbl SET
                            course_code = '$course_code',
                            course = '$course',
                            no_of_quest = '$no_of_quest',
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
    header('location: ../../create_course');
}


if(isset($_POST['push_quest'])){
     $quest_type = mysqli_real_escape_string($conn, $_POST['quest_type']);
     $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
     $classNo = substr($course_code, 3, 1);
     $term = substr($course_code, 5, 1);
    
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

     $check = $conn->query("SELECT * FROM $course_tbl WHERE (course_code = '$course_code' AND term='$log_term' AND session='$log_session')");
    if($check->num_rows > 0){
    while ($row = $check->fetch_assoc()) {
        $no_of_quest = $row['no_of_quest'];
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

                    if($quest == false){
                            $_SESSION['message'] = "The uploaded file seems to be empty!";
                            $_SESSION['msg_type'] = "error";
                            $_SESSION['remedy'] = "Check the file you uploaded";
                        }
                    //To ensure that The same class is not uploaded over and again
                    $checkQuestion = $conn->query("SELECT * FROM $question_tbl_a WHERE (course_code='$course_code' AND session='$log_session' AND quest_no='$q_no' AND quest_type='$quest_type')");

                    //insert data from CSV file 
                    if ($checkQuestion->num_rows == 0) {
                        $query_a = "INSERT INTO $question_tbl_a (session, token, term, course_code, class, quest_no, quest, ans, isCorrect, q_id, quest_type)
     VALUES ('$log_session','$token', '$term', '$course_code', '$class', '$q_no','$quest', '$ans', '$isCorrect', '$q_id', '$quest_type')";
                        mysqli_query($conn, $query_a);

                        $query_b = "INSERT INTO $question_tbl_b (session, token, term, course_code, class, quest_no, quest, ans, isCorrect, q_id, quest_type)
     VALUES ('$log_session','$token', '$term', '$course_code', '$class', '$q_no_B','$quest', '$ans', '$isCorrect', '$q_id', '$quest_type')";
                        mysqli_query($conn, $query_b);

                        $query_c = "INSERT INTO $question_tbl_c (session, token, term, course_code, class, quest_no, quest, ans, isCorrect, q_id, quest_type)
     VALUES ('$log_session','$token', '$term', '$course_code', '$class', '$q_no_C','$quest', '$ans', '$isCorrect', '$q_id', '$quest_type')";
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
 header("location: ../../create_course");
 fclose($csvFile);
    }
   
if(isset($_POST['push_instruct'])){
     $quest_type = mysqli_real_escape_string($conn, $_POST['quest_type']);
     $course_code = mysqli_real_escape_string($conn, $_POST['course_code']);
     $classNo = substr($course_code, 3, 1);
     $term = substr($course_code, 5, 1);
    
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
                    $instruct1   =  mysqli_real_escape_string($conn, $line[0]);
                    $instruct2  =  mysqli_real_escape_string($conn, $line[1]);
                    $instruct3  =  mysqli_real_escape_string($conn, $line[2]);
                    $instruct4  =  mysqli_real_escape_string($conn, $line[3]);
                    $instruct5  =  mysqli_real_escape_string($conn, $line[4]);
                    $instruct6  =  mysqli_real_escape_string($conn, $line[5]);

                    $instructions = '["'.$instruct1.'","'.$instruct2.'","'.$instruct3.'","'.$instruct4.'","'.$instruct5.'","'.$instruct6.'"]';
                    
                    if($instruct6 == false){
                        $instructions = '["'.$instruct1.'","'.$instruct2.'","'.$instruct3.'","'.$instruct4.'","'.$instruct5.'"]';
                    }
                    if($instruct5 == false || $instruct6 == false){
                        $instructions = '["'.$instruct1.'","'.$instruct2.'","'.$instruct3.'","'.$instruct4.'"]';
                    }
                    //To ensure that The same class is not uploaded over and again
                    $checkInstruction = $conn->query("SELECT * FROM $instruction_tbl WHERE (course_code='$course_code' AND session='$log_session' AND quest_type='$quest_type')");

                    //insert data from CSV file 
                    $insert = $conn->query("INSERT INTO $instruction_tbl SET
                                            course_code = '$course_code',
                                            quest_type = '$quest_type',
                                            instruction = '$instructions',
                                            term = '$log_term',
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
                        
                }
            }
        }
    
 header("location: ../../create_course");
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
                    $day  =  mysqli_real_escape_string($conn, $line[0]);
                    $p1  =  mysqli_real_escape_string($conn, $line[1]);
                    $p2  =  mysqli_real_escape_string($conn, $line[2]);
                    $p3  =  mysqli_real_escape_string($conn, $line[3]);
                    $p4  =  mysqli_real_escape_string($conn, $line[4]);
                    $p5  =  mysqli_real_escape_string($conn, $line[5]);
                    $exam_date  =  mysqli_real_escape_string($conn, $line[6]);
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
         header("location: ../../adm_exam");
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
                    $adm_no  =  mysqli_real_escape_string($conn, $line[1]);
                    $course_code  =  mysqli_real_escape_string($conn, $line[2]);
                    $ass  =  mysqli_real_escape_string($conn, $line[3]);
                    $ca1  =  mysqli_real_escape_string($conn, $line[4]);
                    $ca2  =  mysqli_real_escape_string($conn, $line[5]);
                    $theory  =  mysqli_real_escape_string($conn, $line[6]);

                    
                    //update score-sheet 
                        $update1 = $conn->query("UPDATE $score_tbl SET
                                                ass = '$ass',
                                                ca1 = '$ca1',
                                                ca2 = '$ca2',
                                                theory = '$theory', 
                                                period_3 = '$p3', 
                                                period_4 = '$p4', 
                                                period_5 = '$p5', 
                                                WHERE course_code = '$course_code'
                                                AND adm_no = '$adm_no'
                                                AND term = '$log_term'
                                                AND session = '$log_session'
                                                AND teacher_token = '$token'
                                              ");

                    $getOtherScore = $conn->query("SELECT * FROM $score_tbl 
                    WHERE (course_code= '$course_code' AND teacher_token='$token' AND term='$log_term' AND session='$log_session')");
                    $oth = $getOtherScore->fetch_object();
                    $ft_score = $oth->ft_score;
                    $st_score = $oth->st_score;
                    $tt_score = $oth->tt_score;
                    $score = $oth->score;
                    $total = $ass+$ca1+$ca2+$theory+$score;
                    switch($log_term){
                        case 1:
                            $cumulative = $ft_score;
                            $slot = "ft_score";
                            break;
                        case 2:
                            $cumulative = $ft_score+$st_score;
                            $slot = "st_score";
                            break;
                        case 3:
                            $cumulative = $ft_score+$st_score+$tt_score;
                            $slot = "tt_score";
                            break;
                    }

                    $update2 = $conn->query("UPDATE $score_tbl SET
                                                total = '$total',
                                                $slot = '$total',
                                                cumulative = '$cumulative'
                                                WHERE (course_code = '$course_code'
                                                AND adm_no = '$adm_no'
                                                AND term = '$log_term'
                                                AND session = '$log_session'
                                                AND teacher_token = '$token')
                                              ");
                        }
                  if($insert){
                        $_SESSION['message'] = ''.$term.' | '.$log_session.' time table for '.$class_category.' has been uploaded successfully!';
                        $_SESSION['msg_type'] = "success";
                        $_SESSION['remedy'] = "";
                    }
            }
        }
         header("location: ../../adm_exam");
 fclose($csvFile);
    }
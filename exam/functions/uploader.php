<?php 
include "../../config/db.php";
include "../../includes/calls.php";
if(isset($_POST['pushCourse'])){
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


if(isset($_POST['push_exam'])){
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

    $check = $conn->query("SELECT * FROM $course_tbl WHERE (course_code = '$course_code' AND session='$log_session')");
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
                    $_SESSION['message'] = "Questions has been Uploaded!";
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
   
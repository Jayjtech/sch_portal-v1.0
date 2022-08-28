<?php
$cr_question_tbl_a = $conn->query("CREATE TABLE IF NOT EXISTS $question_tbl_a (
    id int(11) AUTO_INCREMENT NOT NULL,
    quest_no int(11)  NOT NULL,
    quest varchar(10000)  NOT NULL,
    ans varchar(100000)  NOT NULL,
    img varchar(255)  NOT NULL,
    isCorrect int(11)  NOT NULL,
    course_code varchar(50)  NOT NULL,
    q_id varchar(50)  NOT NULL,
    term varchar(50)  NOT NULL,
    session varchar(50)  NOT NULL,
    class varchar(50)  NOT NULL,
    PRIMARY KEY (id)
)");

$cr_question_tbl_b = $conn->query("CREATE TABLE IF NOT EXISTS $question_tbl_b (
    id int(11) AUTO_INCREMENT NOT NULL,
    quest_no int(11)  NOT NULL,
    quest varchar(10000)  NOT NULL,
    ans varchar(100000)  NOT NULL,
    img varchar(255)  NOT NULL,
    isCorrect int(11)  NOT NULL,
    course_code varchar(50)  NOT NULL,
    q_id varchar(50)  NOT NULL,
    term varchar(50)  NOT NULL,
    session varchar(50)  NOT NULL,
    class varchar(50)  NOT NULL,
    PRIMARY KEY (id)
)");

$cr_question_tbl_c= $conn->query("CREATE TABLE IF NOT EXISTS $question_tbl_c (
    id int(11) AUTO_INCREMENT NOT NULL,
    quest_no int(11)  NOT NULL,
    quest varchar(10000)  NOT NULL,
    ans varchar(100000)  NOT NULL,
    img varchar(255)  NOT NULL,
    isCorrect int(11)  NOT NULL,
    course_code varchar(50)  NOT NULL,
    q_id varchar(50)  NOT NULL,
    term varchar(50)  NOT NULL,
    session varchar(50)  NOT NULL,
    class varchar(50)  NOT NULL,
    PRIMARY KEY (id)
)");

$cr_instruction_tbl = $conn->query("CREATE TABLE IF NOT EXISTS $instruction_tbl (
    id int(11) AUTO_INCREMENT NOT NULL,
    num int(11) NOT NULL,
    course_code varchar(50)  NOT NULL,
    instruction varchar(10000)  NOT NULL,
    term varchar(255)  NOT NULL,
    session varchar(255)  NOT NULL,
    class varchar(50)  NOT NULL,
    PRIMARY KEY (id)
)");

$cr_score_tbl = $conn->query("CREATE TABLE IF NOT EXISTS $score_tbl (
    id int(11) AUTO_INCREMENT NOT NULL,
    name varchar(255) NOT NULL,
    adm_no varchar(255) NOT NULL,
    class varchar(50)  NOT NULL,
    subject varchar(255)  NOT NULL,
    course_code varchar(255)  NOT NULL,
    score int(11)  NOT NULL,
    paper_type text(50)  NOT NULL,
    term int(11)  NOT NULL,
    session varchar(255)  NOT NULL,
    day varchar(50)  NOT NULL,
    month varchar(50)  NOT NULL,
    year varchar(50)  NOT NULL,
    date varchar(50)  NOT NULL,
    duration int(11)  NOT NULL,
    answeredQuestions varchar(100000000)  NOT NULL,
    minLeft int(11)  NOT NULL,
    PRIMARY KEY (id)
)");

//     for($x = 0; $x < count($questions['question']); $x++){
//         $q_no = $x+1;
//         $q_id = 'Q'.$q_no;
//         $quest = ($questions['question'][$x]['quest']);
//         $ans = json_encode($questions['question'][$x]['ans']);
//         $isCorrect = ($questions['question'][$x]['isCorrect']);
//         $course_code = ($questions['course_code']);
//         $term = ($questions['term']);
//         $session = ($questions['session']);
//         $class = ($questions['class']);
       
        
//         /**Requirement */
//         $no_of_quest = 5;
//         include "q_type.php";
//         include "functions/question_push.php";
//         /**End of processors */
//     };

//    /**Insert instructions */
//    for($i = 0; $i < count($instructions); $i++){
//     $num = $i+1;
//     $instruction = json_encode($instructions['instructions']);
//     $exam_session = $instructions['session'];
//     $exam_term = $instructions['term'];
//     $course_code = $instructions['course_code'];
//     $class = $instructions['class'];
//     /**Requirement */
//     include "functions/instruction_push.php";
//    }
?>
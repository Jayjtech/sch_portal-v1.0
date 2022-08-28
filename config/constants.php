<?php
define("DB_NAME", "sm_system");
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("BASE_URL", "http://localhost/my_cbe_app");

$date = date("d-m-Y");
$day = date("d");
$month = date("m");
$year = date("Y");
$time = date("g:ia ", time());
session_start();

$userId = "Jay18937893";
$question_tbl_a = "quest_type_a";
$question_tbl_b = "quest_type_b";
$question_tbl_c = "quest_type_c";
$instruction_tbl = "instructions";
$score_tbl = "score_sheet";

/**Questions */
$questions = [
            "course_code" => "ICT401",
            "class" => "SSS-1",
            "term" => "1",
            "session" => "2022/2023",
            "question" => [
                    [
                    "quest" => "What is the full meaning of CSS?",
                    "ans" => [
                            "Cascaded Style Sheet",
                            "Cascaded Sheet Style",
                            "Communication Style Shaft",
                            "Computing Style Sheet"
                    ],
                    "isCorrect" => 0
                    ],
                        
                    [
                    "quest" => "HTML stands for ______",
                    "ans" => [
                            "Hyper Transfer Markup Language",
                            "Hyper Text Markup Language",
                            "High Translator Makeup Language",
                            "Help Transfer Markup Language"
                    ],
                    "isCorrect" => 1
                    ],

                    [
                    "quest" => "Which of these is not a data type in JavaScript?",
                    "ans" => [
                            "String",
                            "Array",
                            "Function",
                            "Integer"
                    ],
                    "isCorrect" => 2,
                    ],
                        
                    [
                    "quest" => "Who is the father of computer?",
                    "ans" => [
                            "Bill Gate",
                            "Isaac Newton",
                            "Charles Babbage",
                            "Micheal Faraday"
                    ],
                    "isCorrect" => 2
                    ],

                    [
                    "quest" => "______ is the fastest means of transportation",
                    "ans" => [
                            "Land",
                            "Air",
                            "Pipe",
                            "Water"
                    ],
                    "isCorrect" => 1,
                    ],
                        
                    // [
                    // "quest" => "ICT stands for ________",
                    // "ans" => [
                    //         "Information and Community Technology",
                    //         "Information and Communication Technology",
                    //         "Informal Communication Technology",
                    //         "Independent Commission Telecommunication"
                    // ],
                    // "isCorrect" => 1
                    // ],

                    // [
                    // "quest" => "_______ has made the world a global society",
                    // "ans" => [
                    //         "Food",
                    //         "Vacations",
                    //         "Entertainment",
                    //         "Computer"
                    // ],
                    // "isCorrect" => 3
                    // ]
                ]
            ];


$instructions = [
        "course_code" => "ICT401",
        "class" => "SSS-1",
        "term" => 1,
        "session" => "2022/2023",
                "instructions" => [        
                "Read the questions carefully",
                "No examination malpractice",
                "No side talk",
                "If you have any question, simply signify"
                ]
];


// FUNCTION PAGES
$score_recorder = "functions/submit-exam";
          

?>
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
$settings_tbl = "settings";
$evaluation_tbl = "evaluation";
$session_tbl = "session";
$class_tbl = "class";
$users_tbl = "users";

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

$classes = [
    "class" => [
        1 => "JSS-1",
        2 => "JSS-2",
        3 => "JSS-3",
        4 => "SSS-1",
        5 => "SSS-2",
        6 => "SSS-3"
    ]
];

$sessions = [
    "session" => [
        1 => "2021/2022",
        2 => "2022/2023",
        3 => "2023/2024",
        4 => "2024/2025",
        5 => "2025/2026",
        6 => "2026/2027"
    ]
];
// FUNCTION PAGES
$score_recorder = "functions/submit-exam";
$monnify_res = "functions/payment_gateway/monnify.php";
          
//Details
$mailer_email = "support@ekreat.com";
$sch_name = "Jayjtech Schools";
?>
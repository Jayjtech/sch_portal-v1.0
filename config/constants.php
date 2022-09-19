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
error_reporting(0);

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
$course_tbl = "courses";
$student_award_tbl = "student_award";
$bill_tbl = "bill";
$time_tbl = "time_table";
$cbe_report_tbl = "cbe_report";
$banks_tbl = "banks";
$payroll_tbl = "payroll";
$payroll_title_tbl = "payroll_title";

$add_course = "cbe/functions/uploader";
$cbe_request = "cbe/functions/receive_request";
$course_deleter = "cbe/functions/deleter";
$enrolCourse = "cbe/functions/enrol";
$pusher = "functions/pusher.php";
$exporter = "functions/export.php";
$account_details = "functions/payment_gateway/fetch_banks.php";
$bank_details = "functions/payment_gateway/bank_details.php";

$monnify_base_url = "https://api.monnify.com";
// $monnify_base_url = "https://sandbox.monnify.com";

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
                    ]
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
        1 => "Creche",
        2 => "KG-1",
        3 => "KG-2",
        4 => "NUR-1",
        5 => "NUR-2[Basic-1]",
        6 => "PRY-1[Basic-2]",
        7 => "PRY-2[Basic-3]",
        8 => "PRY-3[Basic-4]",
        9 => "PRY-4[Basic-5]",
        10 => "PRY-5[Basic-6]",
        11 => "JSS-1",
        12 => "JSS-2",
        13 => "JSS-3",
        14 => "SSS-1",
        15 => "SSS-2",
        16 => "SSS-3"
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

$stu_awards = [
    "award" => [
        1 => "Paying",
        2 => "Full Scholarship",
        3 => "Half Scholarship"
    ]
];

// FUNCTION PAGES
$score_recorder = "functions/submit-exam";
$monnify_res = "functions/payment_gateway/monnify.php";
          
//Details
$mailer_email = "support@ekreat.com";
$sch_name = "Jayjtech Schools";
$currency = "&#8358;";
?>
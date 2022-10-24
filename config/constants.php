<?php
define("DB_NAME", "sm_system");
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("BASE_URL", "http://localhost/sch_portal-v1.0");

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
$passage_tbl = "passage";
$score_tbl = "score_sheet";
$settings_tbl = "settings";
$evaluation_tbl = "evaluation";
$result_checker_tbl = "result_checker";
$session_tbl = "session";
$class_tbl = "class";
$users_tbl = "users";
$course_tbl = "courses";
$course_material_tbl = "courses_material";
$student_award_tbl = "student_award";
$bill_tbl = "bill";
$bill_setting_tbl = "bill_setting";
$bill_report_tbl = "bill_report";
$time_tbl = "time_table";
$cbe_report_tbl = "cbe_report";
$banks_tbl = "banks";
$payroll_tbl = "payroll";
$payroll_title_tbl = "payroll_title";
$staff_level_tbl = "staff_level";
$loan_tbl = "loan";
$loan_disbursement_tbl = "loan_disbursement";
$expenses_tbl = "expenses";
$transaction_tbl = "transactions";
$submissions_tbl = "submissions";

/**Routes */
$add_course = "cbe/functions/uploader";
$cbe_request = "cbe/functions/receive_request";
$course_deleter = "cbe/functions/deleter";
$deleter = "functions/deleter.php";
$enrolCourse = "cbe/functions/enrol";
$pusher = "functions/pusher.php";
$resultTypeSetter = "functions/setResultType.php";
$exporter = "functions/export.php";
$account_details = "functions/payment_gateway/fetch_banks.php";
$bank_details = "functions/payment_gateway/bank_details.php";
$reserve_account = "functions/payment_gateway/monnify.php";
$loan_query = "functions/loan_query.php";
$sort_bill = "functions/sort_bill.php";
$profileUploader = "functions/profileUploader.php";
$schLogoUploader = "functions/schLogoUploader.php";
$disburser = "functions/payment_gateway/disburser.php";
$expenses_query = "functions/expenses.php";
$fund_wallet = "functions/payment_gateway/fund_wallet.php";
$exam_query = "functions/exam_query.php";
$receipt = "receipt_pdf";

/**Result templates */
$default_result_template = "images/carousel/banner_2.jpg";
$result_template_a = "images/carousel/banner_12.jpg";
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
    "Creche",
    "KG-1",
    "KG-2",
    "NUR-1",
    "NUR-2[Book-1]",
    "PRY-1[Book-2]",
    "PRY-2[Book-3]",
    "PRY-3[Book-4]",
    "PRY-4[Book-5]",
    "PRY-5[Book-6]",
    "JSS-1",
    "JSS-2",
    "JSS-3",
    "SSS-1",
    "SSS-2",
    "SSS-3"
];

$sessions = [
        "2020/2021",
        ''.($year-1).'/'.($year).'',
        ''.($year).'/'.($year+1).''
        ];

$bill_list = [
         [  
            "bill_title" => "School fee",
            "bill_name" => "sch_fee",
            "status" => 1
        ],
         [  
            "bill_title" => "Registration fee",
            "bill_name" => "reg_fee",
            "status" => 1
        ],
         [  
            "bill_title" => "Uniform fee",
            "bill_name" => "uniform",
            "status" => 1
        ],
         [  
            "bill_title" => "Sport wear fee",
            "bill_name" => "sport_wear",
            "status" => 1
        ],
         [  
            "bill_title" => "Cardigan fee",
            "bill_name" => "cardigan",
            "status" => 1
        ],
         [  
            "bill_title" => "Handbook fee",
            "bill_name" => "handbook",
            "status" => 1
        ],
         [  
            "bill_title" => "Security fee",
            "bill_name" => "security",
            "status" => 1
        ],
         [  
            "bill_title" => "ICT/Website fee",
            "bill_name" => "ict",
            "status" => 1
        ],
         [  
            "bill_title" => "Vocational fee",
            "bill_name" => "vocational",
            "status" => 1
        ],
         [  
            "bill_title" => "Development fee",
            "bill_name" => "development",
            "status" => 1
        ],
         [  
            "bill_title" => "PTA fee",
            "bill_name" => "pta",
            "status" => 1
        ],
         [  
            "bill_title" => "Music fee",
            "bill_name" => "music",
            "status" => 1
        ],
         [  
            "bill_title" => "Cardigan fee",
            "bill_name" => "cardigan",
            "status" => 1
        ],
         [  
            "bill_title" => "Extra lesson fee",
            "bill_name" => "lesson",
            "status" => 1
        ],
         [  
            "bill_title" => "Health fee",
            "bill_name" => "health",
            "status" => 1
        ],
         [  
            "bill_title" => "School media fee",
            "bill_name" => "sch_media",
            "status" => 1
        ],
         [  
            "bill_title" => "Clubs & Societies fee",
            "bill_name" => "club",
            "status" => 1
        ],
         [  
            "bill_title" => "Boarding fee",
            "bill_name" => "boarding_fee",
            "status" => 1
        ],
         [  
            "bill_title" => "ID - card fee",
            "bill_name" => "id_card",
            "status" => 1
        ],
         [  
            "bill_title" => "School badge fee",
            "bill_name" => "sch_badge",
            "status" => 1
        ],
         [  
            "bill_title" => "Valedictory Service fee",
            "bill_name" => "vs_fee",
            "status" => 1
        ],
         [  
            "bill_title" => "Transport fee",
            "bill_name" => "transport",
            "status" => 1
        ],
         [  
            "bill_title" => "Excursion fee",
            "bill_name" => "excursion",
            "status" => 1
        ],
         [  
            "bill_title" => "Sport fee",
            "bill_name" => "sport",
            "status" => 1
        ],
         [  
            "bill_title" => "Others",
            "bill_name" => "others",
            "status" => 1
        ]
];

$stu_awards = [
        "Paying",
        "Full Scholarship",
        "Half Scholarship"
];

// FUNCTION PAGES
$score_recorder = "functions/submit-exam";
$monnify_res = "functions/payment_gateway/monnify.php";
$currency_type = "NGN";
$currency = "&#8358;";

// mk MK_PROD_QSXL9D2HBC
// mc 587163315485
// ms CHPS7PLRGAU2P6VPSPF2GKKQ55JFB8ML
// DB_PS #HxIw5aRLEyC
// DB ekreqipn_sch_portal
?>
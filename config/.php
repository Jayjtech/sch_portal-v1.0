<?php
$create_user = $conn->query("CREATE TABLE IF NOT EXISTS $users_tbl (
    id int(11) AUTO_INCREMENT NOT NULL,
    user_type varchar(255) NOT NULL,
    staff_type varchar(255) NOT NULL,
    name varchar(255) NOT NULL,
    token varchar(255) NOT NULL,
    position int(11) NOT NULL,
    userId varchar(255) NOT NULL,
    adm_no varchar(255) NOT NULL,
    dob varchar(255) NOT NULL,
    reg_date varchar(255) NOT NULL,
    father_name varchar(255) NOT NULL,
    mother_name varchar(255) NOT NULL,
    home_address varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    phone varchar(255) NOT NULL,
    pre_class varchar(50) NOT NULL,
    curr_class varchar(50) NOT NULL,
    monnify_account varchar(1000000000) NOT NULL,
    password varchar(50) NOT NULL,
    pin varchar(255) NOT NULL,
    ip varchar(255) NOT NULL,
    os varchar(255) NOT NULL,
    device varchar(255) NOT NULL,
    img varchar(255) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

if($create_user){
  $user_type = base64_encode('Admin');
  $token = md5(date('Y')*time());
  $pin = base64_encode('12345');
  $check = $conn->query("SELECT * FROM $users_tbl WHERE user_type = 'QWRtaW4=' AND position = 1");
  if($check->num_rows == 0){
    $insert = $conn->query("INSERT INTO $users_tbl SET 
                name = 'Admin',
                token = '$token',
                user_type = '$user_type',
                position = 1,
                userId = '8395465343',
                email = 'admin@example.com',
                pin = '$pin',
                password = '9bdb52d04dc20036dbd8313ed055'
      ");
  }
}

$cr_course_tbl = $conn->query("CREATE TABLE IF NOT EXISTS $course_tbl (
    id int(11) AUTO_INCREMENT NOT NULL,
    course varchar(255)  NOT NULL,
    course_code varchar(50)  NOT NULL,
    no_of_quest int(11)  NOT NULL,
    class varchar(50)  NOT NULL,
    department varchar(50)  NOT NULL,
    taken_by varchar(255)  NOT NULL,
    token varchar(255)  NOT NULL,
    exam_duration int(11)  NOT NULL,
    test_duration int(11)  NOT NULL,
    ass_duration int(11)  NOT NULL,
    exam_unit int(11)  NOT NULL,
    test_unit int(11)  NOT NULL,
    ass_unit int(11)  NOT NULL,
    term varchar(50)  NOT NULL,
    session varchar(50)  NOT NULL,
    created_at varchar(50)  NOT NULL,
    updated_at varchar(50)  NOT NULL,
    PRIMARY KEY (id)
)");


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
    quest_type varchar(50)  NOT NULL,
    token varchar(255)  NOT NULL,
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
    quest_type varchar(50)  NOT NULL,
    token varchar(255)  NOT NULL,
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
    quest_type varchar(50)  NOT NULL,
    token varchar(255)  NOT NULL,
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
    ca1 int(11)  NOT NULL,
    ca2 int(11)  NOT NULL,
    ass int(11)  NOT NULL,
    exam int(11)  NOT NULL,
    total int(11)  NOT NULL,
    ft_score int(11)  NOT NULL,
    st_score int(11)  NOT NULL,
    tt_score int(11)  NOT NULL,
    class varchar(50)  NOT NULL,
    course varchar(255)  NOT NULL,
    course_code varchar(255)  NOT NULL,
    score int(11)  NOT NULL,
    paper_type text(50)  NOT NULL,
    term int(11)  NOT NULL,
    start_time varchar(255)  NOT NULL,
    end_time varchar(255)  NOT NULL,
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

$cr_class_tbl = $conn->query("CREATE TABLE IF NOT EXISTS `$class_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
");

if ($cr_class_tbl) {
  for($x = 1; $x <= count($classes['class']); $x++){
    $class = $classes['class'][$x];
    $check = $conn->query("SELECT * FROM $class_tbl WHERE class = '$class'");
    if($check->num_rows == 0){
      $insert = $conn->query("INSERT INTO $class_tbl (class) 
      VALUES('$class')");
    }
  }
}

$cr_session_tbl = $conn->query("CREATE TABLE IF NOT EXISTS `$session_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
");

if ($cr_session_tbl) {
  for($x = 1; $x <= count($sessions['session']); $x++){
    $session = $sessions['session'][$x];
    $check = $conn->query("SELECT * FROM $session_tbl WHERE session = '$session'");
    if($check->num_rows == 0){
      $insert = $conn->query("INSERT INTO $session_tbl (session) 
      VALUES('$session')");
    }
  }
}

$cr_evaluation = $conn->query("CREATE TABLE IF NOT EXISTS `$evaluation_tbl` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(225) NOT NULL,
    `term` int(11) NOT NULL,
    `session` varchar(50) NOT NULL,
    `adm_no` varchar(225) NOT NULL,
    `overall_score` int(11) NOT NULL,
    `out_of` int(11) NOT NULL,
    `percent_score` float(11) NOT NULL,
    `t_comment` varchar(500) NOT NULL,
    `p_comment` varchar(500) NOT NULL,
    `n_absent` int(11) NOT NULL,
    `n_present` int(11) NOT NULL,
    `punctuality` int(11) NOT NULL,
    `attentiveness` int(11) NOT NULL,
    `neatness` int(11) NOT NULL,
    `honesty` int(11) NOT NULL,
    `relationship` int(11) NOT NULL,
    `skills` int(11) NOT NULL,
    `sport` int(11) NOT NULL,
    `clubs` int(11) NOT NULL,
    `fluency` int(11) NOT NULL,
    `handwriting` int(11) NOT NULL,
    `position` varchar(255) NOT NULL,
    `promoted_to` varchar(225) NOT NULL,
    `next_term_date` varchar(225) NOT NULL,
    `class` varchar(225) NOT NULL,
    `status` varchar(225) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;");

$create_settings = $conn->query("CREATE TABLE IF NOT EXISTS $settings_tbl (
    id int(11) AUTO_INCREMENT NOT NULL,
    sch_name varchar(255) NOT NULL,
    sch_email varchar(255) NOT NULL,
    sch_support_email varchar(255) NOT NULL,
    fb_url int(11) NOT NULL,
    ig_url varchar(255) NOT NULL,
    tw_url varchar(255) NOT NULL,
    yt_url varchar(255) NOT NULL,
    sch_phone_1 varchar(255) NOT NULL,
    sch_phone_2 varchar(255) NOT NULL,
    current_session varchar(255) NOT NULL,
    current_term varchar(255) NOT NULL,
    sch_phone_2 varchar(255) NOT NULL,
    fl_sk_key varchar(255) NOT NULL,
    fl_pk_key varchar(255) NOT NULL,
    pt_sk_key varchar(255) NOT NULL,
    pt_pk_key varchar(255) NOT NULL,
    monnify_key varchar(255) NOT NULL,
    monnify_contract varchar(255) NOT NULL,
    monnify_secret varchar(255) NOT NULL,
    manual_acct varchar(255) NOT NULL,
    manual_acct_name varchar(255) NOT NULL,
    manual_acct_holder varchar(255) NOT NULL,
    announcement varchar(255) NOT NULL,
    pc varchar(255) NOT NULL,
    mc varchar(255) NOT NULL,
    mc_p varchar(255) NOT NULL,
    img varchar(255) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;");

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



// {"status":"Successful",
//   "statusCode":200,
//   "network":"GLO",
//   "denomination":"100",
//   "pinQuantity":"10",
//   "pins":{"1":"DITCOS2.scratch1.create,end_date=02/09/2025,pin="90649",scnum="3037909058",senum="3099983685705301",SCRPREF="100",SUSP_F="0";",
//           "2":"DITCOS2.scratch1.create,end_date=02/09/2025,pin="04198",scnum="3074047839",senum="3099983685705302",SCRPREF="100",SUSP_F="0";",
//           "3":"DITCOS2.scratch1.create,end_date=02/09/2025,pin="91402",scnum="3037124989",senum="3099983685705303",SCRPREF="100",SUSP_F="0";",
//           "4":"DITCOS2.scratch1.create,end_date=02/09/2025,pin="14825",scnum="3046637400",senum="3099983685705304",SCRPREF="100",SUSP_F="0";",
//           "5":"DITCOS2.scratch1.create,end_date=02/09/2025,pin="62577",scnum="3041685133",senum="3099983685705305",SCRPREF="100",SUSP_F="0";",
//           "6":"DITCOS2.scratch1.create,end_date=02/09/2025,pin="98212",scnum="3062317906",senum="3099983685705306",SCRPREF="100",SUSP_F="0";",
//           "7":"DITCOS2.scratch1.create,end_date=02/09/2025,pin="50645",scnum="3065860538",senum="3099983685705307",SCRPREF="100",SUSP_F="0";",
//           "8":"DITCOS2.scratch1.create,end_date=02/09/2025,pin="20970",scnum="3001756322",senum="3099983685705308",SCRPREF="100",SUSP_F="0";",
//           "9":"DITCOS2.scratch1.create,end_date=02/09/2025,pin="95567",scnum="3057839678",senum="3099983685705309",SCRPREF="100",SUSP_F="0";",
//           "10":"DITCOS2.scratch1.create,end_date=02/09/2025,pin="61552",scnum="3092139034",senum="3099983685705310",SCRPREF="100",SUSP_F="0";"},
//           "requestRef":"923h2dsX4Y51662096526|RC44731931662096496",
//           "wallet":1355
//   }
?>
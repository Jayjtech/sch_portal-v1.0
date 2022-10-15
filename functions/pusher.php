<?php
    include "../config/db.php";
    include "../includes/calls.php";
    $userId = $_SESSION['userId'];
    
    if(isset($_GET['department'])){
        $department = mysqli_real_escape_string($conn, $_GET['department']);
        $pre_class = mysqli_real_escape_string($conn, $_GET['pre_class']);
        $phone = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['phone']));
        $religion = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['religion']));
        $state_of_origin = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['state_of_origin']));
        $nationality = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['nationality']));
        $local_government = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['local_government']));
        $dob = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['dob']));
        $home_address = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['home_address']));
        $father_name = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['father_name']));
        $mother_name = htmlspecialchars(mysqli_real_escape_string($conn, $_GET['mother_name']));

        $update = $conn->query("UPDATE $users_tbl SET 
                            department = '$department',
                            pre_class = '$pre_class',
                            phone = '$phone',
                            religion = '$religion',
                            state_of_origin = '$state_of_origin',
                            nationality = '$nationality',
                            local_government = '$local_government',
                            dob = '$dob',
                            home_address = '$home_address',
                            father_name = '$father_name',
                            num_update = 1,
                            mother_name = '$mother_name'
                            WHERE userId = '$userId'
        ");
    if($update){
        $_SESSION['message'] = "Details successfully updated!";
        $_SESSION['msg_type'] = "success";
        $_SESSION['remedy'] = "";
    }else{
        $_SESSION['message'] = "Details could not be updated!";
        $_SESSION['msg_type'] = "success";
        $_SESSION['remedy'] = "";
    }
    header('location: ../bio');
    }


    if(isset($_POST['review_staff'])){
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $class_officiating = mysqli_real_escape_string($conn, $_POST['class_officiating']);
        $privileges = mysqli_real_escape_string($conn, $_POST['privileges']);
        $position = mysqli_real_escape_string($conn, $_POST['position']);
        $token = mysqli_real_escape_string($conn, $_POST['token']);
        $code_d = mysqli_real_escape_string($conn, $_POST['code_d']);
        $hashed_password = substr(md5($code_d), 4);
        $code_d = base64_encode($code_d);
        $staff_level = mysqli_real_escape_string($conn, $_POST['level']);

        $getSalary = $conn->query("SELECT * FROM $staff_level_tbl WHERE level = '$staff_level'");
        $sal = $getSalary->fetch_object();
        $salary = $sal->salary_amount;

        $update = $conn->query("UPDATE $users_tbl SET 
                        name='$name',
                        class_officiating='$class_officiating',
                        staff_level='$staff_level',
                        salary='$salary',
                        code_d='$code_d',
                        password='$hashed_password',
                        position='$position'
                        WHERE token = '$token'
                        ");

       if($update){
            $_SESSION['message'] = "Details successfully updated!";
            $_SESSION['msg_type'] = "success";
            $_SESSION['remedy'] = "";
        }else{
            $_SESSION['message'] = "Details could not be updated!";
            $_SESSION['msg_type'] = "error";
            $_SESSION['remedy'] = "Try again";
        }
        header('location: ../adm_staff?pod='.$token.'');
    }


    if(isset($_POST['review_student'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $curr_class = mysqli_real_escape_string($conn, $_POST['curr_class']);
    $token = mysqli_real_escape_string($conn, $_POST['token']);
    $tuition_discount = mysqli_real_escape_string($conn, $_POST['tuition_discount']);
    $award_type = mysqli_real_escape_string($conn, $_POST['award_type']);
    $sch_fee = mysqli_real_escape_string($conn, $_POST['sch_fee']);
    $ict = mysqli_real_escape_string($conn, $_POST['ict']);
    $music = mysqli_real_escape_string($conn, $_POST['music']);
    $health = mysqli_real_escape_string($conn, $_POST['health']);
    $transport = mysqli_real_escape_string($conn, $_POST['transport']);
    $sport = mysqli_real_escape_string($conn, $_POST['sport']);
    $excursion = mysqli_real_escape_string($conn, $_POST['excursion']);
    $vs_fee = mysqli_real_escape_string($conn, $_POST['vs_fee']);
    $pta = mysqli_real_escape_string($conn, $_POST['pta']);
    $development = mysqli_real_escape_string($conn, $_POST['development']);
    $reg_fee = mysqli_real_escape_string($conn, $_POST['reg_fee']);
    $uniform = mysqli_real_escape_string($conn, $_POST['uniform']);
    $sport_wear = mysqli_real_escape_string($conn, $_POST['sport_wear']);
    $cardigan = mysqli_real_escape_string($conn, $_POST['cardigan']);
    $id_card = mysqli_real_escape_string($conn, $_POST['id_card']);
    $handbook = mysqli_real_escape_string($conn, $_POST['handbook']);
    $sch_media = mysqli_real_escape_string($conn, $_POST['sch_media']);
    $security = mysqli_real_escape_string($conn, $_POST['security']);
    $lesson = mysqli_real_escape_string($conn, $_POST['lesson']);
    $club = mysqli_real_escape_string($conn, $_POST['club']);
    $boarding_fee = mysqli_real_escape_string($conn, $_POST['boarding_fee']);
    $vocational = mysqli_real_escape_string($conn, $_POST['vocational']);
    $sch_badge = mysqli_real_escape_string($conn, $_POST['sch_badge']);
    $others = mysqli_real_escape_string($conn, $_POST['others']);
    $others_covers = mysqli_real_escape_string($conn, $_POST['others_covers']);
    $adm_no = mysqli_real_escape_string($conn, $_POST['adm_no']);
    $code_d = mysqli_real_escape_string($conn, $_POST['code_d']);
    $hashed_password = substr(md5($code_d), 4);
    $code_d = base64_encode($code_d);
    
    /**Summing up all to get total */
        $actual_totalBill = $sch_fee+$ict+$music+$health+$transport+$sport+$excursion+$vs_fee+$pta+$development+$reg_fee+$uniform+$sport_wear+$cardigan+
        $id_card+$handbook+$sch_media+$security+$lesson+$club+$boarding_fee+$vocational+$sch_badge+$others;

    $compulsory_totalBill = 0;
    $getCompulsoryFees = $conn->query("SELECT * FROM $bill_setting_tbl WHERE status=1");
    while($gcsf = $getCompulsoryFees->fetch_assoc()){
        $list[] = $gcsf;
    }

    for($x = 0; $x<count($list); $x++){
        $li = $list[$x]['bill_name']; 
        $compulsory_totalBill = $compulsory_totalBill+$$li;
    }
       $update = $conn->query("UPDATE $users_tbl SET 
                            name='$name',
                            tuition_discount='$tuition_discount',
                            curr_class='$curr_class',
                            award_type='$award_type',
                            code_d='$code_d',
                            password='$hashed_password'
                            WHERE token = '$token'
                            ");

 //To ensure that The same class is not uploaded over and again
    $check = $conn->query("SELECT * FROM $bill_tbl WHERE (userId='$adm_no' AND session='$log_session' AND term='$log_term')");
     
                if($check->num_rows == 0){
                    $insert = $conn->query("INSERT INTO $bill_tbl SET
                                        name = '$name',
                                        class = '$curr_class',
                                        term = '$log_term', 
                                        session = '$log_session', 
                                        userId = '$adm_no', 
                                        sch_fee = '$sch_fee', 
                                        ict = '$ict', 
                                        health = '$health', 
                                        pta = '$pta', 
                                        sport = '$sport', 
                                        music = '$music', 
                                        excursion = '$excursion', 
                                        vs_fee = '$vs_fee', 
                                        transport = '$transport', 
                                        development = '$development', 
                                        others = '$others',
                                        reg_fee = '$reg_fee',
                                        uniform = '$uniform',
                                        sport_wear = '$sport_wear',
                                        cardigan = '$cardigan',
                                        id_card = '$id_card',
                                        handbook = '$handbook',
                                        sch_media = '$sch_media',
                                        security = '$security',
                                        lesson = '$lesson',
                                        club = '$club',
                                        boarding_fee = '$boarding_fee',
                                        vocational = '$vocational',
                                        sch_badge  = '$sch_badge',
                                        others_covers = '$others_covers',
                                        actual_total = '$actual_totalBill',
                                        compulsory_total = '$compulsory_totalBill',
                                        paid = '$compulsory_totalBill',
                                        outstanding = '$compulsory_totalBill'
                                        ");
            }else{
                $update2 = $conn->query("UPDATE $bill_tbl SET 
                            name = '$name',
                            sch_fee='$sch_fee',
                            ict='$ict',
                            sport='$sport',
                            music='$music',
                            health='$health',
                            transport='$transport',
                            excursion='$excursion',
                            vs_fee='$vs_fee',
                            pta='$pta',
                            development='$development',
                            others='$others',
                            reg_fee = '$reg_fee',
                            uniform = '$uniform',
                            sport_wear = '$sport_wear',
                            cardigan = '$cardigan',
                            id_card = '$id_card',
                            handbook = '$handbook',
                            sch_media = '$sch_media',
                            security = '$security',
                            lesson = '$lesson',
                            club = '$club',
                            boarding_fee = '$boarding_fee',
                            vocational = '$vocational',
                            sch_badge  = '$sch_badge',
                            others_covers='$others_covers',
                            actual_total = '$actual_totalBill',
                            compulsory_total = '$compulsory_totalBill',
                            paid = '$compulsory_totalBill',
                            outstanding = '$compulsory_totalBill'
                            WHERE userId = '$adm_no'
                            AND term = '$log_term' 
                            AND session = '$log_session'
                            ");
    }

       if($update){
            $_SESSION['message'] = "Details successfully updated!";
            $_SESSION['msg_type'] = "success";
            $_SESSION['remedy'] = "";
        }else{
            $_SESSION['message'] = "Details could not be updated!";
            $_SESSION['msg_type'] = "error";
            $_SESSION['remedy'] = "";
        }
        header('location: ../adm_students?rev='.$token.'&ac='.$adm_no.'');
    }


    if(isset($_POST['sch_name'])){
        $sch_name = mysqli_real_escape_string($conn, $_POST['sch_name']);
        $sch_motto = mysqli_real_escape_string($conn, $_POST['sch_motto']);
        $sch_email = mysqli_real_escape_string($conn, $_POST['sch_email']);
        $sch_support_email = mysqli_real_escape_string($conn, $_POST['sch_support_email']);
        $fb_url = mysqli_real_escape_string($conn, $_POST['fb_url']);
        $ig_url = mysqli_real_escape_string($conn, $_POST['ig_url']);
        $tw_url = mysqli_real_escape_string($conn, $_POST['tw_url']);
        $yt_url = mysqli_real_escape_string($conn, $_POST['yt_url']);
        $sch_phone_1 = mysqli_real_escape_string($conn, $_POST['sch_phone_1']);
        $sch_phone_2 = mysqli_real_escape_string($conn, $_POST['sch_phone_2']);
        $current_session = mysqli_real_escape_string($conn, $_POST['current_session']);
        $current_term = mysqli_real_escape_string($conn, $_POST['current_term']);
        $fl_sk_key = mysqli_real_escape_string($conn, $_POST['fl_sk_key']);
        $fl_pk_key = mysqli_real_escape_string($conn, $_POST['fl_pk_key']);
        $pt_sk_key = mysqli_real_escape_string($conn, $_POST['pt_sk_key']);
        $pt_pk_key = mysqli_real_escape_string($conn, $_POST['pt_pk_key']);
        $monnify_key = mysqli_real_escape_string($conn, $_POST['monnify_key']);
        $monnify_contract = mysqli_real_escape_string($conn, $_POST['monnify_contract']);
        $monnify_secret = mysqli_real_escape_string($conn, $_POST['monnify_secret']);
        $manual_acct = mysqli_real_escape_string($conn, $_POST['manual_acct']);
        $manual_acct_name = mysqli_real_escape_string($conn, $_POST['manual_acct_name']);
        $manual_acct_holder = mysqli_real_escape_string($conn, $_POST['manual_acct_holder']);

        $update = $conn->query("UPDATE $settings_tbl SET 
                            sch_name = '$sch_name',
                            sch_motto = '$sch_motto',
                            sch_email = '$sch_email',
                            sch_support_email = '$sch_support_email',
                            fb_url = '$fb_url',
                            ig_url = '$ig_url',
                            tw_url = '$tw_url',
                            yt_url = '$yt_url',
                            sch_phone_1 = '$sch_phone_1',
                            sch_phone_2 = '$sch_phone_2',
                            current_session = '$current_session',
                            current_term = '$current_term',
                            fl_sk_key = '$fl_sk_key',
                            fl_pk_key = '$fl_pk_key',
                            pt_sk_key = '$pt_sk_key',
                            pt_pk_key = '$pt_pk_key',
                            monnify_key = '$monnify_key',
                            monnify_contract = '$monnify_contract',
                            monnify_secret = '$monnify_secret',
                            manual_acct = '$manual_acct',
                            manual_acct_name = '$manual_acct_name',
                            manual_acct_holder = '$manual_acct_holder'
        ");
        if($update){
            $_SESSION['message'] = "Changes successfully saved!";
            $_SESSION['msg_type'] = "success";
            $_SESSION['remedy'] = "";
        }else{
            $_SESSION['message'] = "Changes could not be saved!";
            $_SESSION['msg_type'] = "success";
            $_SESSION['remedy'] = "";
        }
        header('location: ../adm_info?school_info');
    }


    /**Upload Bills */
    if(isset($_POST['push_bills'])){
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
                    $sch_fee  =  mysqli_real_escape_string($conn, $line[3]);
                    $reg_fee = mysqli_real_escape_string($conn, $line[4]);
                    $uniform = mysqli_real_escape_string($conn, $line[5]);
                    $sport_wear = mysqli_real_escape_string($conn, $line[6]);
                    $cardigan = mysqli_real_escape_string($conn, $line[7]);
                    $sch_badge = mysqli_real_escape_string($conn, $line[8]);
                    $id_card = mysqli_real_escape_string($conn, $line[9]);
                    $handbook = mysqli_real_escape_string($conn, $line[10]);
                    $lesson = mysqli_real_escape_string($conn, $line[11]);
                    $security = mysqli_real_escape_string($conn, $line[12]);
                    $sch_media = mysqli_real_escape_string($conn, $line[13]);
                    $club = mysqli_real_escape_string($conn, $line[14]);
                    $vocational = mysqli_real_escape_string($conn, $line[15]);
                    $boarding_fee = mysqli_real_escape_string($conn, $line[16]);
                    $ict  =  mysqli_real_escape_string($conn, $line[17]);
                    $health  =  mysqli_real_escape_string($conn, $line[18]);
                    $pta  =  mysqli_real_escape_string($conn, $line[19]);
                    $sport  =  mysqli_real_escape_string($conn, $line[20]);
                    $music  =  mysqli_real_escape_string($conn, $line[21]);
                    $excursion  =  mysqli_real_escape_string($conn, $line[22]);
                    $vs_fee  =  mysqli_real_escape_string($conn, $line[23]);
                    $transport  =  mysqli_real_escape_string($conn, $line[24]);
                    $development  =  mysqli_real_escape_string($conn, $line[25]);
                    $others =  mysqli_real_escape_string($conn, $line[26]);
                    $others_covers  =  mysqli_real_escape_string($conn, $line[27]);

                    $callName = $conn->query("SELECT * FROM $users_tbl WHERE (userId = '$adm_no')");
                    $nam = $callName->fetch_object();

                    $name = $nam->name;
                    $class = $nam->curr_class;

                        /**Summing up all to get total */
        $actual_totalBill = $sch_fee+$ict+$music+$health+$transport+$sport+$excursion+$vs_fee+$pta+$development+$reg_fee+$uniform+$sport_wear+$cardigan+
        $id_card+$handbook+$sch_media+$security+$lesson+$club+$boarding_fee+$vocational+$sch_badge+$others;

        $compulsory_totalBill = 0;

                    //To ensure that The same class is not uploaded over and again
                    $check = $conn->query("SELECT * FROM $bill_tbl WHERE (userId='$adm_no' AND session='$log_session' AND term='$log_term')");

                    //insert data from CSV file 
                    if ($check->num_rows == 0) {
                        $insert = $conn->query("INSERT INTO $bill_tbl  SET
                                                name = '$name',
                                                class = '$class',
                                                term = '$log_term', 
                                                session = '$log_session', 
                                                userId = '$adm_no', 
                                                sch_fee = '$sch_fee', 
                                                ict = '$ict', 
                                                health = '$health', 
                                                pta = '$pta', 
                                                sport = '$sport', 
                                                music = '$music', 
                                                excursion = '$excursion', 
                                                vs_fee = '$vs_fee', 
                                                transport = '$transport', 
                                                development = '$development', 
                                                others = '$others',
                                                reg_fee = '$reg_fee',
                                                uniform = '$uniform',
                                                sport_wear = '$sport_wear',
                                                cardigan = '$cardigan',
                                                id_card = '$id_card',
                                                handbook = '$handbook',
                                                sch_media = '$sch_media',
                                                security = '$security',
                                                lesson = '$lesson',
                                                club = '$club',
                                                boarding_fee = '$boarding_fee',
                                                vocational = '$vocational',
                                                sch_badge  = '$sch_badge',
                                                others_covers = '$others_covers',
                                                actual_total = '$actual_totalBill',
                                                compulsory_total = '$compulsory_totalBill',
                                                paid = '$compulsory_totalBill',
                                                outstanding = '$compulsory_totalBill'
                                              ");
                        

              
                        
                    } else {
                        $update = $conn->query("UPDATE $bill_tbl SET
                                        sch_fee='$sch_fee',
                                        ict='$ict',
                                        sport='$sport',
                                        music='$music',
                                        health='$health',
                                        transport='$transport',
                                        excursion='$excursion',
                                        vs_fee='$vs_fee',
                                        pta='$pta',
                                        development='$development',
                                        others='$others',
                                        reg_fee = '$reg_fee',
                                        uniform = '$uniform',
                                        sport_wear = '$sport_wear',
                                        cardigan = '$cardigan',
                                        id_card = '$id_card',
                                        handbook = '$handbook',
                                        sch_media = '$sch_media',
                                        security = '$security',
                                        lesson = '$lesson',
                                        club = '$club',
                                        boarding_fee = '$boarding_fee',
                                        vocational = '$vocational',
                                        sch_badge  = '$sch_badge',
                                        others_covers='$others_covers',
                                        actual_total = '$actual_totalBill',
                                        compulsory_total = '$compulsory_totalBill',
                                        paid = '$compulsory_totalBill',
                                        outstanding = '$compulsory_totalBill'
                                        WHERE userId = '$adm_no' 
                                        AND term = '$log_term' 
                                        AND session = '$log_session'
                                        ");
                    }
                }
                  if($insert){
                        $_SESSION['message'] = "Bills have been uploaded!";
                        $_SESSION['msg_type'] = "success";
                        $_SESSION['remedy'] = "";
                    }else if($update){
                        $_SESSION['message'] = "Bills have been uploaded!";
                        $_SESSION['msg_type'] = "success";
                        $_SESSION['remedy'] = "";
                    }else{
                        $_SESSION['message'] = "Bill could not be updated!";
                        $_SESSION['msg_type'] = "error";
                        $_SESSION['remedy'] = "This could be due to server error";
                    }
            }
        }
         header("location: ../adm_revenue?revenue");
 fclose($csvFile);
    }


if(isset($_POST['create_payroll'])){
    $disburser = $_POST['disburser'];
    $disbursement_id = $_POST['disbursement_id'];
    $pay_month = mysqli_real_escape_string($conn, $_POST['month']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $insert = $conn->query("INSERT INTO $payroll_title_tbl SET
                            disburser = '$disburser',
                            disbursement_id = '$disbursement_id',
                            month = '$pay_month',
                            description = '$description'
    ");
    if($insert){
        $_SESSION['message'] = 'Payroll successfully created for the month of '.$pay_month.'.';
        $_SESSION['msg_type'] = "success";
        $_SESSION['remedy'] = "";
    }else{
        $_SESSION['message'] = 'Payroll could not be created for the month of '.$pay_month.'.';
        $_SESSION['msg_type'] = "error";
        $_SESSION['remedy'] = "";
    }
    header('location: ../adm_disbursement?create_payroll');
}


if(isset($_POST['add_to_payroll'])){
    $bankDet = base64_decode($_POST['bankDet']);
    $staffName = $_POST['name'];
    $token = mysqli_real_escape_string($conn, $_POST['token']);
    $staffId = mysqli_real_escape_string($conn, $_POST['userId']);
    $staffToken = mysqli_real_escape_string($conn, $_POST['token']);
    $salary = mysqli_real_escape_string($conn, $_POST['salary']);
    $payrollTitle = $_POST['payrollTitle'];
    $ln_debt = $_POST['ln_debt'];
    
    
    if($ln_debt != 0){
        /**This show that the staff has a loan debt */
        $getLoanDet = $conn->query("SELECT * FROM $loan_tbl WHERE amount != '' AND token='$staffToken' ORDER BY id DESC LIMIT 1");
        /**We need to get the initial amount of the loan, in order to calculate what percentage to deduct from the salary */
        $init = $getLoanDet->fetch_object();
        $balance = $init->balance;
        /**Getting loan refund rate */
        $refund_rate = ($admin_det->loan_refund_rate/100);
        $casual_refund_amount = ($refund_rate*$balance);

        if($ln_debt > $casual_refund_amount){
            /**If the debt is greater than the calculated percentage */
            $left_over = 0;
            $loan_credit = $casual_refund_amount;
        }else if($ln_debt == $casual_refund_amount){
            /**If the debt is equal to the calculated percentage */
            $left_over = 0;
            $loan_credit = $casual_refund_amount;
        }else if($ln_debt < $casual_refund_amount){
            /**If the debt is lesser than the calculated percentage */
            $left_over = ($casual_refund_amount-$ln_debt);
            $loan_credit = $ln_debt;
        }
    }else{
        $left_over = 0;
        $loan_credit = 0;
    }
    /**Final amount to disburse as salary for the staff */ 
    $disbursement_amount = ($salary-$loan_credit+$left_over);
    /**End */
    
// echo 'Actual salary: '.$salary.'<br>';
// echo 'Loan credit: '.$loan_credit.'<br>';
// echo 'Salary for the month: '.$disbursement_amount.'<br>';
// exit();
    $check = $conn->query("SELECT * FROM $payroll_title_tbl WHERE disbursement_id='$payrollTitle'");
    $desc = $check->fetch_object();
    $description = $desc->description;
    $pay_month = $desc->month;

    $check_staff = $conn->query("SELECT * FROM $payroll_tbl WHERE userId='$staffId' AND disbursement_id='$payrollTitle'");
    if($check_staff->num_rows == 0){
    $insert = $conn->query("INSERT INTO $payroll_tbl SET
                            userId = '$staffId',
                            staffToken = '$staffToken',
                            bankDet = '$bankDet',
                            name = '$staffName',
                            date = '$date',
                            amount = '$salary',
                            ln_debt = '$ln_debt',
                            loan_credit = '$loan_credit',
                            disbursement_amount = '$disbursement_amount',
                            payment_month = '$pay_month',
                            disbursement_id = '$payrollTitle',
                            description = '$description'
                            ");
    if($insert){
        $_SESSION['message'] = ''.$staffName.' successfully added to the disbursement list for '.$pay_month.'.';
        $_SESSION['msg_type'] = "success";
        $_SESSION['remedy'] = "";
    }else{
        $_SESSION['message'] = ''.$staffName.' could not be added to the disbursement list for '.$pay_month.'.';
        $_SESSION['msg_type'] = "error";
        $_SESSION['remedy'] = "";
    }
}else{
    $_SESSION['message'] = ''.$staffName.' already exist on the disbursement list for '.$pay_month.'.';
    $_SESSION['msg_type'] = "warning";
    $_SESSION['remedy'] = "";
}
    header('location: ../adm_disbursement?staff_list');
}


if(isset($_POST['staff_level'])){
    $staff_level = $_POST['staff_level'];
    $salary_amount = mysqli_real_escape_string($conn, stripcslashes($_POST['salary_amount']));
    
    $check = $conn->query("SELECT * FROM $staff_level_tbl WHERE level='$staff_level'");
    if($check->num_rows == 0){
        $insert = $conn->query("INSERT INTO $staff_level_tbl SET 
                                 level='$staff_level',
                                salary_amount='$salary_amount'
                            ");
    }else{
        $update = $conn->query("UPDATE $staff_level_tbl SET 
                            salary_amount='$salary_amount'
                            WHERE level='$staff_level'
                            ");
        }
        $update_users = $conn->query("UPDATE $users_tbl SET 
                            salary ='$salary_amount'
                            WHERE staff_level = '$staff_level'
                        ");
        if($insert){
            $_SESSION['message'] = 'Level '.$staff_level.' has been saved.';
            $_SESSION['msg_type'] = "success";
            $_SESSION['remedy'] = "";
        }else if($update){
            $_SESSION['message'] = 'Level '.$staff_level.' has been updated.';
            $_SESSION['msg_type'] = "success";
            $_SESSION['remedy'] = "";
        }else{
            $_SESSION['message'] = 'An error occurred during the process!';
            $_SESSION['msg_type'] = "error";
            $_SESSION['remedy'] = "";
        }
       header('location: ../adm_disbursement?staff_level');
}

if(isset($_POST['set_disbursement_key'])){
    $disbursement_source = mysqli_real_escape_string($conn, $_POST['disbursement_source']);
    $disbursement_key = mysqli_real_escape_string($conn, $_POST['disbursement_key']);
    $code_d = base64_encode($disbursement_key);
    $hashed_key = substr(md5($disbursement_key), 4);

    $update = $conn->query("UPDATE $settings_tbl SET 
                        code_d = '$code_d',
                        disbursementSource = '$disbursement_source',
                        disbursement_key = '$hashed_key'
                    ");

        if($update){
            $_SESSION['message'] = 'Changes successfully saved!';
            $_SESSION['msg_type'] = "success";
            $_SESSION['remedy'] = "";
        }else{
             $_SESSION['message'] = 'An error occurred during the process!';
            $_SESSION['msg_type'] = "error";
            $_SESSION['remedy'] = "";
        }
        header('location: ../adm_info?disbursement_key');
}
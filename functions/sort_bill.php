<?php
    include "../config/db.php";
    include "../includes/calls.php";
    if(isset($_POST['sort_bill'])){
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
        $total_amount = mysqli_real_escape_string($conn, $_POST['total_amount']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);

        
        $getWalletBal = $conn->query("SELECT * FROM $users_tbl WHERE userId='$adm_no'");
        $gtw = $getWalletBal->fetch_object();

        if($total_amount < 1){
            $_SESSION['message'] = 'Invalid amount you have to pay!';
            $_SESSION['msg_type'] = 'error';
            $_SESSION['remedy'] = '';
        }else{
        if($gtw->wallet > $total_amount){
           
            $getBill = $conn->query("SELECT * FROM $bill_tbl WHERE (userId='$adm_no' AND term='$log_term' AND session='$log_session')");
            $bil = $getBill->fetch_object();

            /**Setting variables */                            
            $student_name = $gtw->name;
            $student_class = $gtw->curr_class;
            $wallet_before = $gtw->wallet;
            $wallet_after = ($gtw->wallet-$total_amount);
            $outstanding_before = $bil->outstanding;
            $outstanding_after = ($bil->outstanding-$total_amount);

            /**DEDUCT FROM WALLET */
            $updateWallet = $conn->query("UPDATE $users_tbl SET wallet='$wallet_after' WHERE (userId='$adm_no')");

            /**Deduct from bills */
            $sch_fee_bal = ($bil->sch_fee-$sch_fee);
            $ict_bal = ($bil->ict-$ict);
            $music_bal = ($bil->music-$music);
            $health_bal = ($bil->health-$health);
            $sport_bal = ($bil->sport-$sport);
            $excursion_bal = ($bil->excursion-$excursion);
            $vs_fee_bal = ($bil->vs_fee-$vs_fee);
            $pta_bal = ($bil->pta-$pta);
            $development_bal = ($bil->development-$development);
            $others_bal = ($bil->others-$others);
            $transport_bal = ($bil->transport-$transport);
            $reg_fee_bal = ($bil->reg_fee-$reg_fee); 
            $uniform_bal = ($bil->uniform-$uniform); 
            $sport_wear_bal = ($bil->sport_wear-$sport_wear);
            $cardigan_bal = ($bil->cardigan-$cardigan); 
            $id_card_bal = ($bil->id_card-$id_card); 
            $handbook_bal = ($bil->handbook-$handbook); 
            $sch_media_bal = ($bil->sch_media-$sch_media); 
            $security_bal = ($bil->security-$security); 
            $lesson_bal = ($bil->lesson-$lesson); 
            $club_bal = ($bil->club-$club); 
            $boarding_fee_bal = ($bil->boarding_fee-$boarding_fee); 
            $vocational_bal = ($bil->vocational-$vocational); 
            $sch_badge_bal = ($bil->sch_badge-$sch_badge); 


            $total_bal = ($bil->compulsory_total-$total_amount);

            if($updateWallet){
                $update = $conn->query("UPDATE $bill_tbl SET 
                                sch_fee='$sch_fee_bal',
                                ict='$ict_bal',
                                sport='$sport_bal',
                                music='$music_bal',
                                health='$health_bal',
                                transport='$transport_bal',
                                excursion='$excursion_bal',
                                vs_fee='$vs_fee_bal',
                                pta='$pta_bal',
                                development='$development_bal',
                                others='$others_bal',
                                reg_fee = '$reg_fee_bal',
                                uniform = '$uniform_bal',
                                sport_wear = '$sport_wear_bal',
                                cardigan = '$cardigan_bal',
                                id_card = '$id_card_bal',
                                handbook = '$handbook_bal',
                                sch_media = '$sch_media_bal',
                                security = '$security_bal',
                                lesson = '$lesson_bal',
                                club = '$club_bal',
                                boarding_fee = '$boarding_fee_bal',
                                vocational = '$vocational_bal',
                                sch_badge  = '$sch_badge_bal',
                                compulsory_total = '$outstanding_after',
                                paid = '$total_amount',
                                outstanding = '$outstanding_after'
                                WHERE userId = '$adm_no'
                                AND term = '$log_term' 
                                AND session = '$log_session'
                                ");
        

        /**Creating receipt */

        $receipt = [
            "sch_fee" => "$sch_fee",
            "ict" => "$ict",
            "sport" => "$sport",
            "music" => "$music",
            "health" => "$health",
            "transport" => "$transport",
            "excursion" => "$excursion",
            "vs_fee" => "$vs_fee",
            "pta" => "$pta",
            "development" => "$development",
            "others" => "$others",
            "reg_fee" => "$reg_fee",
            "uniform" => "$uniform",
            "sport_wear" => "$sport_wear",
            "cardigan" => "$cardigan",
            "id_card" => "$id_card",
            "handbook" => "$handbook",
            "sch_media" => "$sch_media",
            "security" => "$security",
            "lesson" => "$lesson",
            "club" => "$club",
            "boarding_fee" => "$boarding_fee",
            "vocational" => "$vocational",
            "sch_badge"  => "$sch_badge"
        ];

        $receipt = json_encode($receipt);

        $report = $conn->query("INSERT INTO $bill_report_tbl SET
                            name = '$student_name',
                            class = '$student_class',
                            amount_paid = '$total_amount',
                            wallet_before = '$wallet_before',
                            wallet_after = '$wallet_after',
                            outstanding_before = '$outstanding_before',
                            outstanding_after = '$outstanding_after',
                            description = '$description',
                            receipt = '$receipt',
                            date = '$date',
                            bursar = '$name',
                            adm_no = '$adm_no',
                            term = '$log_term',
                            session = '$log_session'
                ");

            if($report){
                $_SESSION['message'] = 'Transaction successful!';
                $_SESSION['msg_type'] = 'success';
                $_SESSION['remedy'] = '';
            }
        }
        }else{
            $_SESSION['message'] = 'Wallet balance too low!';
            $_SESSION['msg_type'] = 'error';
            $_SESSION['remedy'] = '';
        }
    }
    header('location: ../adm_revenue?sort_bill='.$adm_no.'');
}
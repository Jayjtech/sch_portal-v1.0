<?php
require_once __DIR__ . '/vendor/autoload.php';
include "config/db.php";
include "includes/calls.php";

if (isset($_GET['result_code'])) {
    $result_code = $_GET['result_code'];
    $checkResultPeriod = $conn->query("SELECT * FROM $result_checker_tbl WHERE (code = '$result_code' AND adm_no='$userId')");

    if ($checkResultPeriod->num_rows == 0) {
        $_SESSION['message'] = 'This is an invalid code';
        $_SESSION['msg_type'] = 'warning';
        $_SESSION['remedy'] = 'Use a valid result checker code';
        $_SESSION['btn'] = 'Okay';
        header('location: approved_result');
    } else {
        $re = $checkResultPeriod->fetch_object();
        $re_term = $re->term;
        $re_session = $re->session;

        switch ($re_term) {
            case 1:
                $re_term_syntax = "First";
                $header = "First Term Result Sheet";
                break;
            case 2:
                $re_term_syntax = "Second";
                $header = "Second Term Result Sheet";
                break;
            case 3:
                $re_term_syntax = "Third";
                $header = "Third Term Result Sheet";
                break;
        }
      
        $getResult = $conn->query("SELECT * FROM $score_tbl WHERE (adm_no = '$userId' AND term= '$re_term' AND session='$re_session')");
        
        $getEvaluations = $conn->query("SELECT * FROM $evaluation_tbl WHERE (adm_no = '$userId' AND term= '$re_term' AND session='$re_session')");
        $gE = $getEvaluations->fetch_object();

        $firstTermevaluations = $conn->query("SELECT * FROM $evaluation_tbl WHERE (adm_no= '$userId' AND term =1 AND session = '$re_session')");
        $SecondTermevaluations = $conn->query("SELECT * FROM $evaluation_tbl WHERE (adm_no= '$userId' AND term =2 AND session = '$re_session')");
        $ThirdTermevaluations = $conn->query("SELECT * FROM $evaluation_tbl WHERE (adm_no= '$userId' AND term =3 AND session = '$re_session')");       
        $rowF = $firstTermevaluations->fetch_object();
        $rowS = $SecondTermevaluations->fetch_object();
        $rowT = $ThirdTermevaluations->fetch_object();
        
        // echo $rowF->name;
        // exit();
$mpdf = new \Mpdf\Mpdf();

        //create new pdf
$data = '<!DOCTYPE html>
        <html>
        <head>
            <title>Result Sheet</title>
            <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">
            <!-- <link rel="stylesheet" href="sass/main.css" media="screen" charset="utf-8"/> -->
            <meta content="width=device-width, initial-scale=1.0" name="viewport">
            <meta http-equiv="content-type" content="text-html; charset=utf-8">
            <link rel="stylesheet" href="result.css">
        </head>
        ';
 
$data .= '<body>
<header class="">
    <div class="container">
          <figure>';
                    if($admin_det->img == true):
                        $data .='<img class="" src="images/' . $admin_det->img . '">';
                    endif;
        $data .='
            </figure>
        <div class="company-address">
            <h2 class="title">' . $admin_det->sch_name . '</h2>
            <h5 style="text-align:center;margin-top: -22px;">Motto: ' . $admin_det->sch_motto . '</h5>
            <p style="text-align:center;">
                ' . $admin_det->sch_address . '<br>
                ' . $admin_det->sch_phone_1 . '/' . $admin_det->sch_phone_2 . '. Email: ' . $admin_det->sch_email . '
            </p>
        </div>
        
    </div>
</header>';

$syntax = "Student's name";

$data .= '<section style="margin-top:0;">
        <div class="container">
            <div class="details clearfix">
                <div class="client left">
                    <h1>Report for ' . $re_term_syntax . ' Term | ' . $re_session. '</h1>
                    <p class="name">' . $syntax . ': ' . $det->name . ', Class:<em> ' . $det->curr_class . ' </em></p>
                    <p>Admission Number: ' . $det->userId . '</p>
                    <p>Attendance: <strong><em>' . $gE->n_present . '</em></strong> of <strong><em>' . ($gE->n_absent + $gE->n_present) . '</em></strong></p>
                </div>
                <div class="data right">
                <img style="width:30%;height:25%;float:left;" src="images/profile/' . $p_img . '" alt="Profile Image">
                    <div class="date">
                    <span> Print date: ' . $date . '</span><br>
                    <span> Result Pin: ' . $result_code . '</span>
                    </div>
                </div>
            </div>';

$data .= '
<table border="0" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <th style="text-align:center;" class="">Subject</th>
            <th style="text-align:center;" class="">Ass</th>
            <th style="text-align:center;" class="">CA1</th>
            <th style="text-align:center;" class="">CA2</th>
            <th style="text-align:center;" class="">CA3</th>
            <th style="text-align:center;" class="">Exam</th>
            <th style="text-align:center;" class="">AVG</th>
            ';
        if ($re_term == 1) {
            $data .= '<th style="text-align:center;" class="">FT</th>';
        }else if($re_term == 2){
            $data .= '<th style="text-align:center;" class="">FT</th>
                      <th style="text-align:center;" class="">ST</th>';
        }else if($re_term == 3){
            $data .= '<th style="text-align:center;" class="">FT</th>
                      <th style="text-align:center;" class="">ST</th>
                      <th style="text-align:center;" class="">TT</th>';
        }
       
            $data .= ' <th style="text-align:center;" class="">Cumulative</th>';
        $data .= '
            <th style="text-align:center;" class="">Grade</th>
            <th style="text-align:center;" class="">Position</th>
            <th style="text-align:center;" class="">Remarks</th>
        </tr>
    </thead>';
        while ($row = $getResult->fetch_object()) :
            $data .= '  	
    <tbody>
        <tr> 
           <td style="text-align:center;color:#000;">' . $row->course . '</td>
           <td style="text-align:center;color:#000;">' . $row->ass . '</td>
           <td style="text-align:center;color:#000;">' . $row->ca1 . '</td>
           <td style="text-align:center;color:#000;">' . $row->ca2 . '</td>
           <td style="text-align:center;color:#000;">' . $row->ca3 . '</td>
           <td style="text-align:center;color:#000;">' . $row->exam . '</td>
           <td style="text-align:center;color:#000;">' . $row->total . '</td>';
           
           if ($re_term == 1) {
                $data .= '<td style="text-align:center;color:#000;">' . $row->ft_score . '</td>';
            }else if($re_term == 2){
                $data .= '<td style="text-align:center;color:#000;">' . $row->ft_score . '</td>
                        <td style="text-align:center;color:#000;">' . $row->st_score . '</td>
                ';
            }else if($re_term == 3){
                $data .= '
                    <td style="text-align:center;color:#000;">' . $row->ft_score . '</td>
                    <td style="text-align:center;color:#000;">' . $row->st_score . '</td>
                    <td style="text-align:center;color:#000;">' . $row->tt_score . '</td>
                ';
            }

                $data .= ' <td style="text-align:center;color:#000;">' . $row->cumulative . '</td>';
            $data .= '
                <td style="font-weight:bold;text-align:center;padding:10px;border-radius:10px;">' . $row->grade . '</td>
                <td style="text-align:center;color:#000;">' . $row->position . '</td>
                <td style="text-align:center;">' . $row->remark . '</td>
        </tr>
    </tbody>';
        endwhile;
        $data .= '</table>';


        $data .= '
<div style="width:70%;margin-top:3px;">
<p class="name"><strong>EVALUATIONS</strong> </p>
<table border="0" cellspacing="0" cellpadding="0">
     <thead>
         <tr>
             <th style="text-align:center;">Overall Score</th>
             <th style="text-align:center;">Out of</th>
             <th style="text-align:center;">Percent Score</th>
             <th style="text-align:center;">Position</th>
         </tr>
     </thead>
     <tr>
         <td style="text-align:center;">' . $gE->overall_score . '</td>
         <td style="text-align:center;">' . $gE->out_of . '</td>
         <td style="text-align:center;">' . number_format($gE->percent_score) . ' %</td>
         <td style="text-align:center;">' . $gE->position . '</td>
     </tr>
</table>   
</div>

<div style="width:70%;margin-top:10px;">
<p class="name"><strong>PREVIOUS RESULTS</strong> </p>
<table border="0" cellspacing="0" cellpadding="0">
     <thead>
         <tr>';
        if ($re_term == 1) {
            $data .= '<th style="text-align:center;">First Term</th>';
        }else if ($re_term == 2) {
            $data .= '<th style="text-align:center;">First Term</th>';
            $data .= '<th style="text-align:center;">Second Term</th>';
        }else if ($re_term == 3) {
            $data .= '<th style="text-align:center;">First Term</th>
            <th style="text-align:center;">Second Term</th>
            <th style="text-align:center;">Third Term</th>';
        }
        if (($firstPercent_score != 0) && ($secondPercent_score != 0)) {
            $data .= '
             <th style="text-align:center;">Overall</th>';
        }
        $data .= '
                 
             </tr>
         </thead>
         <tr>';
        if ($re_term == 1) {
            $total_percent = ($rowF->percent_score / 1);
            $data .= '<td style="text-align:center;">' . number_format($rowF->percent_score, 2) . '%</td>';
        }else if ($re_term == 2) {
            $total_percent = (($rowF->percent_score + $rowS->percent_score) / 2);
            $data .= '<td style="text-align:center;">' . number_format($rowF->percent_score, 2) . '%</td>
            <td style="text-align:center;">' . number_format($rowS->percent_score, 2) . '%</td>';
        }else if ($re_term == 3) {
            $total_percent = (($rowF->percent_score + $rowS->percent_score + $rowT->percent_score) / 3);
            $data .= '<td style="text-align:center;">' . number_format($rowF->percent_score, 2) . '%</td>
                 <td style="text-align:center;">' . number_format($rowS->percent_score, 2) . '%</td>
             <td style="text-align:center;">' . number_format($rowT->percent_score, 2) . '%</td>';
        }
        if (($rowF->percent_score != 0) && ($rowS->percent_score != 0)) {
            $data .= '
             <td style="text-align:center;">' . number_format($total_percent, 2) . '%</td>';
        }
        $data .= '
         </tr>
    </table>   
    </div>    
    ';

        $data .= '
   <div class="" style="margin-top:10px;">
           <div class="client left">
               <h1>Keys</h1>
               <p>5 - Excellent, 4 - V.good, 3 - Good, 2 - Fair, 1 - Poor.</p>
           </div>
    </div>
    ';

        $data .= '
<div style="width:45%; float:left; margin-top:20px;">
<p class="name"><strong>AFFECTIVE DOMAIN</strong></p>
<table border="0" cellspacing="0" cellpadding="0">
     <thead>
         <tr>
            <th style="text-align:left;" width:20%;>Punctuality</th>
            <th style="text-align:center;" width:10%;>' . $gE->punctuality . '</th>
         </tr>
         <tr>
            <th style="text-align:left;"  width:20%;>Attentiveness</th>
            <th style="text-align:center;" width:10%;>' . $gE->attentiveness . '</th>
         </tr>
         <tr>
            <th style="text-align:left;"  width:20%;>Neatness</th>
            <th style="text-align:center;" width:10%;>' . $gE->neatness . '</th>
        </tr>
         <tr>
            <th style="text-align:left;" width:20%;>Honesty</th>
            <th style="text-align:center;" width:10%;>' . $gE->honesty . '</th>
         </tr>
         <tr>
            <th style="text-align:left;"  width:20%;>Relationship with others</th>
            <th style="text-align:center;" width:10%;>' . $gE->relationship . '</th>
         </tr>
         
     </thead>  
</table>   
</div>    
';

        $data .= '
<div style="width:45%; margin-left:; ">
<p class="name"><strong>PSYCHOMOTOR DOMAIN</strong></p>
<table border="0" cellspacing="0" cellpadding="0">
     <thead>
         <tr>
            <th style="text-align:left;" width:20%;>Skills in Co-curriculars</th>
            <th style="text-align:center;" width:10%;>' . $gE->skills . '</th>
         </tr>
         <tr>
            <th style="text-align:left;"  width:20%;>Sports/Games</th>
            <th style="text-align:center;" width:10%;>' . $gE->sport . '</th>
         </tr>
         <tr>
            <th style="text-align:left;"  width:20%;>Clubs/Societies</th>
            <th style="text-align:center;" width:10%;>' . $gE->clubs . '</th>
        </tr>
         <tr>
            <th style="text-align:left;"  width:20%;>Fluency</th>
            <th style="text-align:center;" width:10%;>' . $gE->fluency . '</th>
        </tr>
         <tr>
            <th style="text-align:left;"  width:20%;>Handwriting</th>
            <th style="text-align:center;" width:10%;>' . $gE->handwriting . '</th>
        </tr>
     </thead>  
</table>   
</div>    
';

        $syntaxT = "Teacher's";
        $syntaxP = "Principal's";
        // <p><strong>' . $syntaxP . ' Signature:</strong> <img class="" src="admin/' . $p_signature . '" width="100"> </p>
        $data .= '
<div class="" style="margin-top:20px;">
    <div class="details clearfix">
        <div class="client left">
            <p><strong>' . $syntaxT . ' comment:</strong> ' . $gE->t_comment . ' </p>
            <p><strong>' . $syntaxP . ' comment:</strong> ' . $gE->p_comment . ' </p>
            
        </div>
        <div class="data right">
            <div class="date">
            ';
            if($re_term == 3){
                $data .= '<p class="name"><strong>Promoted to:</strong> ' . $gE->promoted_to . '</p>';
            }
              $data .= '<p><strong>Next term begins:</strong> ' . $gE->next_term_date . '</p>
            </div>
        </div>
    </div>
    ';

        $data .= '
<footer>
<div class="container">
    <div class="end">Statement of result was generated on a computer using a valid <b>result checker pin</b> and is valid without seal.</div>
</div>
</footer>
    ';
        $mpdf->WriteHTML($data);
        $mpdf->Output();
    }
}
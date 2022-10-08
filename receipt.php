<?php
require_once __DIR__ . '/vendor/autoload.php';
include "config/db.php";
$compulsoryBillSettings = $conn->query("SELECT * FROM $bill_setting_tbl");
if(isset($_POST['receipt'])){
    $id = $_POST['receipt'];
    $getReceipt = $conn->query("SELECT * FROM $bill_report_tbl WHERE id='$id'");
    $rec = $getReceipt->fetch_object();
    
    $rec_array = json_decode($rec->receipt);
    $sch_fee = $rec_array->sch_fee;
    $ict = $rec_array->ict; 
    $health = $rec_array->health; 
    $pta = $rec_array->pta; 
    $sport = $rec_array->sport; 
    $music = $rec_array->music; 
    $excursion = $rec_array->excursion; 
    $vs_fee = $rec_array->vs_fee; 
    $transport = $rec_array->transport; 
    $development = $rec_array->development; 
    $others = $rec_array->others;
    $reg_fee = $rec_array->reg_fee;
    $uniform = $rec_array->uniform;
    $sport_wear = $rec_array->sport_wear;
    $cardigan = $rec_array->cardigan;
    $id_card = $rec_array->id_card;
    $handbook = $rec_array->handbook;
    $sch_media = $rec_array->sch_media;
    $security = $rec_array->security;
    $lesson = $rec_array->lesson;
    $club = $rec_array->club;
    $boarding_fee = $rec_array->boarding_fee;
    $vocational = $rec_array->vocational;
    $sch_badge  = $rec_array->sch_badge;

        switch ($rec->term) {
            case 1:
                $re_term_syntax = "First";
                break;
            case 2:
                $re_term_syntax = "Second";
                break;
            case 3:
                $re_term_syntax = "Third";
                break;
        }
        $header = "Receipt";
    $mpdf = new \Mpdf\Mpdf();

        //create new pdf
$data = '<!DOCTYPE html>
        <html>
        <head>
            <title>Receipt</title>
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
            <div class="details clearfix" style="font-size:18px;">
                <div class="client left">
                    <h1>Receipt for ' . $re_term_syntax . ' Term | ' . $rec->session. '</h1>
                    <p class="name">' . $syntax . ': ' . $rec->name . ', Class:<em> ' . $rec->class . ' </em></p>
                    <p>Admission Number: ' . $rec->adm_no . '</p>
                </div>
                <div class="data right">
                    <div class="date">
                    <span> Payment date: ' . $rec->date . '</span><br>
                    <span> Bursar: ' . $rec->bursar . '</span>
                    </div>
                </div>
            </div>';

$data .= '
<table border="0" cellspacing="0" cellpadding="0">
    <thead>
        <tr>
            <th style="text-align:left; font-size:18px;" class="">Bill Title</th>
            <th style="text-align:left;font-size:18px;" class="">Amount Paid</th>
        </tr>
    </thead>';
       
$data .= '
<tbody>
';
 while($row = $compulsoryBillSettings->fetch_object()):
            $bill_name = $row->bill_name;
    if($$bill_name == true):
        $data .= '
            <tr> 
                <td style="text-align:left;color:#000;padding-left:20px;font-size:18px;">' . $row->bill_title . '</td>
                <td style="text-align:left;color:#000;padding-left:20px;font-size:18px;">'.$currency.'' . number_format($$bill_name) . '</td>
            </tr>
                ';
    endif;
 endwhile;
    $data .=' 
    <thead>
        <tr>
            <th style="text-align:left;font-size:15px;" class="">Total amount paid</th>
            <th style="text-align:left;font-size:15px;" class="">'.$currency.'' . number_format($rec->amount_paid).'</th>
        </tr>
        <tr>
            <th style="text-align:left;font-size:15px;" class="">Outstanding after payment</th>
            <th style="text-align:left;font-size:15px;" class="">'.$currency.'' . number_format($rec->outstanding_after).'</th>
        </tr>
        <tr>
            <th style="text-align:left;font-size:15px;" class="">Wallet balance after payment</th>
            <th style="text-align:left;font-size:15px;" class="">'.$currency.'' . number_format($rec->wallet_after).'</th>
        </tr>
    </thead>
    </tbody>';
    $data .='
</table>
';

$data .= '
      <div class="" style="margin-top:20px;font-size:18px;">
            <div class="details clearfix">
                <div class="client left">
                    <p><strong>Payment description:</strong> ' . $rec->description . ' </p>
                </div>
            </div>
        </div>
<footer>
<div class="container">
    <div class="end">Receipt was generated on a computer and is valid without seal.</div>
</div>
</footer>
</div>
</section>
    ';
    $mpdf->WriteHTML($data);
    $mpdf->Output();
}
<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Raw score [<?= $term_syntax; ?> term | <?= $log_session; ?>]</p>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Ass</th>
                                    <th>CA1</th>
                                    <th>CA2</th>
                                    <th>CA3</th>
                                    <th>Exam</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $callRawScore->fetch_object()): ?>
                                <tr>
                                    <td class="font-weight-bold"><?= $row->course; ?> [<?= $row->course_code; ?>]</td>
                                    <td><?= $row->ass; ?></td>
                                    <td><?= $row->ca1; ?></td>
                                    <td><?= $row->ca2; ?></td>
                                    <td><?= $row->ca3; ?></td>
                                    <td><?= $row->exam; ?></td>
                                    <td><?= $row->total; ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Approved Result checker</p>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Term</th>
                                    <th>Pin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $callResultPins->fetch_object()):
                                    switch($row->term){
                                        case 1:
                                            $t_syntax = "First Term";
                                            break;
                                        case 2:
                                            $t_syntax = "Second Term";
                                            break;
                                        case 3:
                                            $t_syntax = "Third Term";
                                            break;
                                    }
                                    $bil_term = $row->term;
                                    $bil_session = $row->session;
                                    $curr_sess_bill_report = $conn->query("SELECT * FROM $bill_report_tbl 
                        WHERE (adm_no = '$userId' AND term='$bil_term' AND session ='$bil_session') ORDER BY id DESC LIMIT 1");
                        $BILL = $curr_sess_bill_report->fetch_object();
                                    ?>
                                <tr>
                                    <td><?= $t_syntax; ?> [<?= $row->session; ?>]</td>
                                    <td class="font-weight-bold">
                                        <?php if($BILL->outstanding_after  == 0): ?>
                                        <?= $row->code; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td><a href="<?= $result_sheet_url; ?>?result_code=<?= $row->code; ?>"
                                            style="text-decoration:none;" class="btn-sm btn-warning">Check result</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->

<?php include "includes/footer.php"; ?>
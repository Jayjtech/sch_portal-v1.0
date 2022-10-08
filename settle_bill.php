<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php 
/**Get outstanding fee */
    $curr_sess_oust = $conn->query("SELECT * FROM $bill_tbl WHERE (userId = '$userId' AND session<='$log_session')");
    $curr_sess_bill_report = $conn->query("SELECT * FROM $bill_report_tbl WHERE (adm_no = '$userId' AND term='$log_term' AND session ='$log_session')");
$_SESSION['pg'] = "settle_bill";
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Bill settlement</p>
                    <hr>
                    <div class="row mb-5">
                        <div class="col-sm-8">
                            <p class="card-title text-success">Successful Payments</p>
                            <p class="text-info">This table shows the amount which has been paid so far for
                                <strong><?= $term_syntax; ?>
                                    Term | <?= $log_session; ?></strong> academic period.
                            </p>
                            <div class="table-responsive">
                                <table class="myTable table table-striped table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Amount paid</th>
                                            <th>Wallet before</th>
                                            <th>Outstanding before</th>
                                            <th>Outstanding after</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($csbr = $curr_sess_bill_report->fetch_object()):?>
                                        <tr>
                                            <td><?= $currency; ?><?= number_format($csbr->amount_paid); ?></td>
                                            <td><?= $currency; ?><?= number_format($csbr->wallet_before); ?></td>
                                            <td><?= $currency; ?><?= number_format($csbr->outstanding_before); ?></td>
                                            <td><?= $currency; ?><?= number_format($csbr->outstanding_after); ?></td>
                                            <td>
                                                <form action="<?= $receipt; ?>" method="post">
                                                    <input type="hidden" name="receipt" value="<?= $csbr->id; ?>">
                                                    <button type="submit" class="btn-sm btn-danger">Receipt</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <p class="card-title text-danger">outstanding fees</p>
                            <p class="text-info">This table shows the fees yet to be paid for the various
                                academic period.
                            </p>
                            <div class="table-responsive">
                                <table class="myTable table table-striped table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Term [Session]</th>
                                            <th>Outstanding</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($cso = $curr_sess_oust->fetch_object()):
                                            switch($cso->term){
                                                case 1: 
                                                    $ot_syn = "First";
                                                    break;
                                                case 2: 
                                                    $ot_syn = "Second";
                                                    break;
                                                case 3: 
                                                    $ot_syn = "Third";
                                                    break;
                                            }
                                            ?>
                                        <tr>
                                            <td><?= $ot_syn; ?> Term [<?= $cso->session; ?>]</td>
                                            <td><?= $currency; ?><?= number_format($cso->outstanding); ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <form action="<?= $sort_bill; ?>" method="POST" onsubmit="return sortBill(this)">
                        <div class="row">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-text">Student's wallet balance:
                                        <?= $currency; ?></span>
                                    <input type="text" name="wallet_balance" id="wallet-balance" class="form-control"
                                        value="<?= $det->wallet; ?>" readonly>
                                    <input type="hidden" name="sort_bill" value="1">
                                    <input type="hidden" name="adm_no" value="<?= $det->userId; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php 
                            while($row = $compulsoryBillSettings->fetch_object()):
                                $bill_name = $row->bill_name;
                                ?>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for=""><?= $row->bill_title; ?></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><?= $currency; ?></span>
                                        <input type="number" class="form-control" id="<?= $row->bill_name; ?>"
                                            name="<?= $row->bill_name; ?>" placeholder="Enter school fee"
                                            <?php if($mb->$bill_name == 0) echo "readonly"; ?>
                                            value="<?= !empty($mb->$bill_name) ? $mb->$bill_name: null; ?>">
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>

                            <?php while($row = $actualBillSettings->fetch_object()):
                                $bill_name = $row->bill_name;
                                ?>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for=""><?= $row->bill_title; ?></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><?= $currency; ?></span>
                                        <input type="number" class="form-control" id="<?= $row->bill_name; ?>"
                                            name="<?= $row->bill_name; ?>" readonly placeholder="Enter school fee"
                                            value="0">
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="total-box col-sm-4"></div>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <span class="input-group-text">Description</span>
                                    <textarea cols="30" rows="3" class="form-control" name="description"
                                        placeholder="Enter payment description" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2" align="right">
                            <button class="btn btn-warning">Pay bill</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- content-wrapper ends -->

<?php include "includes/footer.php"; ?>
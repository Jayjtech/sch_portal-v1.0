<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/edit_calls.php"; ?>
<?php if(!in_array($det->position, $worker)): ?>
<script>
window.location.href = "login?msg=Access denied!&msg_type=error"
</script>
<?php endif; ?>
<div class="content-wrapper">
    <?php if(isset($_GET['take_loan']) == true):?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <p class="card-title">Request for loan</p>
                    <div align="right">
                        <a href="?loan_details" class="btn btn-info">Loan Details</a>
                    </div>
                    <hr>
                    <div class="row mt-3 mb-3">
                        <div class="col-sm-6">
                            <?php
                            if($det->salary_count < $admin_det->loan_num_month_legibility){
                                echo '<p class="alert alert-info">To qualify for the loan, you must have been a staff for '.$admin_det->loan_num_month_legibility.'-month</p>';
                            }else if($admin_det->loan_availability == 0){ ?>
                            <p class="alert alert-danger">Loan is currently Unavailable! Check back later.</p>
                            <?php }else{ ?>
                            <p class="font-weight-bold text-info">Kindly note that any loan taken here will before
                                refunded and
                                taken from your <?= $admin_det->loan_refund_rate;?>-month salary.</p>
                            <p class="font-weight-bold"><em>Interest rate:</em> <?= $admin_det->loan_interest; ?>%</p>
                            <form action="<?= $loan_query; ?>" method="post" onsubmit="return requestLoan(this)">
                                <div class="form-group">
                                    <label for="">Amount </label>
                                    <div class="input-group">
                                        <span class="input-group-text"><?= $currency; ?></span>
                                        <input type="text" name="loan_amount" id="loanAmount" min="100" required
                                            placeholder="Enter amount" class="form-control">
                                    </div>
                                    <input type="hidden" name="loan_request" value="1">
                                </div>

                                <div class="form-group" align="right">
                                    <button class="btn btn-primary">Take loan</button>
                                </div>
                            </form>
                            <?php } ?>

                        </div>

                        <div class="col-sm-6">
                            <table class="myTable table table-striped table-borderless">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($row = $myLoanReq->fetch_object()): 
                                        $period = explode("-", $row->date);
                                        $given_month = $period[1];
                                        $status = $row->status;
                                        $your_term = false;
                                        include "includes/status_const.php";
                                        $clean_date = $month_syntax .' '. $period[0].', '.$period[2];
                                    ?>
                                    <tr>
                                        <td class="font-weight-bold"><?= $clean_date; ?> </td>
                                        <td><?= $currency; ?><?= number_format($row->amount); ?></td>
                                        <td><?= $status_syntax;?></td>
                                        <td>
                                            <?php if($row->status != 1 && $row->status != 4 && $row->status != 5 && $row->status != 6 && $row->status != 3):?>
                                            <form action="<?= $loan_query; ?>" onsubmit="return cancelLoan(this)"
                                                method="post">
                                                <input type="hidden" name="cancel_loan" value="1">
                                                <input type="hidden" name="loan_id" value="<?= $row->id; ?>">
                                                <button type="submit" class="btn-sm btn-danger">Cancel</button>
                                            </form>
                                            <?php endif; ?>
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
    <?php endif; ?>

    <?php if(isset($_GET['loan_details']) == true): ?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Loan balance details</p>
                    <div align="right">
                        <a href="?take_loan" class="btn btn-primary">Request for loan</a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Credit</th>
                                    <th>Debit</th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $myLoanDet->fetch_object()): 
                                        $period = explode("-", $row->date);
                                        $given_month = $period[1];
                                        $your_term = false;
                                        include "includes/status_const.php";
                                        $clean_date = $month_syntax .' '. $period[0].', '.$period[2];
                                    ?>
                                <tr>
                                    <td class="font-weight-bold"><?= $clean_date; ?></td>
                                    <td class="font-weight-bold text-dark">
                                        <?= $currency; ?><?= number_format($row->amount); ?></td>
                                    <td class="font-weight-bold text-success">
                                        <?= $currency; ?><?= number_format($row->credit); ?></td>
                                    <td class="font-weight-bold text-danger">
                                        <?= $currency; ?><?= number_format($row->debit); ?></td>
                                    <td class="font-weight-bold text-info">
                                        <?= $currency; ?><?= number_format($row->balance); ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>




    <?php include "includes/footer.php"; ?>
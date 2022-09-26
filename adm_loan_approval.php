<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/edit_calls.php"; ?>
<?php $_SESSION['disburse_type'] = "loan"; ?>
<div class="content-wrapper">
    <?php if(($_GET['key'])== "approve_loan"):?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <p class="card-title">Loan approval</p>
                    <div align="right">
                        <a href="?key=loan_disbursement_list" class="btn btn-warning">Loan disbursement list</a>
                        <a href="?key=loan_setting" class="btn btn-primary">Loan settings</a>
                    </div>
                    <hr>

                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($loan = $callLoanList->fetch_object()):
                                        $period = explode("-", $loan->date);
                                        $given_month = $period[1];
                                        $status = $loan->status;
                                        include "includes/status_const.php";
                                        $clean_date = $month_syntax .' '. $period[0].', '.$period[2];
                                    ?>
                                <tr>
                                    <td class="font-weight-bold"><?= $loan->name; ?></td>
                                    <td><?= $currency; ?><?= number_format($loan->amount); ?></td>
                                    <td class="font-weight-bold"><?= $clean_date; ?></td>
                                    <td><?= $status_syntax;?></td>
                                    <td>
                                        <?php if($status == 0): ?>
                                        <form action="<?= $loan_query; ?>" onsubmit="return loanApproval(this)"
                                            method="post">
                                            <input type="hidden" name="staffToken" value="<?= $loan->token; ?>">
                                            <input type="hidden" name="approve_loan" value="1">
                                            <input type="hidden" name="loan_id" value="<?= $loan->id; ?>">
                                            <input type="hidden" name="staff_name" value="<?= $loan->name; ?>">
                                            <input type="hidden" name="loan_amount" value="<?= $loan->amount; ?>">
                                            <input type="hidden" name="loan_date" value="<?= $clean_date; ?>">
                                            <input type="hidden" name="disbursement_id"
                                                value="<?= $loan->disbursement_id; ?>">
                                            <button class="btn-sm btn-info">Approve <i
                                                    class="mdi mdi-check"></i></button>
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

<?php if(($_GET['key'])== "loan_setting"):?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card position-relative">
            <div class="card-body">
                <p class="card-title">Loan setting</p>
                <div align="right">
                    <a href="?key=loan_disbursement_list" class="btn btn-warning">Loan disbursement list</a>
                    <a href="?key=loan_approval" class="btn btn-primary">Loan approval</a>
                </div>
                <hr>
                <div class="row mt-3 mb-3">
                    <div class="col-sm-6">
                        <form action="<?= $loan_query; ?>" onsubmit="return setLoan(this)" method="post">
                            <div class="form-group">
                                <label for="">Max amount requestable</label>
                                <div class="input-group">
                                    <span class="input-group-text"><?= $currency; ?></span>
                                    <input type="text" name="loan_max_amount" class="form-control" min="0"
                                        placeholder="Enter maximum amount that can be requested" required
                                        value="<?= $admin_det->loan_max_amount; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for=""><em class="font-weight-bold">Legibility:</em> Must have been a staff for
                                    how many months?</label>
                                <div class="input-group">
                                    <input type="text" name="loan_num_month_legibility" min="1"
                                        placeholder="Enter the number of month for legibility" class="form-control"
                                        required value="<?= $admin_det->loan_num_month_legibility; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Refund in how many months?</label>
                                <div class="input-group">
                                    <input type="text" name="loan_refund_rate" min="1"
                                        placeholder="Enter the number of month for refund" class="form-control" required
                                        value="<?= $admin_det->loan_refund_rate; ?>">
                                </div>
                            </div>
                            <input type="hidden" value="1" name="set_loan">
                            <div class="form-group">
                                <label for="">Loan interest rate</label>
                                <div class="input-group">
                                    <span class="input-group-text">%</span>
                                    <input type="text" name="loan_interest" min="0" class="form-control" required
                                        value="<?= $admin_det->loan_interest; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Loan Availability status</label>
                                <div class="input-group">
                                    <select name="availability" class="form-control">
                                        <option value="<?= $admin_det->loan_availability; ?>"><?= $loan_availability; ?>
                                        </option>
                                        <option value="1">Available</option>
                                        <option value="0">Unavailable</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" align="right">
                                <button class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php if(($_GET['key']) == "loan_disbursement_list"): ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title mb-0">Loan Disbursement List</p>
                <div align="right">
                    <a href="?key=create_payroll" class="btn btn-primary">Create Payroll</a>
                    <a href="?key=staff_list" class="btn btn-success">Staff list</a>
                </div>
                <hr>

                <div class="table-responsive">
                    <table class="myTable table table-striped table-borderless">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($dis = $callLoanDisburseList->fetch_object()):
                                        $staff_bnk = json_decode($dis->bankDet);
                                        $status = $dis->status;
                                        $given_month = false;
                                        include "includes/status_const.php";
                                        
                                    ?>
                            <tr>
                                <td class="font-weight-bold"><?= $dis->name; ?></td>
                                <td class="font-weight-bold"><?= $dis->description; ?></td>
                                <td><?= $currency; ?><?= number_format($dis->amount); ?></td>
                                <td><?= $status_syntax;?></td>
                                <td>
                                    <form action="<?= $loan_query; ?>" onsubmit="return removeFromDisburse(this)"
                                        method="post">
                                        <input type="hidden" name="staffToken" value="<?= $dis->staffToken; ?>">
                                        <input type="hidden" name="payment_month" value="<?= $dis->payment_month; ?>">
                                        <input type="hidden" name="staff_name" value="<?= $dis->name; ?>">
                                        <input type="hidden" name="loan_id" value="<?= $dis->loan_id; ?>">
                                        <input type="hidden" name="deny_loan" value="1">
                                        <button class="btn-sm btn-danger">Deny <i class="mdi mdi-minus"></i></button>
                                    </form>
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

<div class="row">
    <div class="col-md-12 stretch-card grid-margin">
        <div class="card">
            <div class="card-body">
                <p class="card-title mb-0">Loan disbursement</p>
                <hr>
                <div class="row">
                    <div class="mt-2 col-sm-6">
                        <form action="<?= $disburser; ?>" onsubmit="return disburse(this)" method="post">
                            <?php
                                $cal = $conn->query("SELECT sum(amount) as total_loan FROM $loan_disbursement_tbl WHERE status = 0 ");
                                $getTotalSal = $cal->fetch_object();
                            ?>
                            <input type="hidden" value="1" name="process_disbursement">
                            <input type="hidden" value="Loan" name="type">
                            <input type="hidden" value="<?= date('YmdHi').uniqid(); ?>" name="disb_id">
                            <p class="font-weight-bold">Total amount to be disbursed:
                                <?= $currency; ?><span><?= number_format($getTotalSal->total_loan);?></span></p>
                            <p class="text-info font-weight-bold">Note that loan will be disbursed to staff whose
                                disbursement status is currently set to "Pending".</p>
                            <div class="form-group" align="right">
                                <button type="submit" class="btn btn-success">Disburse Loan</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php include "includes/footer.php"; ?>
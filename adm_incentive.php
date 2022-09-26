<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/edit_calls.php"; ?>

<div class="content-wrapper">
    <?php if(($_GET['key']) == "take_loan"):?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <p class="card-title">Take a loan</p>
                    <div align="right">
                        <a href="?key=loan_balance" class="btn btn-info">Loan Balance</a>
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
                                        <input type="text" name="loan_amount" id="loanAmount" min="1000" required
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
                                        include "includes/status_const.php";
                                        $clean_date = $month_syntax .' '. $period[0].', '.$period[2];
                                    ?>
                                    <tr>
                                        <td class="font-weight-bold"><?= $clean_date; ?> </td>
                                        <td><?= $currency; ?><?= number_format($row->amount); ?></td>
                                        <td><?= $status_syntax;?></td>
                                        <td>
                                            <?php if($row->status != 4 && $row->status != 5 && $row->status != 6 && $row->status != 3):?>
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

    <?php if(($_GET['key']) == "staff_list"): ?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">List of Salary earning Staff</p>
                    <div align="right">
                        <a href="?key=create_payroll" class="btn btn-primary">Create Payroll</a>
                        <a href="?key=disbursement_list" class="btn btn-success">Disbursement list</a>
                    </div>
                    <hr>
                    <div class="" align="right">
                        <p>Total Salary: <span
                                class="font-weight-bold"><?= $currency; ?><?= number_format($salTol->total_salary); ?></span>
                        </p>
                    </div>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Name[ID]</th>
                                    <th>POD.</th>
                                    <th>Salary</th>
                                    <th>Bank Details</th>
                                    <th>Add to disbursement list</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $callStaff->fetch_object()):
                                    switch($row->position){
                                            case 0:
                                                $POD = '<div class="text-danger">Yet to be assigned!</div>';
                                                break;
                                            case 1:
                                                $POD = "Proprietor";
                                                break;
                                            case 2:
                                                $POD = "Principal";
                                                break;
                                            case 3:
                                                $POD = "Vice Principal";
                                                break;
                                            case 4:
                                                $POD = "Head Teacher";
                                                break;
                                            case 5:
                                                $POD = "Teacher";
                                                break;
                                            case 6:
                                                $POD = "Bursar";
                                                break;
                                            case 7:
                                                $POD = "Treasurer";
                                                break;
                                        }

                                        switch($row->privileges){
                                            case 0:
                                                $priv = '<div class="text-danger">Yet to be assigned!</div>';
                                                break;
                                            case 1:
                                                $priv = "|Student|Staff|Exam|Documents|Revenue|";
                                                break;
                                            case 2:
                                                $priv = "|Student|Staff|Exam|Documents|";
                                                break;
                                            case 3:
                                                $priv = "|Student|Staff|Exam|";
                                                break;
                                            case 4:
                                                $priv = "|Student|Staff|";
                                                break;
                                            case 5:
                                                $priv = "|Student|";
                                                break;
                                        }
                                        $staff_bnk = json_decode($row->bank_details);
                                        
                                        $bankDet = [
                                            "bank" => "$staff_bnk->bank",
                                            "acc_no" => "$staff_bnk->acc_no",
                                            "acc_holder" => "$staff_bnk->acc_holder"
                                        ];
                                    ?>
                                <tr>
                                    <td class="font-weight-bold"><?= $row->name; ?>[<?= $row->userId; ?>]</td>
                                    <td><?= $POD; ?></td>
                                    <td><?= $currency; ?><?= number_format($row->salary); ?></td>
                                    <td>
                                        <p>
                                            Bank: <?= $staff_bnk->bank; ?><br>
                                            Acc. No: <?= $staff_bnk->acc_no; ?><br>
                                            Acc. Holder: <?= $staff_bnk->acc_holder; ?>
                                        </p>
                                    </td>
                                    <td>
                                        <form action="<?= $pusher; ?>" onsubmit="return addToDisburse(this)"
                                            method="post">
                                            <div class="form-group">
                                                <select class="form-control" name="payrollTitle" required>
                                                    <option value="">Select payroll description</option>
                                                    <?php for($i = 0; $i<count($payRData); $i++){?>
                                                    <option value="<?= $payRData[$i]->disbursement_id; ?>">
                                                        <?= $payRData[$i]->description; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <input type="hidden" name="salary" value="<?= $row->salary; ?>">
                                            <input type="hidden" name="name" value="<?= $row->name; ?>">
                                            <input type="hidden" name="bankDet"
                                                value="<?= base64_encode(json_encode($bankDet)); ?>">
                                            <input type="hidden" name="token" value="<?= $row->token; ?>">
                                            <input type="hidden" name="userId" value="<?= $row->userId; ?>">
                                            <button class="btn-sm btn-success">Add <i class="mdi mdi-plus"></i></button>
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
    <?php endif; ?>

    <?php if(($_GET['key']) == "disbursement_list"): ?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Disbursement List</p>
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
                                    <th>Period</th>
                                    <th>Salary</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($dis = $callDisList->fetch_object()):
                                        $staff_bnk = json_decode($dis->bankDet);
                                        $period = explode("-", $dis->payment_month);
                                        $given_month = $period[1];
                                        $status = $dis->status;
                                        include "includes/status_const.php";
                                    ?>
                                <tr>
                                    <td class="font-weight-bold"><?= $dis->name; ?></td>
                                    <td class="font-weight-bold"><?= $dis->description; ?></td>
                                    <td class="font-weight-bold"><?= $month_syntax; ?> <?= $period[0]; ?></td>
                                    <td><?= $currency; ?><?= number_format($dis->salary); ?></td>
                                    <td><?= $status_syntax;?></td>
                                    <td>
                                        <form action="<?= $deleter; ?>" onsubmit="return removeFromDisburse(this)"
                                            method="post">
                                            <input type="hidden" name="staffToken" value="<?= $dis->staffToken; ?>">
                                            <input type="hidden" name="payment_month"
                                                value="<?= $dis->payment_month; ?>">
                                            <input type="hidden" name="staff_name" value="<?= $dis->name; ?>">
                                            <input type="hidden" name="disbursement_id"
                                                value="<?= $dis->disbursement_id; ?>">
                                            <button class="btn-sm btn-danger">Remove <i
                                                    class="mdi mdi-minus"></i></button>
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
                    <p class="card-title mb-0">Salary disbursement</p>
                    <hr>
                    <div class="row">
                        <div class="mt-2 col-sm-6">
                            <form action="" method="POST" onsubmit="return disburse(this)">
                                <div class="form-group">
                                    <label for="">Select which period you are disbursing for</label>
                                    <select class="payroll-period form-control" name="payrollTitle" required>
                                        <option value="">Select which period you are disbursing for</option>
                                        <?php for($i = 0; $i<count($payRData); $i++){
                                            $period = explode("-", $payRData[$i]->month);
                                            $given_month = $period[1];
                                           include "includes/status_const.php";
                                            ?>
                                        <option value="<?= $payRData[$i]->disbursement_id; ?>">
                                            <?= $payRData[$i]->description; ?> [<?= $month_syntax; ?>,
                                            <?= $period[0]; ?>]
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <p class="font-weight-bold">Total amount to be disbursed: <?= $currency; ?><span
                                        class="salary_response">0.00</span></p>
                                <p class="text-info font-weight-bold">Note that salary will only be disbursed to staff
                                    who provided their account details and are on the disbursement list.</p>
                                <div class="form-group" align="right">
                                    <button type="submit" class="btn btn-success">Disburse Salary</button>
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
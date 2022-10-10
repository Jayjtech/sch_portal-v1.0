<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/edit_calls.php"; ?>
<?php $_SESSION['page'] = "salary"; ?>
<div class="content-wrapper">
    <p id="walletResponse" class="font-weight-bold"></p>
    <p id="statusResponse" class="font-weight-bold"></p>
    <?php if(($_GET['key']) == "create_payroll"):?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <div align="right">
                        <a href="?key=staff_list" class="btn btn-primary">Staff list</a>
                        <a href="?key=disbursement_list" class="btn btn-success">Disbursement
                            list</a>
                    </div>
                    <hr>
                    <div class="row mt-3 mb-3">
                        <div class="col-sm-2">
                            <h4 class="card-title">Create Staff level</h4>
                            <form action="<?= $pusher; ?>" method="post">
                                <div class="form-group">
                                    <label for="">Select Level</label>
                                    <select name="staff_level" id="" required class="form-control">
                                        <option value="">Select Level</option>
                                        <option value="1">Level-1</option>
                                        <option value="2">Level-2</option>
                                        <option value="3">Level-3</option>
                                        <option value="4">Level-4</option>
                                        <option value="5">Level-5</option>
                                        <option value="6">Level-6</option>
                                        <option value="7">Level-7</option>
                                        <option value="8">Level-8</option>
                                        <option value="9">Level-9</option>
                                        <option value="10">Level-10</option>
                                        <option value="12">Level-12</option>
                                        <option value="13">Level-13</option>
                                        <option value="14">Level-14</option>
                                        <option value="15">Level-15</option>
                                        <option value="16">Level-16</option>
                                        <option value="17">Level-17</option>
                                        <option value="18">Level-18</option>
                                        <option value="19">Level-19</option>
                                        <option value="20">Level-20</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="">Salary</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><?= $currency; ?></span>
                                        <input type="text" name="salary_amount" class="form-control"
                                            placeholder="Salary">
                                    </div>
                                </div>
                                <div class="" align="right">
                                    <button type="submit" class="btn btn-primary mr-2" name="review_staff">Save</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-sm-6">
                            <h4 class="card-title">Level table</h4>
                            <div class="table-responsive">
                                <table class="myTable table table-striped table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Level</th>
                                            <th>Salary</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $callStaffLevels->fetch_object()):?>
                                        <tr>
                                            <td class="font-weight-bold">Level <?= $row->level?></td>
                                            <td><?= $currency; ?><?= number_format($row->salary_amount); ?></td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <h4 class="card-title">Create Payroll</h4>
                            <form action="<?= $pusher; ?>" class="forms-sample" method="POST"
                                onsubmit="return payrollTitle(this)">
                                <div class="">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Month of Disbursement</label>
                                        <input type="month" class="form-control" id="month" name="month"
                                            placeholder="Enter month" value="">
                                    </div>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea rows="6" class="form-control" name="description"
                                            placeholder="Enter a detailed description for the disbursement"></textarea>
                                    </div>
                                </div>
                                <input type="hidden" name="disburser" value="<?= $det->name; ?>">
                                <input type="hidden" name="disbursement_id" value="<?= date('YmdHi').uniqid(); ?>">

                                <div class="" align="right">
                                    <button type="submit" class="btn btn-primary mr-2" name="review_staff">Create
                                        payroll</button>
                                </div>
                            </form>
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
                                    <th>Loan debt</th>
                                    <th>Bank Details</th>
                                    <th>Add to disbursement list</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $callStaff->fetch_object()):
                                    $staff_id = $row->userId;
                                    $checkLoan = $conn->query("SELECT * FROM $loan_tbl WHERE userId='$staff_id' ORDER BY id DESC LIMIT 1");
                                    $ln = $checkLoan->fetch_object();
                                    $st_position = $row->position;
                                    $st_privileges = $row->privileges;
                                    $given_month = false;
                                    $status = false;
                                    include "includes/status_const.php";
                                        $staff_bnk = json_decode($row->bank_details);
                                        
                                        $bankDet = [
                                            "bank" => "$staff_bnk->bank",
                                            "acc_no" => "$staff_bnk->acc_no",
                                            "bank_code" => "$staff_bnk->bank_code",
                                            "acc_holder" => "$staff_bnk->acc_holder"
                                        ];
                                    ?>
                                <tr>
                                    <td class="font-weight-bold"><?= $row->name; ?> [<?= $row->userId; ?>]</td>
                                    <td><?= $POD; ?></td>
                                    <td class="text-success font-weight-bold">
                                        <?= $currency; ?><?= number_format($row->salary); ?></td>
                                    <td class="text-danger font-weight-bold">
                                        <?php if($ln->balance == true): ?>
                                        -<?= $currency; ?><?= number_format($ln->balance); ?>
                                        <?php endif; ?>
                                    </td>
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
                                            <input type="hidden" name="create_payroll" value="1">
                                            <input type="hidden" name="name" value="<?= $row->name; ?>">
                                            <input type="hidden" name="ln_debt" value="<?= $ln->balance; ?>">
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
                                    <th>Loan Debt</th>
                                    <th>Loan Refund</th>
                                    <th>Disbursement Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($dis = $callDisList->fetch_object()):
                                        $period = explode("-", $dis->payment_month);
                                        $given_month = $period[1];
                                        $status = $dis->status;
                                        include "includes/status_const.php";
                                    ?>
                                <tr>
                                    <td class="font-weight-bold"><?= $dis->name; ?></td>
                                    <td class="font-weight-bold"><?= $dis->description; ?></td>
                                    <td class="font-weight-bold"><?= $month_syntax; ?> <?= $period[0]; ?></td>
                                    <td class="font-weight-bold text-dark">
                                        <?= $currency; ?><?= number_format($dis->amount); ?></td>
                                    <td class="font-weight-bold text-danger">
                                        <?= $currency; ?><?= number_format($dis->ln_debt); ?></td>
                                    <td class="font-weight-bold text-success">
                                        <?php if($dis->loan_credit): ?>
                                        <?= $currency; ?><?= number_format($dis->loan_credit); ?></td>
                                    <?php endif; ?>
                                    <td class="font-weight-bold text-warning">
                                        <?= $currency; ?><?= number_format($dis->disbursement_amount); ?></td>
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
                            <form action="<?= $disburser; ?>" method="POST" onsubmit="return disburse(this)">
                                <div class="form-group">
                                    <label for="">Select which period you are disbursing for</label>
                                    <select class="payroll-period form-control" name="disbursement_id" required>
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
                                <input type="hidden" value="1" name="process_disbursement">
                                <input type="hidden" value="Salary" name="type">
                                <input type="hidden" value="<?= date('YmdHi').uniqid(); ?>" name="disb_id">
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


    <?php include "includes/autorefresh.php"; ?>
    <?php include "includes/footer.php"; ?>
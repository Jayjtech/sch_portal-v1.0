<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/edit_calls.php"; ?>
<?php if($det->user_type == "c3R1ZHk="): ?>
<script>
window.location.href = "login?msg=Access denied!&msg_type=error"
</script>
<?php endif; ?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="<?= $bank_details; ?>" method="post">
                        <div class="row">
                            <div class="col-sm-4">
                                <?php if($bank_account == false){?>
                                <p class="card-title mb-0">Add bank account details</p>
                                <?php }else{?>
                                <p class="card-title mb-0">Bank account details</p>
                                <?php } ?>
                                <hr>
                                <div class="form-group col-sm-12">
                                    <label for="">Select bank name</label>
                                    <select name="bank" class="form-control" id="bank" required>
                                        <option value="<?= $bank_account->bank; ?>|<?= $bank_account->bank_code; ?>">
                                            <?= $bank_account->bank; ?></option>
                                        <?php while($bnk = $bankList->fetch_object()):?>
                                        <option value="<?= $bnk->bank; ?>|<?= $bnk->bank_code; ?>">
                                            <?= $bnk->bank;?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="">Account number</label>
                                    <input type="number" name="acc_no" value="<?= $bank_account->acc_no; ?>"
                                        class="form-control" id="accountNo" placeholder="Enter your account number"
                                        required>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="">Account holder's name</label>
                                    <input type="text" name="acc_holder" value="<?= $bank_account->acc_holder; ?>"
                                        id="bankHolder" class="form-control" readonly required>
                                    <input type="hidden" id="valid" value="0" name="valid">
                                </div>

                                <div class="form-group col-sm-12" align="right">
                                    <img src="images/loading-2.gif" width="50" alt="Loading" class="loading-img"
                                        style="display: none;">
                                    <?php if($bank_account == false){?>
                                    <button type="submit" name="add_account" class="btn btn-dark">Add</button>
                                    <?php }else{?>
                                    <button type="submit" name="add_account" class="btn btn-info">Update</button>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <p class="card-title">Salary details</p>
                                <div class="table-responsive">
                                    <table class="myTable table table-striped table-borderless">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Description</th>
                                                <th>Period</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($row = $mySalDet->fetch_object()): 
                                        $period = explode("-", $row->date);
                                        $given_month = $period[1];
                                        $status = $row->status;
                                        $your_term = false;
                                        include "includes/status_const.php";
                                        $clean_date = $month_syntax .' '. $period[0].', '.$period[2];
                                    ?>
                                            <tr>
                                                <td class="font-weight-bold"><?= $clean_date; ?></td>
                                                <td class="font-weight-bold text-dark">
                                                    <?= $currency; ?><?= number_format($row->amount); ?></td>
                                                <td><?= $row->description; ?></td>
                                                <td><?= $row->payment_month; ?></td>
                                                <td class="font-weight-bold text-danger"><?= $status_syntax;?></td>
                                            </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



</div>


<script src="js/validate-account.js"></script>
<?php include "includes/footer.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/edit_calls.php"; ?>

<div class="content-wrapper">
    <?php if(($_GET['key'])== "create_payroll"):?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <h4 class="card-title">Payroll form</h4>
                    <hr>
                    <form action="<?= $pusher;?>" class="forms-sample" method="POST" onsubmit="return revStaff(this)">
                        <div class="row mt-3 mb-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Month of Disbursement</label>
                                    <input type="month" class="form-control" id="month" name="month"
                                        placeholder="Enter month" value="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="" id="" cols="2" class="form-control" name="description"
                                        placeholder="Enter a detailed description for the disbursement"></textarea>
                                </div>
                            </div>
                            <input type="hidden" name="disburser" value="<?= $edS->name?>">
                            <input type="hidden" name="disbursement_id" value="<?= date('YmdHi').uniqid(); ?>">
                        </div>
                        <div class="" align="right">
                            <button type="submit" class="btn btn-primary mr-2" name="review_staff">Create
                                payroll</button>
                        </div>

                    </form>
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
                    </div>
                    <hr>
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
                                            <input type="hidden" name="name" value="<?= $row->name; ?>">
                                            <input type="hidden" name="bankDet" value="<?= json_encode($bankDet); ?>">
                                            <input type="hidden" name="token" value="<?= $row->token; ?>">
                                            <input type="hidden" name="userId" value="<?= $row->token; ?>">
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



    <?php include "includes/footer.php"; ?>
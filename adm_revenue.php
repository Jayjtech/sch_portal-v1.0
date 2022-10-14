<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/edit_calls.php"; ?>
<?php if(!in_array($det->position, $bursar)): ?>
<script>
window.location.href = "login?msg=Access denied!&msg_type=error"
</script>
<?php endif; ?>
<?php 
$_SESSION['pg'] = "adm_revenue";
$compulsoryFee = $conn->query("SELECT * FROM $bill_setting_tbl");
  while($row = $compulsoryFee->fetch_object()){
        $data[] = $row;
    }
?>

<div class="content-wrapper">
    <?php if(isset($_GET['revenue']) == true):?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Bills and Revenue table for <?= $term_syntax?> term |
                        <?= $log_session; ?></p>
                    <div align="right">
                        <a href="?bill_summary" class="btn btn-success">Bill summary</a>
                        <a href="?set_compulsory_fee" class="btn btn-primary">Set compulsory fees</a>
                    </div>
                    <hr>

                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Name[Adm No.]</th>
                                    <th>Class</th>
                                    <th>Total compulsory fee</th>
                                    <th>Total actual fee</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $callBills->fetch_object()):?>
                                <tr>
                                    <td><?= $row->name; ?>[<?= $row->userId; ?>]</td>
                                    <td class="font-weight-bold"><?= $row->class; ?></td>
                                    <td><?= $currency; ?><?= number_format($row->compulsory_total); ?></td>
                                    <td><?= $currency; ?><?= number_format($row->actual_total); ?></td>
                                    <td><a href="?sort_bill=<?= $row->userId;?>" style="text-decoration:none;"
                                            class="btn-sm btn-success">View/Sort bills</a></td>
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
        <div class="col-md-6 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Bill uploader</p>
                    <hr>
                    <div class="mt-2">
                        <div class="container">
                            <p>Click the green button to download the bill format as an Excel CSV file.</p>
                            <p class="text-info">Note: Bills will be downloaded for the term and Session you logged in
                                to.</p>
                            <form action="<?= $exporter; ?>" method="get">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select name="class" id="class" class="form-control" required>
                                                <option value="">For what class?</option>
                                                <option value="all">All classes</option>
                                                <?php for($i = 0; $i<count($classData); $i++){?>
                                                <option value="<?= $classData[$i]->class; ?>">
                                                    <?= $classData[$i]->class; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="table" value="<?= $bill_tbl; ?>">
                                    <input type="hidden" name="term" value="<?= $term_syntax; ?> term">
                                    <input type="hidden" name="session" value="<?= $log_session; ?>">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <button class="btn btn-success"><i class="mdi mdi-download"></i> Excel
                                                Format</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="container mt-3">
                            <form action="<?= $pusher;?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="">Choose Bill Excel File</label>
                                            <input type="file" name="file" class="form-control btn btn-dark" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <button type="submit" name="push_bills" class="mt-3 btn btn-primary"><i
                                                    class="mdi mdi-upload"></i> Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(isset($_GET['set_compulsory_fee']) == true):?>
    <div class="row">
        <div class="col-md-12 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Set compulsory fees</p>
                    <div class="mb-2" align="right">
                        <a href="?revenue" class="btn btn-dark">Back</a>
                    </div>
                    <hr>
                    <div class="mt-2">
                        <div class="container">
                            <form action="<?= $sort_bill; ?>" method="post" onsubmit="return addCompulsoryFee(this)">
                                <div class="row">
                                    <div class="col-sm-12 mb-2 mt-3">
                                        <p class="font-weight-bold text-info">Any fee selected will be added to the list
                                            of compulsory fees</p>
                                        <div class="mt-2 col-sm-12 font-weight-bold">
                                            Tagged Fees:
                                            <span class="text-success fee-list-el row">
                                                <?php
                                                $list = json_decode($admin_det->compulsory_fee);
                                                for($x = 0; $x < count($list); $x++){
                                                    echo '<span class="col-sm-3">'.$list[$x].'</span> ';
                                                }
                                                ?>
                                            </span>
                                        </div>
                                        <textarea name="tagged_fees" class="form-control" id="screen-el" cols="2"
                                            style="display:none;" rows="2"><?= $admin_det->compulsory_fee; ?></textarea>

                                    </div>
                                </div>

                                <div class="mt-2" align="right">
                                    <button type="submit" class="btn btn-success">Submit list</button>
                                </div>
                                <hr>
                            </form>
                            <div class="col-sm-12 mt-4">
                                <!-- Buttons for tagging questions -->
                                <p>Toggle fee button to add or remove fee from the compulsory fee list.</p>
                                <?php for($i = 0; $i < count($data); $i++):?>
                                <button class="mb-2 btn btn-primary border-right"
                                    onclick="addFee('<?= $data[$i]->bill_title; ?>')">
                                    <?= $data[$i]->bill_title; ?></button>
                                <?php endfor; ?>
                                <!-- End -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(isset($_GET['bill_summary']) == true):?>
            <div class="row">
                <div class="col-md-12 stretch-card grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title mb-0">Bill Summary for</p>
                            <div class="mb-2" align="right">
                                <a href="?revenue" class="btn btn-dark">Back</a>
                            </div>
                            <hr>
                            <p class="font-weight-bold"><?= $term_syntax?> term | <?= $log_session; ?>:</p>

                            <span class="text-danger">Oustanding [Compulsory fees] =
                                <?= $currency; ?><?= number_format($compBill->comp_total); ?></span><br>
                            <span class="text-success">Already Earned =
                                <?= $currency; ?><?= number_format($earn->already_earned); ?></span><br>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif;?>

            <?php if(isset($_GET['sort_bill']) == true):?>
            <div class="row">
                <div class="col-md-12 stretch-card grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title mb-0">Sort <em><?= $bil->name; ?>'s</em> Bill [<?= $bil->class; ?>]</p>
                            <div class="mb-2" align="right">
                                <a href="?revenue" class="btn btn-dark">Back</a>
                            </div>
                            <hr>
                            <div class="row mb-5">
                                <div class="col-sm-8">
                                    <p class="card-title text-success">Successful Payments</p>
                                    <p class="text-info">This table shows the amount
                                        <strong><em><?= $bil->name; ?></em></strong>which has paid so far for
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
                                                    <td><?= $currency; ?><?= number_format($csbr->wallet_before); ?>
                                                    </td>
                                                    <td><?= $currency; ?><?= number_format($csbr->outstanding_before); ?>
                                                    </td>
                                                    <td><?= $currency; ?><?= number_format($csbr->outstanding_after); ?>
                                                    </td>
                                                    <td>
                                                        <form action="<?= $receipt; ?>" method="post">
                                                            <input type="hidden" name="receipt"
                                                                value="<?= $csbr->id; ?>">
                                                            <button type="submit"
                                                                class="btn-sm btn-danger">Receipt</button>
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
                                    <p class="text-info">This table shows the fees yet to be paid by the
                                        <strong><em><?= $bil->name; ?></em></strong> for the various
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
                                            <input type="text" name="wallet_balance" id="wallet-balance"
                                                class="form-control" value="<?= $wal->wallet; ?>" readonly>
                                            <input type="hidden" name="sort_bill" value="1">
                                            <input type="hidden" name="adm_no" value="<?= $_GET['sort_bill']; ?>">
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
                                                    <?php if($bil->$bill_name == 0) echo "readonly"; ?>
                                                    value="<?= !empty($bil->$bill_name) ? $bil->$bill_name: null; ?>">
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
                                                    name="<?= $row->bill_name; ?>" readonly
                                                    placeholder="Enter school fee" value="0">
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
            <?php endif;?>

        </div>

        <script>
        function calCompulsoryTotal() {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "functions/calculateCompulsoryBal.php", false);
            xmlhttp.send(null);
            // document.getElementById("statusResponse").innerHTML = xmlhttp.responseText;
        }
        calCompulsoryTotal();
        setInterval(function() {
            calCompulsoryTotal();
        }, 1000);
        </script>

        <!-- Adder.js for adding item to a list -->
        <script src="js/adder.js"></script>
        <?php include "includes/sum_bills.php"; ?>
        <?php include "includes/footer.php"; ?>
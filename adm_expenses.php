<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/edit_calls.php"; ?>
<?php if(!in_array($det->position, $bursar)): ?>
<script>
window.location.href = "login?msg=Access denied!&msg_type=error"
</script>
<?php endif; ?>

<div class="content-wrapper">
    <p id="walletResponse" class="font-weight-bold"></p>
    <p id="statusResponse" class="font-weight-bold"></p>
    <?php if(isset($_GET['table']) == true):?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <p class="card-title">List of expenses so far</p>
                    <hr>
                    <div align="right">
                        <a href="?expenses_form" class="btn btn-primary">Expenses form</a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Subject</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Academic Period</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $callExpenses->fetch_object()): 
                                    switch($row->term){
                                        case 1:
                                            $t_syntax = "First";
                                        break;
                                        case 2:
                                            $t_syntax = "Second";
                                        break;
                                        case 3:
                                            $t_syntax = "Third";
                                        break;
                                    }
                                    ?>
                                <tr>
                                    <td><?= $row->description; ?></td>
                                    <td class="font-weight-bold"><?= $row->subject; ?></td>
                                    <td><?= $currency; ?><?= number_format($row->amount); ?></td>
                                    <td><?= $row->date; ?></td>
                                    <td><?= $t_syntax; ?> Term | <?= $row->session; ?></td>
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

    <?php if(isset($_GET['expenses_form']) == true):?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <p class="card-title">Add new record</p>
                    <hr>
                    <div align="right">
                        <a href="?table" class="btn btn-success">Expenses table</a>
                    </div>
                    <p class="text-info">Fill the form below to record new expense</p>
                    <form action="<?= $expenses_query; ?>" method="post">
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <label for="">Subject</label>
                                <input type="text" name="subject" class="form-control"
                                    placeholder="Enter the subject or Item spent on" required>
                                <input type="hidden" name="record_expenses" value="1">
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label for="">Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text"><?= $currency; ?></span>
                                    <input type="number" name="amount" class="form-control" min="1"
                                        placeholder="Enter the subject or Item spent on" required>
                                </div>
                            </div>

                            <div class="col-sm-12 mb-2">
                                <label for="">Description</label>
                                <div class="form-group">
                                    <textarea name="description" class="form-control" rows="3"
                                        placeholder="A brief description" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2" align="right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>


    <?php include "includes/footer.php"; ?>
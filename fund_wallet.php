<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <h4 class="card-title">Fund wallet</h4>
                    <hr>
                    <?php 
                    if($monnify_account == true):
                    ?>
                    <div class="col-md-6 grid-margin transparent">
                        <p class="font-weight-bold">Make your bank transfer into any of the accounts listed below and
                            your wallet
                            will be funded automatically.</p>
                        <div class="row">
                            <div class="col-md-6 mb-4 stretch-card transparent">
                                <div class="card card-tale">
                                    <div class="card-body">
                                        <p class="mb-4"><?= $monnify_account->responseBody->accounts[0]->bankName; ?>
                                        </p>
                                        <p class="fs-30 mb-2">
                                            <?= $monnify_account->responseBody->accounts[0]->accountNumber; ?></p>
                                        <p><?= $monnify_account->responseBody->accounts[0]->accountName; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 stretch-card transparent">
                                <div class="card card-dark-blue">
                                    <div class="card-body">
                                        <p class="mb-4"><?= $monnify_account->responseBody->accounts[1]->bankName; ?>
                                        </p>
                                        <p class="fs-30 mb-2">
                                            <?= $monnify_account->responseBody->accounts[1]->accountNumber; ?></p>
                                        <p><?= $monnify_account->responseBody->accounts[1]->accountName; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                                <div class="card card-light-blue">
                                    <div class="card-body">
                                        <p class="mb-4"><?= $monnify_account->responseBody->accounts[2]->bankName; ?>
                                        </p>
                                        <p class="fs-30 mb-2">
                                            <?= $monnify_account->responseBody->accounts[2]->accountNumber; ?></p>
                                        <p><?= $monnify_account->responseBody->accounts[2]->accountName; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 stretch-card transparent">
                                <div class="card card-light-danger">
                                    <div class="card-body">
                                        <p class="mb-4"><?= $monnify_account->responseBody->accounts[3]->bankName; ?>
                                        </p>
                                        <p class="fs-30 mb-2">
                                            <?= $monnify_account->responseBody->accounts[3]->accountNumber; ?></p>
                                        <p><?= $monnify_account->responseBody->accounts[3]->accountName; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="col-md-6 grid-margin transparent">
                        <p class="font-weight-bold">Click the button below to reserve bank accounts.</p>
                        <div class="row">
                            <form action="<?= $reserve_account; ?>" method="post">
                                <input type="hidden" name="userId" value="<?= $det->userId; ?>">
                                <button class="btn btn-primary">Reserve bank accounts</button>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- content-wrapper ends -->

<?php include "includes/footer.php"; ?>
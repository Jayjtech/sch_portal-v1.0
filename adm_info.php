<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/edit_calls.php"; ?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <h4 class="card-title">School Information</h4>
                    <form action="<?= $pusher;?>" class="forms-sample" method="POST" onsubmit="return schInfo(this)">
                        <p class="text-uppercase text-info">school description / contact</p>
                        <div class="row mt-3 mb-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">School Name</label>
                                    <input type="text" class="form-control" id="sch_name" name="sch_name"
                                        placeholder="Enter school name" value="<?= $admin_det->sch_name; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">School Motto</label>
                                    <input type="text" class="form-control" id="sch_motto" name="sch_motto"
                                        placeholder="Enter school motto" value="<?= $admin_det->sch_motto; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">School Phone Number I</label>
                                    <input type="text" class="form-control" id="sch_phone_1" name="sch_phone_1"
                                        placeholder="Enter school phone number I"
                                        value="<?= $admin_det->sch_phone_1; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">School Phone Number II</label>
                                    <input type="text" class="form-control" id="sch_phone_2" name="sch_phone_2"
                                        placeholder="Enter school phone number II"
                                        value="<?= $admin_det->sch_phone_2; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">School Email</label>
                                    <input type="text" class="form-control" id="sch_email" name="sch_email"
                                        placeholder="Enter school email" value="<?= $admin_det->sch_email; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">School Support Email</label>
                                    <input type="text" class="form-control" id="sch_support_email"
                                        name="sch_support_email" placeholder="Enter school support email"
                                        value="<?= $admin_det->sch_support_email; ?>">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <p class="text-uppercase text-info">school media platforms</p>
                        <div class="row mt-3 mb-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">School Facebook URL</label>
                                    <input type="text" class="form-control" id="fb_url" name="fb_url"
                                        placeholder="Enter school facebook URL" value="<?= $admin_det->fb_url; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">School Instagram URL</label>
                                    <input type="text" class="form-control" id="ig_url" name="ig_url"
                                        placeholder="Enter school instagram URL" value="<?= $admin_det->ig_url; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">School Twitter URL</label>
                                    <input type="text" class="form-control" id="tw_url" name="tw_url"
                                        placeholder="Enter school twitter URL" value="<?= $admin_det->tw_url; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">School Youtube URL</label>
                                    <input type="text" class="form-control" id="yt_url" name="yt_url"
                                        placeholder="Enter school youtube URL" value="<?= $admin_det->yt_url; ?>">
                                </div>
                            </div>


                        </div>
                        <hr>
                        <p class="text-uppercase text-info">current academic period</p>
                        <div class="row mt-3 mb-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Current Academic Session</label>
                                    <select class="form-control form-control-lg" name="current_session"
                                        id="current_session">
                                        <option value="<?= $admin_det->current_session; ?>">
                                            <?= $admin_det->current_session; ?></option>
                                        <?php while($row = $callSession->fetch_object()):?>
                                        <option value="<?= $row->session; ?>"><?= $row->session; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Current Academic Term</label>
                                    <select class="form-control form-control-lg" name="current_term" id="current_term">
                                        <option value="<?= $admin_det->current_term; ?>">
                                            <?= $current_term_syntax; ?></option>
                                        <option value="1">First Term</option>
                                        <option value="2">Second Term</option>
                                        <option value="3">Third Term</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <p class="text-uppercase text-info">payment gateways</p>
                        <div class="row mt-3 mb-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Flutterwave Secret Key</label>
                                    <input type="text" class="form-control" id="fl_sk_key" name="fl_sk_key"
                                        placeholder="Enter flutterwave secret key"
                                        value="<?= $admin_det->fl_sk_key; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Flutterwave Public Key</label>
                                    <input type="text" class="form-control" id="fl_pk_key" name="fl_pk_key"
                                        placeholder="Enter flutterwave public key"
                                        value="<?= $admin_det->fl_pk_key; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Paystack Secret Key</label>
                                    <input type="text" class="form-control" id="pt_sk_key" name="pt_sk_key"
                                        placeholder="Enter paystack secret key" value="<?= $admin_det->pt_sk_key; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Paystack Public Key</label>
                                    <input type="text" class="form-control" id="pt_pk_key" name="pt_pk_key"
                                        placeholder="Enter paystack public key" value="<?= $admin_det->pt_pk_key; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Monnify API Key</label>
                                    <input type="text" class="form-control" id="monnify_key" name="monnify_key"
                                        placeholder="Enter monnify APi key" value="<?= $admin_det->monnify_key; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Monnify Secret Key</label>
                                    <input type="text" class="form-control" id="monnify_secret" name="monnify_secret"
                                        placeholder="Enter monnify secret key"
                                        value="<?= $admin_det->monnify_secret; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Monnify Contract Key</label>
                                    <input type="text" class="form-control" id="monnify_contract"
                                        name="monnify_contract" placeholder="Enter monnify contract key"
                                        value="<?= $admin_det->monnify_contract; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">School Manual Account Number</label>
                                    <input type="text" class="form-control" id="manual_acct" name="manual_acct"
                                        placeholder="Enter manual account number"
                                        value="<?= $admin_det->manual_acct; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">School Manual Account Name</label>
                                    <input type="text" class="form-control" id="manual_acct_name"
                                        name="manual_acct_name" placeholder="Enter manual account name"
                                        value="<?= $admin_det->manual_acct_name; ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">School Manual Account Holder</label>
                                    <input type="text" class="form-control" id="manual_acct_holder"
                                        name="manual_acct_holder" placeholder="Enter manual account holder"
                                        value="<?= $admin_det->manual_acct_holder; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="" align="right">
                            <button type="submit" class="btn btn-primary mr-2" name="update_sch_info">Save
                                changes</button>
                        </div>

                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include "includes/footer.php"; ?>
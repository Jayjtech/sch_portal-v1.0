<?php include "includes/header.php"; ?>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo" align="center">
                                <img src="images/<?= $admin_det->img; ?>" alt="logo">
                            </div>
                            <h4>Provide your test access key to proceed to CBE</h4>
                            <form class="pt-3" id="testProceed">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="accessKey"
                                        placeholder="Access key">
                                </div>

                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <?php include "includes/log_footer.php"; ?>
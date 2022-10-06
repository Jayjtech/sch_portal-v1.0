<?php include "includes/header.php"; ?>
<?php include "includes/academic_period.php"; ?>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="images/logo.svg" alt="logo">
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form id="loginForm" class="pt-3" method="POST">
                                <div class="form-group">
                                    <input type="text" class="UserId form-control form-control-lg" id="userId"
                                        onkeyup="check()" placeholder="User - ID">
                                </div>
                                <div class="form-group">
                                    <select class="form-control form-control-lg user-category" style="display:none;"
                                        id="userCategory">
                                        <option value="">Select Category</option>
                                        <option value="c3R1ZHk=">Student</option>
                                        <option value="d29yaw==">Staff</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" class="form-control form-control-lg" id="password"
                                            placeholder="Password">
                                        <span class="input-group-text" id="eye-el" onclick="viewPassword()"><i
                                                class="mdi mdi-eye"></i></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <select class="form-control form-control-lg" id="term">
                                        <option value="<?= $current_term; ?>"><?= $term_syntax; ?> Term</option>
                                        <option value="1">First Term</option>
                                        <option value="2">Second Term</option>
                                        <option value="3">Third Term</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <select class="form-control form-control-lg" id="Session">
                                        <option value="<?= $current_session; ?>"><?= $current_session; ?></option>
                                        <?php while($row = $callSession->fetch_object()):?>
                                        <option value="<?= $row->session; ?>"><?= $row->session; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>

                                <div class="mt-3 loginResponse">
                                    <div class="mt-2 mb-3 logUser"></div>
                                    <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN
                                        IN</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            Keep me signed in
                                        </label>
                                    </div>
                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                </div>

                                <div class="text-center mt-4 font-weight-light">
                                    Don't have an account? <a href="register" class="text-primary">Create</a>
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
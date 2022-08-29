<?php include "includes/header.php"; ?>
<?php include "includes/calls.php"; ?>
<script src="js/googleapis.js"></script>
<script src="js/jquery.js"></script>

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
                            <h4>New here?</h4>
                            <h6 class="font-weight-light">Registering is easy. It only takes a few steps</h6>
                            <form class="pt-3" id="registerForm">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="name"
                                        placeholder="Full Name">
                                </div>
                                <input type="hidden" id="ip" value="<?= UserInfo::get_ip(); ?>">
                                <input type="hidden" id="device" value="<?= UserInfo::get_device(); ?>">
                                <input type="hidden" id="os" value="<?= UserInfo::get_os(); ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="email"
                                        placeholder="Email - ID">
                                </div>
                                <div class="form-group">
                                    <select class="form-control form-control-lg user-category" id="userCategory">
                                        <option value="">Select Category</option>
                                        <option value="c3R1ZHk=">Student</option>
                                        <option value="d29yaw==">Staff</option>
                                    </select>
                                </div>
                                <div class="form-group categoryResponse"></div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" class="form-control form-control-lg" id="password"
                                            placeholder="Password">
                                        <span class="input-group-text" id="eye-el" onclick="viewPassword()"><i
                                                class="mdi mdi-eye"></i></span>
                                    </div>
                                    <div id="message" class="mt-2">
                                        <h6>Password must contain the following:</h6>
                                        <span id="letter" class="invalid">A <b>lowercase</b> letter</span><br>
                                        <span id="capital" class="invalid">A <b>capital (uppercase)</b>
                                            letter</span><br>
                                        <span id="number" class="invalid">A <b>number</b></span><br>
                                        <span id="length" class="invalid">Minimum <b>8 characters</b></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" class="form-control form-control-lg" id="rPassword"
                                            placeholder="Repeat Password">
                                        <span class="input-group-text" id="eye-el2" onclick="viewPassword2()"><i
                                                class="mdi mdi-eye"></i></span>
                                    </div>
                                    <div class="mb-4">
                                        <div class="form-check">
                                            <label class="form-check-label text-muted">
                                                <input type="checkbox" class="form-check-input">
                                                I agree to all Terms & Conditions
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mt-3 registerResponse">
                                        <div class="mt-2 mb-3 createUser"></div>
                                        <button type="submit"
                                            class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                            name="register">SIGN
                                            UP</button>
                                    </div>
                                    <div class="text-center mt-4 font-weight-light">
                                        Already have an account? <a href="login" class="text-primary">Login</a>
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
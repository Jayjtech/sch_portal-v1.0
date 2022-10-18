<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php if($det->num_update == 1){
    $readonly = "readonly";
}else{
    $readonly = "";
}
?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <h4 class="card-title">Student's detail</h4>
                    <hr>
                    <form action="<?= $pusher;?>" class="forms-sample" method="POST" onsubmit="return bioData(this)">
                        <input type="hidden" name="bio_data" value="1">
                        <h6 class="text-uppercase">Educational details</h6>
                        <div class="row mt-3 mb-3">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Name</label>
                                    <input type="text" class="form-control" value="<?= $det->name; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Admission Number</label>
                                    <input type="text" class="form-control" value="<?= $det->userId; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Email - ID</label>
                                    <input type="text" class="form-control" value="<?= $det->email; ?>" readonly>
                                </div>
                            </div>
                            <?php if(!$det->staff_type):?>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Current class</label>
                                    <input type="text" class="form-control" value="<?= $det->curr_class; ?>" readonly>
                                </div>
                            </div>
                            <?php if($det->pre_class){?>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Previous class</label>
                                    <input type="text" class="form-control" value="<?= $det->pre_class; ?>" required
                                        readonly>
                                </div>
                            </div>
                            <?php }else{?>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Previous Class</label>
                                    <select name="pre_class" id="pre_class" class="form-control" required>
                                        <option value="">Choose previous class</option>
                                        <?php for($i = 0; $i<count($classData); $i++){?>
                                        <option value="<?= $classData[$i]->class; ?>">
                                            <?= $classData[$i]->class; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <?php }?>
                            <?php if($det->department){?>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Department</label>
                                    <input type="text" class="form-control" value="<?= $det->department; ?>" required
                                        readonly>
                                </div>
                            </div>
                            <?php }else{?>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Department</label>
                                    <select name="department" id="department" class="form-control" required>
                                        <option value="">Choose department</option>
                                        <option value="Non">Non</option>
                                        <option value="Art">Art</option>
                                        <option value="Science">Science</option>
                                        <option value="Commercial">Commercial</option>
                                    </select>
                                </div>
                            </div>
                            <?php }?>
                            <?php endif; ?>
                        </div>
                        <hr>
                        <h6 class="text-uppercase">Other details</h6>
                        <div class="row">
                            <?php if(!$det->staff_type):?>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Father's name</label>
                                    <input type="text" class="form-control" id="father_name" <?= $readonly; ?> required
                                        value="<?= $det->father_name?>" name="father_name"
                                        placeholder="Enter father's name">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mother's name</label>
                                    <input type="text" class="form-control" id="mother_name" <?= $readonly; ?>
                                        name="mother_name" value="<?= $det->mother_name?>"
                                        placeholder="Enter mother's name" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Father/Mother's phone number separated by a
                                        comma</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="<?= $det->phone?>" placeholder="eg. 07034876144,07069056472"
                                        <?= $readonly; ?> required>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Your Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" <?= $readonly; ?> required
                                        name="dob" value="<?= $det->dob?>">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Religion</label>
                                    <input type="text" class="form-control" id="religion" name="religion"
                                        value="<?= $det->religion?>" <?= $readonly; ?> placeholder="Enter your religion"
                                        required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nationality</label>
                                    <input type="text" class="form-control" id="nationality" name="nationality"
                                        placeholder="Enter your nationality" <?= $readonly; ?>
                                        value="<?= $det->nationality?>" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">State of Origin</label>
                                    <input type="text" class="form-control" id="state_of_origin" name="state_of_origin"
                                        <?= $readonly; ?> value="<?= $det->state_of_origin?>"
                                        placeholder="Enter your state of origin" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Local Government Area</label>
                                    <input type="text" class="form-control" id="local_government"
                                        value="<?= $det->local_government?>" name="local_government" required
                                        <?= $readonly; ?> placeholder="Enter assignment duration" <?= $readonly; ?>>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Residential address</label>
                                    <input type="text" class="form-control" id="home_address" name="home_address"
                                        value="<?= $det->home_address?>" placeholder="Enter assignment duration"
                                        <?= $readonly; ?> required>
                                </div>
                            </div>
                        </div>
                        <?php if($det->num_update == 0): ?>
                        <button type="submit" class="btn btn-primary mr-2" name="bio_data">Update</button>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <h4 class="card-title">Upload profile picture</h4>
                    <hr>
                    <div class="col-lg-4">
                        <div class="" id="uploaded_image">
                            <div class="wrapper" style="background:url('images/profile/<?= $p_img; ?>'); height:150px;width:150px;position:relative;border:5px solid #fefeee;
											border-radius: 50%;background-size: 100% 100%;margin: 0px auto;overflow:hidden;">
                                <box-icon type='solid' name='camera'></box-icon>
                                <input type="file" name="file" id="file" class="my_file" accept="image/png, image/jpeg"
                                    class="account-file-input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wrapper ends -->
<script type="text/javascript">

</script>
<?php include "includes/footer.php"; ?>
<?php if(!$det->home_address && $det->user_type != "QWRtaW4="):?>
<script>
swal.fire({
    title: `Please take time to fill-up your Bio-data!`,
    text: `This is a very important requirement.`,
    icon: `warning`,
})
</script>
<?php endif; ?>
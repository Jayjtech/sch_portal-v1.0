<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/edit_calls.php"; ?>
<?php if(!in_array($det->position, $adminLevel2)): ?>
<script>
window.location.href = "login?msg=Access denied!&msg_type=error"
</script>
<?php endif; ?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Student List</p>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Adm. No.</th>
                                    <th>Email | Phone</th>
                                    <th>Class</th>
                                    <th>Department</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($stu = $callStudents->fetch_object()):
                                    switch($stu->img){
                                        case false:
                                        $st_img = 'default-img.jpg';
                                        break;
                                        case true:
                                        $st_img = $stu->img;
                                        break;
                                    }
                                    ?>
                                <tr>
                                    <td class="py-1"><img src="images/profile/<?= $st_img; ?>" alt="image" />
                                    </td>
                                    <td><?= $stu->name; ?></td>
                                    <td class="font-weight-bold"><?= $stu->userId; ?></td>
                                    <td><?= $stu->email; ?> | <?= $stu->phone; ?></td>
                                    <td class="font-weight-bold"><?= $stu->curr_class; ?></td>
                                    <td><?= $stu->department; ?></td>
                                    <td>
                                        <a href="adm_students?rev=<?= htmlspecialchars($stu->token); ?>&ac=<?= htmlspecialchars($stu->userId); ?>"
                                            class="btn-sm btn-primary"><i class="mdi mdi-pen"></i> Review </a>
                                    </td>
                                    <td>
                                        <form action="<?= $pusher; ?>" method="POST" onsubmit="return delStudent(this)">
                                            <input type="hidden" name="adm_no" value="<?= $stu->userId?>">
                                            <input type="hidden" name="delete_student" value="<?= $stu->userId?>">
                                            <button type="submit" name="" class="btn-sm btn-danger"><i
                                                    class="mdi mdi-delete"></i></button>
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
    <?php if(isset($_GET['rev'])):?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <h4 class="card-title">Review Student</h4>
                    <hr>

                    <form action="<?= $pusher; ?>" class="forms-sample" method="POST" onsubmit="return revStu(this)">
                        <div class="row mt-3 mb-3">
                            <div class="col-sm-6">
                                <div class="wrapper" style="background:url('images/profile/<?= $ed_img; ?>'); height:150px;width:150px;position:relative;border:5px solid #fefeee;
											border-radius: 50%;background-size: 100% 100%;margin: 0px auto;overflow:hidden;">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Token</label>
                                    <input type="text" class="form-control" id="token" name="token"
                                        value="<?= $edStu->token; ?>" readonly>
                                </div>
                            </div>
                            <div class="row col-sm-6">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter student's name" value="<?=$edStu->name; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Current Class</label>
                                        <select name="curr_class" id="curr_class" class="form-control" required>
                                            <option value="<?= $curr_class_val; ?>"><?= $curr_class; ?></option>
                                            <?php for($i = 0; $i<count($classData); $i++){?>
                                            <option value="<?= $classData[$i]->class; ?>">
                                                <?= $classData[$i]->class; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="text-info">Compulsory fee discount in %</label>
                                    <input type="number" class="form-control" id="tuition_discount"
                                        name="tuition_discount" placeholder="Enter tuition fee discount in %"
                                        value="<?= $edStu->tuition_discount; ?>">
                                </div>
                            </div>

                            <input type="hidden" name="adm_no" value="<?= $edStu->userId?>">
                            <input type="hidden" name="review_student" value="1">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Award type</label>
                                    <select name="award_type" id="award_type" class="form-control" required>
                                        <option value="<?= $award_val; ?>"><?= $award; ?></option>
                                        <?php while($awd = $callStudentAward->fetch_object()):?>
                                        <option value="<?= $awd->award; ?>"><?= $awd->award; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control form-control-lg" id="password"
                                            name="code_d" placeholder="Password" onkeyup="show()"
                                            value="<?= base64_decode($edStu->code_d); ?>" required>
                                        <span class="input-group-text" id="eye-el" onclick="viewPassword()"><i
                                                class="mdi mdi-eye"></i></span>
                                        <p class="text-danger p-format" style="display:none;">Minimum length: 8; at
                                            least an uppercase and a lowercase letter eg. Math14ew</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <?php if(in_array($det->position, $adminLevel1)): ?>
                        <div class="mt-2 mb-3 navigator">
                            <a class="btn btn-light" onclick="openBills();"><i class="mdi mdi-receipt"></i> Click to
                                view
                                student's bills</a>
                        </div>
                        <?php endif; ?>
                        <div class="container bill-container">
                            <p class="text-uppercase text-info">BILLS</p>
                            <div class="row">
                                <div class="col-sm-8"></div>
                                <div class="total-box col-sm-4"></div>
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
                                                value="<?= !empty($bil->$bill_name) ? $bil->$bill_name: 0; ?>">
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
                                                name="<?= $row->bill_name; ?>" placeholder="Enter school fee"
                                                value="<?= !empty($bil->$bill_name) ? $bil->$bill_name: null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <?php endwhile; ?>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="">What does other fees cover?</label>
                                        <textarea id="others_covers" name="others_covers" cols="3" class="form-control"
                                            rows="2"
                                            placeholder="What does other fees cover?"><?= !empty($bil->others_covers) ?$bil->others_covers :null;?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="" align="right">
                            <button type="submit" class="btn btn-primary mr-2" name="review_staff">Save
                                Changes</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php include "includes/sum_bills.php"; ?>
    <?php include "includes/footer.php"; ?>
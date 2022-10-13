<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/edit_calls.php"; ?>
<?php if(!in_array($det->position, $adminLevel1)): ?>
<script>
window.location.href = "login?msg=Access denied!&msg_type=error"
</script>
<?php endif; ?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Staff List</p>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>ID</th>
                                    <th>Type</th>
                                    <th>Class Officiating</th>
                                    <th>POD.</th>
                                    <!-- <th>Privileges</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $callStaff->fetch_object()):
                                    $st_position = $row->position;
                                    $st_privileges = $row->privileges;
                                    $given_month = false;
                                    $status = false;
                                    include "includes/status_const.php";
                                       switch($row->img){
                                            case false:
                                            $st_img = 'default-img.jpg';
                                            break;
                                            case true:
                                            $st_img = $row->img;
                                            break;
                                        }
                                    ?>
                                <tr>
                                    <td class="py-1"><img src="images/profile/<?= $st_img; ?>" alt="image" />
                                    </td>
                                    <td><?= $row->name; ?></td>
                                    <td class="font-weight-bold"><?= $row->userId; ?></td>
                                    <td><?= $row->staff_type; ?></td>
                                    <td><?= $row->class_officiating; ?></td>
                                    <td><?= $POD; ?></td>
                                    <td>
                                        <a href="adm_staff?pod=<?= htmlspecialchars($row->token); ?>"
                                            class="btn-sm btn-primary"><i class="mdi mdi-pen"></i> Review </a>
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
    <?php if(isset($_GET['pod'])):?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <h4 class="card-title">Review Staff</h4>
                    <form action="<?= $pusher;?>" class="forms-sample" method="POST" onsubmit="return revStaff(this)">
                        <div class="row mt-3 mb-3">
                            <div class="col-sm-6">
                                <div class="wrapper" style="background:url('images/profile/<?= $ed_img; ?>'); height:150px;width:150px;position:relative;border:5px solid #fefeee;
											border-radius: 50%;background-size: 100% 100%;margin: 0px auto;overflow:hidden;">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter staff's name" value="<?=$edS->name; ?>">
                                </div>
                            </div>
                            <input type="hidden" name="token" value="<?= $edS->token?>">
                            <input type="hidden" name="review_staff" value="1">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Post of Duty</label>
                                    <select name="position" id="position" class="form-control">
                                        <option value="<?= $choose_pod_val; ?>"><?= $choose_pod; ?></option>
                                        <option value="1">Proprietor</option>
                                        <option value="2">Principal</option>
                                        <option value="3">Vice Principal</option>
                                        <option value="4">Head Teacher</option>
                                        <option value="5">Teacher</option>
                                        <option value="6">Bursar</option>
                                        <option value="7">Treasurer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control form-control-lg" id="password"
                                            name="code_d" placeholder="Password" onchange="show()"
                                            value="<?= base64_decode($edS->code_d); ?>">
                                        <span class="input-group-text" id="eye-el" onclick="viewPassword()"><i
                                                class="mdi mdi-eye"></i></span>
                                        <p class="text-danger p-format" style="display:none;">Minimum length: 8; at
                                            least an uppercase and a lowercase letter eg. Math14ew</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Level</label>
                                    <select name="level" id="" required class="form-control">
                                        <option value="<?= $assign_level_val; ?>"><?= $assign_level; ?></option>
                                        <?php while($lev = $callStaffLevels->fetch_object()):?>
                                        <option value="<?= $lev->level?>">Level-<?= $lev->level?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Class Officiating</label>
                                    <select name="class_officiating" id="class_officiating" class="form-control"
                                        required>
                                        <option value="<?= $assign_class_val; ?>"><?= $assign_class; ?></option>
                                        <option value="Non">Non</option>
                                        <?php for($i = 0; $i<count($classData); $i++){?>
                                        <option value="<?= $classData[$i]->class; ?>">
                                            <?= $classData[$i]->class; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Salary</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><?= $currency; ?></span>
                                        <input type="number" class="form-control" id="salary" name="salary"
                                            placeholder="Enter staff's salary" readonly value="<?=$edS->salary; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2" name="review_staff">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>


    <?php include "includes/footer.php"; ?>
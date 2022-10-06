<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/edit_calls.php"; ?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Staff List</p>
                    <?php if($callStaff->num_rows > 0){ ?>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>ID</th>
                                    <th>Type</th>
                                    <th>Class Officiating</th>
                                    <th>POD.</th>
                                    <th>Privileges</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $callStaff->fetch_object()):
                                    switch($row->position){
                                            case 0:
                                                $POD = '<div class="text-danger">Yet to be assigned!</div>';
                                                break;
                                            case 1:
                                                $POD = "Proprietor";
                                                break;
                                            case 2:
                                                $POD = "Principal";
                                                break;
                                            case 3:
                                                $POD = "Vice Principal";
                                                break;
                                            case 4:
                                                $POD = "Head Teacher";
                                                break;
                                            case 5:
                                                $POD = "Teacher";
                                                break;
                                            case 6:
                                                $POD = "Bursar";
                                                break;
                                            case 7:
                                                $POD = "Treasurer";
                                                break;
                                        }

                                        switch($row->privileges){
                                            case 0:
                                                $priv = '<div class="text-danger">Yet to be assigned!</div>';
                                                break;
                                            case 1:
                                                $priv = "|Student|Staff|Exam|Documents|Revenue|";
                                                break;
                                            case 2:
                                                $priv = "|Student|Staff|Exam|Documents|";
                                                break;
                                            case 3:
                                                $priv = "|Student|Staff|Exam|";
                                                break;
                                            case 4:
                                                $priv = "|Student|Staff|";
                                                break;
                                            case 5:
                                                $priv = "|Student|";
                                                break;
                                        }
                                    ?>
                                <tr>
                                    <td><?= $row->name; ?></td>
                                    <td class="font-weight-bold"><?= $row->userId; ?></td>
                                    <td><?= $row->staff_type; ?></td>
                                    <td><?= $row->class_officiating; ?></td>
                                    <td><?= $POD; ?></td>
                                    <td><?= $priv; ?></td>
                                    <td>
                                        <a href="adm_staff?pod=<?= htmlspecialchars($row->token); ?>"
                                            class="btn-sm btn-primary"><i class="mdi mdi-pen"></i> Review </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php }else{ ?>
                    <div class="alert alert-danger mt-5">This table is empty!</div>
                    <?php } ?>
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
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter staff's name" value="<?=$edS->name; ?>">
                                </div>
                            </div>
                            <input type="hidden" name="token" value="<?= $edS->token?>">
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
                                    <label for="">Privilege</label>
                                    <select name="privileges" id="privileges" class="form-control">
                                        <option value="<?= $assign_priv_val; ?>"><?= $assign_priv; ?></option>
                                        <option value="1">|Student|Staff|Exam|Documents|Revenue|</option>
                                        <option value="2">|Students|Staff|Exam|Documents|</option>
                                        <option value="3">|Students|Staff|Exam|</option>
                                        <option value="4">|Students|Staff|</option>
                                        <option value="5">|Students|</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Class Officiating</label>
                                    <select name="class_officiating" id="class_officiating" class="form-control"
                                        required>
                                        <option value="<?= $assign_class_val; ?>"><?= $assign_class; ?></option>
                                        <?php for($i = 0; $i<count($classData); $i++){?>
                                        <option value="<?= $classData[$i]->class; ?>">
                                            <?= $classData[$i]->class; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary mr-2" name="review_staff">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>


    <?php include "includes/footer.php"; ?>
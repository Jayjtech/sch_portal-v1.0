<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/edit_calls.php"; ?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Enrolment List for <?= $term_syntax?> term | <?= $log_session; ?></p>
                    <?php if($callStudents->num_rows > 0){ ?>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Adm. No.</th>
                                    <th>Course[Code]</th>
                                    <th>[ASS]+[CA1]+[CA2]+[EXAM] = [TOTAL]</th>
                                    <th>Token</th>
                                    <th>Status</th>
                                    <th>Paper Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($enr = $callEnrolmentList->fetch_object()):
                                    switch($enr->status){
                                        case 0: 
                                            $status = "Not taken";
                                            $col = "badge badge-warning";
                                            break;
                                        case 1: 
                                            $status = "Taken";
                                            $col = "badge badge-success";
                                            break;
                                    }
                                    ?>
                                <tr>
                                    <td><?= $enr->name; ?></td>
                                    <td class="font-weight-bold"><?= $enr->adm_no; ?></td>
                                    <td><?= $enr->course; ?>[<?= $enr->course_code; ?>]</td>
                                    <td>[ <?= $enr->ass; ?> ] + [ <?= $enr->ca1; ?> ] + [ <?= $enr->ca2; ?> ] + [
                                        <?= $enr->exam; ?> ] =
                                        [ <?= $enr->total; ?> ]</td>
                                    <td><?= $enr->exam_token; ?></td>
                                    <td>
                                        <p class="<?= $col; ?>"><?= $status; ?></p>
                                    </td>
                                    <td><?= $enr->paper_type; ?></td>
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

    <div class="row">
        <div class="col-md-6 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Upload Exam Time-table</p>
                    <div class="mt-2">
                        <div class="container">
                            <p>Click the green button to download the time-table format as an Excel CSV file.</p>
                            <p class="text-info">Note: Time-table will be downloaded for the term and session you logged
                                in to.</p>
                            <form action="<?= $exporter; ?>" method="get">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select name="class_category" id="class_category" class="form-control"
                                                required>
                                                <option value="">Class category</option>
                                                <option value="SS">Senior School</option>
                                                <option value="JS">Junior School</option>
                                                <option value="PR">Primary School</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="table" value="<?= $time_tbl; ?>">
                                    <input type="hidden" name="term" value="<?= $term_syntax; ?> term">
                                    <input type="hidden" name="session" value="<?= $log_session; ?>">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <button class="btn btn-success"><i class="mdi mdi-download"></i> Excel
                                                Format</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="container mt-3">
                            <P class="card-title">Upload</P>
                            <form action="<?= $pusher;?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select name="class_category" id="class_category" class="form-control"
                                                required>
                                                <option value="">Class category</option>
                                                <option value="Senior School">Senior School</option>
                                                <option value="Junior School">Junior School</option>
                                                <option value="Primary School">Primary School</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="term" value="<?= $term_syntax; ?> term">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Choose Time-table Excel File</label>
                                            <input type="file" name="file" class="form-control btn btn-dark" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <button type="submit" name="push_time_table" class="btn btn-primary"><i
                                                    class="mdi mdi-upload"></i> Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 stretch-card grid-margin">
            <div class="row">
                <div class="grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Uploaded Courses</p>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Course</th>
                                            <th>Type</th>
                                            <th>No. of Q</th>
                                            <th>Department</th>
                                            <th colspan="2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $coursesT=$conn->query("SELECT * FROM $course_tbl WHERE term='$log_term' AND session='$log_session'");
                                                while($row = $coursesT->fetch_object()):
                                                    $cCode = $row->course_code;
                                                $selectUpload = $conn->query("SELECT * FROM $question_tbl_a WHERE course_code='$cCode' AND session='$log_session' LIMIT 1");
                                        ?>
                                        <tr>
                                            <?php while($sel = $selectUpload->fetch_object()){ ?>
                                            <td><?= $row->course; ?>[<?= $sel->course_code; ?>]</td>
                                            <td><?= $sel->quest_type; ?></td>
                                            <td><?= $row->no_of_quest; ?></td>
                                            <td><?= $row->department; ?></td>
                                            <td></td>

                                        </tr>
                                        <?php } ?>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>


    <?php include "includes/footer.php"; ?>
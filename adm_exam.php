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
    <?php if(isset($_GET['result_template'])): ?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Result template setting</p>
                    <div class="" align="right">
                        <a href="?enrolment_list" class="btn btn-success">Enrolment list</a>
                        <a href="?time_table" class="btn btn-primary">Time table</a>
                    </div>
                    <hr>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Select result template</label>
                            <select name="result_type" class="result-type form-control">
                                <option value="1">Default</option>
                                <option value="2">Type 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="">Preview</label>
                        <div class="resultTypeResponse">
                            <div class="alert alert-success col-sm-8">Current result template
                                <em><strong><?= $r_t_syntax; ?></strong></em>
                            </div>
                            <div class="mt-3">
                                <img src="<?= $r_t_imgUrl; ?>" class="img-thumbnail" alt="Result Template">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php endif; ?>

    <?php if(isset($_GET['enrolment_list'])): ?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Enrolment List for <?= $term_syntax; ?> term | <?= $log_session; ?></p>
                    <div class="" align="right">
                        <a href="?result_template" class="btn btn-danger">Result template</a>
                        <a href="?time_table" class="btn btn-primary">Time table</a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Adm. No.</th>
                                    <th>Course[Code]</th>
                                    <th>Status</th>
                                    <th></th>
                                    <th>[ASS]+[CA1]+[CA2]+[CA3]+[EXAM] = [TOTAL]</th>
                                    <th>Token</th>
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
                                    <td>
                                        <p class="<?= $col; ?>"><?= $status; ?></p>
                                    </td>
                                    <td>
                                        <?php if($status == "Taken"):?>
                                        <form action="<?= $exam_query; ?>" onsubmit="return reTakeExam(this)"
                                            method="post">
                                            <input type="hidden" name="retake_exam" value="<?= $enr->exam_token ;?>">
                                            <input type="hidden" name="student_name" value="<?= $enr->name ;?>">
                                            <button type="submit" class="btn-sm btn-primary">Re-take</button>
                                        </form>
                                        <?php endif; ?>
                                    </td>
                                    <td>[ <?= $enr->ass; ?> ] + [ <?= $enr->ca1; ?> ] + [ <?= $enr->ca2; ?> ] + [
                                        <?= $enr->ca3; ?> ] + [
                                        <?= !empty($enr->exam) ? :$enr->score; ?> ]
                                        [ <?= $enr->total; ?> ]</td>
                                    <td><?= $enr->exam_token; ?></td>
                                    <td><?= $enr->paper_type; ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(isset($_GET['time_table'])): ?>
    <div class="row">
        <div class="col-md-12 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Exam time-table</p>
                    <div class="" align="right">
                        <a href="result_template" class="btn btn-danger">Result template</a>
                        <a href="?enrolment_list" class="btn btn-success">Enrolment list</a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Day [Date]</th>
                                    <th>1st Period</th>
                                    <th>2nd Period</th>
                                    <th>3rd Period</th>
                                    <th>4th Period</th>
                                    <th>5th Period</th>
                                    <th>Class</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($tim = $callTimeTable->fetch_object()): ?>
                                <tr>
                                    <td><?= $tim->day; ?> [<?= $tim->exam_date; ?>]</td>
                                    <td><?= $tim->period_1; ?></td>
                                    <td><?= $tim->period_2; ?></td>
                                    <td><?= $tim->period_3; ?></td>
                                    <td><?= $tim->period_4; ?></td>
                                    <td><?= $tim->period_5; ?></td>
                                    <td><?= $tim->class_array; ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Upload Exam Time-table</p>
                    <hr>
                    <div class="mt-2">
                        <div class="container">
                            <p>Click the green button to download the time-table format as an Excel CSV file.</p>
                            <p class="text-info">Note: Time-table will be downloaded for the term and session you
                                logged
                                in to.</p>
                            <form action="<?= $exporter; ?>" method="get">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select name="class_category" id="class_category" class="form-control"
                                                required>
                                                <option value="">Class category</option>
                                                <option value="Senior-School">Senior School</option>
                                                <option value="Junior-School">Junior School</option>
                                                <option value="Primary-School">Primary School</option>
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
                            <form action="<?= $add_course;?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select name="class_category" id="class_category" class="form-control"
                                                required>
                                                <option value="">School category</option>
                                                <option value="Senior-School">Senior School</option>
                                                <option value="Junior-School">Junior School</option>
                                                <option value="Primary-School">Primary School</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="term" value="<?= $term_syntax; ?> term">
                                    <div class="col-sm-6">
                                        <div class="form-group">
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
                        <hr>
                        <div class="container mt-3">
                            <P class="card-title">Clear time-table</P>
                            <form action="<?= $course_deleter; ?>" onsubmit="return delTimeTbl(this)" method="get">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select name="class_category" id="class_category" class="form-control"
                                                required>
                                                <option value="">Class category</option>
                                                <option value="Senior-School">Senior School</option>
                                                <option value="Junior-School">Junior School</option>
                                                <option value="Primary-School">Primary School</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="del_table" value="<?= $time_tbl; ?>">
                                    <input type="hidden" name="term" value="<?= $term_syntax; ?> term">
                                    <input type="hidden" name="session" value="<?= $log_session; ?>">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <button class="btn btn-danger"><i class="mdi mdi-delete"></i>
                                                Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>


<?php include "includes/footer.php"; ?>
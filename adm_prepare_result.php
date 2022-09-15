<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/edit_calls.php"; ?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Score sheet for <?= $term_syntax?> term | <?= $log_session; ?></p>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Name[Adm No.]</th>
                                    <th>Class</th>
                                    <th>Course[Code]</th>
                                    <th>[ASS]+[CA1]+[CA2]+[THEORY+OBJ] = [TOTAL]</th>
                                    <th>Position</th>
                                    <th>Grade</th>
                                    <th>Remark</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($scr = $callScoreSheet->fetch_object()):?>
                                <tr>
                                    <td><?= $scr->name; ?>[<?= $scr->adm_no; ?>]</td>
                                    <td class="font-weight-bold"><?= $scr->class; ?></td>
                                    <td><?= $scr->course; ?>[<?= $scr->course_code; ?>]</td>
                                    <td>[ <?= $scr->ass; ?> ] + [ <?= $scr->ca1; ?> ] + [ <?= $scr->ca2; ?> ] + [
                                        <?= $scr->theory; ?> + <?= $scr->score; ?> ] =
                                        [ <?= $scr->total; ?> ]</td>
                                    <td><?= $scr->position; ?></td>
                                    <td><?= $scr->grade; ?></td>
                                    <td><?= $scr->remark; ?></td>
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
                            <p>Click the green button to download the score-sheet format as an Excel CSV file.</p>
                            <p class="text-info">Note: Score-sheet will be downloaded for the term and session you
                                logged in to and based on your choice of class.</p>
                            <form action="<?= $exporter; ?>" method="get">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select name="course_code" id="course_code" class="form-control" required>
                                                <option value="">Course code</option>
                                                <?php while($sel = $selCourses->fetch_object()):?>
                                                <option value="<?= $sel->course_code; ?>">
                                                    <?= $sel->course_code; ?> [<?= $sel->course; ?>]
                                                </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="table" value="<?= $score_tbl; ?>">
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
                            <p>Select the score-sheet you want to upload</p>
                            <p class="text-info">Note: Score will be inserted into the spots that has the course codes
                                in the score sheet.</p>
                            <form action="<?= $add_course;?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="term" value="<?= $term_syntax; ?> term">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="file" name="file" class="form-control btn btn-dark" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <button type="submit" name="push_score_sheet" class="btn btn-primary"><i
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


</div>


<?php include "includes/footer.php"; ?>
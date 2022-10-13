<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/edit_calls.php"; ?>
<?php if(!in_array($det->position, $worker)): ?>
<script>
window.location.href = "login?msg=Access denied!&msg_type=error"
</script>
<?php endif; ?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Comment table for <?= $term_syntax?> term | <?= $log_session; ?></p>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Name[Adm No.]</th>
                                    <th>Class</th>
                                    <th>Overall</th>
                                    <th>Out of</th>
                                    <th>% Score</th>
                                    <th>Position</th>
                                    <th>Promoted-to</th>
                                    <th>Teacher's Comment</th>
                                    <th>Head-teacher's Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($scr = $callEvaluation->fetch_object()):?>
                                <tr>
                                    <td><?= $scr->name; ?>[<?= $scr->adm_no; ?>]</td>
                                    <td class="font-weight-bold"><?= $scr->class; ?></td>
                                    <td><?= $scr->overall_score; ?></td>
                                    <td><?= $scr->out_of; ?></td>
                                    <td><?= $scr->percent_score; ?></td>
                                    <td><?= $scr->position; ?></td>
                                    <td><?= $scr->promoted_to; ?></td>
                                    <td><?= $scr->t_comment; ?></td>
                                    <td><?= $scr->p_comment; ?></td>
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
                    <p class="card-title mb-0">Comment uploader</p>
                    <hr>
                    <div class="mt-2">
                        <div class="container">
                            <p>Click the green button to download the comment format as an Excel CSV file.</p>
                            <p class="text-info">Note: Comment will be downloaded for the term and session you
                                logged in to and based on the class you officiate or the class you select.</p>
                            <form action="<?= $exporter; ?>" method="get">
                                <div class="row">
                                    <input type="hidden" name="table" value="<?= $evaluation_tbl; ?>">
                                    <input type="hidden" name="type" value="teacher">

                                    <div class="col-sm-4">
                                        <?php if(in_array($det->position, $adminLevel2)): ?>
                                        <div class="form-group">
                                            <label for="">Select class</label>
                                            <select name="class_officiating" id="class_officiating" class="form-control"
                                                required>
                                                <option value="">Select class</option>
                                                <?php for($i = 0; $i<count($classData); $i++){?>
                                                <option value="<?= $classData[$i]->class; ?>">
                                                    <?= $classData[$i]->class; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <?php endif; ?>

                                        <div class="form-group">
                                            <button class="btn btn-success"><i class="mdi mdi-download"></i> Teacher's
                                                comment format</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>

                        <div class="container mt-3">
                            <P class="card-title">Upload teacher's comment</P>
                            <p>Select the comment file you want to upload</p>
                            <p class="text-info">Note: Comment will be inserted into the spots that has the admission
                                number in the comment file.</p>
                            <form action="<?= $add_course;?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="term" value="<?= $term_syntax; ?> term">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="file" name="file" class="form-control btn btn-dark" required>
                                        </div>
                                        <?php if(in_array($det->position, $adminLevel2)): ?>
                                        <div class="form-group">
                                            <label for="">Select class</label>
                                            <select name="class_officiating" id="class_officiating" class="form-control"
                                                required>
                                                <option value="">Select class</option>
                                                <?php for($i = 0; $i<count($classData); $i++){?>
                                                <option value="<?= $classData[$i]->class; ?>">
                                                    <?= $classData[$i]->class; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <?php endif; ?>
                                    </div>

                                    <input type="hidden" value="1" name="upload_t_comment">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <button type="submit" name="" class="btn btn-primary"><i
                                                    class="mdi mdi-upload"></i> Upload teacher's comment</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>

                        <?php if(in_array($det->position, $adminLevel2)): ?>

                        <div class="container mt-3">
                            <p>Click the green button to download the comment format as an Excel CSV file.</p>
                            <p class="text-info">Note: Comment will be downloaded for the term and session you
                                logged in to and will contain the list of all students.</p>
                            <form action="<?= $exporter; ?>" method="get">
                                <div class="row">
                                    <input type="hidden" name="table" value="<?= $evaluation_tbl; ?>">
                                    <input type="hidden" name="type" value="head_teacher">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <button class="btn btn-success"><i class="mdi mdi-download"></i> Head
                                                teacher's comment format</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <P class="card-title">Upload Head Teacher's Comment</P>
                            <p>Select the comment file you want to upload</p>
                            <p class="text-info">Note: Comment will be inserted into the spots that has the admission
                                number in the comment file.</p>
                            <form action="<?= $add_course;?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="term" value="<?= $term_syntax; ?> term">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="file" name="file" class="form-control btn btn-dark" required>
                                        </div>
                                    </div>
                                    <input type="hidden" value="1" name="upload_h_comment">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <button type="submit" name="" class="btn btn-primary"><i
                                                    class="mdi mdi-upload"></i> Upload head teacher's comment</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>


<?php include "includes/footer.php"; ?>
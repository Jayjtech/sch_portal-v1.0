<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>

<div class="content-wrapper">
    <?php if(isset($_GET['material_table']) == true):?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Course material for <?= $term_syntax; ?> term</p>
                    <div class="" align="right">
                        <a href="?submissions" class="btn btn-primary">Submissions</a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Teacher</th>
                                    <th>Course</th>
                                    <th>Title</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $myCourseMat->fetch_object()):?>
                                <tr>
                                    <td class="font-weight-bold"><?= $row->name; ?></td>
                                    <td><?= $row->course; ?>[<?= $row->course_code;?>]</td>
                                    <td><?= $row->title; ?></td>
                                    <td><a href="course_material/<?= $row->file; ?>" style="text-decoration:none;"
                                            class="btn-sm btn-info">View</a>
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
    <?php endif; ?>

    <?php if(isset($_GET['submissions']) == true):?>
    <div class="row">
        <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Send response to teachers</p>
                    <div class="" align="right">
                        <a href="?material_table" class="btn btn-primary">Course materials</a>
                    </div>
                    <hr>
                    <form action="<?= $add_course; ?>" method="post" enctype="multipart/form-data"
                        onsubmit="return docSub(this)">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Select file</label>
                                    <input type="file" name="file" class="form-control btn btn-dark" required>
                                </div>
                            </div>
                            <input type="hidden" name="submission" value="1">
                            <div class="col-sm-12">
                                <label for="">Material title</label>
                                <select name="mat_id" class="form-control" required>
                                    <option value="">Material title</option>
                                    <?php while($row = $matTitle->fetch_object()): ?>
                                    <option value="<?= $row->id; ?>"><?= $row->title; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="p-2" align="right">
                                <button type="submit" name="" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">My submissions for <?= $term_syntax; ?> term</p>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Title</th>
                                    <th>To</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $mySubmissions->fetch_object()):
                                    $status = $row->status;
                                    include "includes/status_const.php";
                                    ?>
                                <tr>
                                    <td><?= $row->course; ?>[<?= $row->course_code;?>]</td>
                                    <td><?= $row->title; ?></td>
                                    <td><?= $row->teacher; ?></td>
                                    <td><?= $status_syntax; ?></td>
                                    <td>
                                        <?php if($row->status == 0): ?>
                                        <form action="<?= $course_deleter; ?>" method="GET"
                                            onsubmit="return delSub(this)">
                                            <input type="hidden" name="del_sub" value="<?= $row->id; ?>">
                                            <input type="hidden" name="document" value="<?= $row->file; ?>">
                                            <button class="btn-sm btn-danger"><i class="mdi mdi-delete"></i></button>
                                        </form>
                                        <?php endif; ?>
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


    <?php endif; ?>

</div>
<!-- content-wrapper ends -->

<?php include "includes/footer.php"; ?>
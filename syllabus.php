<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Syllabus for <?= $term_syntax; ?> term</p>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Title</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $mySyllabus->fetch_object()):?>
                                <tr>
                                    <td><?= $row->course; ?>[<?= $row->course_code;?>]</td>
                                    <td><?= $row->title; ?></td>
                                    <td><a href="course_material/<?= $row->file; ?>" class="btn-sm btn-info">View</a>
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

</div>
<!-- content-wrapper ends -->

<?php include "includes/footer.php"; ?>
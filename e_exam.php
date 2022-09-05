<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <h4 class="card-title">Available E- Exam [Assignment | Test | Exam] </h4>
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
                                <?php $coursesT=$conn->query("SELECT * FROM $course_tbl WHERE department='$department' OR department='general' AND (term='$log_term' AND session='$log_session')");
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
                                    <td>
                                        <form action="" method="get" onsubmit="return enrolCourse(this)">
                                            <input type="text" name="userId" value="<?= $userId ;?>">
                                        </form>
                                    </td>

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
<!-- content-wrapper ends -->

<?php include "includes/footer.php"; ?>
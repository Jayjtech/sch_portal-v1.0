<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <h4 class="card-title">Available E- Exam [Assignment | Test | Exam] </h4>
                    <p class="text-info"><strong>NOTE:</strong> You must have enrolled in order to be able to
                        take tests and Assignments.</p>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Type</th>
                                    <th>No. of Q</th>
                                    <th>Enrolment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $coursesT=$conn->query("SELECT * FROM $course_tbl WHERE (term='$log_term' AND session='$log_session') AND (department='$department' OR department='general')");
                                        while($row = $coursesT->fetch_object()):
                                            $cCode = $row->course_code;
                                        $selectUpload = $conn->query("SELECT * FROM $question_tbl_a WHERE (course_code='$cCode' AND session='$log_session') LIMIT 1");
                                    ?>
                                <tr>
                                    <?php while($sel = $selectUpload->fetch_object()){ 
                                          $checkScoreSheet = $conn->query("SELECT * FROM $score_tbl WHERE (course_code='$cCode' AND adm_no='$userId' AND session='$log_session' AND term='$log_term')");
                                        $chk = $checkScoreSheet->fetch_object();
                                        switch($checkScoreSheet->num_rows){
                                        case 0: 
                                            $status = "Not enrolled";
                                            $col = "badge badge-warning";
                                            break;
                                        case 1: 
                                            $status = "Enrolled";
                                            $col = "badge badge-success";
                                            break;
                                    }
                                        ?>
                                    <td><?= $row->course; ?>[<?= $sel->course_code; ?>]</td>
                                    <td><?= $sel->quest_type; ?></td>
                                    <td><?= $row->no_of_quest; ?></td>
                                    <td>
                                        <p class="<?= $col; ?>"><?= $status; ?></p>
                                    </td>
                                    <td>
                                        <form action="<?= $cbe_request; ?>" method="POST"
                                            onsubmit="return startTest(this)">
                                            <input type="hidden" name="userId" value="<?= $userId ;?>">
                                            <input type="hidden" name="paper_type" value="<?= $chk->paper_type ;?>">
                                            <input type="hidden" name="course_code" value="<?= $row->course_code ;?>">
                                            <input type="hidden" name="course" value="<?= $row->course ;?>">
                                            <input type="hidden" name="quest_type" value="<?= $sel->quest_type;?>">
                                            <button type="submit" class="btn-sm btn-success">Start</button>
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
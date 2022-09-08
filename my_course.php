<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <h4 class="card-title">Register courses for <?= $log_session; ?> <?= $term_syntax; ?> Term
                        <?= $det->curr_class ;?></h4>

                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Code</th>
                                    <th>Questions</th>
                                    <th>Duration[Exam|Test|Ass.]</th>
                                    <th>Mark[Exam|Test|Ass.]</th>
                                    <th>Session</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $availableCourse->fetch_object()):?>
                                <tr>
                                    <td><?= $row->course; ?></td>
                                    <td class="font-weight-bold"><?= $row->course_code; ?></td>
                                    <td><?= $row->no_of_quest; ?></td>
                                    <td>Exam:<?= $row->exam_duration; ?> | Test:<?= $row->test_duration; ?> |
                                        Ass:<?= $row->ass_duration; ?>
                                    </td>
                                    <td>Exam:<?= $row->exam_unit; ?> | Test:<?= $row->test_unit; ?> |
                                        Ass:<?= $row->ass_unit; ?></td>
                                    <td><?= $row->session; ?></td>
                                    <td>
                                        <form name="enrolC" action="<?= $enrolCourse; ?>" method="get"
                                            onsubmit="return enrolCourse(this)">
                                            <input type="hidden" name="course_code" value="<?= $row->course_code; ?>">
                                            <input type="hidden" name="course" value="<?= $row->course; ?>">
                                            <button type="submit" class="btn-sm btn-success">Enrol <i
                                                    class="mdi mdi-plus"></i></button>
                                        </form>
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
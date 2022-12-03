<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <h4 class="card-title">Enrolled courses for <?= $term_syntax; ?> Term |
                        <?= $log_session; ?> | <?= $det->curr_class ;?></h4>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Course[code]</th>
                                    <th>Teacher</th>
                                    <th>ASS | CA1 | CA2 | CA3</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $enrolledCourse->fetch_object()):
                                /**Get staff */
                                $teacher_token = $row->teacher_token;
                                $getTeacher = $conn->query("SELECT * FROM $users_tbl WHERE token='$teacher_token'");
                                $teacherDet = $getTeacher->fetch_object(); 

                                    switch($row->status){
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
                                    <td><?= $row->course; ?>[<?= $row->course_code; ?>]</td>
                                    <td class="font-weight-bold"><?= $teacherDet->name; ?></td>
                                    <td><?= $row->ass; ?> | <?= $row->ca1; ?> | <?= $row->ca2; ?> | <?= $row->ca3; ?>
                                    </td>
                                    <td>
                                        <p class="<?= $col; ?>"><?= $status; ?></p>
                                    </td>
                                    <td>
                                        <?php if($row->status == 0):?>
                                        <form action="<?= $course_deleter; ?>" method="GET"
                                            onsubmit="return delCourse(this)">
                                            <input type="hidden" name="del_course" value="<?= $row->course_code; ?>">
                                            <input type="hidden" name="course" value="<?= $row->course; ?>">
                                            <button type="submit" class="btn-sm btn-danger">Delete <i
                                                    class="mdi mdi-delete"></i></button>
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
        <?php if($exp_acad_period == false):?>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <h4 class="card-title">Available courses for <?= $term_syntax; ?>
                        Term |
                        <?= $log_session; ?> | <?= $det->curr_class ;?></h4>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Course[code]</th>
                                    <th>Teacher</th>
                                    <th>Duration[Minute]</th>
                                    <th>Mark[EXAM|CA|ASS]</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $availableCourse->fetch_object()):?>
                                <tr>
                                    <td><?= $row->course; ?>[<?= $row->course_code; ?>]</td>
                                    <td class="font-weight-bold"><?= $row->taken_by; ?></td>
                                    <td>Exam:<?= $row->exam_duration; ?> | Test:<?= $row->test_duration; ?> |
                                        Ass:<?= $row->ass_duration; ?>
                                    </td>
                                    <td>Exam:<?= $row->exam_unit; ?> | Test:<?= $row->test_unit; ?> |
                                        Ass:<?= $row->ass_unit; ?></td>
                                    <td>
                                        <form name="enrolC" action="<?= $enrolCourse; ?>" method="GET"
                                            onsubmit="return enrolCourse(this)">
                                            <input type="hidden" name="sch_category" value="<?= $row->sch_category; ?>">
                                            <input type="hidden" name="course_code" value="<?= $row->course_code; ?>">
                                            <input type="hidden" name="course" value="<?= $row->course; ?>">
                                            <input type="hidden" name="teacher_token" value="<?= $row->token; ?>">
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
        <?php endif; ?>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <h4 class="card-title">Exam time-table for <?= $term_syntax; ?> Term |
                        <?= $log_session; ?> | <?= $det->curr_class ;?></h4>

                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>DAY</th>
                                    <th>1st Period</th>
                                    <th>2nd Period</th>
                                    <th>3rd Period</th>
                                    <th>4th Period</th>
                                    <th>5th Period</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($tim = $callTimeTable->fetch_object()):
                                    $class_array = explode(",", $tim->class_array);
                                        if(in_array($det->curr_class, $class_array)){
                                    ?>
                                <tr>
                                    <td><?= $tim->day; ?></td>
                                    <td><?= $tim->period_1; ?></td>
                                    <td><?= $tim->period_2; ?></td>
                                    <td><?= $tim->period_3; ?></td>
                                    <td><?= $tim->period_4; ?></td>
                                    <td><?= $tim->period_5; ?></td>
                                    <td><?= $tim->exam_date; ?></td>
                                </tr>

                                <?php 
                                        }
                            endwhile; ?>
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
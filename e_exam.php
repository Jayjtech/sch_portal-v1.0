<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <h4 class="card-title">Available E - Exam [Assignment | Test | Exam] </h4>
                    <hr>
                    <p class="text-info"><strong>NOTE:</strong> You must have enrolled in order to be able to
                        take tests and Assignments.</p>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Teacher</th>
                                    <th>Type</th>
                                    <th>Access key</th>
                                    <th>No. of Q</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $coursesT=$conn->query("SELECT * FROM $course_tbl WHERE (term='$log_term' AND session='$log_session') AND (department='$department' OR department='General' OR department='Non')");
                                        while($row = $coursesT->fetch_object()):
                                            $cCode = $row->course_code;
                                             $teacher_token = $row->token;
                                        /**Checking score sheet */
                                        $checkScoreSheet = $conn->query("SELECT * FROM $score_tbl WHERE (course_code='$cCode' AND adm_no='$userId' AND session='$log_session' AND term='$log_term' AND teacher_token='$teacher_token')");
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
                                <?php 
                                    $selectUpload = $conn->query("SELECT * FROM $question_tbl_a WHERE (course_code='$cCode' AND session='$log_session' AND quest_type='Ass' AND token='$teacher_token' AND class='$curr_class') LIMIT 1");
                                    while($sel = $selectUpload->fetch_object()){ 
                                        $quest_id = $sel->quest_id;
                                        /**Checking if test has been taken */
                                        $checkAssStatus = $conn->query("SELECT * FROM $cbe_report_tbl WHERE test_taken='$quest_id' AND adm_no='$userId'");
                                        if($checkAssStatus->num_rows == 0){
                                            $ass_proceed = true;
                                            $ass_status = '';
                                        }else{
                                            $ass_proceed = false;
                                            $ass_status = '<p class="text-warning font-weight-bold">Taken</p>';
                                        }

                                        /**Get staff */
                                        $getTeacher = $conn->query("SELECT * FROM $users_tbl WHERE token='$teacher_token'");
                                        $teacherDet = $getTeacher->fetch_object(); 
                                    ?>
                                <tr>
                                    <td><?= $row->course; ?>[<?= $sel->course_code; ?>]</td>
                                    <td><?= $teacherDet->name; ?></td>
                                    <td><?= $sel->quest_type; ?></td>
                                    <td class="font-weight-bold">
                                        <?php
                                        if($sel->quest_type == "Exam"){
                                            if($chk->public == 0){
                                                echo '<p class="badge badge-warning">Hidden<p>';
                                            }else{
                                                echo '<p class="text-success">'.$chk->exam_token.'</p>';
                                            } 
                                        }
                                        ?>
                                    </td>
                                    <td><?= $row->ass_no_of_quest; ?></td>
                                    <td><?= $ass_status; ?></td>
                                    <td>
                                        <?php if($ass_proceed == true){ ?>
                                        <form action="<?= $cbe_request; ?>" method="POST"
                                            onsubmit="return startTest(this)">
                                            <input type="hidden" name="paper_type" value="<?= $chk->paper_type ;?>">
                                            <input type="hidden" name="course_code" value="<?= $row->course_code ;?>">
                                            <input type="hidden" name="course" value="<?= $row->course ;?>">
                                            <input type="hidden" name="quest_id" value="<?= $sel->quest_id ;?>">
                                            <input type="hidden" name="teacher_token" value="<?= $row->token ;?>">
                                            <input type="hidden" name="quest_type" value="<?= $sel->quest_type;?>">
                                            <button type="submit" class="btn-sm btn-success">Proceed</button>
                                        </form>
                                        <?php } ?>
                                    </td>

                                </tr>
                                <?php } ?>
                                <?php 
                                    $selectUpload = $conn->query("SELECT * FROM $question_tbl_a WHERE (course_code='$cCode' AND session='$log_session' AND quest_type='Test' AND token='$teacher_token' AND class='$curr_class') LIMIT 1");
                                    while($sel = $selectUpload->fetch_object()){ 
                                        $quest_id = $sel->quest_id;
                                        // $teacher_token = $row->token;
                                        /**Checking if test has been taken */
                                        $checkTestStatus = $conn->query("SELECT * FROM $cbe_report_tbl WHERE test_taken='$quest_id' AND adm_no='$userId'");
                                        if($checkTestStatus->num_rows == 0){
                                            $test_proceed = true;
                                            $test_status = '';
                                        }else{
                                            $test_proceed = false;
                                            $test_status = '<p class="text-warning font-weight-bold">Taken</p>';
                                        }
                                          /**Get staff */
                                        $getTeacher = $conn->query("SELECT * FROM $users_tbl WHERE token='$teacher_token'");
                                        $teacherDet = $getTeacher->fetch_object(); 
                                    ?>
                                <tr>
                                    <td><?= $row->course; ?>[<?= $sel->course_code; ?>]</td>
                                    <td><?= $teacherDet->name; ?></td>
                                    <td><?= $sel->quest_type; ?></td>
                                    <td class="font-weight-bold">
                                        <?php
                                        if($sel->quest_type == "Exam"){
                                            if($chk->public == 0){
                                                echo '<p class="badge badge-warning">Hidden<p>';
                                            }else{
                                                echo '<p class="text-success">'.$chk->exam_token.'</p>';
                                            } 
                                        }
                                        ?>
                                    </td>
                                    <td><?= $row->test_no_of_quest; ?></td>
                                    <td><?= $test_status;?></td>
                                    <td>
                                        <?php if($test_proceed == true){ ?>
                                        <form action="<?= $cbe_request; ?>" method="POST"
                                            onsubmit="return startTest(this)">
                                            <input type="hidden" name="paper_type" value="<?= $chk->paper_type ;?>">
                                            <input type="hidden" name="course_code" value="<?= $row->course_code ;?>">
                                            <input type="hidden" name="course" value="<?= $row->course ;?>">
                                            <input type="hidden" name="teacher_token" value="<?= $row->token ;?>">
                                            <input type="hidden" name="quest_id" value="<?= $sel->quest_id ;?>">
                                            <input type="hidden" name="quest_type" value="<?= $sel->quest_type;?>">
                                            <button type="submit" class="btn-sm btn-success">Proceed</button>
                                        </form>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php 
                                    $selectUpload = $conn->query("SELECT * FROM $question_tbl_a WHERE (course_code='$cCode' AND session='$log_session' AND quest_type='Exam' AND token='$teacher_token' AND class='$curr_class') LIMIT 1");
                                    while($sel = $selectUpload->fetch_object()){ 
                                        $quest_id = $sel->quest_id;
                                        // $teacher_token = $row->token;
                                        /**Checking if test has been taken */
                                        $checkExamStatus = $conn->query("SELECT * FROM $cbe_report_tbl WHERE test_taken='$quest_id' AND adm_no='$userId'");
                                        if($checkExamStatus->num_rows == 0){
                                            $exam_proceed = true;
                                            $exam_status = '';
                                        }else{
                                            $exam_proceed = false;
                                            $exam_status = '<p class="text-warning font-weight-bold">Taken</p>';
                                        }
                                         /**Get staff */
                                        $getTeacher = $conn->query("SELECT * FROM $users_tbl WHERE token='$teacher_token'");
                                        $teacherDet = $getTeacher->fetch_object(); 
                                    ?>
                                <tr>
                                    <td><?= $row->course; ?>[<?= $sel->course_code; ?>]</td>
                                    <td><?= $teacherDet->name; ?></td>
                                    <td><?= $sel->quest_type; ?></td>
                                    <td class="font-weight-bold">
                                        <?php
                                        
                                            if($chk->public == 0){
                                                echo '<p class="badge badge-warning">Hidden<p>';
                                            }else{
                                                echo '<p class="text-success">'.$chk->exam_token.'</p>';
                                            } 
                                        
                                        ?>
                                    </td>
                                    <td><?= $row->exam_no_of_quest; ?></td>
                                    <td><?= $exam_status; ?></td>
                                    <td>
                                        <?php if($exam_proceed == true){ ?>
                                        <form action="<?= $cbe_request; ?>" method="POST"
                                            onsubmit="return startTest(this)">
                                            <input type="hidden" name="paper_type" value="<?= $chk->paper_type ;?>">
                                            <input type="hidden" name="course_code" value="<?= $row->course_code ;?>">
                                            <input type="hidden" name="course" value="<?= $row->course ;?>">
                                            <input type="hidden" name="teacher_token" value="<?= $row->token ;?>">
                                            <input type="hidden" name="quest_id" value="<?= $sel->quest_id ;?>">
                                            <input type="hidden" name="quest_type" value="<?= $sel->quest_type;?>">
                                            <button type="submit" class="btn-sm btn-success">Proceed</button>
                                        </form>
                                        <?php } ?>
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
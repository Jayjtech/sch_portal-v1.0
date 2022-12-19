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
    <?php if(isset($_GET['course_tbl']) == true):?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Course Table [<?= $term_syntax; ?> term | <?= $log_session; ?>]</p>
                    <div class="" align="right">
                        <a href="?index" class="btn btn-primary" style="text-decoration:none;">Create course</a>
                        <a href="?upload_question" class="btn btn-danger" style="text-decoration:none;">Upload
                            question</a>
                        <a href="?course_material" class="btn btn-success" style="text-decoration:none;">Upload
                            materials</a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Course</th>
                                    <th>Class</th>
                                    <th>No. of Question[Exam|Test|Ass]</th>
                                    <th>Duration[Exam|Test|Ass.]</th>
                                    <th>Mark[Exam|Test|Ass.]</th>
                                    <th>Session</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $callCourses->fetch_object()):?>
                                <tr>
                                    <td>
                                        <form action="<?= $course_deleter; ?>" method="GET"
                                            onsubmit="return delForm(this);">
                                            <input type="hidden" name="del" value="<?= $row->id; ?>">
                                            <button type="submit" class="btn-sm btn-danger"><i class="mdi mdi-delete"
                                                    style="font-size:15px;"></i></button>
                                        </form>
                                    </td>
                                    <td><a href="?index=<?= $row->course_code; ?>&sch_category=<?= $row->sch_category; ?>"
                                            class="btn-sm btn-primary">Review</a></td>
                                    <td><?= $row->course; ?>[<?= $row->course_code;?>]</td>
                                    <td><?= $row->class; ?></td>
                                    <td>Exam: <?= $row->exam_no_of_quest; ?> | Test: <?= $row->test_no_of_quest; ?> |
                                        Ass: <?= $row->ass_no_of_quest; ?></td>
                                    <td>Exam: <?= $row->exam_duration; ?> | Test: <?= $row->test_duration; ?> |
                                        Ass: <?= $row->ass_duration; ?>
                                    </td>
                                    <td>Exam: <?= $row->exam_unit; ?> | Test: <?= $row->test_unit; ?> |
                                        Ass: <?= $row->ass_unit; ?></td>
                                    <td><?= $row->session; ?></td>
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


    <?php if(isset($_GET['index']) == true):?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <h4 class="card-title">Create Course</h4>
                    <div class="" align="right">
                        <a href="?course_tbl" class="btn btn-dark" style="text-decoration:none;">View courses</a>
                        <a href="?upload_question" class="btn btn-danger" style="text-decoration:none;">Upload
                            question</a>
                        <a href="?course_material" class="btn btn-success" style="text-decoration:none;">Upload
                            materials</a>
                    </div>
                    <hr>
                    <p class="text-info font-weight-bold">Fill this form to create a course</p>
                    <form action="<?= $add_course;?>" class="forms-sample" method="POST"
                        onsubmit="return addCourse(this)">
                        <div class="row mt-3 mb-3">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Course[Subject] title</label>
                                    <input type="text" class="form-control" id="course" name="course"
                                        value="<?= !empty($courseDet->course) ? $courseDet->course:null; ?>" required
                                        placeholder="Enter course title">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Course code</label> <span class="cCA text-danger"
                                        style="display:none;"><small>No space; no symbol; 6 characters e.g MAT101
                                        </small></span>
                                    <input type="text" class="form-control"
                                        value="<?= !empty($courseDet->course_code) ? $courseDet->course_code:null; ?>"
                                        id="course_code" name="course_code" required <?= $readonly;?>
                                        placeholder="Enter course code">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">School category</label>
                                    <select name="sch_category" id="sch_category" class="form-control sch_category"
                                        required>
                                        <option value="<?= $sch_catValue; ?>"><?= $sch_cat;?></option>
                                        <option value="Senior-School">Senior School</option>
                                        <option value="Junior-School">Junior School</option>
                                        <option value="Primary-School">Primary School</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Department</label>
                                    <select name="department" id="department" class="form-control" required>
                                        <option value="<?= $departValue; ?>"><?= $departM; ?></option>
                                        <option value="Non">Non</option>
                                        <option value="General">General</option>
                                        <option value="Art">Art</option>
                                        <option value="Science">Science</option>
                                        <option value="Commercial">Commercial</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">How many questions will you upload?</label>
                                    <div class="row">
                                        <div class="col-4">
                                            <select name="ass_no_of_quest" id="ass_no_of_quest" class="form-control"
                                                required>
                                                <option value="<?= $assValue; ?>"><?= $ass; ?></option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="30">30</option>
                                                <option value="40">40</option>
                                                <option value="50">50</option>
                                                <option value="60">60</option>
                                                <option value="70">70</option>
                                                <option value="80">80</option>
                                                <option value="90">90</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <select name="test_no_of_quest" id="test_no_of_quest" class="form-control"
                                                required>
                                                <option value="<?= $testValue; ?>"><?= $test; ?></option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="30">30</option>
                                                <option value="40">40</option>
                                                <option value="50">50</option>
                                                <option value="60">60</option>
                                                <option value="70">70</option>
                                                <option value="80">80</option>
                                                <option value="90">90</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <select name="exam_no_of_quest" id="exam_no_of_quest" class="form-control"
                                                required>
                                                <option value="<?= $examValue; ?>"><?= $exam; ?></option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="30">30</option>
                                                <option value="40">40</option>
                                                <option value="50">50</option>
                                                <option value="60">60</option>
                                                <option value="70">70</option>
                                                <option value="80">80</option>
                                                <option value="90">90</option>
                                                <option value="100">100</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mark per question [Ass | Test | Exam]</label>
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="number" class="form-control" id="ass_unit" min="1"
                                                name="ass_unit"
                                                value="<?= !empty($courseDet->ass_unit) ? $courseDet->ass_unit:null; ?>"
                                                placeholder="Ass" required>
                                        </div>

                                        <div class="col-4">
                                            <input type="number" class="form-control" id="test_unit" min="1"
                                                name="test_unit"
                                                value="<?= !empty($courseDet->test_unit) ? $courseDet->test_unit:null; ?>"
                                                placeholder="Test" required>
                                        </div>

                                        <div class="col-4">
                                            <input type="number" class="form-control" id="exam_unit" min="1"
                                                name="exam_unit"
                                                value="<?= !empty($courseDet->exam_unit) ? $courseDet->exam_unit:null; ?>"
                                                placeholder="Exam" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Duration in minutes</label>
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="number" class="form-control" id="ass_duration" min="3"
                                                name="ass_duration"
                                                value="<?= !empty($courseDet->ass_duration) ? $courseDet->ass_duration:null; ?>"
                                                placeholder="Ass" required>
                                        </div>
                                        <div class="col-4">
                                            <input type="number" class="form-control" id="test_duration" min="3"
                                                name="test_duration"
                                                value="<?= !empty($courseDet->test_duration) ? $courseDet->test_duration:null; ?>"
                                                placeholder="Test" required>
                                        </div>
                                        <div class="col-4">
                                            <input type="number" class="form-control" id="exam_duration" min="3"
                                                name="exam_duration"
                                                value="<?= !empty($courseDet->exam_duration) ? $courseDet->exam_duration:null; ?>"
                                                placeholder="Exam" required>
                                        </div>
                                        <input type="hidden" name="<?= $revCourseQuery; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="" align="right">
                            <button type="submit" class="btn btn-primary mr-2"> <?= $revCourseTag; ?></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(isset($_GET['upload_question']) == true):?>
    <div class="row">
        <div class="col-md-12 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Upload Questions and Instructions</p>
                    <div class="" align="right">
                        <a href="?course_tbl" class="btn btn-dark" style="text-decoration:none;">View courses</a>
                        <a href="?index" class="btn btn-primary" style="text-decoration:none;">Create course</a>
                        <a href="?course_material" class="btn btn-success" style="text-decoration:none;">Upload
                            materials</a>
                    </div>
                    <hr>
                    <div class="row mt-2">
                        <div class="container col-sm-4 border-right">
                            <p class="card-title">Download Format</p>
                            <hr>
                            <p>Select a category and click the green button to download the excel CSV format.
                            </p>
                            <form action="<?= $exporter; ?>" method="get">
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select name="quest_instruct" id="quest_instruct" class="form-control" required>
                                        <option value="">Choose category</option>
                                        <option value="question">Questions</option>
                                        <option value="instruction">Instruction</option>
                                    </select>
                                </div>
                                <input type="hidden" name="token" value="<?= $token ; ?>">
                                <button type="submit" class="btn btn-success"><i class="mdi mdi-download"></i>Excel
                                    Format</button>
                            </form>
                        </div>
                        <hr>

                        <div class="container mt-3 col-sm-4 border-right">
                            <p class="text-info card-title">Upload Question</p>
                            <hr>
                            <form action="<?= $add_course;?>" method="POST" onsubmit="return uploadQuest(this)"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Choose question file</label>
                                            <input type="file" name="file" class="form-control btn btn-dark" required>
                                        </div>
                                    </div>
                                    <input type="hidden" name="push_quest" value="1">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Question Category</label>
                                            <select name="quest_type" id="quest_type" class="form-control" required>
                                                <option value="">Question type</option>
                                                <option value="Exam">Exam</option>
                                                <option value="Test">Test</option>
                                                <option value="Ass">Assignment</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Course code</label>
                                            <select name="course_code" id="course-code-el" class="form-control"
                                                required>
                                                <option value="">Course code</option>
                                                <?php for($i = 0; $i<count($coList); $i++){
                                                   $value = base64_encode('{"course_code":"'.$coList[$i]->course_code.'","sch_category":"'.$coList[$i]->sch_category.'"}'); 
                                                    ?>
                                                <option value="<?= $value; ?>">
                                                    <?= $coList[$i]->course; ?>
                                                    [<?= $coList[$i]->course_code; ?>] <?= $coList[$i]->sch_category; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <button type="submit" name="" class="btn btn-primary"><i
                                                class="mdi mdi-upload"></i> Upload Question</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>

                        <div class="container mt-3 col-sm-4">
                            <p class="text-info card-title">Upload Instruction</p>
                            <hr>
                            <form action="<?= $add_course;?>" method="POST" onsubmit="return uploadInstruct(this)"
                                enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Choose instruction file</label>
                                            <input type="file" name="file" class="form-control btn btn-dark" required>
                                        </div>
                                    </div>
                                    <input type="hidden" name="push_instruct" value="1">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Instruction Category</label>
                                            <select name="quest_type" id="quest_type2" class="form-control" required>
                                                <option value="">Question type</option>
                                                <option value="Exam">Exam</option>
                                                <option value="Test">Test</option>
                                                <option value="Ass">Assignment</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Course code</label>
                                            <select name="course_code" id="course-code-el2" class="form-control"
                                                required>
                                                <option value="">Course code</option>
                                                <?php for($i = 0; $i<count($coList); $i++){
                                                    $value = base64_encode('{"course_code":"'.$coList[$i]->course_code.'","sch_category":"'.$coList[$i]->sch_category.'"}'); 
                                                    ?>
                                                <option value="<?= $value; ?>">
                                                    <?= $coList[$i]->course; ?>
                                                    [<?= $coList[$i]->course_code; ?>] <?= $coList[$i]->sch_category; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <button type="submit" name="" class="btn btn-primary"><i
                                                class="mdi mdi-upload"></i> Upload Instruction</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Uploaded Questions</p>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Class</th>
                                    <th>Type</th>
                                    <th>No. of Q</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $coursesTAss=$conn->query("SELECT * FROM $course_tbl WHERE term='$log_term' AND session='$log_session' AND token='$token'");
                                                while($row = $coursesTAss->fetch_object()):
                                                    $cCode = $row->course_code;
                                    ?>
                                <?php
                                        $selectUploadAss = $conn->query("SELECT * FROM $question_tbl_a WHERE token='$token' AND course_code='$cCode' AND term='$log_term' AND session='$log_session' AND quest_type='Ass' ORDER BY id ASC LIMIT 1");
                                        while($sel1 = $selectUploadAss->fetch_object()){
                                        $qd = $sel1->quest_id; 
                                        $getPassage = $conn->query("SELECT * FROM $passage_tbl WHERE (quest_id='$qd' AND token='$token' AND term='$log_term' AND session='$log_session')");
                                        $gP = $getPassage->fetch_object();
                                       if($getPassage->num_rows == 0){
                                            $btn = "Add passage";
                                            $col = "primary";
                                        }else{
                                            $btn = "Edit passage";
                                            $col = "info";
                                        }
                                    ?>
                                <tr>
                                    <td><?= $row->course; ?>[<?= $sel1->course_code; ?>]</td>
                                    <td><?= $sel1->class; ?></td>
                                    <td><?= $sel1->quest_type; ?></td>
                                    <td><?= $row->ass_no_of_quest; ?></td>
                                    <td><?= $row->department; ?></td>
                                    <td><a href="adm_view_question?qd=<?= $sel1->quest_id; ?>&sch_category=<?= $sel1->sch_category; ?>"
                                            style="text-decoration:none;" class="btn-sm btn-info"><i
                                                class="mdi mdi-eye"></i>
                                            View</a></td>
                                    <td><a href="adm_add_passage?qd=<?= $sel1->quest_id; ?>&sch_category=<?= $sel1->sch_category; ?>"
                                            style="text-decoration:none;"
                                            class="btn-sm btn-<?= $col;?>"><?= $btn; ?></a>
                                    </td>
                                    <td>
                                        <form action="<?= $course_deleter; ?>" method="get"
                                            onsubmit="return delQuest(this)">
                                            <input type="hidden" name="del_quest" value="<?= $sel1->course_code; ?>">
                                            <input type="hidden" name="quest_type" value="<?= $sel1->quest_type; ?>">
                                            <button type="submit" name="del" class="btn-sm btn-danger"><i
                                                    class="mdi mdi-delete" style="font-size:15px;"></i></button>
                                        </form>
                                    </td>

                                </tr>
                                <?php } ?>
                                <?php 
                                        $selectUploadTest = $conn->query("SELECT * FROM $question_tbl_a WHERE token='$token' AND course_code='$cCode' AND term='$log_term' AND session='$log_session' AND quest_type='Test' ORDER BY id ASC LIMIT 1");
                                        while($sel2 = $selectUploadTest->fetch_object()){ 
                                        $qd = $sel2->quest_id;
                                        $getPassage = $conn->query("SELECT * FROM $passage_tbl WHERE (quest_id='$qd' AND token='$token' AND term='$log_term' AND session='$log_session')");
                                        $gP = $getPassage->fetch_object();
                                       if($getPassage->num_rows == 0){
                                            $btn = "Add passage";
                                            $col = "primary";
                                        }else{
                                            $btn = "Edit passage";
                                            $col = "info";
                                        }
                                            ?>
                                <tr>
                                    <td><?= $row->course; ?>[<?= $sel2->course_code; ?>]</td>
                                    <td><?= $sel2->class; ?></td>
                                    <td><?= $sel2->quest_type; ?></td>
                                    <td><?= $row->test_no_of_quest; ?></td>
                                    <td><?= $row->department; ?></td>
                                    <td><a href="adm_view_question?qd=<?= $sel2->quest_id; ?>&sch_category=<?= $sel2->sch_category; ?>"
                                            style="text-decoration:none;" class="btn-sm btn-info"><i
                                                class="mdi mdi-eye"></i>
                                            View</a></td>

                                    <td><a href="adm_add_passage?qd=<?= $sel2->quest_id; ?>&sch_category=<?= $sel2->sch_category; ?>"
                                            style="text-decoration:none;"
                                            class="btn-sm btn-<?= $col;?>"><?= $btn; ?></a>
                                    </td>
                                    <td>
                                        <form action="<?= $course_deleter; ?>" method="get"
                                            onsubmit="return delQuest(this)">
                                            <input type="hidden" name="del_quest" value="<?= $sel2->course_code; ?>">
                                            <input type="hidden" name="quest_type" value="<?= $sel2->quest_type; ?>">
                                            <button type="submit" name="del" class="btn-sm btn-danger"><i
                                                    class="mdi mdi-delete" style="font-size:15px;"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php 
                                        $selectUploadExam = $conn->query("SELECT * FROM $question_tbl_a WHERE token='$token' AND course_code='$cCode' AND term='$log_term' AND session='$log_session' AND quest_type='Exam' ORDER BY id ASC LIMIT 1");
                                        while($sel3 = $selectUploadExam->fetch_object()){ 
                                        $qd = $sel3->quest_id;
                                        $getPassage = $conn->query("SELECT * FROM $passage_tbl WHERE (quest_id='$qd' AND token='$token' AND term='$log_term' AND session='$log_session')");
                                        $gP = $getPassage->fetch_object();
                                       if($getPassage->num_rows == 0){
                                            $btn = "Add passage";
                                            $col = "primary";
                                        }else{
                                            $btn = "Edit passage";
                                            $col = "info";
                                        }
                                            ?>
                                <tr>
                                    <td><?= $row->course; ?>[<?= $sel3->course_code; ?>]</td>
                                    <td><?= $sel3->class; ?></td>
                                    <td><?= $sel3->quest_type; ?></td>
                                    <td><?= $row->exam_no_of_quest; ?></td>
                                    <td><?= $row->department; ?></td>
                                    <td><a href="adm_view_question?qd=<?= $sel3->quest_id; ?>&sch_category=<?= $sel3->sch_category; ?>"
                                            style="text-decoration:none;" class="btn-sm btn-info"><i
                                                class="mdi mdi-eye"></i>
                                            View</a></td>
                                    <td><a href="adm_add_passage?qd=<?= $sel3->quest_id; ?>&sch_category=<?= $sel3->sch_category; ?>"
                                            style="text-decoration:none;"
                                            class="btn-sm btn-<?= $col;?>"><?= $btn; ?></a>
                                    </td>
                                    <td>
                                        <form action="<?= $course_deleter; ?>" method="get"
                                            onsubmit="return delQuest(this)">
                                            <input type="hidden" name="del_quest" value="<?= $sel3->course_code; ?>">
                                            <input type="hidden" name="quest_type" value="<?= $sel3->quest_type; ?>">
                                            <button type="submit" name="del" class="btn-sm btn-danger"><i
                                                    class="mdi mdi-delete" style="font-size:15px;"></i></button>
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

    <?php endif; ?>

    <?php if(isset($_GET['course_material']) == true):?>
    <div class="row">
        <div class="col-md-12 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Upload course material</p>
                    <div class="" align="right">
                        <a href="?course_tbl" class="btn btn-dark">View courses</a>
                        <a href="?index" class="btn btn-primary">Create course</a>
                        <a href="?upload_question" class="btn btn-danger">Upload question</a>
                    </div>
                    <hr>
                    <div class="row mt-2">
                        <div class="col-sm-4 border-right">
                            <form action="<?= $add_course; ?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Select file</label>
                                            <input type="file" name="file" class="form-control btn btn-dark" required>
                                        </div>
                                    </div>
                                    <input type="hidden" name="course_material" value="1">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Material title</label>
                                            <input type="text" class="form-control" name="title" required
                                                placeholder="Material title">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Category</label>
                                            <select name="category" class="form-control" required>
                                                <option value="">Material type</option>
                                                <option value="Syllabus">Syllabus</option>
                                                <option value="Lesson note">Lesson note</option>
                                                <option value="Document">Other documents</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Course code</label>
                                            <select name="course_code" id="course-code-el2" class="form-control"
                                                required>
                                                <option value="">Course code</option>
                                                <?php for($i = 0; $i<count($coList); $i++){
                                                   $value = base64_encode('{"course_code":"'.$coList[$i]->course_code.'","sch_category":"'.$coList[$i]->sch_category.'"}'); 
                                                    ?>
                                                <option value="<?= $value; ?>">
                                                    <?= $coList[$i]->course; ?>
                                                    [<?= $coList[$i]->course_code; ?>] <?= $coList[$i]->sch_category; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="p-2">
                                        <button type="submit" name="" class="btn btn-primary"><i
                                                class="mdi mdi-upload"></i> Upload Material</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-8">
                            <div class="table-responsive">
                                <table class="myTable table table-striped table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Course</th>
                                            <th>Category</th>
                                            <th>Title</th>
                                            <th>File</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = $callMaterial->fetch_object()):?>
                                        <tr>
                                            <td><?= $row->course; ?>[<?= $row->course_code;?>]</td>
                                            <td><?= $row->category; ?></td>
                                            <td><?= $row->title; ?></td>
                                            <td> <a href="course_material/<?= $row->file; ?>">View</a></td>
                                            <td>
                                                <form action="<?= $course_deleter; ?>" method="get"
                                                    onsubmit="return delMat(this)">
                                                    <input type="hidden" name="del_mat" value="<?= $row->id; ?>">
                                                    <input type="hidden" name="document" value="<?= $row->file; ?>">
                                                    <button type="submit" class="btn-sm btn-danger"><i
                                                            class="mdi mdi-delete" style="font-size:15px;"></i></button>
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
    </div>
    <div class="row">
        <div class="col-md-12 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Response from my students</p>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Title</th>
                                    <th></th>
                                    <th>Validation</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $callSubmissions->fetch_object()):
                                    $status = $row->status;
                                    $your_term = false;
                                    include "includes/status_const.php";
                                    ?>
                                <tr>
                                    <td><?= $row->name; ?></td>
                                    <td><?= $row->course; ?>[<?= $row->course_code;?>]</td>
                                    <td><?= $row->title; ?></td>
                                    <td><a href="course_material/<?= $row->file; ?>">View</a></td>
                                    <td>
                                        <?php if($row->status == 0): ?>
                                        <form action="<?= $add_course; ?>" method="get" onsubmit="return valRes(this)">
                                            <input type="hidden" name="val_res" value="<?= $row->id; ?>">
                                            <button type="submit" class="btn-sm btn-info"><i class="mdi mdi-check"
                                                    style="font-size:15px;"></i></button>
                                        </form>
                                        <?php else: ?>
                                        <p><?= $status_syntax; ?></p>
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
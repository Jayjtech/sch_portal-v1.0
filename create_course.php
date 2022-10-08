<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>

<div class="content-wrapper">
    <?php if(isset($_GET['course_tbl']) == true):?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Course Table [<?= $term_syntax; ?> term | <?= $log_session; ?>]</p>
                    <div class="" align="right">
                        <a href="?index" class="btn btn-primary">Create course</a>
                        <a href="?upload_question" class="btn btn-danger">Upload question</a>
                        <a href="?course_material" class="btn btn-success">Upload materials</a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>No. of Question[Exam|Test|Ass]</th>
                                    <th>Duration[Exam|Test|Ass.]</th>
                                    <th>Mark[Exam|Test|Ass.]</th>
                                    <th>Session</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $callCourses->fetch_object()):?>
                                <tr>
                                    <td><?= $row->course; ?>[<?= $row->course_code;?>]</td>
                                    <td>Exam: <?= $row->exam_no_of_quest; ?> | Test: <?= $row->test_no_of_quest; ?> |
                                        Ass: <?= $row->ass_no_of_quest; ?></td>
                                    <td>Exam: <?= $row->exam_duration; ?> | Test: <?= $row->test_duration; ?> |
                                        Ass: <?= $row->ass_duration; ?>
                                    </td>
                                    <td>Exam: <?= $row->exam_unit; ?> | Test: <?= $row->test_unit; ?> |
                                        Ass: <?= $row->ass_unit; ?></td>
                                    <td><?= $row->session; ?></td>

                                    <td>
                                        <form action="<?= $course_deleter; ?>" method="GET"
                                            onsubmit="return delForm(this);">
                                            <input type="hidden" name="del" value="<?= $row->id; ?>">
                                            <button type="submit" class="btn-sm btn-danger"><i class="mdi mdi-delete"
                                                    style="font-size:15px;"></i></button>
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
    <?php endif; ?>


    <?php if(isset($_GET['index']) == true):?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <h4 class="card-title">Create Course</h4>
                    <div class="" align="right">
                        <a href="?course_tbl" class="btn btn-dark">View courses</a>
                        <a href="?upload_question" class="btn btn-danger">Upload question</a>
                        <a href="?course_material" class="btn btn-success">Upload materials</a>
                    </div>
                    <hr>
                    <p class="text-info font-weight-bold">Fill this form to create a course</p>
                    <form action="<?= $add_course;?>" class="forms-sample" method="POST"
                        onsubmit="return addCourse(this)">
                        <div class="row mt-3 mb-3">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Course[Subject] title</label>
                                    <input type="text" class="form-control" id="course" name="course" required
                                        placeholder="Enter course title">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Course code</label> <span class="cCA text-danger"
                                        style="display:none;"><small>No space; no symbol; 6 characters e.g MAT101
                                        </small></span>
                                    <input type="text" class="form-control" id="course_code" name="course_code" required
                                        placeholder="Enter course code">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Department</label>
                                    <select name="department" id="department" class="form-control" required>
                                        <option value="">Choose department</option>
                                        <option value="general">General</option>
                                        <option value="Art">Art</option>
                                        <option value="Science">Science</option>
                                        <option value="Commercial">Commercial</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">How many question will you upload?</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <select name="ass_no_of_quest" id="ass_no_of_quest" class="form-control"
                                                required>
                                                <option value="">Ass</option>
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
                                        <div class="col-sm-4">
                                            <select name="test_no_of_quest" id="test_no_of_quest" class="form-control"
                                                required>
                                                <option value="">Test</option>
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
                                        <div class="col-sm-4">
                                            <select name="exam_no_of_quest" id="exam_no_of_quest" class="form-control"
                                                required>
                                                <option value="">Exam</option>
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
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="ass_unit" min="1"
                                                name="ass_unit" placeholder="Ass" required>
                                        </div>

                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="test_unit" min="1"
                                                name="test_unit" placeholder="Test" required>
                                        </div>

                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="exam_unit" min="1"
                                                name="exam_unit" placeholder="Exam" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Duration in minutes</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="ass_duration" min="3"
                                                name="ass_duration" placeholder="Ass" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="test_duration" min="3"
                                                name="test_duration" placeholder="Test" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" id="exam_duration" min="3"
                                                name="exam_duration" placeholder="Exam" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <input type="submit" class="btn btn-primary mr-2" name="pushCourse" value="Submit"> -->
                        <button type="submit" class="btn btn-primary mr-2" name="pushCourse">Submit</button>
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
                        <a href="?course_tbl" class="btn btn-dark">View courses</a>
                        <a href="?index" class="btn btn-primary">Create course</a>
                        <a href="?course_material" class="btn btn-success">Upload materials</a>
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
                                                <?php for($i = 0; $i<count($coList); $i++){?>
                                                <option value="<?= $coList[$i]->course_code; ?>">
                                                    <?= $coList[$i]->course; ?>
                                                    [<?= $coList[$i]->course_code; ?>]</option>
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
                                                <?php for($i = 0; $i<count($coList); $i++){?>
                                                <option value="<?= $coList[$i]->course_code; ?>">
                                                    <?= $coList[$i]->course; ?>
                                                    [<?= $coList[$i]->course_code; ?>]</option>
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
                                        <th>Type</th>
                                        <th>No. of Q</th>
                                        <th>Department</th>
                                        <th>Action</th>
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
                                            ?>
                                    <tr>
                                        <td><?= $row->course; ?>[<?= $sel1->course_code; ?>]</td>
                                        <td><?= $sel1->quest_type; ?></td>
                                        <td><?= $row->ass_no_of_quest; ?></td>
                                        <td><?= $row->department; ?></td>
                                        <td>
                                            <form action="<?= $course_deleter; ?>" method="get"
                                                onsubmit="return delQuest(this)">
                                                <input type="hidden" name="del_quest"
                                                    value="<?= $sel1->course_code; ?>">
                                                <input type="hidden" name="quest_type"
                                                    value="<?= $sel1->quest_type; ?>">
                                                <button type="submit" name="del" class="btn-sm btn-danger"><i
                                                        class="mdi mdi-delete" style="font-size:15px;"></i></button>
                                            </form>
                                        </td>

                                    </tr>
                                    <?php } ?>
                                    <?php 
                                        $selectUploadTest = $conn->query("SELECT * FROM $question_tbl_a WHERE token='$token' AND course_code='$cCode' AND term='$log_term' AND session='$log_session' AND quest_type='Test' ORDER BY id ASC LIMIT 1");
                                        while($sel2 = $selectUploadTest->fetch_object()){ 
                                            ?>
                                    <tr>
                                        <td><?= $row->course; ?>[<?= $sel2->course_code; ?>]</td>
                                        <td><?= $sel2->quest_type; ?></td>
                                        <td><?= $row->test_no_of_quest; ?></td>
                                        <td><?= $row->department; ?></td>
                                        <td>
                                            <form action="<?= $course_deleter; ?>" method="get"
                                                onsubmit="return delQuest(this)">
                                                <input type="hidden" name="del_quest"
                                                    value="<?= $sel2->course_code; ?>">
                                                <input type="hidden" name="quest_type"
                                                    value="<?= $sel2->quest_type; ?>">
                                                <button type="submit" name="del" class="btn-sm btn-danger"><i
                                                        class="mdi mdi-delete" style="font-size:15px;"></i></button>
                                            </form>
                                        </td>

                                    </tr>
                                    <?php } ?>
                                    <?php 
                                        $selectUploadExam = $conn->query("SELECT * FROM $question_tbl_a WHERE token='$token' AND course_code='$cCode' AND term='$log_term' AND session='$log_session' AND quest_type='Exam' ORDER BY id ASC LIMIT 1");
                                        while($sel3 = $selectUploadExam->fetch_object()){ 
                                            ?>
                                    <tr>
                                        <td><?= $row->course; ?>[<?= $sel3->course_code; ?>]</td>
                                        <td><?= $sel3->quest_type; ?></td>
                                        <td><?= $row->exam_no_of_quest; ?></td>
                                        <td><?= $row->department; ?></td>
                                        <td>
                                            <form action="<?= $course_deleter; ?>" method="get"
                                                onsubmit="return delQuest(this)">
                                                <input type="hidden" name="del_quest"
                                                    value="<?= $sel3->course_code; ?>">
                                                <input type="hidden" name="quest_type"
                                                    value="<?= $sel3->quest_type; ?>">
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
                                                <?php for($i = 0; $i<count($coList); $i++){?>
                                                <option value="<?= $coList[$i]->course_code; ?>">
                                                    <?= $coList[$i]->course; ?>
                                                    [<?= $coList[$i]->course_code; ?>]</option>
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
    <?php endif; ?>

</div>
<!-- content-wrapper ends -->

<?php include "includes/footer.php"; ?>
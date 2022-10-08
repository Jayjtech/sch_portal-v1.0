<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php
if(isset($_GET['qd'])){
/**Get questions */
$quest_id = $_GET['qd'];
$fetchQuestions = $conn->query("SELECT * FROM $question_tbl_a WHERE quest_id = '$quest_id'");
    while($row = $fetchQuestions->fetch_object()){
        $course_code = $row->course_code;
        $quest_type = $row->quest_type;
        $data[] = $row;
    }
    if($fetchQuestions->num_rows == 0){
        $_SESSION['message'] = 'Question you searched for does not exist!';
        $_SESSION['msg_type'] = 'error';
        $_SESSION['remedy'] = '';
        header('location:create_course?upload_question');
    }
}

?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0"><?= $course_code; ?> <?= $quest_type; ?> questions</p>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Question</th>
                                    <th>Option A</th>
                                    <th>Option B</th>
                                    <th>Option C</th>
                                    <th>Option D</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($x = 0; $x < count($data); $x++):
                                    $ans = json_decode($data[$x]->ans);
                                    ?>
                                <tr>
                                    <td><?= $data[$x]->quest_no; ?></td>
                                    <td><?= $data[$x]->quest; ?></td>
                                    <?php for($i = 0; $i < count($ans); $i++):?>
                                    <td><?= $ans[$i] ?></td>
                                    <?php endfor; ?>
                                    <td>
                                        <a href="question_editor?qid=<?= $data[$x]->q_id; ?>&cd=<?= $data[$x]->course_code; ?>&qt=<?= $data[$x]->quest_type; ?>"
                                            class="btn-sm btn-primary"><i class="mdi mdi-pen"></i> Edit </a>
                                    </td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php include "includes/footer.php"; ?>
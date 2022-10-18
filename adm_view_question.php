<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/calls.php"; ?>
<?php if(!in_array($det->position, $worker)): ?>
<script>
window.location.href = "login?msg=Access denied!&msg_type=error"
</script>
<?php endif; ?>
<?php
if(isset($_GET['qd'])){
/**Get questions */
$quest_id = $_GET['qd'];
$sch_category = $_GET['sch_category'];
$fetchQuestions = $conn->query("SELECT * FROM $question_tbl_a WHERE (quest_id = '$quest_id' AND sch_category='$sch_category' AND token='$token' AND term='$log_term' AND session='$log_session')");
    while($row = $fetchQuestions->fetch_object()){
        $course_code = $row->course_code;
        $q_class = $row->class;
        $quest_type = $row->quest_type;
        $data[] = $row;
    }
    if($fetchQuestions->num_rows == 0){
        $_SESSION['message'] = 'Question you searched for does not exist!';
        $_SESSION['msg_type'] = 'error';
        $_SESSION['remedy'] = '';
        header('location:create_course?upload_question');
    }

    $getPassage = $conn->query("SELECT * FROM $passage_tbl WHERE (quest_id='$quest_id' AND sch_category='$sch_category' AND token='$token' AND term='$log_term' AND session='$log_session')");
    $gP = $getPassage->fetch_object();
}

?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0"><?= $course_code; ?> <?= $q_class; ?> <em
                            class="text-success"><?= $quest_type; ?></em>
                        questions</p>
                    <div class="" align="right">
                        <a href="create_course?upload_question" style="text-decoration:none;"
                            class="btn btn-dark">Back</a>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>No.</th>
                                    <th>Question</th>
                                    <th>Option A</th>
                                    <th>Option B</th>
                                    <th>Option C</th>
                                    <th>Option D</th>
                                    <th>Question Image</th>
                                    <th>Passage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for($x = 0; $x < count($data); $x++):
                                    $ans = json_decode($data[$x]->ans);
                                    if(in_array($data[$x]->quest_no, json_decode($gP->tagged_questions))){
                                        $psg_status = '<p class="text-success font-weight-bold">True</p>';
                                    }else{
                                        $psg_status = '<p class="text-danger">False</p>';
                                    }
                                    ?>
                                <tr>
                                    <td>
                                        <a href="adm_question_editor?qid=<?= $data[$x]->q_id; ?>&cd=<?= $data[$x]->course_code; ?>&qt=<?= $data[$x]->quest_type; ?>&sch_category=<?= $data[$x]->sch_category; ?>"
                                            class="btn-sm btn-primary" style="text-decoration:none;"><i
                                                class="mdi mdi-pen"></i> Edit </a>
                                    </td>
                                    <td><?= $data[$x]->quest_no; ?></td>
                                    <td><?= $data[$x]->quest; ?></td>
                                    <?php for($i = 0; $i < count($ans); $i++):?>
                                    <td><?= $ans[$i] ?></td>
                                    <?php endfor; ?>
                                    <td>
                                        <?php if($data[$x]->img == true){
                                            echo '<p class="text-success font-weight-bold">True</p>';
                                        }else{
                                            echo '<p class="text-danger">False</p>';
                                        } ?>
                                    </td>
                                    <td><?= $psg_status; ?></td>
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
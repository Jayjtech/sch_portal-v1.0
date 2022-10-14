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
/**Get question */

$qd = $_GET['qd'];
$getQuestion = $conn->query("SELECT * FROM $question_tbl_a WHERE (quest_id = '$qd' AND token='$token' AND term='$log_term' AND session='$log_session')");
  while($row = $getQuestion->fetch_object()){
        $course_code = $row->course_code;
        $quest_type = $row->quest_type;
        $data[] = $row;
    }
    if($getQuestion->num_rows == 0){
        $_SESSION['message'] = 'Question you searched for does not exist!';
        $_SESSION['msg_type'] = 'error';
        $_SESSION['remedy'] = '';
        header('location:create_course?upload_question');
    }
}

$getPassage = $conn->query("SELECT * FROM $passage_tbl WHERE (quest_id='$qd' AND token='$token' AND term='$log_term' AND session='$log_session')");
$gP = $getPassage->fetch_object();
if($getPassage->num_rows == 0){
    $btn = "Save passage";
    $col = "primary";
}else{
    $btn = "Update passage";
    $col = "warning";
}
?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0"><?= $course_code; ?> <em class="text-success"><?= $quest_type; ?></em>
                    </p>
                    <div class="" align="right">
                        <a href="create_course?upload_question" style="text-decoration:none;"
                            class="btn btn-dark">Back</a>
                    </div>
                    <hr>
                    <form action="<?= $add_course; ?>" method="post" onsubmit="return addPassage(this)"
                        enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12 border-right">
                                <p class="card-title">Type your passage here</p>
                                <textarea class="tinymce-editor" id="passage"
                                    name="passage"><?= $gP->passage; ?></textarea>

                                <input type="hidden" name="add_passage" value="1">
                                <input type="hidden" name="course_code" value="<?= $course_code; ?>">
                                <input type="hidden" name="quest_id" value="<?= $qd; ?>">
                                <hr>
                                <div class="col-sm-12 mb-2 mt-3">
                                    <p class="font-weight-bold text-info">Passage will appear during the exam on any
                                        question that is tagged here.</p>
                                    <div class="mt-2 col-sm-8 font-weight-bold">
                                        Tagged Questions:
                                        <span class="text-success quest-list-el">
                                            <?php
                                                $list = json_decode($gP->tagged_questions);
                                                for($x = 0; $x < count($list); $x++){
                                                    echo $list[$x].', ';
                                                }
                                                ?>
                                        </span>
                                    </div>
                                    <hr>
                                    <textarea name="tagged_questions" class="form-control" id="screen-el" cols="2"
                                        style="display:none;" rows="2"><?= $gP->tagged_questions; ?></textarea>

                                </div>

                                <div class="mt-2" align="right">
                                    <button type="submit" class="btn btn-<?=$col;?>"><?= $btn; ?></button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="col-sm-12 mt-4">
                        <!-- Buttons for tagging questions -->
                        <p>Toggle question button to add or remove question number from the list.</p>
                        <?php for($i = 0; $i < count($data); $i++):?>
                        <button class="mb-2 btn btn-primary border-right" onclick="addQuest('<?= $data[$i]->q_id; ?>')">
                            <?= $data[$i]->q_id; ?></button>
                        <?php endfor; ?>
                        <!-- End -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Adder.js for adding item to a list -->
<script src="js/adder.js"></script>
<?php include "includes/footer.php"; ?>
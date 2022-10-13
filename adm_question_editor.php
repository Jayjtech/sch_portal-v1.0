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
if(isset($_GET['qid'])){
/**Get question */
$q_id = $_GET['qid'];
$cd = $_GET['cd'];
$qt = $_GET['qt'];
$getQuestion = $conn->query("SELECT * FROM $question_tbl_a WHERE (q_id = '$q_id' AND course_code ='$cd' AND quest_type ='$qt' AND token='$token' AND term='$log_term' AND session='$log_session')");
    while($row = $getQuestion->fetch_object()){
        $quest_img = $row->img;
        if ($quest_img != "") {
            $display_img = 'images/exam/' . $quest_img;
        } else {
            $display_img = 'images/default_img.png';
        }
        
        $quest_no = $row->quest_no;
        $isCorrect = $row->isCorrect;
        $question = $row->quest;
        $quest_id = $row->quest_id;
        $data[] = $row;
    }
    if($getQuestion->num_rows == 0){
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
                    <p class="card-title mb-0"><?= $cd; ?> <em class="text-success"><?= $qt; ?></em> | Question
                        <?= $quest_no; ?></p>
                    <div class="" align="right">
                        <a href="adm_view_question?qd=<?= $quest_id; ?>" style="text-decoration:none;"
                            class="btn btn-dark">Back</a>
                    </div>
                    <hr>
                    <form action="<?= $add_course; ?>" method="post" onsubmit="return updateQuest(this)"
                        enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6 border-right">
                                <p class="card-title">Question</p>
                                <textarea class="tinymce-editor" id="question-text"
                                    name="questionText"><?= $question; ?></textarea>
                            </div>
                            <input type="hidden" name="update_question" value="1">
                            <input type="hidden" name="course_code" value="<?= $cd; ?>">
                            <input type="hidden" name="q_id" value="<?= $q_id; ?>">
                            <input type="hidden" name="quest_img" value="<?= $quest_img; ?>">
                            <input type="hidden" name="quest_type" value="<?= $qt; ?>">
                            <input type="hidden" name="quest_id" value="<?= $quest_id; ?>">
                            <div class="col-sm-6">
                                <div class="col-sm-12">
                                    <p class="card-title">For question in image format</p>
                                    <img src="<?= $display_img; ?>" class="img-thumbnail" id="quest-img-preview"
                                        width="300" alt="Question image">
                                    <div class="pt-2">
                                        <input type="file" name="quest_img" id="quest-img" <?= $required; ?>
                                            onchange="previewImage();" class="btn btn-primary btn-sm">
                                    </div>
                                </div>
                                <hr>
                                <p class="card-title">Answers</p>
                                <?php 
                                    $ans = json_decode($data[0]->ans);
                                    for($i = 0; $i < count($ans); $i++):
                                        switch($i){
                                            case 0:
                                                $option = "A";
                                                break;
                                            case 1:
                                                $option = "B";
                                                break;
                                            case 2:
                                                $option = "C";
                                                break;
                                            case 3:
                                                $option = "D";
                                                break;
                                            case 4:
                                                $option = "E";
                                                break;
                                        }
                                    ?>
                                <div class="mb-2">
                                    <div class="input-group">
                                        <span class="input-group-text"><?= $option; ?></span>
                                        <textarea class="form-control" id="option<?= $option; ?>"
                                            name="option<?= $option; ?>"><?= $ans[$i]; ?></textarea>
                                    </div>
                                </div>
                                <?php endfor; ?>
                                <hr>
                                <div class="col-sm-6 mb-2">
                                    <div class="form-group">
                                        <p class="card-title">Select the correct option</p>
                                        <select name="isCorrect" id="" class="form-control">

                                            <?php 
                                        $ans = json_decode($data[0]->ans);?>
                                            <option value="<?= $isCorrect; ?>"><?= $ans[$isCorrect]; ?></option>
                                            <?php
                                        for($i = 0; $i < count($ans); $i++):
                                            switch($i){
                                                case 0:
                                                    $option = "A";
                                                    break;
                                                case 1:
                                                    $option = "B";
                                                    break;
                                                case 2:
                                                    $option = "C";
                                                    break;
                                                case 3:
                                                    $option = "D";
                                                    break;
                                                case 4:
                                                    $option = "E";
                                                    break;
                                            }
                                        ?>
                                            <option value="<?= $i; ?>">Option <?= $option; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-2" align="right">
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
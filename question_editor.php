<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php
if(isset($_GET['qid'])){
/**Get question */
$q_id = $_GET['qid'];
$cd = $_GET['cd'];
$qt = $_GET['qt'];
$getQuestion = $conn->query("SELECT * FROM $question_tbl_a WHERE q_id = '$q_id' AND course_code ='$cd' AND quest_type ='$qt'");
    while($row = $getQuestion->fetch_object()){
        $quest_no = $row->quest_no;
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
                    <p class="card-title mb-0"><?= $cd; ?> | Question <?= $quest_no; ?></p>
                    <hr>
                    <?php for($x = 0; $x < count($data); $x++):
                        $ans = json_decode($data[$x]->ans);
                    ?>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>



    <?php include "includes/footer.php"; ?>
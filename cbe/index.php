<?php include "../config/db.php"; ?>
<?php include "functions/question_pull.php"; ?>
<?php

switch($exam_term){
    case 1 :
    $termSyntax = "First Term";
    break;
    case 2 :
    $termSyntax = "Second Term";
    break;
    case 3 :
    $termSyntax = "Third Term";
    break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Examination</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="main">
        <div class="nav">
            <span id="course-el">Course: <?= $exam_course; ?> | Course code: <?= $exam_course_code; ?> |
                <?= $no_of_question; ?> questions</span>
            <span id="questCount-el"></span>
            <span>Paper type: <?= $user_paper_type; ?></span>
            <span id="countDown-el">Exam duration: <?= $duration; ?> minutes</span>
        </div>
        <div class="userDetails">
            <span>Name: <?= $_SESSION['name']; ?></span><br>
            <span>Adm. No: <?= $_SESSION['userId']; ?></span><br>
            <span>Class: <?= $class; ?></span><br>
            <span>Academic Period: <?= $termSyntax; ?> | <?= $exam_session; ?></span>
        </div>
        <div class="submit-div" align="right">
            <form action="<?= $score_recorder; ?>" method="POST" onsubmit="return submitExam(this)">
                <input type="hidden" id="score-holder" name="score" value="">
                <input type="hidden" id="min-left" name="minLeft" value="">
                <textarea id="answeredQuest" name="answered_quest" style="display:none;" value=""></textarea>
                <input type="hidden" id="examDet" name="examDet"
                    value="<?= base64_encode('{"userId":"'. $_SESSION['userId'].'","name":"'. $_SESSION['name'].'","quest_type":"'. $quest_type .'",
                    "class":"'. $class .'","examTerm":"'. $exam_term .'","examSession":"'. $exam_session .'","paper_type":"'. $user_paper_type .'",
                    "course_code":"'. $exam_course_code .'","subject":"'. $exam_course .'","duration":"'. $duration .'"}');?>">
                <button type="submit" name="submit_score" class="btn btn-submit">Submit</button>
            </form>
        </div>

        <div class="container">
            <!-- Render questions -->
            <div class="quest-el"></div>
            <!-- ! -->
            <div class="main-container">
                <div class="instructions">
                    <h4>Instructions</h4>
                    <ul id="instruct-el">
                        <!-- Render instructions -->
                    </ul>
                </div>
                <button id="start-btn" class="nav-btn">START EXAM</button>
            </div>

            <div class="primary-nav">
                <button id="prev-btn" class="nav-btn" style="display:none;" onclick="prevQuest()">Previous</button>
                <button id="next-btn" class="nav-btn" style="display:none;" onclick="nextQuest()">Next</button>
            </div>
            <div class="answered-el">
                <!-- Render already answered questions in here -->
            </div>
        </div>

        <div class="solution-nav">
            <button id="prev-sol" style="display:none;" onclick="prevSol()">Previous</button>
            <button id="next-sol" style="display:none;" onclick="nextSol()">Next</button>
            <div>

            </div>
            <script src="js/sweetalert.js"></script>
            <script src="js/jquery.js"></script>
            <script src="js/googleapis.js"></script>
            <?php include "functions/script.php"; ?>
</body>

</html>
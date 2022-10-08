<?php include "../config/db.php"; ?>
<?php include "../includes/calls.php"; ?>
<?php include "functions/question_pull.php"; 
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
    <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../images/favicon.png" />
    <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
</head>

<body>
    <div class="main col-lg-9 bg-light">
        <div class="nav bg-primary">
            <span id="course-el">Course: <?= $exam_course; ?> [<?= $exam_course_code; ?>]
                | <?= $no_of_question; ?> questions | Category: <?= $_SESSION['quest_type']; ?></span>
            <span id="questCount-el"></span>
            <span>Paper type: <?= $user_paper_type; ?></span>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="userDetails mt-2 p-3 bg-light">
                    <span>Name: <?= $_SESSION['name']; ?></span><br>
                    <span>Adm. No: <?= $_SESSION['userId']; ?></span><br>
                    <span>Class: <?= $class; ?></span><br>
                    <span>Academic Period: <?= $termSyntax; ?> | <?= $exam_session; ?></span>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="container row">
                    <div class="col-8 mt-3">
                        <h4 id="countDown-el">Exam duration: <?= $duration; ?> minutes</h4>
                        <div class="progress mt-3" style="height:30%;">

                        </div>
                    </div>
                    <div class="col-4">
                        <div class="submit-div" align="right">
                            <form action="<?= $score_recorder; ?>" id="reportForm" method="POST"
                                onsubmit="return submitExam(this)">
                                <input type="hidden" id="score-holder" name="score" value="">
                                <input type="hidden" id="min-left" name="minLeft" value="">
                                <textarea id="answeredQuest" name="answered_quest" style="display:none;"
                                    value=""></textarea>
                                <input type="hidden" id="examDet" name="examDet"
                                    value="<?= base64_encode('{"userId":"'. $_SESSION['userId'].'","name":"'. $_SESSION['name'].'","quest_type":"'. $quest_type .'",
                    "class":"'. $class .'","examTerm":"'. $exam_term .'","examSession":"'. $exam_session .'","paper_type":"'. $user_paper_type .'",
                    "course_code":"'. $exam_course_code .'","subject":"'. $exam_course .'","duration":"'. $duration .'"}');?>">
                                <button type="submit" name="submit_score" style="display:none;"
                                    class="btn btn-success btn-submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                <button id="start-btn" class="nav-btn btn btn-primary">START EXAM</button>
            </div>

            <div class="primary-nav">
                <button id="prev-btn" class="nav-btn btn btn-primary" style="display:none;" onclick="prevQuest()"><i
                        class="mdi mdi-arrow-left">Previous</i> </button>
                <button id="next-btn" class="nav-btn btn btn-primary" style="display:none;" onclick="nextQuest()">
                    <i class="mdi mdi-arrow-right">Next</i> </button>
            </div>
            <div class="answered-el mt-3">
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
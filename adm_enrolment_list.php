<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php if(!in_array($det->position, $worker)): ?>
<script>
window.location.href = "login?msg=Access denied!&msg_type=error"
</script>
<?php endif; ?>
<div class="content-wrapper">


    <?php if(isset($_GET['index'])): ?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">My students enrolment List for <?= $term_syntax; ?> term |
                        <?= $log_session; ?></p>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Adm. No.</th>
                                    <th>Course[Code]</th>
                                    <th>Status</th>
                                    <th>[ASS]+[CA1]+[CA2]+[CA3]+[EXAM] = [TOTAL]</th>
                                    <th>Token</th>
                                    <th>Paper Type</th>
                                    <th>Token status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($enr = $callEnrolmentList->fetch_object()):
                                    switch($enr->status){
                                        case 0: 
                                            $status = "Not taken";
                                            $col = "badge badge-warning";
                                            break;
                                        case 1: 
                                            $status = "Taken";
                                            $col = "badge badge-success";
                                            break;
                                        }
                                    switch($enr->public){
                                        case 0: 
                                            $tokenStatus = "Set to public";
                                            $col = "warning";
                                            break;
                                        case 1: 
                                            $tokenStatus = "Set to private";
                                            $col = "success";
                                            break;
                                        }
                                    ?>
                                <tr>
                                    <td><?= $enr->name; ?></td>
                                    <td class="font-weight-bold"><?= $enr->adm_no; ?></td>
                                    <td><?= $enr->course; ?>[<?= $enr->course_code; ?>]</td>
                                    <td>
                                        <p class="<?= $col; ?>"><?= $status; ?></p>
                                    </td>

                                    <td>[ <?= $enr->ass; ?> ] + [ <?= $enr->ca1; ?> ] + [ <?= $enr->ca2; ?> ] + [
                                        <?= $enr->ca3; ?> ] + [
                                        <?= !empty($enr->exam) ? :$enr->score; ?> ]
                                        [ <?= $enr->total; ?> ]</td>
                                    <td><?= $enr->exam_token; ?></td>
                                    <td><?= $enr->paper_type; ?></td>
                                    <td>
                                        <a href="<?= $add_course; ?>?changeExamStatus=<?= $enr->adm_no; ?>&course_code=<?= $enr->course_code; ?>&status=<?= $enr->public; ?>"
                                            class="btn-sm btn-<?= $col; ?>"><?= $tokenStatus; ?></a>

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

    <div class="row">
        <div class="col-md-12 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Exam token</p>
                    <hr>
                    <div class="mt-2">
                        <div class="container">
                            <p>Click the green button to set exam token to public.</p>
                            <p class="text-info">Note: Token for this exam will now be visible to students that enrolled
                                for the course.</p>
                            <form action="<?= $add_course; ?>" method="POST">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select name="course_code" id="course_code" class="form-control" required>
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
                                    <input type="hidden" name="set_to_public" value="0930">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <button class="btn btn-success"><i class="mdi mdi-eye-open"></i> Set to
                                                public</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>

<?php include "includes/footer.php"; ?>
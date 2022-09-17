<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/edit_calls.php"; ?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Bills and Revenue table for <?= $term_syntax?> term |
                        <?= $log_session; ?></p>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Name[Adm No.]</th>
                                    <th>Class</th>
                                    <th>School fee</th>
                                    <th>ICT</th>
                                    <th>Music</th>
                                    <th>Health</th>
                                    <th>Sport</th>
                                    <th>PTA</th>
                                    <th>Development</th>
                                    <th>VS</th>
                                    <th>Excursion</th>
                                    <th>Others</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $callBills->fetch_object()):?>
                                <tr>
                                    <td><?= $row->name; ?>[<?= $row->userId; ?>]</td>
                                    <td class="font-weight-bold"><?= $row->class; ?></td>
                                    <td><?= $currency; ?><?= number_format($row->sch_fee); ?></td>
                                    <td><?= $currency; ?><?= number_format($row->ict); ?></td>
                                    <td><?= $currency; ?><?= number_format($row->music); ?></td>
                                    <td><?= $currency; ?><?= number_format($row->health); ?></td>
                                    <td><?= $currency; ?><?= number_format($row->sport); ?></td>
                                    <td><?= $currency; ?><?= number_format($row->pta); ?></td>
                                    <td><?= $currency; ?><?= number_format($row->development); ?></td>
                                    <td><?= $currency; ?><?= number_format($row->vs_fee); ?></td>
                                    <td><?= $currency; ?><?= number_format($row->excursion); ?></td>
                                    <td><?= $currency; ?><?= number_format($row->others); ?></td>
                                    <td><?= $currency; ?><?= number_format($row->total); ?></td>
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
                    <p class="card-title mb-0">Comment uploader</p>
                    <hr>
                    <div class="mt-2">
                        <div class="container">
                            <p>Click the green button to download the comment format as an Excel CSV file.</p>
                            <p class="text-info">Note: Comment will be downloaded for the term and session you
                                logged in to and based on the class you officiate.</p>
                            <form action="<?= $exporter; ?>" method="get">
                                <div class="row">
                                    <input type="hidden" name="table" value="<?= $evaluation_tbl; ?>">
                                    <input type="hidden" name="type" value="teacher">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <button class="btn btn-success"><i class="mdi mdi-download"></i> Teacher's
                                                comment format</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <form action="<?= $exporter; ?>" method="get">
                                <div class="row">
                                    <input type="hidden" name="table" value="<?= $evaluation_tbl; ?>">
                                    <input type="hidden" name="type" value="head_teacher">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <button class="btn btn-success"><i class="mdi mdi-download"></i> Head
                                                teacher's comment format</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="container mt-3">
                            <P class="card-title">Upload teacher's comment</P>
                            <p>Select the comment file you want to upload</p>
                            <p class="text-info">Note: Comment will be inserted into the spots that has the admission
                                number in the comment file.</p>
                            <form action="<?= $add_course;?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="term" value="<?= $term_syntax; ?> term">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="file" name="file" class="form-control btn btn-dark" required>
                                        </div>
                                    </div>
                                    <input type="hidden" value="1" name="upload_t_comment">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <button type="submit" name="" class="btn btn-primary"><i
                                                    class="mdi mdi-upload"></i> Upload teacher's comment</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="container mt-3">
                            <P class="card-title">Upload Head Teacher's Comment</P>
                            <p>Select the comment file you want to upload</p>
                            <p class="text-info">Note: Comment will be inserted into the spots that has the admission
                                number in the comment file.</p>
                            <form action="<?= $add_course;?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <input type="hidden" name="term" value="<?= $term_syntax; ?> term">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="file" name="file" class="form-control btn btn-dark" required>
                                        </div>
                                    </div>
                                    <input type="hidden" value="1" name="upload_h_comment">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <button type="submit" name="" class="btn btn-primary"><i
                                                    class="mdi mdi-upload"></i> Upload head teacher's comment</button>
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


</div>


<?php include "includes/footer.php"; ?>
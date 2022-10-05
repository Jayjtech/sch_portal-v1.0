<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>
<?php include "includes/edit_calls.php"; ?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Student List</p>
                    <hr>
                    <div class="table-responsive">
                        <table class="myTable table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Adm. No.</th>
                                    <th>Email | Phone</th>
                                    <th>Department</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($stu = $callStudents->fetch_object()):?>
                                <tr>
                                    <td><?= $stu->name; ?></td>
                                    <td class="font-weight-bold"><?= $stu->userId; ?></td>
                                    <td><?= $stu->email; ?> | <?= $stu->phone; ?></td>
                                    <td><?= $stu->department; ?></td>
                                    <td>
                                        <a href="adm_students?rev=<?= htmlspecialchars($stu->token); ?>&ac=<?= htmlspecialchars($stu->userId); ?>"
                                            class="btn-sm btn-primary"><i class="mdi mdi-pen"></i> Review </a>
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
    <?php if(isset($_GET['rev'])):?>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <h4 class="card-title">Review Student</h4>
                    <hr>
                    <form action="<?= $pusher;?>" class="forms-sample" method="POST" onsubmit="return revStu(this)">
                        <div class="row mt-3 mb-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Token</label>
                                    <input type="text" class="form-control" id="token" name="token"
                                        value="<?= $edStu->token; ?>" readonly>
                                </div>
                            </div>
                            <div class="row col-sm-6">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter student's name" value="<?=$edStu->name; ?>">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Current Class</label>
                                        <select name="curr_class" id="curr_class" class="form-control" required>
                                            <option value="<?= $curr_class_val; ?>"><?= $curr_class; ?></option>
                                            <?php while($cl = $callClass->fetch_object()):?>
                                            <option value="<?= $cl->class; ?>"><?= $cl->class; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="text-info">Tuition fee discount in % eg. 1.0%[Pay full],
                                        0.9%[Pay 90% of tuition fee]</label>
                                    <input type="number" class="form-control" id="tuition_discount"
                                        name="tuition_discount" placeholder="Enter tuition fee discount in % "
                                        value="<?= $edStu->tuition_discount; ?>">
                                </div>
                            </div>
                            <input type="hidden" name="adm_no" value="<?= $edStu->userId?>">
                            <input type="hidden" name="review_student" value="1">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Award type</label>
                                    <select name="award_type" id="award_type" class="form-control" required>
                                        <option value="<?= $award_val; ?>"><?= $award; ?></option>
                                        <?php while($awd = $callStudentAward->fetch_object()):?>
                                        <option value="<?= $awd->award; ?>"><?= $awd->award; ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-2 mb-3 navigator">
                            <a class="btn btn-light" onclick="openBills();"><i class="mdi mdi-receipt"></i> Click to
                                view
                                student's bills</a>
                        </div>

                        <div class="container bill-container">
                            <p class="text-uppercase text-info">BILLS</p>
                            <div class="row">
                                <div class="col-sm-8"></div>
                                <div class="total-box col-sm-4"></div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">School fee</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="sch_fee" name="sch_fee"
                                                placeholder="Enter school fee"
                                                value="<?= !empty($bil->sch_fee) ? $bil->sch_fee: null; ?>">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Registration fee</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="reg_fee" name="reg_fee"
                                                placeholder="Enter registration fee"
                                                value="<?= !empty($bil->reg_fee) ? $bil->reg_fee : null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Uniform</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="uniform" name="uniform"
                                                placeholder="Enter uniform price"
                                                value="<?= !empty($bil->uniform) ? $bil->uniform : null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Cardigan</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="cardigan" name="cardigan"
                                                placeholder="Enter cardigan price"
                                                value="<?= !empty($bil->cardigan) ? $bil->cardigan : null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">School badge</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="sch_badge" name="sch_badge"
                                                placeholder="Enter school badge price"
                                                value="<?= !empty($bil->sch_badge) ? $bil->sch_badge : null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Sport wear</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="sport_wear" name="sport_wear"
                                                placeholder="Enter sport wear price"
                                                value="<?= !empty($bil->sport_wear) ? $bil->sport_wear : null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">ID - card</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="id_card" name="id_card"
                                                placeholder="Enter ID - card price"
                                                value="<?= !empty($bil->id_card) ? $bil->id_card : null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Handbook</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="handbook" name="handbook"
                                                placeholder="Enter handbook price"
                                                value="<?= !empty($bil->handbook) ? $bil->handbook : null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Extra Lesson</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="lesson" name="lesson"
                                                placeholder="Enter extra lesson fee"
                                                value="<?= !empty($bil->lesson) ? $bil->lesson : null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Security</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="security" name="security"
                                                placeholder="Enter security levy"
                                                value="<?= !empty($bil->security) ? $bil->security : null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">School Media</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="sch_media" name="sch_media"
                                                placeholder="Enter school media fee"
                                                value="<?= !empty($bil->sch_media) ? $bil->sch_media : null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Club & Societies</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="club" name="club"
                                                placeholder="Enter club fee"
                                                value="<?= !empty($bil->club) ? $bil->club : null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Boarding fee</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="boarding_fee"
                                                name="boarding_fee" placeholder="Enter boarding fee"
                                                value="<?= !empty($bil->boarding_fee) ? $bil->boarding_fee : null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">ICT fee</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="ict" name="ict"
                                                placeholder="Enter ICT fee"
                                                value="<?= !empty($bil->ict) ? $bil->ict : null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Vocational</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="vocational" name="vocational"
                                                placeholder="Enter vocational levy"
                                                value="<?= !empty($bil->vocational) ? $bil->vocational : null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Music fee</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="music" name="music"
                                                placeholder="Enter music fee" value="<?= $bil->music; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Health fee</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="health" name="health"
                                                placeholder="Enter health fee"
                                                value="<?= !empty($bil->health) ? $bil->health :null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Sport fee</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="sport" name="sport"
                                                placeholder="Enter sport fee"
                                                value="<?= !empty($bil->sport) ? $bil->sport :null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Transportation fee</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="transport" name="transport"
                                                placeholder="Enter transport fee"
                                                value="<?= !empty($bil->transport) ? $bil->transport:null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Excursion fee</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="excursion" name="excursion"
                                                placeholder="Enter transport fee"
                                                value="<?= !empty($bil->excursion)? $bil->excursion : null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Valedictory Service fee</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="vs_fee" name="vs_fee"
                                                placeholder="Enter valedictory service fee"
                                                value="<?= !empty($bil->vs_fee) ?$bil->vs_fee:null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">PTA fee</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="pta" name="pta"
                                                placeholder="Enter PTA fee"
                                                value="<?= !empty($bil->pta) ? $bil->pta:null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Development fee</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="development"
                                                name="development" placeholder="Enter development fee"
                                                value="<?= !empty($bil->development) ?$bil->development:null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Other fees</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><?= $currency; ?></span>
                                            <input type="number" class="form-control" id="others" name="others"
                                                placeholder="Enter other fee"
                                                value="<?= !empty($bil->others) ?$bil->others:null; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label for="">What does other fees cover?</label>
                                        <textarea id="others_covers" name="others_covers" cols="3" class="form-control"
                                            rows="2"
                                            placeholder="What does other fees cover?"><?= !empty($bil->others_covers) ?$bil->others_covers :null;?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="" align="right">
                            <button type="submit" class="btn btn-primary mr-2" name="review_staff">Save Changes</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Bill uploader</p>
                    <hr>
                    <div class="mt-2">
                        <div class="container">
                            <p>Click the green button to download the bill format as an Excel CSV file.</p>
                            <p class="text-info">Note: Bills will be downloaded for the term and Session you logged in
                                to.</p>
                            <form action="<?= $exporter; ?>" method="get">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select name="class" id="class" class="form-control" required>
                                                <option value="">For what class?</option>
                                                <option value="all">All classes</option>
                                                <?php while($cl = $callClass2->fetch_object()):?>
                                                <option value="<?= $cl->class; ?>"><?= $cl->class; ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="table" value="<?= $bill_tbl; ?>">
                                    <input type="hidden" name="term" value="<?= $term_syntax; ?> term">
                                    <input type="hidden" name="session" value="<?= $log_session; ?>">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <button class="btn btn-success"><i class="mdi mdi-download"></i> Excel
                                                Format</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <div class="container mt-3">
                            <form action="<?= $pusher;?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="">Choose Bill Excel File</label>
                                            <input type="file" name="file" class="form-control btn btn-dark" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <button type="submit" name="push_bills" class="mt-3 btn btn-primary"><i
                                                    class="mdi mdi-upload"></i> Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


    <?php include "includes/footer.php"; ?>
<?php include "includes/header.php"; ?>
<?php include "includes/navbar.php"; ?>
<?php include "includes/sidebar.php"; ?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome <?= $det->name; ?></h3>
                    <h6 class="font-weight-normal mb-0">All systems are running
                        smoothly!
                </div>
                <div class="col-12 col-xl-4 mb-4 mb-xl-0">
                    <div class="walletBal"></div>
                    <h6 class="font-weight-normal mb-0 text-info">Clear your bills with ease from your wallet!
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card tale-bg">
                <div class="card-people mt-auto">
                    <img src="images/dashboard/people.svg" alt="people">
                    <div class="weather-info">
                        <div class="d-flex">
                            <div>
                                <h2 class="mb-0 font-weight-normal"><i class="mdi mdi-calendar"></i> Today
                                    (<?= date('d'); ?> <?= date('M'); ?> <?= date('Y'); ?>)
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        if($det->user_type == "c3R1ZHk="){
        if($monnify_account == true):
         ?>
        <div class="col-md-6 grid-margin transparent">
            <p class="font-weight-bold">Make your bank transfer to any of the accounts listed below and your wallet
                will be funded automatically.</p>
            <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <p class="mb-4"><?= $monnify_account->responseBody->accounts[0]->bankName; ?></p>
                            <p class="fs-30 mb-2"><?= $monnify_account->responseBody->accounts[0]->accountNumber; ?></p>
                            <p><?= $monnify_account->responseBody->accounts[0]->accountName; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                        <div class="card-body">
                            <p class="mb-4"><?= $monnify_account->responseBody->accounts[1]->bankName; ?></p>
                            <p class="fs-30 mb-2"><?= $monnify_account->responseBody->accounts[1]->accountNumber; ?></p>
                            <p><?= $monnify_account->responseBody->accounts[1]->accountName; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                        <div class="card-body">
                            <p class="mb-4"><?= $monnify_account->responseBody->accounts[2]->bankName; ?></p>
                            <p class="fs-30 mb-2"><?= $monnify_account->responseBody->accounts[2]->accountNumber; ?></p>
                            <p><?= $monnify_account->responseBody->accounts[2]->accountName; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                    <div class="card card-light-danger">
                        <div class="card-body">
                            <p class="mb-4"><?= $monnify_account->responseBody->accounts[3]->bankName; ?></p>
                            <p class="fs-30 mb-2"><?= $monnify_account->responseBody->accounts[3]->accountNumber; ?></p>
                            <p><?= $monnify_account->responseBody->accounts[3]->accountName; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php }else{ /**Teacher */ ?>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <p class="card-title">Created Courses[Subjects]</p>
                        <a href="create_course" class="btn btn-dark">Create course</a>
                    </div>
                    <p class="font-weight-500 text-info">Note that the created courses[subjects] will be visible to
                        students[pupils] in the selected category
                    </p>
                    <?php if($created_course_count > 0){ ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Course[Subject]</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $callCourses->fetch_object()):?>
                                <tr>
                                    <td><?= $row->course; ?>[<?= $row->course_code; ?>]</td>
                                    <td class="font-weight-medium">
                                        <a href="" class="badge badge-primary">Publish</a>
                                    </td>
                                    <td>
                                        <form action="<?= $course_deleter; ?>" method="GET"
                                            onsubmit="return delForm(this);">
                                            <input type="hidden" name="del" value="<?= $row->id; ?>">
                                            <button type="submit" class="btn"><i class="mdi mdi-delete"
                                                    style="font-size:25px;"></i></button>
                                        </form>
                                    </td>
                                </tr>

                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php }else{ ?>
                    <div class="alert alert-danger mt-5">This table is empty!</div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title"><?= $_SESSION['user_type']; ?>'s Details</p>
                    <hr>
                    <div class="" align="right">
                        <h6><?= $det->userId;?></h6>
                        <h6><?= $det->name;?></h6>
                        <h6><?= $det->email;?></h6>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-borderless">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td class="font-weight-bold">|</td>
                                    <td class="font-weight-bold"><?= $det->name; ?></td>
                                </tr>

                                <tr>
                                    <th>Email-ID</th>
                                    <td class="font-weight-bold">|</td>
                                    <td class="font-weight-bold"><?= $det->email; ?></td>
                                </tr>

                                <tr>
                                    <th>Token</th>
                                    <td class="font-weight-bold">|</td>
                                    <td class="font-weight-bold"><?= $det->token; ?></td>
                                </tr>

                                <?php if($_SESSION['user_type'] == "Student"):?>
                                <tr>
                                    <th>Admission Number</th>
                                    <td class="font-weight-bold">|</td>
                                    <td class="font-weight-bold"><?= $det->userId; ?></td>
                                </tr>
                                <tr>
                                    <th>Class</th>
                                    <td class="font-weight-bold">|</td>
                                    <td class="font-weight-bold"><?= $det->curr_class; ?></td>
                                </tr>
                                <?php endif; ?>
                                <?php if($_SESSION['user_type'] == "Staff" || $_SESSION['user_type'] == "Admin"):?>
                                <tr>
                                    <th>Post of Duty</th>
                                    <td class="font-weight-bold">|</td>
                                    <td class="font-weight-bold"><?= $POD; ?></td>
                                </tr>
                                <tr>
                                    <th>Staff Type</th>
                                    <td class="font-weight-bold">|</td>
                                    <td class="font-weight-bold"><?= $det->staff_type; ?></td>
                                </tr>
                                <tr>
                                    <th>Class officiating</th>
                                    <td class="font-weight-bold">|</td>
                                    <td class="font-weight-bold"><?= $det->class_officiating; ?></td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-6 grid-margin stretch-card">
            <div class="card position-relative">
                <div class="card-body">
                    <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2"
                        data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-md-12 col-xl-9">
                                        <div class="row">
                                            <div class="col-md-12 border-right">
                                                <!-- ANNOUNCEMENT WILL BE HERE -->
                                                THANK YOU VERY MUCH!!!!
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    <div class="col-md-12 col-xl-9">
                                        <div class="row">
                                            <div class="col-md-12 border-right">
                                                SECOND ANNOUNCMENT WILL BE HERE
                                                <!-- SECOND ANNOUNCMENT WILL BE HERE -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Top Products</p>
                    <hr>
                    <div class="table-responsive">
                        <table class="table myTable table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Search Engine Marketing</td>
                                    <td class="font-weight-bold">$362</td>
                                    <td>21 Sep 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-success">Completed</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Search Engine Optimization</td>
                                    <td class="font-weight-bold">$116</td>
                                    <td>13 Jun 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-success">Completed</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Display Advertising</td>
                                    <td class="font-weight-bold">$551</td>
                                    <td>28 Sep 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-warning">Pending</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pay Per Click Advertising</td>
                                    <td class="font-weight-bold">$523</td>
                                    <td>30 Jun 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-warning">Pending</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>E-Mail Marketing</td>
                                    <td class="font-weight-bold">$781</td>
                                    <td>01 Nov 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-danger">Cancelled</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Referral Marketing</td>
                                    <td class="font-weight-bold">$283</td>
                                    <td>20 Mar 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-warning">Pending</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Social media marketing</td>
                                    <td class="font-weight-bold">$897</td>
                                    <td>26 Oct 2018</td>
                                    <td class="font-weight-medium">
                                        <div class="badge badge-success">Completed</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> -->



    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-0">Projects</p>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th class="pl-0  pb-2 border-bottom">Places</th>
                                    <th class="border-bottom pb-2">Orders</th>
                                    <th class="border-bottom pb-2">Users</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="pl-0">Kentucky</td>
                                    <td>
                                        <p class="mb-0"><span class="font-weight-bold mr-2">65</span>(2.15%)</p>
                                    </td>
                                    <td class="text-muted">65</td>
                                </tr>
                                <tr>
                                    <td class="pl-0">Ohio</td>
                                    <td>
                                        <p class="mb-0"><span class="font-weight-bold mr-2">54</span>(3.25%)</p>
                                    </td>
                                    <td class="text-muted">51</td>
                                </tr>
                                <tr>
                                    <td class="pl-0">Nevada</td>
                                    <td>
                                        <p class="mb-0"><span class="font-weight-bold mr-2">22</span>(2.22%)</p>
                                    </td>
                                    <td class="text-muted">32</td>
                                </tr>
                                <tr>
                                    <td class="pl-0">North Carolina</td>
                                    <td>
                                        <p class="mb-0"><span class="font-weight-bold mr-2">46</span>(3.27%)</p>
                                    </td>
                                    <td class="text-muted">15</td>
                                </tr>
                                <tr>
                                    <td class="pl-0">Montana</td>
                                    <td>
                                        <p class="mb-0"><span class="font-weight-bold mr-2">17</span>(1.25%)</p>
                                    </td>
                                    <td class="text-muted">25</td>
                                </tr>
                                <tr>
                                    <td class="pl-0">Nevada</td>
                                    <td>
                                        <p class="mb-0"><span class="font-weight-bold mr-2">52</span>(3.11%)</p>
                                    </td>
                                    <td class="text-muted">71</td>
                                </tr>
                                <tr>
                                    <td class="pl-0 pb-0">Louisiana</td>
                                    <td class="pb-0">
                                        <p class="mb-0"><span class="font-weight-bold mr-2">25</span>(1.32%)</p>
                                    </td>
                                    <td class="pb-0">14</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">Charts</p>
                            <div class="charts-data">
                                <div class="mt-3">
                                    <p class="mb-0">Data 1</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="progress progress-md flex-grow-1 mr-4">
                                            <div class="progress-bar bg-inf0" role="progressbar" style="width: 95%"
                                                aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mb-0">5k</p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <p class="mb-0">Data 2</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="progress progress-md flex-grow-1 mr-4">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 35%"
                                                aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mb-0">1k</p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <p class="mb-0">Data 3</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="progress progress-md flex-grow-1 mr-4">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 48%"
                                                aria-valuenow="48" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mb-0">992</p>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <p class="mb-0">Data 4</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="progress progress-md flex-grow-1 mr-4">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 25%"
                                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <p class="mb-0">687</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 stretch-card grid-margin grid-margin-md-0">
                    <div class="card data-icon-card-primary">
                        <div class="card-body">
                            <p class="card-title text-white">Number of Meetings</p>
                            <div class="row">
                                <div class="col-8 text-white">
                                    <h3>34040</h3>
                                    <p class="text-white font-weight-500 mb-0">The total number of
                                        sessions within the date range.It is calculated as the sum .
                                    </p>
                                </div>
                                <div class="col-4 background-icon">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Notifications</p>
                    <ul class="icon-data-list">
                        <li>
                            <div class="d-flex">
                                <img src="images/faces/face1.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">Isabella Becker</p>
                                    <p class="mb-0">Sales dashboard have been created</p>
                                    <small>9:30 am</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <img src="images/faces/face2.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">Adam Warren</p>
                                    <p class="mb-0">You have done a great job #TW111</p>
                                    <small>10:30 am</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <img src="images/faces/face3.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">Leonard Thornton</p>
                                    <p class="mb-0">Sales dashboard have been created</p>
                                    <small>11:30 am</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <img src="images/faces/face4.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">George Morrison</p>
                                    <p class="mb-0">Sales dashboard have been created</p>
                                    <small>8:50 am</small>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex">
                                <img src="images/faces/face5.jpg" alt="user">
                                <div>
                                    <p class="text-info mb-1">Ryan Cortez</p>
                                    <p class="mb-0">Herbs are fun and easy to grow.</p>
                                    <small>9:00 am</small>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Advanced Table</p>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="example" class="display expandable-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Quote#</th>
                                            <th>Product</th>
                                            <th>Business type</th>
                                            <th>Policy holder</th>
                                            <th>Premium</th>
                                            <th>Status</th>
                                            <th>Updated at</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- content-wrapper ends -->
<script>
function getWalletBal() {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "functions/getWalletBalance.php", false);
    xmlhttp.send(null);
    document.querySelector(".walletBal").innerHTML = xmlhttp.responseText;
}
getWalletBal();
setInterval(function() {
    getWalletBal();
}, 1000);
</script>
<?php include "includes/footer.php"; ?>
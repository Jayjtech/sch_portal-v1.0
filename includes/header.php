<?php include "config/db.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link href="vendors/simple-datatables/style.css" rel="stylesheet">
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"> -->
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <link rel="stylesheet" href="css/pass.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
</head>

<style type="text/css">
.my_file {
    position: absolute;
    bottom: 0;
    outline: none;
    color: transparent;
    width: 100%;
    box-sizing: border-box;
    padding: 15px 55px;
    cursor: pointer;
    transition: 0.5s;
    background: rgba(0, 0, 0, 0.5);
    opacity: 0;
}

.my_file::-webkit-file-upload-button {
    visibility: hidden;
}

.my_file::before {
    content: '\f030';
    font-family: fontAwesome;
    font-size: 30px;
    color: #fff;
    display: inline-block;
    -webkit-user-select: none;
}

.my_file::after {
    content: 'Update';
    font-family: 'arial';
    font-weight: bold;
    color: #fff;
    display: block;
    top: 50px;
    font-size: 12px;
    position: absolute;
}

.my_file:hover {
    opacity: 1;
}

.mobile-view {
    display: none;
}

@media only screen and (max-width: 800px) {
    .desktop-view {
        display: none;
    }

    .mobile-view {
        display: block;
        color: whitesmoke;
        position: fixed;
        bottom: 0;
        left: 0;
        display: flex;
        justify-content: space-around;
        align-items: center;
        width: 100%;
        padding: 20px;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1;
    }
}

.imgGallery img {
    padding: 8px;
    max-width: 100px;
}
</style>
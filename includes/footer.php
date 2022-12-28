<!-- partial:partials/_footer.html -->
<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <?= $year; ?>.
            <a href="https://ekreat.com" target="_blank">Designed and developed by Ekreat solutions</a></span>
    </div>
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"><a
                href="https://wa.me/+2347034876144" target="_blank"></a></span>
    </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>

<!-- TinyMCE -->
<script src="vendor/tinymce/tinymce.min.js"></script>
<script src="vendor/tiny.js"></script>
<!-- End of tinyMCE -->

<!-- container-scroller -->
<script src="js/validator.js"></script>
<script src="js/sweetalert2.js"></script>
<!-- plugins:js -->
<script src="vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="vendors/chart.js/Chart.min.js"></script>
<script src="vendors/datatables.net/jquery.dataTables.js"></script>
<script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="js/dataTables.select.min.js"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="js/off-canvas.js"></script>
<script src="js/hoverable-collapse.js"></script>
<script src="js/template.js"></script>
<script src="js/settings.js"></script>
<script src="js/todolist.js"></script>

<!-- endinject -->
<!-- Custom js for this page-->
<script src="js/dashboard.js"></script>
<script src="js/Chart.roundedBarCharts.js"></script>

<script>
/**DataTable */
$(document).ready(function() {
    $('.myTable').DataTable();
});
</script>

<?php if(isset($_SESSION['message'])):?>
<script>
swal.fire({
    title: "<?= $_SESSION['message']; ?>",
    text: "<?= $_SESSION['remedy']; ?>",
    icon: "<?= $_SESSION['msg_type']; ?>"
})
</script>
<?php endif; ?>

<?php unset($_SESSION['message']); ?>

<?php include "footer_script.php"; ?>
<?php include "auth.php"; ?>

<!-- End custom js for this page-->
</body>

</html>
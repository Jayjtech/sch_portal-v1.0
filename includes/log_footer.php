  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->

  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <script src="js/functions.js"></script>
  <script src="js/sweetalert2.js"></script>
  <script src="js/sweetalert.js"></script>

  <?php if(isset($_GET['msg'])):?>
  <script>
swal({
    title: "<?= $_GET['msg']; ?>",
    text: "<?= $_GET['remedy']; ?>",
    icon: "<?= $_GET['msg_type']; ?>"
})
  </script>
  <?php endif; ?>
  <!-- endinject -->
  </body>

  </html>
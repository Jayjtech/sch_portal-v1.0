<?php
include "config/db.php";
session_destroy();
?>

<script>
localStorage.clear();
window.location.href = "login";
</script>
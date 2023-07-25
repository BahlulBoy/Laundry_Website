<?php
if (!isset($_SESSION['login']) && !isset($_SESSION['admin'])) {
    echo "<script>window.location='login.php'</script>";
}
?>
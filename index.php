<?php
    require_once('function.php');
    if (!isset($_SESSION['login']) && !isset($_SESSION['admin'])) {
        echo "<script>window.location='login.php'</script>";
    } else {
        echo "<script>window.location='order.php'</script>";
    }
?>
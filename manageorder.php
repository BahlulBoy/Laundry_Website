<?php 
    require_once 'function.php';
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            editOrder($id, $status);
        }
    }
?>
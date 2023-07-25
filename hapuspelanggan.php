<?php
require 'function.php';
$nama = $_GET['id'];
hapusPelanggan($nama);
header("Location:pelanggan.php?pesan=data pelanggan telah dihapus");
?>
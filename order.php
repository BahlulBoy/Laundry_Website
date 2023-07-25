<?php 
	require_once('function.php');
    require_once 'loginconfirm.php';
    $order_belum = count(query("SELECT * FROM `order` WHERE status = 'belum'"));
	$order_belum_dibayar = count(query("SELECT * FROM `order` WHERE status = 'belum dibayar'"));
	$order_sudah_dibayar = count(query("SELECT * FROM `order` WHERE status = 'sudah dibayar'"));
    if (isset($_GET['pesan'])) {
        $pesan = $_GET['pesan'];
        echo "<script>alert('$pesan')</script>";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Kilat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./style.css/style.css">
</head>
<body>
    <!-- memunculkan navbar -->
    <?php require './head/navbar.php'; ?>
    <!-- memunculkan navbar -->

    <div class="content px-20 pb-10">
        <div class="header flex justify-between items-center h-14 mt-3">
            <h4 class="font-semibold">Selamat Datang, <?= $_SESSION['admin'] ?></h4>
            <a href="tambahorder.php" class="btn-order flex justify-center items-center px-6 h-2/3 rounded-xl border text-white" href=""><i class="bi bi-cart3 pr-2"></i>Order baru</a>
        </div>
        <div class="order-desc grid grid-cols-3 gap-20 mt-2 h-24">
            <div class="item flex flex-col justify-center pl-6 shadow-item border h-full rounded-xl bg-slate-50">
                <h4>Order Belum Dikerjakan</h4>
                <h4 class="text-xl font-bold"><?= $order_belum ?></h4>
            </div>
            <div class="item flex flex-col justify-center pl-6 shadow-item border h-full rounded-xl bg-slate-50">
                <h4>Order Belum Dibayar</h4>
                <h4 class="text-xl font-bold"><?= $order_belum_dibayar ?></h4>
            </div>
            <div class="item flex flex-col justify-center pl-6 shadow-item border h-full rounded-xl bg-slate-50">
                <h4>Order Belum Telah Dibayar</h4>
                <h4 class="text-xl font-bold"><?= $order_sudah_dibayar ?></h4>
            </div>
        </div>
        <div class="search-order w-full h-12 bg-white mt-8 rounded-2xl shadow-item">
            <form action="./order.php" method="get" class="flex h-full">
                <input class="grow pl-6 rounded-2xl" type="text" name="search" id="search" placeholder="Cari Order Berdasarkan Nama Pelanggan">
                <div class="btn-place flex-none w-32 py-1 px-3">
                    <button class="w-full h-full border rounded-lg" type="submit"><i class="bi bi-search"></i> Search</button>
                </div>
            </form>
        </div>
        <div class="order-belum-dikerjakan w-full bg-white mt-8 px-7 py-4 rounded-lg shadow-item">
            <h1 class="text-2xl font-bold pb-3">Order Belum Dikerjakan</h1>
            <hr>
            <div class="items-list table w-full mt-3 font-bold">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="h-14 tablehead">
                            <th class="text-white">No</th>
                            <th class="text-white">ID Order</th>
                            <th class="text-white">Tanggal Order</th>
                            <th class="text-white">Nama Pelanggan</th>
                            <th class="text-white">Jenis Paket</th>
                            <th class="text-white">Tanggal Ambil</th>
                            <th class="text-white">Jumlah Berat (Kg)</th>
                            <th class="text-white">Total Bayar</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                     $query_belum = "SELECT * FROM `order` WHERE status = 'belum' ORDER BY kode_pemesanan DESC";
                     if (isset($_GET['search']) && !empty($_GET['search'])) {
                        $b = $_GET['search'];
                        $query_belum = "SELECT * FROM `order` WHERE status = 'belum' AND nama_pelanggan LIKE '%$b%' ORDER BY kode_pemesanan DESC;";
                     }
                     $order = query($query_belum); 
                     if (!empty($order)) :?>
                     <?php 
                        $no_order = 1;
                        foreach($order as $or) : ?>
                        <tr class="font-normal">
                            <td class="text-center"><?=$no_order ?></td>
                            <td class="text-center"><?= $or['kode_pemesanan'] ?></td>
                            <td class="text-center"><?= $or['tanggal_pesan'] ?></td>
                            <td class="text-center"><?= $or['nama_pelanggan'] ?></td>
                            <td class="text-center"><?= selectTipeName($or['id_jenis']) ?></td>
                            <td class="text-center"><?= $or['tanggal_ambil'] ?></td>
                            <td class="text-center"><?= $or['total_berat'] . ' Kg' ?></td>
                            <td class="text-center"><?= $or['harga'] ?></td>
                            <td class="text-center"><?= $or['status'] ?></td>
                            <td class="flex flex-col justify-center items-center">
                                <a href="manageorder.php?id=<?= $or['kode_pemesanan'] ?>&status=belum dibayar" onclick="return confirm('Yakin ingin mengedit status?');" class="btn-sudah text-white border my-1 px-1 rounded-lg">Sudah</a>
                                <a href="manageorder.php?id=<?= $or['kode_pemesanan'] ?>&status=hapus" onclick="return confirm('Yakin akan menghapus?');" class="btn-hapus text-white border my-1 px-1 rounded-lg">Hapus</a>
                            </td>
                        </tr>
                        <?php $no_order++ ?>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td class="flex justify-center items-center w-full h-14 font-medium">Data Tidak Tersedia</td>
                            </tr>
                        <?php endif?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="order-belum-dibayar w-full bg-white mt-8 px-7 py-4 rounded-lg shadow-item">
            <h1 class="text-2xl font-bold pb-3">Order Belum Dibayar</h1>
            <hr>
            <div class="items-list table w-full mt-3 font-bold">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="h-14 tablehead">
                            <th class="text-white">No</th>
                            <th class="text-white">ID Order</th>
                            <th class="text-white">Tanggal Order</th>
                            <th class="text-white">Nama Pelanggan</th>
                            <th class="text-white">Jenis Paket</th>
                            <th class="text-white">Tanggal Ambil</th>
                            <th class="text-white">Jumlah Berat (Kg)</th>
                            <th class="text-white">Total Bayar</th>
                            <th class="text-white">Status</th>
                            <th class="text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                     $query_belum_bayar = "SELECT * FROM `order` WHERE status = 'belum dibayar' ORDER BY kode_pemesanan DESC";
                     if (isset($_GET['search']) && !empty($_GET['search'])) {
                        $b = $_GET['search'];
                        $query_belum_bayar = "SELECT * FROM `order` WHERE status = 'belum dibayar' AND nama_pelanggan LIKE '%$b%' ORDER BY kode_pemesanan DESC";
                     }
                     $order = query($query_belum_bayar); 
                     if (!empty($order)) :?>
                     <?php 
                        $no_order = 1;
                        foreach($order as $or) : ?>
                        <tr class="font-normal">
                            <td class="text-center"><?=$no_order ?></td>
                            <td class="text-center"><?= $or['kode_pemesanan'] ?></td>
                            <td class="text-center"><?= $or['tanggal_pesan'] ?></td>
                            <td class="text-center"><?= $or['nama_pelanggan'] ?></td>
                            <td class="text-center"><?= selectTipeName($or['id_jenis']) ?></td>
                            <td class="text-center"><?= $or['tanggal_ambil'] ?></td>
                            <td class="text-center"><?= $or['total_berat'] . ' Kg' ?></td>
                            <td class="text-center"><?= $or['harga'] ?></td>
                            <td class="text-center"><?= $or['status'] ?></td>
                            <td class="flex flex-col justify-center items-center">
                                <a href="manageorder.php?id=<?= $or['kode_pemesanan'] ?>&status=sudah dibayar" onclick="return confirm('Yakin ingin mengedit status?');" class="btn-bayar text-white border my-1 px-1 rounded-lg">Dibayar</a>
                                <a href="manageorder.php?id=<?= $or['kode_pemesanan'] ?>&status=hapus" onclick="return confirm('Yakin akan menghapus?');" class="btn-hapus text-white border my-1 px-1 rounded-lg">Hapus</a>
                            </td>
                        </tr>
                        <?php $no_order++ ?>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td class="flex justify-center items-center w-full h-14 font-medium">Data Tidak Tersedia</td>
                            </tr>
                        <?php endif?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
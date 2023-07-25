<?php 
	require_once('function.php');
    require_once 'loginconfirm.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Kilat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./style.css/style.css">
</head>
<body>
    <?php require './head/navbar.php'; ?>
    <div class="content px-20 pb-10">
    <div class="search-order w-full h-12 bg-white mt-8 rounded-2xl shadow-item">
        <form action="./riwayattransaksi.php" method="get" class="flex h-full">
            <input class="grow pl-6 rounded-2xl" type="text" name="search" id="search" placeholder="Cari Order Berdasarkan Nama Pelanggan">
            <div class="btn-place flex-none w-32 py-1 px-3">
                <button class="w-full h-full border rounded-lg" type="submit"><i class="bi bi-search"></i> Search</button>
            </div>
        </form>
    </div>
    <div class="order-belum-dikerjakan w-full bg-white mt-8 px-7 py-4 rounded-lg shadow-item">
            <h1 class="text-2xl font-bold pb-3">Order Telah Dibayar</h1>
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
                     $query_dibayar = "SELECT * FROM `order` WHERE status = 'sudah dibayar' ORDER BY kode_pemesanan DESC";
                     if (isset($_GET['search']) && !empty($_GET['search'])) {
                        $b = $_GET['search'];
                        $query_dibayar = "SELECT * FROM `order` WHERE status = 'sudah dibayar' AND nama_pelanggan LIKE '%$b%' ORDER BY kode_pemesanan DESC";
                     }
                     $order = query($query_dibayar); 
                     if (!empty($order)) :?>
                     <?php 
                        $no_order = 1;
                        foreach($order as $or) : ?>
                        <tr class="font-normal h-12">
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
                                <a href="editorder.php?id=<?= $or['kode_pemesanan'] ?>" onclick="return confirm('Yakin akan menghapus?');" class="btn-sudah text-white border my-1 px-1 rounded-lg">Edit</a>
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
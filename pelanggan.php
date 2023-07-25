<?php 
    require_once 'function.php';
    require_once 'loginconfirm.php';
?>
<?php
    if (isset($_GET['pesan'])) {
        $pesan = $_GET['pesan'];
?>
    <script>alert('<?= $pesan ?>')</script>
<?php
    }
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
        <div class="header flex justify-between items-center h-14 mt-3">
            <a class="btn-back flex justify-center items-center px-6 h-2/3 rounded-xl border text-white" href="order.php">Kembali</a>
            <a class="btn-order flex justify-center items-center px-6 h-2/3 rounded-xl border text-white" href="tambahpelanggan.php">Tambah Data</a>
        </div>
        <div class="search-order w-full h-12 bg-white mt-4 rounded-2xl shadow-item">
            <form action="./pelanggan.php" method="get" class="flex h-full flex-row">
                <input class="grow pl-6 rounded-2xl" type="text" name="search" id="search" placeholder="Cari Pelanggan Berdasarkan Nama">
                <div class="btn-place flex-none w-32 py-1 px-3">
                    <button class="w-full h-full border rounded-lg" type="submit"><i class="bi bi-search"></i> Search</button>
                </div>
            </form>
        </div>
        <div class="order-belum-dikerjakan w-full bg-white mt-8 px-7 py-4 rounded-lg shadow-item">
            <h1 class="text-2xl font-bold pb-3">Pelanggan</h1>
            <hr>
            <div class="items-list table w-full mt-3 font-bold">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="h-14 tablehead">
                            <th class="text-white">No</th>
                            <th class="text-white">ID Pelanggan</th>
                            <th class="text-white">Nama Pelanggan</th>
                            <th class="text-white">No telp</th>
                            <th class="text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $query = "SELECT * FROM `pelanggan`";
                    if (isset($_GET['search']) && !empty($_GET['search'])) {
                        $nama = $_GET['search'];
                        $query = "SELECT * FROM `pelanggan` WHERE `pelanggan`.`nama` LIKE '%$nama%'";
                    }
                    $pelanggan = query($query);
                    if (!empty($pelanggan)) { 
                        $number = 1;
                        foreach ($pelanggan as $row) {
                    ?>
                        <tr class="font-normal">
                            <td class="text-center"><?= $number ?></td>
                            <td class="text-center"><?= $row['id_pelanggan'] ?></td>
                            <td class="text-center"><?= $row['nama'] ?></td>
                            <td class="text-center"><?= $row['telp'] ?></td>
                            <td class="grid grid-row-2 justify-center items-center w-full">
                                <a href="editpelanggan.php?id=<?= $row['nama'] ?>" onclick="return confirm('Yakin ingin mengedit status?');" class="btn-sudah text-white border flex justify-center items-center my-1 px-1 rounded-lg">Edit</a>
                                <a href="hapuspelanggan.php?id=<?= $row['nama'] ?>" onclick="return confirm('Yakin akan menghapus?');" class="btn-hapus text-white border flex justify-center items-center my-1 px-1 rounded-lg">Hapus</a>
                            </td>
                        </tr>
                    <?php 
                        $number++;
                        }
                    } else {
                    ?>
                    <tr>
                        <td class="flex justify-center items-center w-full h-14 font-medium">Data Tidak Tersedia</td>
                    </tr>
                    <?php } ?>
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</body>
</html>
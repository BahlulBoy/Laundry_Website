<?php
    require 'function.php';
    require_once 'loginconfirm.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Kilat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./style.css/style.css">
</head>
<body>
    <?php require './head/navbar.php'; ?>
    <div class="content px-20 pb-10">
        <div class="order-belum-dikerjakan w-full bg-white mt-8 px-7 py-4 rounded-lg shadow-item">
            <h1 class="text-2xl font-bold pb-3">Karyawan</h1>
            <hr>
            <div class="items-list table w-full mt-3 font-bold">
                <table class="table-auto w-full">
                    <thead>
                        <tr class="h-14 tablehead">
                            <th class="text-white">No</th>
                            <th class="text-white">ID Karyawan</th>
                            <th class="text-white">Nama Karyawan</th>
                            <th class="text-white">No telp</th>
                            <th class="text-white">Jabatan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $query = "SELECT * FROM `karyawan`";
                        $karyawan = query($query);
                        $number = 1;
                        foreach ($karyawan as $row) {
                    ?>
                        <tr class="font-normal h-14">
                            <td class="text-center"><?= $number ?></td>
                            <td class="text-center"><?= $row['id'] ?></td>
                            <td class="text-center"><?= $row['nama'] ?></td>
                            <td class="text-center"><?= $row['telp'] ?></td>
                            <td class="text-center"><?= $row['jabatan'] ?></td>
                        </tr>
                    <?php $number++; } ?>
                    </tbody>
                    
                </table>
                <div class="box flex justify-center items-center w-full my-2">
                    <a href="./order.php" class="btn-back text-white flex justify-center items-center w-fit px-10 h-10 border rounded-xl">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
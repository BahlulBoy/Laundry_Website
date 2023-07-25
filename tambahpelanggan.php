<?php 
	require_once('function.php');
    if (isset($_POST['pelanggan'])) {
        $nama = $_POST['nama_pelanggan'];
        $q = "SELECT * FROM `pelanggan` WHERE nama = '$nama'";
        $pelanggan = query($q);
        if(!empty($pelanggan)) {
            echo "<script>alert('nama telah digunakan')</script>";
        } else {
            if (tambahPelanggan($_POST) > 0) {
                header("Location: pelanggan.php?pesan=data pelanggan telah dibuat");
            } else {
                header("Location: pelanggan.php?pesan=terdapat kesalahan");
            }
        }
    }
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
            <h5 class="flex justify-center items-center py-3 text-xl font-semibold">Tambah Data Pelanggan</h5>
            <hr>
            <form action="" method="post" class="flex flex-col justify-center w-full my-3">
                <div class="px-4 py-2">
                    <label class="flex w-full my-1" for="nama_pelanggan">Nama Pelanggan</label>
                    <input required placeholder="Nama Pelanggan" class="border rounded-lg w-full h-9 my-1 px-4 py-6" type="text" name="nama_pelanggan" id="nama_pelanggan">
                </div>
                <div class="px-4 py-2">
                    <label class="flex w-full my-1" for="telp">Telp</label>
                    <input required placeholder="No Telepon" class="border rounded-lg w-full h-9 my-1 px-4 py-6" type="number" name="telp" id="telp">
                </div>
                <div class="flex justify-between px-4 py-4">
                    <a class="btn-back py-1 border flex justify-center items-center px-4 rounded-lg text-white" href="pelanggan.php">Kembali</a>
                    <button class="bg-orange-400 py-1 border flex justify-center items-center px-4 rounded-lg text-white" type="submit" name="pelanggan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
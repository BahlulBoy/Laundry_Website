<?php 
	require_once('function.php');
    if (isset($_POST['nama_pelanggan']) && $_POST['nama_pelanggan'] != ""){
        $nama = $_POST['nama_pelanggan'];
        $q = "SELECT * FROM `pelanggan` WHERE nama = '$nama'";
        $pelanggan = query($q);
        if(!empty($pelanggan)) {
            if (addOrder($_POST) > 0) {
                header("Location: order.php?pesan=order telah dibuat");
            }
        } else {
?>
        <script>
            const g = confirm("Nama pelanggan Tidak Ditemukan\nApakah ingin membuat data pelanggan baru")
            if(g){
                window.location.href = "tambahpelanggan.php";
            }
        </script>
<?php
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
            <h5 class="flex justify-center items-center py-3 text-xl font-semibold">Tambah Data Order</h5>
            <hr>
            <form action="" method="post" class="flex flex-col justify-center w-full my-3">
                <div class="px-4 py-2">
                    <label class="flex w-full my-1" for="nama_pelanggan">Nama Pelanggan</label>
                    <input required placeholder="Nama Pelanggan" class="border rounded-lg w-full h-9 my-1 px-4 py-6" type="text" name="nama_pelanggan" id="nama_pelanggan">
                </div>
                <div class="px-4 py-2">
                    <label class="flex w-full my-1" for="total_berat">Total Berat</label>
                    <input required placeholder="Total Berat" class="border rounded-lg w-full h-9 my-1 px-4 py-6" type="number" name="total_berat" id="total_berat">
                </div>
                <div class="px-4 py-2">
                    <label class="flex w-full my-1" for="jenis_paket">Jenis Paket</label>
                    <select required name="jenis_paket" id="jenis_paket" required class="px-4 w-full h-12 border rounded-lg" aria-label="Default select example">
                        <option value="" disabled selected>Open this select menu</option>
                        <?php 
                            $paket = selectTipe();
                            while ($data = mysqli_fetch_assoc($paket)) {
                        ?>
                            <option value="<?= $data['id_jenis'] ?>"><?= $data['paket'] ?>  <?= $data['harga'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="px-4 py-2">
                    <label class="flex w-full my-1" for="tanggal_ambil">Tanggal Ambil</label>
                    <input required class="border rounded-lg w-full h-9 my-1 px-4 py-6" type="date" name="tanggal_ambil" id="tanggal_ambil">
                </div>
                <div class="flex justify-between px-4 py-4">
                    <a class="btn-back py-1 border flex justify-center items-center px-4 rounded-lg text-white" href="order.php">Kembali</a>
                    <button class="bg-orange-400 py-1 border flex justify-center items-center px-4 rounded-lg text-white" type="submit" name="order">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
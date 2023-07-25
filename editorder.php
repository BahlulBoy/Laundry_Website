<?php 
	require_once('function.php');
    $id = $_GET['id'];
    $query = "SELECT * FROM `order` WHERE `order`.`kode_pemesanan` = '$id'";
    $result = mysqli_query($koneksi, $query);
    $data_res = mysqli_fetch_assoc($result);
    if (isset($_POST['order'])) {
        $nama = $_POST['nama_pelanggan'];
        $q = "SELECT * FROM `pelanggan` WHERE nama = '$nama'";
        $pelanggan = query($q);
        if (!empty($pelanggan)) {
            if (editOrderRiwayat($id, $_POST) > 0) {
                header("Location:riwayattransaksi.php?pesan=data telah diedit");
            } else {
                header("Location:riwayattransaksi.php?pesan=terdapat kesalahan");
            }
        } else {
            echo "<script>alert('Nama Pelanggan Tidak Terdaftar')</script>";
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
            <form action="./editorder.php?id=<?= $id ?>" method="post" class="flex flex-col justify-center w-full my-3">
                <div class="px-4 py-2">
                    <label class="flex w-full my-1" for="nama_pelanggan">Nama Pelanggan</label>
                    <input value="<?= $data_res['nama_pelanggan'] ?>" required placeholder="Nama Pelanggan" class="border rounded-lg w-full h-9 my-1 px-4 py-6" type="text" name="nama_pelanggan" id="nama_pelanggan">
                </div>
                <div class="px-4 py-2">
                    <label class="flex w-full my-1" for="total_berat">Total Berat (kg)</label>
                    <input value="<?= intval($data_res['total_berat']) ?>" required placeholder="Total Berat" class="border rounded-lg w-full h-9 my-1 px-4 py-6" type="number" name="total_berat" id="total_berat">
                </div>
                <div class="px-4 py-2">
                    <label class="flex w-full my-1" for="jenis_paket">Jenis Paket</label>
                    <select required name="jenis_paket" id="jenis_paket" required class="px-4 w-full h-12 border rounded-lg" aria-label="Default select example">
                        <?php 
                            $paket = selectTipe();
                            while ($data = mysqli_fetch_assoc($paket)) {
                        ?>
                            <option <?php if ($data['id_jenis'] == $data_res['id_jenis']) {echo "selected";} ?> value="<?= $data['id_jenis'] ?>"><?= $data['paket'] ?>  <?= $data['harga'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="flex justify-between px-4 py-4">
                    <a class="btn-back py-1 border flex justify-center items-center px-4 rounded-lg text-white" href="riwayattransaksi.php">Kembali</a>
                    <button class="bg-orange-400 py-1 border flex justify-center items-center px-4 rounded-lg text-white" type="submit" name="order">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
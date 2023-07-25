<?php 
    session_start();

    //koneksi Ke database
    $host	= 'localhost';
    $user   = 'root';
    $pass	= '';
    $db	    = 'laundry';

    $koneksi = mysqli_connect($host,$user,$pass,$db);

    //untuk enkripsi password
    function hash_password($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }
    
    //fungsi untuk menampilkan semua query dari database
    function query($query){
        global $koneksi;
        $result = mysqli_query($koneksi, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    //CRUD (Management Order)
// Membuat Sebuah Order Baru
function addOrder($pelanggan){
    global $koneksi;
    $possibleChars = 'abcdefghijklmnopqrstuvwxyz';
    $shuffledChars = str_shuffle($possibleChars);
    $id_pesanan = substr($shuffledChars, 0, 10);
    $totalBerat = htmlspecialchars($pelanggan['total_berat']);
    $tanggalAmbil = htmlspecialchars($pelanggan['tanggal_ambil']);
    $q = "SELECT * FROM `admin`";
    $result = mysqli_query($koneksi, $q);
    $r = mysqli_fetch_assoc($result);
    $id_admin = $r['id_admin'];
    $id_jenis = htmlspecialchars($pelanggan['jenis_paket']);
    $nama = htmlspecialchars($pelanggan['nama_pelanggan']);
    $status = "belum";
    $paket_query = "SELECT * FROM `jenis_paket` WHERE id_jenis = '$id_jenis';";
    $t = mysqli_query($koneksi, $paket_query);
    $i = mysqli_fetch_assoc($t);
    $harga_jenis = intval($i['harga']);
    $berat = intval($totalBerat);
    $harga = $harga_jenis * $berat;
    $insert = "INSERT INTO `order` (`kode_pemesanan`, `total_berat`, `tanggal_pesan`, `tanggal_ambil`, `id_admin`, `id_jenis`, `nama_pelanggan`, `status`, `harga`) VALUES ('$id_pesanan', '$totalBerat', CURRENT_DATE(), '$tanggalAmbil', '$id_admin', '$id_jenis', '$nama', '$status', '$harga');";
    mysqli_query($koneksi, $insert);
    return mysqli_affected_rows($koneksi);
}

// Tambah Pelanggan
function tambahPelanggan($pelanggan) {
    global $koneksi;
    $possibleChars = 'abcdefghijklmnopqrstuvwxyz';
    $shuffledChars = str_shuffle($possibleChars);
    $id_pelanggan = substr($shuffledChars, 0, 10);
    $nama_pelanggan = htmlspecialchars($pelanggan['nama_pelanggan']);
    $telp = htmlspecialchars($pelanggan['telp']);
    $q = "INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `telp`) VALUES ('$id_pelanggan', '$nama_pelanggan', '$telp');";
    mysqli_query($koneksi, $q);
    return mysqli_affected_rows($koneksi);
}

//Edit Pelanggan
function editPelanggan($id, $pelanggan) {
    global $koneksi;
    $nama = htmlspecialchars($pelanggan['nama_pelanggan']);
    $telp = htmlspecialchars($pelanggan['telp']);
    $order = "UPDATE `order` SET `nama_pelanggan` = '$nama' WHERE `order`.`nama_pelanggan` = '$id';";
    mysqli_query($koneksi, $order);
    $pelanggan_query = "UPDATE `pelanggan` SET `nama` = '$nama', `telp` = '$telp' WHERE `pelanggan`.`nama` = '$id';";
    mysqli_query($koneksi, $pelanggan_query);
    return mysqli_affected_rows($koneksi);
}

//Hapus Pelanggan
function hapusPelanggan($id) {
    global $koneksi;
    $query = "DELETE FROM `pelanggan` WHERE `pelanggan`.`nama` = '$id'";
    mysqli_query($koneksi, $query);
    $query_2 = "DELETE FROM `order` WHERE `order`.`nama_pelanggan` = '$id'";
    mysqli_query($koneksi, $query_2);
    return mysqli_affected_rows($koneksi);
}

//Menampilkan list Tipe Paket
function selectTipe() {
    global $koneksi;
    $query = "SELECT * FROM `jenis_paket`";
    $result = mysqli_query($koneksi, $query);
    return $result;
}

//Menampilkan Tipe Paket Berdasarkan Nama
function selectTipeName($id_tipe) {
    global $koneksi;
    $query = "SELECT * FROM `jenis_paket` WHERE id_jenis = '$id_tipe';";
    $result = mysqli_query($koneksi, $query);
    $f = mysqli_fetch_assoc($result);
    return $f['paket'];
}

//Mengedit Order
function editOrder($id, $status) {
    global $koneksi;
    $query = "";
    if ($status == "hapus") {
        $query_riwayat_hapus = "DELETE FROM `riwayat` WHERE `riwayat`.`kode_pemesanan` = '$id';";
        mysqli_query($koneksi, $query_riwayat_hapus);
        $query = "DELETE FROM `order` WHERE `order`.`kode_pemesanan` = '$id'";
        $pesan = "order telah dihapus";
    } else {
        if ($status == "sudah dibayar") {
            $query_riwayat = "INSERT INTO `riwayat` (`status`, `kode_pemesanan`) VALUES ('$status', '$id');";
            mysqli_query($koneksi, $query_riwayat);
        }
        $query = "UPDATE `order` SET `status` = '$status' WHERE `order`.`kode_pemesanan` = '$id'";
        $pesan = "order telah sukses diedit";
    }
    mysqli_query($koneksi, $query);
    header("Location: order.php?pesan=$pesan");
}

//Mengedit Riwayat Order
function editOrderRiwayat($id, $post) {
    global $koneksi;
    $nama_pelanggan = htmlspecialchars($post['nama_pelanggan']);
    $total_berat = intval(htmlspecialchars($post['total_berat']));
    $id_jenis = htmlspecialchars($post['jenis_paket']);

    $paket_query = "SELECT * FROM `jenis_paket` WHERE id_jenis = '$id_jenis';";
    $t = mysqli_query($koneksi, $paket_query);
    $i = mysqli_fetch_assoc($t);
    $harga_jenis = intval($i['harga']);

    $harga = $total_berat * $harga_jenis;
    $query = "UPDATE `order` SET `id_jenis` = '$id_jenis', `nama_pelanggan` = '$nama_pelanggan', `harga` = '$harga', `total_berat` = '$total_berat' WHERE `order`.`kode_pemesanan` = '$id'";
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}
?>
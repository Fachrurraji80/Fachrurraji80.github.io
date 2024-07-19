<?php 
include '../koneksi/koneksi.php';

$hal = isset($_GET['hal']) ? $_GET['hal'] : null;
$kode_customer = isset($_GET['kd_cs']) ? $_GET['kd_cs'] : null;
$kode_produk = isset($_GET['produk']) ? $_GET['produk'] : null;
$qty = isset($_GET['jml']) ? $_GET['jml'] : 1; // Default value if 'jml' is not set

$result = mysqli_query($conn, "SELECT * FROM produk WHERE kode_produk = '$kode_produk'");
$row = mysqli_fetch_assoc($result);

$nama_produk = $row['nama'];
$harga = $row['harga'];

if ($hal == 1) {
    $cek = mysqli_query($conn, "SELECT * from keranjang where kode_produk = '$kode_produk' and kode_customer = '$kode_customer'");
    $jml = mysqli_num_rows($cek);
    $row1 = mysqli_fetch_assoc($cek);
    if ($jml > 0) {
        $set = $row1['qty'] + 1;
        $update = mysqli_query($conn, "UPDATE keranjang SET qty = '$set' WHERE kode_produk = '$kode_produk' and kode_customer = '$kode_customer'");
        if ($update) {
            echo "
            <script>
            alert('BERHASIL DITAMBAHKAN KE KERANJANG');
            window.location = '../keranjang.php';
            </script>
            ";
            die;
        }
    } else {
        $insert = mysqli_query($conn, "INSERT INTO keranjang (kode_customer, kode_produk, nama_produk, qty, harga) VALUES('$kode_customer', '$kode_produk', '$nama_produk', '$qty', '$harga')");
        if ($insert) {
            echo "
            <script>
            alert('BERHASIL DITAMBAHKAN KE KERANJANG');
            window.location = '../keranjang.php';
            </script>
            ";
            die;
        }
    }
} else {
    $cek = mysqli_query($conn, "SELECT * from keranjang where kode_produk = '$kode_produk' and kode_customer = '$kode_customer'");
    $jml = mysqli_num_rows($cek);
    $row1 = mysqli_fetch_assoc($cek);
    if ($jml > 0) {
        $set = $row1['qty'] + $qty;
        $update = mysqli_query($conn, "UPDATE keranjang SET qty = '$set' WHERE kode_produk = '$kode_produk' and kode_customer = '$kode_customer'");
        if ($update) {
            echo "
            <script>
            alert('BERHASIL DITAMBAHKAN KE KERANJANG');
            window.location = '../detail_produk.php?produk=".$kode_produk."';
            </script>
            ";
            die;
        }
    } else {
        $insert = mysqli_query($conn, "INSERT INTO keranjang (kode_customer, kode_produk, nama_produk, qty, harga) VALUES('$kode_customer', '$kode_produk', '$nama_produk', '$qty', '$harga')");
        if ($insert) {
            echo "
            <script>
            alert('BERHASIL DITAMBAHKAN KE KERANJANG');
            window.location = '../detail_produk.php?produk=".$kode_produk."';
            </script>
            ";
            die;
        }
    }
}
?>

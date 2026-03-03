<?php

include 'config/database.php';

$kode_buku = $_POST['kode_buku'];
$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun = $_POST['tahun'];
$stok = $_POST['stok'];

$query = mysqli_query($koneksi, "INSERT INTO buku VALUES(NULL, '$kode_buku', '$judul', '$penulis', '$penerbit', '$tahun', '$stok')");

if ($query) {
    header("location:buku.php?pesan=tambah_sukses");
}
else {
    echo "Gagal menambahkan data: " . mysqli_error($koneksi);
}
?>

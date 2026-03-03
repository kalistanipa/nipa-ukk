<?php

include 'config/database.php';

$id = $_POST['id'];
$kode_buku = $_POST['kode_buku'];
$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun = $_POST['tahun'];
$stok = $_POST['stok'];

$query = mysqli_query($koneksi, "UPDATE buku SET kode_buku='$kode_buku', judul_buku='$judul', penulis='$penulis', penerbit='$penerbit', tahun_terbit='$tahun', stok='$stok' WHERE id_buku='$id'");

if ($query) {
    header("location:buku.php?pesan=edit_sukses");
}
else {
    echo "Gagal mengupdate data: " . mysqli_error($koneksi);
}
?>

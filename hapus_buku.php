<?php

include 'config/database.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku='$id'");

if ($query) {
    header("location:buku.php?pesan=hapus_sukses");
}
else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>

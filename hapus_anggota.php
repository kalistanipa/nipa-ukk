<?php

include 'config/database.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "DELETE FROM anggota WHERE id_anggota='$id'");

if ($query) {
    header("location:anggota.php?pesan=hapus_sukses");
}
else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>

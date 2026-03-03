<?php

include 'config/database.php';

$id = $_GET['id'];

$query = mysqli_query($koneksi, "DELETE FROM users WHERE id_user='$id'");

if ($query) {
    header("location:user.php?pesan=hapus_sukses");
}
else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>

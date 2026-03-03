<?php

include 'config/database.php';

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$level = $_POST['level'];

$query = mysqli_query($koneksi, "INSERT INTO users VALUES(NULL, '$username', '$password', '$nama', '$level')");

if ($query) {
    header("location:user.php?pesan=tambah_sukses");
}
else {
    echo "Gagal menambahkan data: " . mysqli_error($koneksi);
}
?>

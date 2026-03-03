<?php

include 'config/database.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];

if ($password == "") {
    $query = mysqli_query($koneksi, "UPDATE users SET nama_lengkap='$nama', username='$username', level='$level' WHERE id_user='$id'");
}
else {
    $password_md5 = md5($password);
    $query = mysqli_query($koneksi, "UPDATE users SET nama_lengkap='$nama', username='$username', password='$password_md5', level='$level' WHERE id_user='$id'");
}

if ($query) {
    header("location:user.php?pesan=edit_sukses");
}
else {
    echo "Gagal mengupdate data: " . mysqli_error($koneksi);
}
?>

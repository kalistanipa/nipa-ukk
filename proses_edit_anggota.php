<?php

include 'config/database.php';

$id = $_POST['id'];
$nis = $_POST['nis'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
$alamat = $_POST['alamat'];
$password = $_POST['password'];

if ($password == "") {
    $query = mysqli_query($koneksi, "UPDATE anggota SET nis='$nis', nama_lengkap='$nama', kelas='$kelas', jurusan='$jurusan', alamat='$alamat' WHERE id_anggota='$id'");
}
else {
    $password_md5 = md5($password);
    $query = mysqli_query($koneksi, "UPDATE anggota SET nis='$nis', nama_lengkap='$nama', kelas='$kelas', jurusan='$jurusan', alamat='$alamat', password='$password_md5' WHERE id_anggota='$id'");
}

if ($query) {
    header("location:anggota.php?pesan=edit_sukses");
}
else {
    echo "Gagal mengupdate data: " . mysqli_error($koneksi);
}
?>

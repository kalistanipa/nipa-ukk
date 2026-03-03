<?php

include 'config/database.php';

$nis = $_POST['nis'];
$nama = $_POST['nama'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];
$alamat = $_POST['alamat'];
$password = md5($_POST['password']); // Simple MD5 as seen in existing database structure

$query = mysqli_query($koneksi, "INSERT INTO anggota VALUES(NULL, '$nis', '$nama', '$kelas', '$jurusan', '$alamat', '$password')");

if ($query) {
    header("location:anggota.php?pesan=tambah_sukses");
}
else {
    echo "Gagal menambahkan data: " . mysqli_error($koneksi);
}
?>

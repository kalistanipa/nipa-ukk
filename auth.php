<?php
session_start();
include 'config/database.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

// Cek di tabel users (Admin/Petugas)
$query_admin = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
$cek_admin = mysqli_num_rows($query_admin);

if ($cek_admin > 0) {
    $data = mysqli_fetch_assoc($query_admin);
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['nama'] = $data['nama_lengkap'];
    $_SESSION['level'] = $data['level'];
    $_SESSION['status'] = "login";

    // Redirect ke dashboard admin
    header("location:index.php");
}
else {
    // Cek di tabel anggota (Siswa)
    $query_siswa = mysqli_query($koneksi, "SELECT * FROM anggota WHERE nis='$username' AND password='$password'");
    $cek_siswa = mysqli_num_rows($query_siswa);

    if ($cek_siswa > 0) {
        $data = mysqli_fetch_assoc($query_siswa);
        $_SESSION['id_anggota'] = $data['id_anggota'];
        $_SESSION['nis'] = $data['nis'];
        $_SESSION['nama'] = $data['nama_lengkap'];
        $_SESSION['level'] = 'anggota';
        $_SESSION['status'] = "login";

        // Redirect ke dashboard anggota
        header("location:index.php");
    }
    else {
        header("location:login.php?pesan=gagal");
    }
}
?>

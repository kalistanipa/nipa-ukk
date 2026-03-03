<?php

include 'config/database.php';
session_start();

$id_anggota = $_POST['id_anggota'];
$id_buku = $_POST['id_buku'];
$tgl_pinjam = $_POST['tgl_pinjam'];
$tgl_kembali = $_POST['tgl_kembali'];
$id_user = $_SESSION['id_user']; // Petugas yang melayani
$status = 'dipinjam';

// Begin Transaction
mysqli_begin_transaction($koneksi);

try {
    // 1. Insert into peminjaman table
    $query_peminjaman = mysqli_query($koneksi, "INSERT INTO peminjaman VALUES(NULL, '$id_anggota', '$id_user', '$tgl_pinjam', '$tgl_kembali', '$status')");

    if (!$query_peminjaman) {
        throw new Exception("Gagal insert peminjaman");
    }

    $id_peminjaman = mysqli_insert_id($koneksi);

    // 2. Insert into detail_peminjaman
    $query_detail = mysqli_query($koneksi, "INSERT INTO detail_peminjaman VALUES(NULL, '$id_peminjaman', '$id_buku')");

    if (!$query_detail) {
        throw new Exception("Gagal insert detail peminjaman");
    }

    // 3. Update book stock
    $query_stok = mysqli_query($koneksi, "UPDATE buku SET stok = stok - 1 WHERE id_buku='$id_buku'");

    if (!$query_stok) {
        throw new Exception("Gagal update stok buku");
    }

    // Commit Transaction
    mysqli_commit($koneksi);

    header("location:peminjaman.php?pesan=tambah_sukses");

}
catch (Exception $e) {
    // Rollback Transaction if error
    mysqli_rollback($koneksi);
    echo "Transaksi Gagal: " . $e->getMessage();
}
?>

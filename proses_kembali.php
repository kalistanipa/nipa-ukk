<?php

include 'config/database.php';

$id_peminjaman = $_GET['id'];
$tgl_kembali_real = date('Y-m-d');

// Begin Transaction
mysqli_begin_transaction($koneksi);

try {
    // 1. Update status peminjaman
    $query_update = mysqli_query($koneksi, "UPDATE peminjaman SET status_peminjaman='dikembalikan' WHERE id_peminjaman='$id_peminjaman'");

    if (!$query_update) {
        throw new Exception("Gagal update status peminjaman");
    }

    // 2. Get list of books in this transaction
    $query_buku = mysqli_query($koneksi, "SELECT id_buku FROM detail_peminjaman WHERE id_peminjaman='$id_peminjaman'");

    while ($b = mysqli_fetch_array($query_buku)) {
        $id_buku = $b['id_buku'];
        // 3. Update book stock (increase)
        $query_stok = mysqli_query($koneksi, "UPDATE buku SET stok = stok + 1 WHERE id_buku='$id_buku'");
        if (!$query_stok) {
            throw new Exception("Gagal update stok buku");
        }
    }

    // Commit Transaction
    mysqli_commit($koneksi);

    header("location:pengembalian.php?pesan=kembali_sukses");

}
catch (Exception $e) {
    // Rollback Transaction if error
    mysqli_rollback($koneksi);
    echo "Pengembalian Gagal: " . $e->getMessage();
}
?>

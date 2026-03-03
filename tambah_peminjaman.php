<?php

include 'header.php';
include 'config/database.php';
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2 class="mb-4" style="display: flex; align-items: center; gap: 0.75rem;">
        <img src="assets/images/logo-lib.svg" alt="Logo" style="width: 45px; height: 45px; filter: drop-shadow(0 4px 3px rgb(0 0 0 / 0.07));">
        Tambah Peminjaman
    </h2>
    
    <form action="proses_tambah_peminjaman.php" method="POST">
        <div class="form-group">
            <label class="form-label">Anggota Pemimjam</label>
            <select name="id_anggota" class="form-control" required>
                <option value="">-- Pilih Anggota --</option>
                <?php
$data_anggota = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY nama_lengkap ASC");
while ($a = mysqli_fetch_array($data_anggota)) {
    echo "<option value='" . $a['id_anggota'] . "'>" . $a['nis'] . " - " . $a['nama_lengkap'] . "</option>";
}
?>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Buku yang Dipinjam</label>
            <select name="id_buku" class="form-control" required>
                <option value="">-- Pilih Buku --</option>
                <?php
$data_buku = mysqli_query($koneksi, "SELECT * FROM buku WHERE stok > 0 ORDER BY judul_buku ASC");
while ($b = mysqli_fetch_array($data_buku)) {
    echo "<option value='" . $b['id_buku'] . "'>" . $b['kode_buku'] . " - " . $b['judul_buku'] . " (Stok: " . $b['stok'] . ")</option>";
}
?>
            </select>
            <small class="text-muted">Untuk saat ini hanya support 1 buku per transaksi.</small>
        </div>

        <div class="form-group">
            <label class="form-label">Tanggal Pinjam</label>
            <input type="date" name="tgl_pinjam" class="form-control" required value="<?php echo date('Y-m-d'); ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Tanggal Kembali (Rencana)</label>
            <input type="date" name="tgl_kembali" class="form-control" required value="<?php echo date('Y-m-d', strtotime('+7 days')); ?>">
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
            <a href="peminjaman.php" class="btn" style="background-color: var(--secondary-color); color: white; margin-left: 0.5rem;">Batal</a>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>

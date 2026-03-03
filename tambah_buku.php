<?php include 'header.php'; ?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2 class="mb-4">Tambah Buku Baru</h2>
    
    <form action="proses_tambah_buku.php" method="POST">
        <div class="form-group">
            <label class="form-label">Kode Buku</label>
            <input type="text" name="kode_buku" class="form-control" required placeholder="Contoh: BK001">
        </div>

        <div class="form-group">
            <label class="form-label">Judul Buku</label>
            <input type="text" name="judul" class="form-control" required placeholder="Masukkan Judul Buku">
        </div>

        <div class="form-group">
            <label class="form-label">Penulis</label>
            <input type="text" name="penulis" class="form-control" required placeholder="Masukkan Nama Penulis">
        </div>

        <div class="form-group">
            <label class="form-label">Penerbit</label>
            <input type="text" name="penerbit" class="form-control" required placeholder="Masukkan Nama Penerbit">
        </div>

        <div class="form-group">
            <label class="form-label">Tahun Terbit</label>
            <input type="number" name="tahun" class="form-control" required min="1900" max="<?php echo date('Y'); ?>" placeholder="Masukkan Tahun Terbit">
        </div>

        <div class="form-group">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" required min="0" placeholder="Jumlah Stok">
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <a href="buku.php" class="btn" style="background-color: var(--secondary-color); color: white; margin-left: 0.5rem;">Batal</a>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>

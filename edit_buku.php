<?php

include 'header.php';
include 'config/database.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$id'");
while ($d = mysqli_fetch_array($data)) {
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2 class="mb-4">Edit Data Buku</h2>
    
    <form action="proses_edit_buku.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $d['id_buku']; ?>">
        
        <div class="form-group">
            <label class="form-label">Kode Buku</label>
            <input type="text" name="kode_buku" class="form-control" required value="<?php echo $d['kode_buku']; ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Judul Buku</label>
            <input type="text" name="judul" class="form-control" required value="<?php echo $d['judul_buku']; ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Penulis</label>
            <input type="text" name="penulis" class="form-control" required value="<?php echo $d['penulis']; ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Penerbit</label>
            <input type="text" name="penerbit" class="form-control" required value="<?php echo $d['penerbit']; ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Tahun Terbit</label>
            <input type="number" name="tahun" class="form-control" required min="1900" max="<?php echo date('Y'); ?>" value="<?php echo $d['tahun_terbit']; ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Stok</label>
            <input type="number" name="stok" class="form-control" required min="0" value="<?php echo $d['stok']; ?>">
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Update Data</button>
            <a href="buku.php" class="btn" style="background-color: var(--secondary-color); color: white; margin-left: 0.5rem;">Batal</a>
        </div>
    </form>
</div>

<?php

}
include 'footer.php';
?>

<?php
include 'header.php';
include 'config/database.php';
?>

<div class="card" style="max-width: 500px; margin: 0 auto; border: 2px solid var(--primary-color);">
    <div style="text-align: center; margin-bottom: 2rem; border-bottom: 1px solid #eee; padding-bottom: 1rem;">
        <h2 style="color: var(--primary-color);">KARTU ANGGOTA</h2>
        <p>PERPUSTAKAAN DIGITAL</p>
    </div>

    <?php
if (isset($_SESSION['id_anggota'])) {
    $id_anggota = $_SESSION['id_anggota'];
    $data = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id_anggota='$id_anggota'");
    $d = mysqli_fetch_array($data);
?>
    
    <div style="display: flex; flex-direction: column; gap: 1rem;">
        <div style="display: flex; border-bottom: 1px dashed #ccc; padding-bottom: 0.5rem;">
            <strong style="width: 120px;">NIS</strong>
            <span>: <?php echo $d['nis']; ?></span>
        </div>
        <div style="display: flex; border-bottom: 1px dashed #ccc; padding-bottom: 0.5rem;">
            <strong style="width: 120px;">Nama</strong>
            <span>: <?php echo $d['nama_lengkap']; ?></span>
        </div>
        <div style="display: flex; border-bottom: 1px dashed #ccc; padding-bottom: 0.5rem;">
            <strong style="width: 120px;">Kelas</strong>
            <span>: <?php echo $d['kelas']; ?></span>
        </div>
        <div style="display: flex; border-bottom: 1px dashed #ccc; padding-bottom: 0.5rem;">
            <strong style="width: 120px;">Jurusan</strong>
            <span>: <?php echo $d['jurusan']; ?></span>
        </div>
        <div style="display: flex; padding-bottom: 0.5rem;">
            <strong style="width: 120px;">Alamat</strong>
            <span>: <?php echo $d['alamat']; ?></span>
        </div>
    </div>

    <div class="mt-4 text-center">
        <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print"></i> Cetak Kartu</button>
    </div>

    <?php
}
else {
    echo '<p class="text-center">Anda login sebagai Admin/Petugas, menu ini khusus Anggota.</p>';
}
?>
</div>
<?php include 'footer.php'; ?>

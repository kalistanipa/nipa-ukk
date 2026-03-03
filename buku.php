<?php
include 'header.php';
include 'config/database.php';
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2 style="margin-bottom: 0;">Data Buku</h2>
        <?php if ($_SESSION['level'] != 'anggota'): ?>
        <a href="tambah_buku.php" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Buku</a>
        <?php
endif; ?>
    </div>

    <?php
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "tambah_sukses") {
        echo '<div class="alert" style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;">Data buku berhasil ditambahkan.</div>';
    }
    elseif ($_GET['pesan'] == "hapus_sukses") {
        echo '<div class="alert" style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;">Data buku berhasil dihapus.</div>';
    }
    elseif ($_GET['pesan'] == "edit_sukses") {
        echo '<div class="alert" style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;">Data buku berhasil diupdate.</div>';
    }
}
?>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
            <thead>
                <tr style="background-color: #f8fafc; text-align: left;">
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">No</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Kode Buku</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Judul Buku</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Penulis</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Penerbit</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Tahun</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Stok</th>
                    <?php if ($_SESSION['level'] != 'anggota'): ?>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Aksi</th>
                    <?php
endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
$no = 1;
$data = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY judul_buku ASC");
while ($d = mysqli_fetch_array($data)) {
?>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 1rem;"><?php echo $no++; ?></td>
                        <td style="padding: 1rem;"><?php echo $d['kode_buku']; ?></td>
                        <td style="padding: 1rem;"><?php echo $d['judul_buku']; ?></td>
                        <td style="padding: 1rem;"><?php echo $d['penulis']; ?></td>
                        <td style="padding: 1rem;"><?php echo $d['penerbit']; ?></td>
                        <td style="padding: 1rem;"><?php echo $d['tahun_terbit']; ?></td>
                        <td style="padding: 1rem;"><?php echo $d['stok']; ?></td>
                        <?php if ($_SESSION['level'] != 'anggota'): ?>
                        <td style="padding: 1rem; white-space: nowrap;">
                            <a href="edit_buku.php?id=<?php echo $d['id_buku']; ?>" class="btn" style="background-color: #eab308; color: white; padding: 0.5rem 0.75rem; font-size: 0.8rem;"><i class="fas fa-edit"></i></a>
                            <a href="hapus_buku.php?id=<?php echo $d['id_buku']; ?>" class="btn" style="background-color: #ef4444; color: white; padding: 0.5rem 0.75rem; font-size: 0.8rem;" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                        </td>
                        <?php
    endif; ?>
                    </tr>
                <?php
}
?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'footer.php'; ?>

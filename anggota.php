<?php
include 'header.php';
include 'config/database.php';
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2 style="margin-bottom: 0;">Data Anggota</h2>
        <a href="tambah_anggota.php" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Anggota</a>
    </div>

    <?php
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "tambah_sukses") {
        echo '<div class="alert" style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;">Data anggota berhasil ditambahkan.</div>';
    }
    elseif ($_GET['pesan'] == "hapus_sukses") {
        echo '<div class="alert" style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;">Data anggota berhasil dihapus.</div>';
    }
    elseif ($_GET['pesan'] == "edit_sukses") {
        echo '<div class="alert" style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;">Data anggota berhasil diupdate.</div>';
    }
}
?>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
            <thead>
                <tr style="background-color: #f8fafc; text-align: left;">
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">No</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">NIS</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Nama Lengkap</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Kelas</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Jurusan</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Alamat</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
$no = 1;
$data = mysqli_query($koneksi, "SELECT * FROM anggota ORDER BY nama_lengkap ASC");
while ($d = mysqli_fetch_array($data)) {
?>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 1rem;"><?php echo $no++; ?></td>
                        <td style="padding: 1rem;"><?php echo $d['nis']; ?></td>
                        <td style="padding: 1rem;"><?php echo $d['nama_lengkap']; ?></td>
                        <td style="padding: 1rem;"><?php echo $d['kelas']; ?></td>
                        <td style="padding: 1rem;"><?php echo $d['jurusan']; ?></td>
                        <td style="padding: 1rem;"><?php echo $d['alamat']; ?></td>
                        <td style="padding: 1rem;">
                            <a href="edit_anggota.php?id=<?php echo $d['id_anggota']; ?>" class="btn" style="background-color: #eab308; color: white; padding: 0.5rem 0.75rem; font-size: 0.8rem;"><i class="fas fa-edit"></i></a>
                            <a href="hapus_anggota.php?id=<?php echo $d['id_anggota']; ?>" class="btn" style="background-color: #ef4444; color: white; padding: 0.5rem 0.75rem; font-size: 0.8rem;" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php
}
?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'footer.php'; ?>

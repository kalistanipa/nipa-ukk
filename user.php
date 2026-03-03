<?php
include 'header.php';
include 'config/database.php';
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2 style="margin-bottom: 0;">Manajemen User</h2>
        <a href="tambah_user.php" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah User</a>
    </div>

    <?php
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "tambah_sukses") {
        echo '<div class="alert" style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;">Data user berhasil ditambahkan.</div>';
    }
    elseif ($_GET['pesan'] == "hapus_sukses") {
        echo '<div class="alert" style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;">Data user berhasil dihapus.</div>';
    }
    elseif ($_GET['pesan'] == "edit_sukses") {
        echo '<div class="alert" style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;">Data user berhasil diupdate.</div>';
    }
}
?>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
            <thead>
                <tr style="background-color: #f8fafc; text-align: left;">
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">No</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Nama Lengkap</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Username</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Level</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
$no = 1;
$data = mysqli_query($koneksi, "SELECT * FROM users ORDER BY nama_lengkap ASC");
while ($d = mysqli_fetch_array($data)) {
?>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 1rem;"><?php echo $no++; ?></td>
                        <td style="padding: 1rem;"><?php echo $d['nama_lengkap']; ?></td>
                        <td style="padding: 1rem;"><?php echo $d['username']; ?></td>
                        <td style="padding: 1rem;"><?php echo ucfirst($d['level']); ?></td>
                        <td style="padding: 1rem;">
                            <a href="edit_user.php?id=<?php echo $d['id_user']; ?>" class="btn" style="background-color: #eab308; color: white; padding: 0.5rem 0.75rem; font-size: 0.8rem;"><i class="fas fa-edit"></i></a>
                            <?php if ($d['id_user'] != $_SESSION['id_user']): // Prevent deleting self ?>
                            <a href="hapus_user.php?id=<?php echo $d['id_user']; ?>" class="btn" style="background-color: #ef4444; color: white; padding: 0.5rem 0.75rem; font-size: 0.8rem;" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                            <?php
    endif; ?>
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

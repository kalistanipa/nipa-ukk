<?php
include 'header.php';
include 'config/database.php';
?>

<div class="card">
    <h2 class="mb-4" style="display: flex; align-items: center; gap: 0.75rem;">
        <img src="assets/images/logo-lib.svg" alt="Logo" style="width: 45px; height: 45px; filter: drop-shadow(0 4px 3px rgb(0 0 0 / 0.07));">
        Riwayat Peminjaman Saya
    </h2>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
            <thead>
                <tr style="background-color: #f8fafc; text-align: left;">
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">No</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Gambar</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Tanggal Pinjam</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Tanggal Kembali</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Status</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Buku</th>
                </tr>
            </thead>
            <tbody>
                <?php
if (isset($_SESSION['id_anggota'])) {
    $id_anggota = $_SESSION['id_anggota'];
    $no = 1;
    $data = mysqli_query($koneksi, "SELECT peminjaman.*, buku.judul_buku 
                            FROM peminjaman 
                            JOIN detail_peminjaman ON peminjaman.id_peminjaman = detail_peminjaman.id_peminjaman
                            JOIN buku ON detail_peminjaman.id_buku = buku.id_buku
                            WHERE peminjaman.id_anggota = '$id_anggota'
                            ORDER BY id_peminjaman DESC");

    if (mysqli_num_rows($data) > 0) {
        while ($d = mysqli_fetch_array($data)) {
?>
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding: 1rem;"><?php echo $no++; ?></td>
                                <td style="padding: 1rem;">
                                    <div style="width: 40px; height: 55px; background: #f3f4f6; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #9ca3af; border: 1px solid #e5e7eb;">
                                        <i class="fas fa-book" style="font-size: 1.2rem;"></i>
                                    </div>
                                </td>
                                <td style="padding: 1rem;"><?php echo date('d-m-Y', strtotime($d['tanggal_pinjam'])); ?></td>
                                <td style="padding: 1rem;"><?php echo date('d-m-Y', strtotime($d['tanggal_kembali'])); ?></td>
                                <td style="padding: 1rem;">
                                    <?php
            if ($d['status_peminjaman'] == 'dipinjam') {
                echo '<span style="background-color: #fef3c7; color: #d97706; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 500;">Dipinjam</span>';
            }
            else {
                echo '<span style="background-color: #d1fae5; color: #065f46; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 500;">Dikembalikan</span>';
            }
?>
                                </td>
                                <td style="padding: 1rem;"><?php echo $d['judul_buku']; ?></td>
                            </tr>
                        <?php
        }
    }
    else {
        echo '<tr><td colspan="5" class="text-center" style="padding: 1rem;">Belum ada riwayat peminjaman.</td></tr>';
    }
}
else {
    echo '<tr><td colspan="5" class="text-center" style="padding: 1rem;">Anda login sebagai Admin/Petugas, menu ini khusus Anggota.</td></tr>';
}
?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'footer.php'; ?>

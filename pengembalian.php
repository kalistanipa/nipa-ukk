<?php
include 'header.php';
include 'config/database.php';
?>

<div class="card">
    <h2 class="mb-4" style="display: flex; align-items: center; gap: 0.75rem;">
        <img src="assets/images/logo-lib.svg" alt="Logo" style="width: 45px; height: 45px; filter: drop-shadow(0 4px 3px rgb(0 0 0 / 0.07));">
        Data Pengembalian
    </h2>

    <?php
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "kembali_sukses") {
        echo '<div class="alert" style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;">Buku berhasil dikembalikan.</div>';
    }
}
?>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
            <thead>
                <tr style="background-color: #f8fafc; text-align: left;">
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">No</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Gambar</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Nama Peminjam</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Tanggal Pinjam</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Jatuh Tempo</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Denda</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
$no = 1;
$data = mysqli_query($koneksi, "SELECT peminjaman.*, anggota.nama_lengkap FROM peminjaman, anggota WHERE peminjaman.id_anggota=anggota.id_anggota AND status_peminjaman='dipinjam' ORDER BY id_peminjaman DESC");
while ($d = mysqli_fetch_array($data)) {
    // Hitung denda
    $tgl_kembali = $d['tanggal_kembali'];
    $tgl_sekarang = date('Y-m-d');
    $lambat = strtotime($tgl_sekarang) - strtotime($tgl_kembali);
    $denda = 0;
    if ($lambat > 0) {
        $hari = $lambat / (60 * 60 * 24);
        $denda = $hari * 1000; // Denda Rp 1.000 per hari
    }
?>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 1rem;"><?php echo $no++; ?></td>
                        <td style="padding: 1rem;">
                            <div style="width: 40px; height: 55px; background: #f3f4f6; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #9ca3af; border: 1px solid #e5e7eb;">
                                <i class="fas fa-book" style="font-size: 1.2rem;"></i>
                            </div>
                        </td>
                        <td style="padding: 1rem;"><?php echo $d['nama_lengkap']; ?></td>
                        <td style="padding: 1rem;"><?php echo date('d-m-Y', strtotime($d['tanggal_pinjam'])); ?></td>
                        <td style="padding: 1rem;"><?php echo date('d-m-Y', strtotime($d['tanggal_kembali'])); ?></td>
                        <td style="padding: 1rem;">
                            <?php if ($denda > 0): ?>
                                <span style="color: red; font-weight: bold;">Rp <?php echo number_format($denda); ?></span>
                                <small>(Telat <?php echo $hari; ?> hari)</small>
                            <?php
    else: ?>
                                <span style="color: green;">-</span>
                            <?php
    endif; ?>
                        </td>
                        <td style="padding: 1rem;">
                            <a href="proses_kembali.php?id=<?php echo $d['id_peminjaman']; ?>" class="btn" style="background-color: #10b981; color: white; padding: 0.5rem 0.75rem; font-size: 0.8rem;" onclick="return confirm('Proses pengembalian buku?')"><i class="fas fa-check"></i> Kembalikan</a>
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

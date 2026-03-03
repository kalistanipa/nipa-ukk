<?php
include 'header.php';
include 'config/database.php';
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2 style="margin-bottom: 0; display: flex; align-items: center; gap: 0.75rem;">
            <img src="assets/images/logo-lib.svg" alt="Logo" style="width: 45px; height: 45px; filter: drop-shadow(0 4px 3px rgb(0 0 0 / 0.07));">
            Data Peminjaman
        </h2>
        <a href="tambah_peminjaman.php" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Peminjaman</a>
    </div>

    <?php
if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == "tambah_sukses") {
        echo '<div class="alert" style="background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;">Transaksi peminjaman berhasil ditambahkan.</div>';
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
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Tanggal Kembali</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Status</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Jumlah Buku</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
$no = 1;
$data = mysqli_query($koneksi, "SELECT peminjaman.*, anggota.nama_lengkap, 
                        (SELECT count(id_detail) FROM detail_peminjaman WHERE id_peminjaman=peminjaman.id_peminjaman) as jumlah_buku 
                        FROM peminjaman, anggota 
                        WHERE peminjaman.id_anggota=anggota.id_anggota 
                        AND status_peminjaman='dipinjam'
                        ORDER BY id_peminjaman DESC");
while ($d = mysqli_fetch_array($data)) {
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
                            <span style="background-color: #fef3c7; color: #d97706; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.875rem; font-weight: 500;">
                                <?php echo ucfirst($d['status_peminjaman']); ?>
                            </span>
                        </td>
                        <td style="padding: 1rem; text-align: center;"><?php echo $d['jumlah_buku']; ?></td>
                        <td style="padding: 1rem;">
                            <!-- <a href="detail_peminjaman.php?id=<?php echo $d['id_peminjaman']; ?>" class="btn" style="background-color: #3b82f6; color: white; padding: 0.5rem 0.75rem; font-size: 0.8rem;"><i class="fas fa-eye"></i></a> -->
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

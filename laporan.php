<?php
include 'header.php';
include 'config/database.php';
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2 style="margin-bottom: 0;">Laporan Peminjaman</h2>
        <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print"></i> Cetak Laporan</button>
    </div>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
            <thead>
                <tr style="background-color: #f8fafc; text-align: left;">
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">No</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Nama Peminjam</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Tanggal Pinjam</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Tanggal Kembali</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Status</th>
                    <th style="padding: 1rem; border-bottom: 2px solid var(--border-color);">Buku</th>
                </tr>
            </thead>
            <tbody>
                <?php
$no = 1;
$data = mysqli_query($koneksi, "SELECT peminjaman.*, anggota.nama_lengkap, buku.judul_buku 
                        FROM peminjaman 
                        JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota
                        JOIN detail_peminjaman ON peminjaman.id_peminjaman = detail_peminjaman.id_peminjaman
                        JOIN buku ON detail_peminjaman.id_buku = buku.id_buku
                        ORDER BY id_peminjaman DESC");
while ($d = mysqli_fetch_array($data)) {
?>
                    <tr style="border-bottom: 1px solid var(--border-color);">
                        <td style="padding: 1rem;"><?php echo $no++; ?></td>
                        <td style="padding: 1rem;"><?php echo $d['nama_lengkap']; ?></td>
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
?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'footer.php'; ?>

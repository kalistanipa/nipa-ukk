<?php

include 'header.php';
include 'config/database.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM anggota WHERE id_anggota='$id'");
while ($d = mysqli_fetch_array($data)) {
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2 class="mb-4">Edit Data Anggota</h2>
    
    <form action="proses_edit_anggota.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $d['id_anggota']; ?>">
        
        <div class="form-group">
            <label class="form-label">NIS (Nomor Induk Siswa)</label>
            <input type="text" name="nis" class="form-control" required value="<?php echo $d['nis']; ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required value="<?php echo $d['nama_lengkap']; ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Kelas</label>
            <select name="kelas" class="form-control" required>
                <option value="">-- Pilih Kelas --</option>
                <option value="X" <?php if ($d['kelas'] == "X")
        echo "selected"; ?>>X</option>
                <option value="XI" <?php if ($d['kelas'] == "XI")
        echo "selected"; ?>>XI</option>
                <option value="XII" <?php if ($d['kelas'] == "XII")
        echo "selected"; ?>>XII</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Jurusan</label>
            <select name="jurusan" class="form-control" required>
                <option value="">-- Pilih Jurusan --</option>
                <option value="RPL" <?php if ($d['jurusan'] == "RPL")
        echo "selected"; ?>>Rekayasa Perangkat Lunak</option>
                <option value="TKJ" <?php if ($d['jurusan'] == "TKJ")
        echo "selected"; ?>>Teknik Komputer dan Jaringan</option>
                <option value="MM" <?php if ($d['jurusan'] == "MM")
        echo "selected"; ?>>Multimedia</option>
                <option value="AK" <?php if ($d['jurusan'] == "AK")
        echo "selected"; ?>>Akuntansi</option>
                <option value="AP" <?php if ($d['jurusan'] == "AP")
        echo "selected"; ?>>Administrasi Perkantoran</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" required rows="3"><?php echo $d['alamat']; ?></textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Password <small>(Kosongkan jika tidak ingin mengubah password)</small></label>
            <input type="password" name="password" class="form-control" placeholder="Password Baru">
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Update Data</button>
            <a href="anggota.php" class="btn" style="background-color: var(--secondary-color); color: white; margin-left: 0.5rem;">Batal</a>
        </div>
    </form>
</div>

<?php

}
include 'footer.php';
?>

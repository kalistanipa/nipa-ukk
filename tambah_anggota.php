<?php include 'header.php'; ?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2 class="mb-4">Tambah Anggota Baru</h2>
    
    <form action="proses_tambah_anggota.php" method="POST">
        <div class="form-group">
            <label class="form-label">NIS (Nomor Induk Siswa)</label>
            <input type="text" name="nis" class="form-control" required placeholder="Masukkan NIS">
        </div>

        <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required placeholder="Masukkan Nama Lengkap">
        </div>

        <div class="form-group">
            <label class="form-label">Kelas</label>
            <select name="kelas" class="form-control" required>
                <option value="">-- Pilih Kelas --</option>
                <option value="X">X</option>
                <option value="XI">XI</option>
                <option value="XII">XII</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Jurusan</label>
            <select name="jurusan" class="form-control" required>
                <option value="">-- Pilih Jurusan --</option>
                <option value="RPL">Rekayasa Perangkat Lunak</option>
                <option value="TKJ">Teknik Komputer dan Jaringan</option>
                <option value="MM">Multimedia</option>
                <option value="AK">Akuntansi</option>
                <option value="AP">Administrasi Perkantoran</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" required rows="3" placeholder="Masukkan Alamat Lengkap"></textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required placeholder="Password untuk Login">
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan Data</button>
            <a href="anggota.php" class="btn" style="background-color: var(--secondary-color); color: white; margin-left: 0.5rem;">Batal</a>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>

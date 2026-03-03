<?php include 'header.php'; ?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2 class="mb-4">Tambah User Baru</h2>
    
    <form action="proses_tambah_user.php" method="POST">
        <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required placeholder="Masukkan Nama Lengkap">
        </div>

        <div class="form-group">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required placeholder="Masukkan Username">
        </div>

        <div class="form-group">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required placeholder="Masukkan Password">
        </div>

        <div class="form-group">
            <label class="form-label">Level</label>
            <select name="level" class="form-control" required>
                <option value="">-- Pilih Level --</option>
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
            </select>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan User</button>
            <a href="user.php" class="btn" style="background-color: var(--secondary-color); color: white; margin-left: 0.5rem;">Batal</a>
        </div>
    </form>
</div>

<?php include 'footer.php'; ?>

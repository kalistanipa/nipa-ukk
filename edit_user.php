<?php

include 'header.php';
include 'config/database.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user='$id'");
while ($d = mysqli_fetch_array($data)) {
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2 class="mb-4">Edit Data User</h2>
    
    <form action="proses_edit_user.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $d['id_user']; ?>">
        
        <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" required value="<?php echo $d['nama_lengkap']; ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required value="<?php echo $d['username']; ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Password <small>(Kosongkan jika tidak ingin mengubah password)</small></label>
            <input type="password" name="password" class="form-control" placeholder="Password Baru">
        </div>

        <div class="form-group">
            <label class="form-label">Level</label>
            <select name="level" class="form-control" required>
                <option value="admin" <?php if ($d['level'] == "admin")
        echo "selected"; ?>>Admin</option>
                <option value="petugas" <?php if ($d['level'] == "petugas")
        echo "selected"; ?>>Petugas</option>
            </select>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Update User</button>
            <a href="user.php" class="btn" style="background-color: var(--secondary-color); color: white; margin-left: 0.5rem;">Batal</a>
        </div>
    </form>
</div>

<?php

}
include 'footer.php';
?>

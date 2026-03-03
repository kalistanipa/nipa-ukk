<?php
include 'config/database.php';

echo "Database connection verified.\n";

// Check Admin
$query_admin = mysqli_query($koneksi, "SELECT * FROM users LIMIT 1");
if ($row = mysqli_fetch_assoc($query_admin)) {
    echo "Admin User Found: " . $row['username'] . " (Hash: " . $row['password'] . ")\n";
}
else {
    echo "No Admin found.\n";
}

// Check Anggota
$query_anggota = mysqli_query($koneksi, "SELECT * FROM anggota LIMIT 1");
if ($row = mysqli_fetch_assoc($query_anggota)) {
    echo "Anggota Found: " . $row['nis'] . " (Hash: " . $row['password'] . ")\n";
}
else {
    echo "No Anggota found.\n";
}
?>

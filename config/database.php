<?php
$host = getenv("DB_HOST") ?: "localhost";
$user = getenv("DB_USER") ?: "root";
$pass = getenv("DB_PASS") !== false ? getenv("DB_PASS") : "";
$db = getenv("DB_NAME") ?: "peminjaman_buku";
$port = getenv("DB_PORT") ?: 3306;
$ssl = getenv("DB_SSL") === "true";

$koneksi = mysqli_init();

if ($ssl) {
    mysqli_ssl_set($koneksi, NULL, NULL, NULL, NULL, NULL);
    mysqli_real_connect($koneksi, $host, $user, $pass, $db, (int)$port, NULL, MYSQLI_CLIENT_SSL);
}
else {
    mysqli_real_connect($koneksi, $host, $user, $pass, $db, (int)$port);
}

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

<?php
$koneksi = mysqli_init();

$database_url = getenv("DATABASE_URL");
if ($database_url) {
    $parsed_url = parse_url($database_url);
    $host = $parsed_url["host"] ?? "localhost";
    $user = $parsed_url["user"] ?? "root";
    $pass = $parsed_url["pass"] ?? "";
    $port = $parsed_url["port"] ?? 3306;
    $db = isset($parsed_url["path"]) ? ltrim($parsed_url["path"], "/") : "peminjaman_buku";
    $ssl = true; // URL mode generally means cloud DB with SSL
}
else {
    $host = getenv("DB_HOST") ?: "localhost";
    $user = getenv("DB_USER") ?: "root";
    $pass = getenv("DB_PASS") !== false ? getenv("DB_PASS") : "";
    $db = getenv("DB_NAME") ?: "peminjaman_buku";
    $port = (int)(getenv("DB_PORT") ?: 3306);
    $ssl = getenv("DB_SSL") === "true";
}

// Aiven MySQL biasanya memerlukan SSL
if ($ssl) {
    mysqli_options($koneksi, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);
    mysqli_ssl_set($koneksi, NULL, NULL, NULL, NULL, NULL);
    mysqli_real_connect($koneksi, $host, $user, $pass, $db, (int)$port, NULL, MYSQLI_CLIENT_SSL);
}
else {
    mysqli_real_connect($koneksi, $host, $user, $pass, $db, (int)$port);
}

if (!$koneksi) {
    die("Koneksi gagal ke $host: " . mysqli_connect_error());
}
?>

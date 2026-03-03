<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:login.php?pesan=belum_login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Perpustakaan</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .navbar {
            background: var(--surface-color);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .nav-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        .nav-logo a {
            text-decoration: none;
            color: inherit;
        }
        .nav-user {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .main-content {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-logo">
            <a href="index.php"><i class="fas fa-book-reader"></i> Perpus Digital</a>
        </div>
        <div class="nav-user">
            <span>Halo, <b><?php echo $_SESSION['nama']; ?></b> (<?php echo ucfirst($_SESSION['level']); ?>)</span>
            <a href="logout.php" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">Logout</a>
        </div>
    </nav>
    <div class="main-content">

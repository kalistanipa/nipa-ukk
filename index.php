<?php
session_start();
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
    <title>Dashboard - Perpus Digital</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Font Awesome -->
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
        .welcome-card {
            background: linear-gradient(135deg, var(--primary-color), #7c3aed);
            color: white;
            padding: 2rem;
            border-radius: 1rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-lg);
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        .stat-card {
            background: var(--surface-color);
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-icon {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }
        .icon-blue { background-color: #3b82f6; }
        .icon-green { background-color: #10b981; }
        .icon-orange { background-color: #f59e0b; }
        .icon-purple { background-color: #8b5cf6; }
        
        .stat-info h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        .stat-info p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        .menu-card {
            background: var(--surface-color);
            padding: 2rem;
            border-radius: 1rem;
            text-align: center;
            box-shadow: var(--shadow);
            text-decoration: none;
            color: var(--text-color);
            transition: all 0.3s;
            border: 1px solid transparent;
        }
        .menu-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        .menu-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        .menu-title {
            font-weight: 600;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="nav-logo">
            <i class="fas fa-book-reader"></i> Perpus Digital
        </div>
        <div class="nav-user">
            <span>Halo, <b><?php echo $_SESSION['nama']; ?></b> (<?php echo ucfirst($_SESSION['level']); ?>)</span>
            <a href="logout.php" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.875rem;">Logout</a>
        </div>
    </nav>

    <div class="main-content">
        <div class="welcome-card">
            <h1>Selamat Datang di Sistem Informasi Perpustakaan</h1>
            <p style="opacity: 0.9; margin-top: 0.5rem;">Kelola peminjaman buku dan anggota dengan mudah dan efisien.</p>
        </div>

        <?php
include 'config/database.php';

if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas'):
    // Fetch stats for Admin/Petugas
    $count_anggota = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM anggota"));
    $count_buku = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM buku"));

    // Count total books currently borrowed (not just sessions)
    $q_pinjam = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM detail_peminjaman 
                                       JOIN peminjaman ON detail_peminjaman.id_peminjaman = peminjaman.id_peminjaman 
                                       WHERE peminjaman.status_peminjaman='dipinjam'");
    $count_pinjam = mysqli_fetch_assoc($q_pinjam)['total'];

    // Count total books ever borrowed (total transactions)
    $q_transaksi = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM detail_peminjaman");
    $count_transaksi = mysqli_fetch_assoc($q_transaksi)['total'];
?>
            <!-- Admin Dashboard -->
             <h2 class="mb-4">Statistik Perpustakaan</h2>
            <div class="stats-grid">
                <a href="anggota.php" class="stat-card" style="text-decoration: none; color: inherit;">
                    <div class="stat-icon icon-blue">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $count_anggota; ?></h3>
                        <p>Total Anggota</p>
                    </div>
                </a>
                <a href="buku.php" class="stat-card" style="text-decoration: none; color: inherit;">
                    <div class="stat-icon icon-purple">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $count_buku; ?></h3>
                        <p>Total Judul Buku</p>
                    </div>
                </a>
                <a href="peminjaman.php" class="stat-card" style="text-decoration: none; color: inherit;">
                    <div class="stat-icon icon-orange">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $count_pinjam; ?></h3>
                        <p>Sedang Dipinjam</p>
                    </div>
                </a>
                <a href="laporan.php" class="stat-card" style="text-decoration: none; color: inherit;">
                    <div class="stat-icon icon-green">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $count_transaksi; ?></h3>
                        <p>Total Transaksi</p>
                    </div>
                </a>
            </div>

            <h2 class="mb-4 mt-4">Menu Utama</h2>
            <div class="menu-grid">
                <a href="anggota.php" class="menu-card">
                    <div class="menu-icon"><i class="fas fa-users-cog"></i></div>
                    <div class="menu-title">Data Anggota</div>
                </a>
                <a href="buku.php" class="menu-card">
                    <div class="menu-icon"><i class="fas fa-swatchbook"></i></div>
                    <div class="menu-title">Data Buku</div>
                </a>
                <a href="peminjaman.php" class="menu-card">
                    <div class="menu-icon">
                        <img src="assets/images/logo-lib.svg" alt="Peminjaman" style="width: 60px; height: 60px; filter: drop-shadow(0 2px 2px rgb(0 0 0 / 0.1));">
                    </div>
                    <div class="menu-title">Peminjaman</div>
                </a>
                <a href="pengembalian.php" class="menu-card">
                    <div class="menu-icon"><i class="fas fa-undo-alt"></i></div>
                    <div class="menu-title">Pengembalian</div>
                </a>
                <a href="laporan.php" class="menu-card">
                    <div class="menu-icon"><i class="fas fa-file-invoice"></i></div>
                    <div class="menu-title">Laporan</div>
                </a>
                <a href="user.php" class="menu-card">
                    <div class="menu-icon"><i class="fas fa-user-shield"></i></div>
                    <div class="menu-title">Manajemen User</div>
                </a>
            </div>

        <?php
else:
    // Fetch stats for Member
    $id_anggota = $_SESSION['id_anggota'];

    // Count books currently borrowed by this member
    $q_user_pinjam = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM detail_peminjaman 
                                            JOIN peminjaman ON detail_peminjaman.id_peminjaman = peminjaman.id_peminjaman 
                                            WHERE peminjaman.id_anggota='$id_anggota' AND peminjaman.status_peminjaman='dipinjam'");
    $count_user_pinjam = mysqli_fetch_assoc($q_user_pinjam)['total'];

    // Count total books in history for this member
    $q_user_riwayat = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM detail_peminjaman 
                                             JOIN peminjaman ON detail_peminjaman.id_peminjaman = peminjaman.id_peminjaman 
                                             WHERE peminjaman.id_anggota='$id_anggota'");
    $count_user_riwayat = mysqli_fetch_assoc($q_user_riwayat)['total'];
?>
            <!-- Member Dashboard -->
            <div class="stats-grid">
                <a href="peminjaman.php" class="stat-card" style="text-decoration: none; color: inherit;">
                    <div class="stat-icon icon-orange">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $count_user_pinjam; ?></h3>
                        <p>Buku Dipinjam</p>
                    </div>
                </a>
                <a href="riwayat.php" class="stat-card" style="text-decoration: none; color: inherit;">
                    <div class="stat-icon icon-green">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $count_user_riwayat; ?></h3>
                        <p>Riwayat Peminjaman</p>
                    </div>
                </a>
            </div>

             <h2 class="mb-4 mt-4">Menu Anggota</h2>
            <div class="menu-grid">
                <a href="buku.php" class="menu-card">
                    <div class="menu-icon"><i class="fas fa-search"></i></div>
                    <div class="menu-title">Cari Buku</div>
                </a>
                <a href="riwayat.php" class="menu-card">
                    <div class="menu-icon">
                        <img src="assets/images/logo-lib.svg" alt="Riwayat" style="width: 60px; height: 60px; filter: drop-shadow(0 2px 2px rgb(0 0 0 / 0.1));">
                    </div>
                    <div class="menu-title">Riwayat Peminjaman</div>
                </a>
                <a href="kartu.php" class="menu-card">
                    <div class="menu-icon"><i class="fas fa-id-card"></i></div>
                    <div class="menu-title">Kartu Anggota</div>
                </a>
            </div>
        <?php
endif; ?>
    </div>
</body>
</html>

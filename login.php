<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpus Digital</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
            <div class="glass-card">
                <div class="login-header">
                    <h1>Perpus Digital</h1>
                    <p>Login untuk melanjutkan</p>
                </div>
                
                <?php if (isset($_GET['pesan'])): ?>
                    <?php if ($_GET['pesan'] == 'gagal'): ?>
                        <div class="alert alert-danger">Username atau Password salah!</div>
                    <?php
    elseif ($_GET['pesan'] == 'logout'): ?>
                        <div class="alert alert-success" style="background-color: #d1fae5; color: #065f46; border-color: #a7f3d0;">Anda telah berhasil logout.</div>
                    <?php
    elseif ($_GET['pesan'] == 'belum_login'): ?>
                        <div class="alert alert-warning" style="background-color: #fef3c7; color: #92400e; border-color: #fde68a;">Silakan login terlebih dahulu.</div>
                    <?php
    endif; ?>
                <?php
endif; ?>

                <form action="auth.php" method="POST">
                    <div class="form-group">
                        <label for="username" class="form-label">Username / NIS</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan Username atau NIS" required autofocus>
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                    
                    <div class="mt-4 text-center">
                        <a href="#" style="font-size: 0.9rem;">Lupa password?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
